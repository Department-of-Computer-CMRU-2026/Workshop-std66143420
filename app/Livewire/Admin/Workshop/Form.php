<?php

namespace App\Livewire\Admin\Workshop;

use App\Models\Workshop;
use Livewire\Component;

class Form extends Component
{
    public ?Workshop $workshop = null;

    public $title = '';
    public $description = '';
    public $speaker_name = '';
    public $capacity = 50;
    public $start_time = '';
    public $end_time = '';
    public $location = '';

    public function mount(?Workshop $workshop = null)
    {
        if ($workshop && $workshop->exists) {
            $this->workshop = $workshop;
            $this->title = $workshop->title;
            $this->description = $workshop->description;
            $this->speaker_name = $workshop->speaker_name;
            $this->capacity = $workshop->capacity;
            
            // Format for datetime-local input (YYYY-MM-DDThh:mm)
            $this->start_time = $workshop->start_time?->format('Y-m-d\TH:i');
            $this->end_time = $workshop->end_time?->format('Y-m-d\TH:i');
            $this->location = $workshop->location;
        }
    }

    public function rules()
    {
        return [
            'title' => 'required|string|max:255',
            'description' => 'required|string',
            'speaker_name' => 'required|string|max:255',
            'capacity' => 'required|integer|min:1',
            'start_time' => 'required|date',
            'end_time' => 'required|date|after:start_time',
            'location' => 'required|string|max:255',
        ];
    }

    public function confirmSave()
    {
        $this->validate();

        $action = $this->workshop && $this->workshop->exists ? 'แก้ไข' : 'เพิ่ม';
        $title = $this->workshop && $this->workshop->exists ? 'ยืนยันการแก้ไขข้อมูล' : 'ยืนยันการเพิ่มเวิร์กชอปใหม่';

        $this->dispatch('swal:confirm', [[
            'title' => $title,
            'text' => "คุณต้องการ{$action}ข้อมูลหัวข้อนี้ใช่หรือไม่?",
            'icon' => 'question',
            'confirmText' => "ใช่, {$action}ข้อมูล",
            'cancelText' => 'ยกเลิก',
            'method' => 'executeSave'
        ]]);
    }

    #[\Livewire\Attributes\On('executeSave')]
    public function save()
    {
        $validatedData = $this->validate();

        if ($this->workshop && $this->workshop->exists) {
            $this->workshop->update($validatedData);
        } else {
            Workshop::create($validatedData);
        }

        $this->redirectRoute('admin.workshops.index', navigate: true);
    }

    public function render()
    {
        return view('livewire.admin.workshop.form');
    }
}
