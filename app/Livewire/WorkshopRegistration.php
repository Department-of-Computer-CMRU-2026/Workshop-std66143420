<?php

namespace App\Livewire;

use App\Models\Registration;
use App\Models\Workshop;
use Livewire\Component;
use Livewire\Attributes\Validate;

class WorkshopRegistration extends Component
{
    public Workshop $workshop;

    #[Validate('required|string|min:8|max:20')]
    public $student_id = '';

    #[Validate('required|string|min:3|max:100')]
    public $student_name = '';

    public $successMessage = '';
    public $errorMessage = '';

    public function mount(Workshop $workshop)
    {
        $this->workshop = $workshop;
        
        if (auth()->check()) {
            $user = auth()->user();
            $this->student_id = $user->student_id ?? '';
            $this->student_name = $user->name ?? '';
        }
    }

    public function confirmSave()
    {
        // Require login
        if (!auth()->check()) {
            return redirect()->route('login');
        }

        $this->validate();

        // ตรวจสอบเงื่อนไขเบื้องต้นก่อนกดยืนยัน
        if ($this->workshop->isFull()) {
            $this->dispatch('swal:alert', [[
                'title' => 'ที่นั่งเต็มแล้ว',
                'text' => 'ขออภัยครับ ที่นั่งสำหรับหัวข้อนี้เต็มแล้ว',
                'icon' => 'error'
            ]]);
            return;
        }

        $this->dispatch('swal:confirm', [[
            'title' => 'ยืนยันการลงทะเบียน',
            'text' => 'คุณต้องการลงทะเบียนเข้าร่วมหัวข้อ "' . $this->workshop->title . '" ใช่หรือไม่?',
            'icon' => 'question',
            'confirmText' => 'ยืนยันการลงทะเบียน',
            'cancelText' => 'ยกเลิก',
            'method' => 'executeSave'
        ]]);
    }

    #[\Livewire\Attributes\On('executeSave')]
    public function save()
    {
        if (!auth()->check()) return;

        // 0. ตรวจสอบโควตา (ห้ามเกิน 3 หัวข้อ)
        $userRegistrationsCount = auth()->user()->registrations()->count();
        if ($userRegistrationsCount >= 3) {
            $this->dispatch('swal:alert', [[
                'title' => 'ลงทะเบียนครบโควตาจัดสรร',
                'text' => 'ขออภัย คุณไม่สามารถลงทะเบียนได้เนื่องจากคุณลงทะเบียนครบกำหนด 3 หัวข้อแล้ว',
                'icon' => 'warning'
            ]]);
            return;
        }

        // 1. ตรวจสอบที่นั่งว่าง
        if ($this->workshop->isFull()) {
            $this->dispatch('swal:alert', [[
                'title' => 'ที่นั่งเต็มแล้ว',
                'text' => 'ขออภัยครับ ที่นั่งสำหรับหัวข้อนี้เต็มแล้ว',
                'icon' => 'error'
            ]]);
            return;
        }

        // 2. ตรวจสอบการลงทะเบียนซ้ำ
        $exists = Registration::where('workshop_id', $this->workshop->id)
            ->where('user_id', auth()->id())
            ->exists();

        if ($exists) {
            $this->dispatch('swal:alert', [[
                'title' => 'ลงทะเบียนซ้ำ',
                'text' => 'คุณได้ลงทะเบียนในหัวข้อนี้ไปแล้วครับ',
                'icon' => 'warning'
            ]]);
            return;
        }

        // 3. บันทึกข้อมูล
        Registration::create([
            'workshop_id' => $this->workshop->id,
            'student_id' => $this->student_id,
            'student_name' => $this->student_name,
            'user_id' => auth()->id(),
        ]);

        $this->dispatch('swal:alert', [[
            'title' => 'ลงทะเบียนสำเร็จ!',
            'text' => 'แล้วพบกันในวันงานนะครับ',
            'icon' => 'success'
        ]]);
        
        // Refresh workshop data to update count
        $this->workshop->load('registrations');
    }

    public function render()
    {
        return view('livewire.workshop-registration')
            ->layout('layouts.workshop');
    }
}
