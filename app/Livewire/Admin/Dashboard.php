<?php

namespace App\Livewire\Admin;

use App\Models\Registration;
use App\Models\Workshop;
use Livewire\Component;

class Dashboard extends Component
{
    public function render()
    {
        $workshops = Workshop::withCount('registrations')->get();
        
        $totalWorkshops = $workshops->count();
        $totalRegistrations = Registration::count();
        $totalCapacity = $workshops->sum('capacity');
        
        $occupancyRate = $totalCapacity > 0 ? round(($totalRegistrations / $totalCapacity) * 100) : 0;

        return view('livewire.admin.dashboard', [
            'workshops' => $workshops,
            'totalWorkshops' => $totalWorkshops,
            'totalRegistrations' => $totalRegistrations,
            'totalCapacity' => $totalCapacity,
            'occupancyRate' => $occupancyRate,
        ]);
    }
}
