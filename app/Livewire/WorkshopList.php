<?php

namespace App\Livewire;

use App\Models\Workshop;
use Livewire\Component;

class WorkshopList extends Component
{
    public function render()
    {
        return view('livewire.workshop-list', [
            'workshops' => Workshop::withCount('registrations')->get(),
        ])->layout('layouts.workshop');
    }
}
