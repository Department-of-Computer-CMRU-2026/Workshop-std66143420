<div>
    <div class="mb-6 flex flex-col md:flex-row md:items-center justify-between gap-4">
        <div class="flex items-center gap-4">
            <flux:button href="{{ route('admin.workshops.index') }}" wire:navigate icon="arrow-left" variant="ghost" class="text-slate-500" />
            <flux:header>
                <flux:heading size="xl">ผู้ลงทะเบียน: {{ $workshop->title }}</flux:heading>
                <flux:subheading>รายชื่อผู้ที่จองที่นั่งในเวิร์กชอปนี้ ({{ $registrants->total() }} / {{ $workshop->capacity }} คน)</flux:subheading>
            </flux:header>
        </div>
        
        <div class="w-full md:w-64">
            <flux:input wire:model.live.debounce.300ms="search" placeholder="ค้นหารหัสนักศึกษา/ชื่อ..." icon="magnifying-glass" />
        </div>
    </div>

    <flux:card>
        <flux:table>
            <flux:table.columns>
                <flux:table.column>ลำดับ</flux:table.column>
                <flux:table.column>รหัสนักศึกษา</flux:table.column>
                <flux:table.column>ชื่อ-นามสกุล</flux:table.column>
                <flux:table.column>เวลาที่ลงทะเบียน</flux:table.column>
            </flux:table.columns>

            <flux:table.rows>
                @forelse ($registrants as $index => $registration)
                    <flux:table.row>
                        <flux:table.cell class="text-slate-500">
                            {{ $registrants->firstItem() + $index }}
                        </flux:table.cell>
                        <flux:table.cell class="font-medium">
                            {{ $registration->student_id }}
                        </flux:table.cell>
                        <flux:table.cell>
                            {{ $registration->student_name }}
                        </flux:table.cell>
                        <flux:table.cell>
                            {{ $registration->created_at->format('d M y, H:i:s') }}
                        </flux:table.cell>
                    </flux:table.row>
                @empty
                    <flux:table.row>
                        <flux:table.cell colspan="4" class="text-center py-6 text-slate-500">
                            @if($search)
                                ไม่พบข้อมูลนักศึกษาที่ค้นหา
                            @else
                                ยังไม่มีผู้ลงทะเบียนในหัวข้อนี้
                            @endif
                        </flux:table.cell>
                    </flux:table.row>
                @endforelse
            </flux:table.rows>
        </flux:table>

        <div class="mt-4">
            {{ $registrants->links() }}
        </div>
    </flux:card>
</div>
