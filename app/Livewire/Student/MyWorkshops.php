<?php

namespace App\Livewire\Student;

use Livewire\Component;

class MyWorkshops extends Component
{
    public function confirmCancel($registrationId)
    {
        $this->dispatch('swal:confirm', [[
            'title' => 'ยืนยันการยกเลิก',
            'text' => 'คุณแน่ใจหรือไม่ที่จะยกเลิกการลงทะเบียน? หากยกเลิกแล้วอาจเสียที่นั่งให้ผู้อื่นได้',
            'icon' => 'warning',
            'confirmText' => 'ใช่, ยกเลิกการลงทะเบียน',
            'cancelText' => 'ไม่, ย้อนกลับ',
            'method' => 'executeCancel',
            'params' => $registrationId
        ]]);
    }

    #[\Livewire\Attributes\On('executeCancel')]
    public function cancelRegistration($registrationId)
    {
        $registration = auth()->user()->registrations()->find($registrationId);
        
        if ($registration) {
            $registration->delete();
            $this->dispatch('swal:alert', [[
                'title' => 'ยกเลิกสำเร็จ',
                'text' => 'ยกเลิกการลงทะเบียนเรียบร้อยแล้ว',
                'icon' => 'success'
            ]]);
        }
    }

    public function render()
    {
        $registrations = auth()->user()->registrations()->with('workshop')->latest()->get();

        return view('livewire.student.my-workshops', [
            'registrations' => $registrations
        ])->layout('layouts.app');
    }
}
