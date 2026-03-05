<?php

namespace App\Livewire\Student;

use Livewire\Component;

class MyWorkshops extends Component
{
    public function cancelRegistration($registrationId)
    {
        $registration = auth()->user()->registrations()->find($registrationId);
        
        if ($registration) {
            $registration->delete();
            session()->flash('success', 'ยกเลิกการลงทะเบียนเสร็จสิ้น');
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
