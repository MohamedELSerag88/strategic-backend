<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\ConsultationRequest>
 */
class ConsultationRequestFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            'name' => $this->faker->name(),
            'job_position' => $this->faker->randomElement(explode(",","رئیس مجلس إدارة, مدیر عام, مدیر تنفیذي, مدیر إدارة, مؤسس, آخر")),
            'email' => $this->faker->unique()->safeEmail(),
            'phone' => $this->faker->phoneNumber(),
            'org_type' => $this->faker->randomElement(explode(",","حكومیة, خاصة, حزبیة, خیریة, نفع عام")),
            'org_status' => $this->faker->randomElement(explode(",","قائمة, تحت التأسیس, مشروع جدید")),
            'org_name' => $this->faker->company(),
            'establishment_date' => $this->faker->date(),
            'ownership_type' => $this->faker->randomElement(explode(",","رئیس مجلس إدارة, مدیر عام, مدیر تنفیذي, مدیر إدارة, مؤسس, آخر")),
            'means_type' => $this->faker->randomElement(explode(",","قناة تلفزیونیة, إذاعة مسموعة, موقع إلكتروني, منصات تواصل اجتماعي, متعددة")),
            'headquarter_country' => $this->faker->country(),
            'employees_number' =>$this->faker->randomElement(explode(",","أقل من ,٥٠ ,١٠٠-٥٠ ,٢٠٠-١٠١ ,٥٠٠-٢٠١ ,١٠٠٠-٥٠١ ,٢٠٠٠-١٠٠١ أكثر من ٢٠٠٠")),
            'external_offices_number' =>$this->faker->randomElement(explode(",","لا یوجد, ,٥-١ ,١٠-٦ ,٢٠-١١ أكثر من ٢٠")),
            'annual_budget' =>$this->faker->randomElement(explode(",","أقـل مـن مـلیون,$ ٥-١ مـلیون,$ ١٠-٦ مـلیون,$ ٢٠-١١ مـلیون,$ ٥٠-٢١ مـلیون,$
١٠٠-٥١ ملیون,$ ٢٠٠-١٠١ ملیون, ٥٠٠-٢٠١ ملیون,$ أكثر من ٥٠٠ ملیون$")),
            'suffers_area' => $this->faker->randomElement(explode(",","تحریریة, إداریة, مالیة, تسویقیة, أخرى")),
            'notes' => $this->faker->paragraph(),
        ];
    }
}
