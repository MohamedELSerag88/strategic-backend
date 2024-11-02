<?php

namespace App\Jobs;


use Illuminate\Support\Facades\Mail;

class SendMail extends BaseJob
{


    /**
     * Create a new job instance.
     */
    public function __construct($data)
    {
        //
        parent::__construct($data);
    }

    /**
     * Execute the job.
     */
    public function handle(): void
    {
        Mail::send($this->data['view'], $this->data['data'], function ($email) {
            if(isset($this->data['email_to']))
                $email->to($this->data['email_to']);
            if(isset($this->data['email_cc']))
                $email->cc($this->data['email_cc']);
            if(isset($this->data['email_bcc']))
                $email->bcc($this->data['email_bcc']);

            $sender_name = isset($this->data['sender_name']) && !empty($this->data['sender_name'])? $this->data['sender_name']: config('mail.from.name');
            $sender_email = isset($this->data['sender_email']) && !empty($this->data['sender_email'])? $this->data['sender_email']: config('mail.from.address');
            $email->from($sender_email, $sender_name);
            $email->subject($this->data['subject']);

            if(!empty($this->data['file'])) {
                foreach ($this->data['file'] as $filePath) {
                    if(!empty($filePath)){
                        $email->attach($filePath);
                    }
                }
            }
        });
    }
}
