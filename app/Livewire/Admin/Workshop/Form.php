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
