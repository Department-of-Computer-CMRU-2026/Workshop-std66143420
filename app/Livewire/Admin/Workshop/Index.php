<?php

namespace App\Livewire\Admin\Workshop;

use App\Models\Workshop;
use Livewire\Component;
use Livewire\WithPagination;

class Index extends Component
{
    use WithPagination;

    public function delete(Workshop $workshop)
    {
        $workshop->delete();
        // flux()->toast('ลบข้อมูลเวิร์กชอปเรียบร้อยแล้ว');
    }

    public function render()
    {
        return view('livewire.admin.workshop.index', [
            'workshops' => Workshop::withCount('registrations')->latest()->paginate(10),
        ]);
    }
}
