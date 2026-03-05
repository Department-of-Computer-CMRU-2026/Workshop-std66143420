<?php

namespace App\Livewire\Admin\Workshop;

use App\Models\Workshop;
use Livewire\Component;
use Livewire\WithPagination;

class Index extends Component
{
    use WithPagination;

    public function confirmDelete($id)
    {
        $this->dispatch('swal:confirm', [[
            'title' => 'ยืนยันการลบข้อมูล',
            'text' => 'คุณแน่ใจหรือไม่ที่จะลบเวิร์กชอปนี้? ข้อมูลการลงทะเบียนทั้งหมดจะถูกลบไปด้วย',
            'icon' => 'warning',
            'confirmText' => 'ใช่, ลบเลย',
            'cancelText' => 'ยกเลิก',
            'method' => 'executeDelete',
            'params' => [$id]
        ]]);
    }

    #[\Livewire\Attributes\On('executeDelete')]
    public function executeDelete($id)
    {
        $workshop = Workshop::find($id);
        if ($workshop) {
            $workshop->delete();
            $this->dispatch('swal:alert', [[
                'title' => 'ลบข้อมูลสำเร็จ',
                'text' => 'ลบข้อมูลเวิร์กชอปเรียบร้อยแล้ว',
                'icon' => 'success'
            ]]);
        }
    }

    public function render()
    {
        return view('livewire.admin.workshop.index', [
            'workshops' => Workshop::withCount('registrations')->latest()->paginate(10),
        ]);
    }
}
