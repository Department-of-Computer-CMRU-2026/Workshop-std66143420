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

    public function save()
    {
        // Require login
        if (!auth()->check()) {
            return redirect()->route('login');
        }

        $this->validate();

        // 0. ตรวจสอบโควตา (ห้ามเกิน 3 หัวข้อ)
        $userRegistrationsCount = auth()->user()->registrations()->count();
        if ($userRegistrationsCount >= 3) {
            $this->errorMessage = 'ขออภัย คุณไม่สามารถลงทะเบียนได้เนื่องจากคุณลงทะเบียนครบกำหนด 3 หัวข้อแล้ว';
            return;
        }

        // 1. ตรวจสอบที่นั่งว่าง
        if ($this->workshop->isFull()) {
            $this->errorMessage = 'ขออภัยครับ ที่นั่งสำหรับหัวข้อนี้เต็มแล้ว';
            return;
        }

        // 2. ตรวจสอบการลงทะเบียนซ้ำ
        $exists = Registration::where('workshop_id', $this->workshop->id)
            ->where('user_id', auth()->id())
            ->exists();

        if ($exists) {
            $this->errorMessage = 'คุณได้ลงทะเบียนในหัวข้อนี้ไปแล้วครับ';
            return;
        }

        // 3. บันทึกข้อมูล
        Registration::create([
            'workshop_id' => $this->workshop->id,
            'student_id' => $this->student_id,
            'student_name' => $this->student_name,
            'user_id' => auth()->id(),
        ]);

        $this->successMessage = 'ลงทะเบียนสำเร็จ! แล้วพบกันในวันงานนะครับ';
        
        // Refresh workshop data to update count
        $this->workshop->load('registrations');
    }

    public function render()
    {
        return view('livewire.workshop-registration')
            ->layout('layouts.workshop');
    }
}
