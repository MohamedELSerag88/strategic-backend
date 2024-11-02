<?php
namespace App\Jobs;

use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Support\Facades\Mail;

abstract class BaseJob extends Job implements ShouldQueue
{
    /**
     * Data array hosting the job's data.
     *
     * @var array
     */
    protected $data;
    /**
     * Create a new job instance.
     *
     * @param array $data
     * @return void
     */
    public function __construct($data)
    {
        $this->data = $data;
    }
    /**
     * Gets the job's data in an array.</br>
     * If a key is specified, and it exists in the array, its value is returned, otherwise the default value is.
     *
     * @param $key string
     * @param $default mixed
     * @return mixed
     */
    public function getData($key = null, $default = null)
    {
        if (is_null($key)) {
            return $this->data;
        } else if (isset($this->data[$key])) {
            return $this->data[$key];
        }
        return $default;
    }
    /**
     * Queues the provided media path for syncing with other API nodes.
     *
     * @param string $paths
     */
    protected function queueMediaForSyncing($paths)
    {
        $mediaSync = $this->getMediaSync();
        $mediaSync->syncMedia($paths);
    }
    protected function sendReportMail($blade, $params)
    {
        $exportUrlAsAttachment = env('EXPORT_URL_AS_ATTACHMENT', false) && (!filter_var($params['url'], FILTER_VALIDATE_URL));

        $params['exportUrlAsAttachment'] = $exportUrlAsAttachment;
        Mail::send($blade, $params, function ($email) use ($exportUrlAsAttachment, $params) {
            if (isset($this->data['email_to']) && !empty($this->data['email_to'])) {
                $email->to($this->data['email_to']);
            }
            if (isset($this->data['email_cc']) && !empty($this->data['email_cc'])) {
                $email->cc($this->data['email_cc']);
            }
            if (isset($this->data['email_bcc']) && !empty($this->data['email_bcc'])) {
                $email->bcc($this->data['email_bcc']);
            }
            $email->subject($this->data['subject']);
            if ($exportUrlAsAttachment)
                $email->attach($params['url']);
        });
    }
}
