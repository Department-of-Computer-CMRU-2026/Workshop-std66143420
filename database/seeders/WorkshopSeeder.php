<?php

namespace Database\Seeders;

use App\Models\Workshop;
use Illuminate\Database\Seeder;

class WorkshopSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $workshops = [
            [
                'title' => 'Web Development with Laravel & Livewire',
                'description' => 'มาเรียนรู้วิธีการสร้างเว็บแอปพลิเคชันที่ทันสมัยด้วย Laravel 12 และ Livewire 4 สำหรับนักพัฒนามือใหม่',
                'speaker_name' => 'รุ่นพี่ สมชาย (Senior Dev)',
                'capacity' => 20,
                'start_time' => now()->addDays(7)->setTime(13, 0),
                'end_time' => now()->addDays(7)->setTime(16, 0),
                'location' => 'ห้องปฏิบัติการคอมพิวเตอร์ 1',
            ],
            [
                'title' => 'Introduction to Docker & Containers',
                'description' => 'ทำความรู้จักกับ Docker การสร้าง Image และการใช้ Compose สำหรับโปรเจกต์ของคุณ',
                'speaker_name' => 'รุ่นพี่ สมหญิง (DevOps Engineer)',
                'capacity' => 15,
                'start_time' => now()->addDays(8)->setTime(9, 0),
                'end_time' => now()->addDays(8)->setTime(12, 0),
                'location' => 'ห้องประชุม IT 2',
            ],
            [
                'title' => 'UI/UX Design for Web Applications',
                'description' => 'พื้นฐานการออกแบบ UI ที่สวยงามและ UX ที่ใช้งานง่ายสำหรับแอปพลิเคชันสมัยใหม่',
                'speaker_name' => 'รุ่นพี่ มานะ (UX Designer)',
                'capacity' => 10,
                'start_time' => now()->addDays(9)->setTime(14, 0),
                'end_time' => now()->addDays(9)->setTime(17, 0),
                'location' => 'ห้องเรียนออนไลน์ (Discord)',
            ],
        ];

        foreach ($workshops as $workshop) {
            Workshop::create($workshop);
        }
    }
}
