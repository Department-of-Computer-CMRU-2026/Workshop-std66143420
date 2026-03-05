<div>
    <div class="flex justify-between items-center mb-6">
        <flux:header>
            <flux:heading size="xl">จัดการเวิร์กชอป</flux:heading>
            <flux:subheading>เพิ่ม แก้ไข หรือลบข้อมูลหัวข้อเวิร์กชอป</flux:subheading>
        </flux:header>

        <flux:button href="{{ route('admin.workshops.create') }}" wire:navigate variant="primary" icon="plus">
            เพิ่มหัวข้อใหม่
        </flux:button>
    </div>

    <flux:card>
        <flux:table>
            <flux:table.columns>
                <flux:table.column>หัวข้อ</flux:table.column>
                <flux:table.column>วิทยากร</flux:table.column>
                <flux:table.column>เวลาจัดงาน</flux:table.column>
                <flux:table.column>ที่นั่ง / ผู้สมัคร</flux:table.column>
                <flux:table.column>ลิงก์</flux:table.column>
                <flux:table.column>จัดการ</flux:table.column>
            </flux:table.columns>

            <flux:table.rows>
                @foreach ($workshops as $workshop)
                    <flux:table.row>
                        <flux:table.cell class="font-medium max-w-xs break-words">
                            {{ $workshop->title }}
                        </flux:table.cell>
                        <flux:table.cell>{{ $workshop->speaker_name }}</flux:table.cell>
                        <flux:table.cell>
                            <div class="text-sm">
                                <div>{{ $workshop->start_time->format('d M y') }}</div>
                                <div class="text-slate-500">{{ $workshop->start_time->format('H:i') }} - {{ $workshop->end_time->format('H:i') }}</div>
                            </div>
                        </flux:table.cell>
                        <flux:table.cell>
                            <flux:badge size="sm" color="{{ $workshop->isFull() ? 'danger' : 'success' }}">
                                {{ $workshop->registrations_count }} / {{ $workshop->capacity }}
                            </flux:badge>
                        </flux:table.cell>
                        <flux:table.cell>
                            <flux:button variant="ghost" size="sm" href="{{ route('workshop.register', $workshop) }}" target="_blank" icon="arrow-top-right-on-square" class="text-slate-400 hover:text-indigo-500" />
                        </flux:table.cell>
                        <flux:table.cell>
                            <flux:dropdown>
                                <flux:button variant="ghost" size="sm" icon="ellipsis-horizontal" />
                                
                                <flux:navmenu>
                                    <flux:navmenu.item href="{{ route('admin.workshops.edit', $workshop) }}" wire:navigate icon="pencil">แก้ไข</flux:navmenu.item>
                                    <flux:navmenu.item href="{{ route('admin.workshops.registrants', $workshop) }}" wire:navigate icon="users">ดูผู้ลงทะเบียน</flux:navmenu.item>
                                    <flux:navmenu.item wire:click="delete({{ $workshop->id }})" wire:confirm="คุณแน่ใจหรือไม่ที่จะลบเวิร์กชอปนี้?" icon="trash" class="text-rose-500">ลบ</flux:navmenu.item>
                                </flux:navmenu>
                            </flux:dropdown>
                        </flux:table.cell>
                    </flux:table.row>
                @endforeach
            </flux:table.rows>
        </flux:table>
        
        <div class="mt-4">
            {{ $workshops->links() }}
        </div>
    </flux:card>
</div>
