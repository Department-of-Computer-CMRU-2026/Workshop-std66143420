<?php

namespace App\Livewire\Admin\Workshop;

use App\Models\Workshop;
use Livewire\Component;
use Livewire\WithPagination;

class Registrants extends Component
{
    use WithPagination;

    public Workshop $workshop;
    public $search = '';

    public function mount(Workshop $workshop)
    {
        $this->workshop = $workshop;
    }

    public function updatingSearch()
    {
        $this->resetPage();
    }

    public function render()
    {
        $registrants = $this->workshop->registrations()
            ->when($this->search, function ($query) {
                $query->where(function ($query) {
                    $query->where('student_id', 'like', '%' . $this->search . '%')
                          ->orWhere('student_name', 'like', '%' . $this->search . '%');
                });
            })
            ->latest()
            ->paginate(15);

        return view('livewire.admin.workshop.registrants', [
            'registrants' => $registrants,
        ]);
    }
}
