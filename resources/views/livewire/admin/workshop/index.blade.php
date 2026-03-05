<div class="space-y-8">
    <div class="mb-6 flex flex-col sm:flex-row justify-between items-start sm:items-center gap-4 border-b border-slate-200/5 dark:border-slate-700/50 pb-6">
        <div>
            <flux:heading size="xl" class="text-slate-900 dark:text-white font-bold tracking-tight">จัดการเวิร์กชอป</flux:heading>
            <flux:subheading class="text-slate-500 dark:text-slate-400 mt-1">เพิ่ม แก้ไข หรือลบข้อมูลหัวข้อเวิร์กชอปในระบบ</flux:subheading>
        </div>

        <a href="{{ route('admin.workshops.create') }}" wire:navigate class="inline-flex items-center justify-center px-5 py-2.5 bg-gradient-to-r from-blue-600 to-indigo-600 hover:from-blue-500 hover:to-indigo-500 text-white font-semibold rounded-xl shadow-md shadow-blue-500/20 transition-all duration-300 transform hover:-translate-y-0.5">
            <flux:icon.plus class="w-5 h-5 mr-2" />
            เพิ่มหัวข้อใหม่
        </a>
    </div>

    <div class="bg-white dark:bg-slate-800/60 border border-slate-200 dark:border-slate-700/50 rounded-2xl shadow-sm overflow-hidden">
        <div class="p-2">
            <flux:table>
                <flux:table.columns>
                    <flux:table.column>หัวข้อ</flux:table.column>
                    <flux:table.column>วิทยากร</flux:table.column>
                    <flux:table.column>เวลาจัดงาน</flux:table.column>
                    <flux:table.column>ที่นั่ง / ผู้สมัคร</flux:table.column>
                    <flux:table.column>สถานะ</flux:table.column>
                    <flux:table.column>จัดการ</flux:table.column>
                </flux:table.columns>

                <flux:table.rows>
                    @foreach ($workshops as $workshop)
                        <flux:table.row class="hover:bg-slate-50 dark:hover:bg-slate-800/40 transition-colors">
                            <flux:table.cell class="font-bold text-slate-900 dark:text-white max-w-xs break-words">
                                <a href="{{ route('admin.workshops.edit', $workshop) }}" class="hover:text-blue-500 dark:hover:text-blue-400 transition-colors flex items-center gap-3">
                                    <div class="w-10 h-10 rounded-xl bg-blue-50 dark:bg-blue-500/10 flex items-center justify-center shrink-0">
                                        <flux:icon.book-open class="w-5 h-5 text-blue-600 dark:text-blue-400" />
                                    </div>
                                    <span class="line-clamp-2">{{ $workshop->title }}</span>
                                </a>
                            </flux:table.cell>
                            <flux:table.cell>
                                <span class="flex items-center text-slate-600 dark:text-slate-300">
                                    <flux:icon.user class="w-4 h-4 mr-2 text-slate-400" />
                                    {{ $workshop->speaker_name }}
                                </span>
                            </flux:table.cell>
                            <flux:table.cell>
                                <span class="flex flex-col text-sm">
                                    <span class="font-medium text-slate-900 dark:text-white">{{ $workshop->start_time->format('d M Y') }}</span>
                                    <span class="text-slate-500 dark:text-slate-400">{{ $workshop->start_time->format('H:i') }} - {{ $workshop->end_time->format('H:i') }} น.</span>
                                </span>
                            </flux:table.cell>
                            <flux:table.cell>
                                <div class="flex items-center gap-3">
                                    @php 
                                        $percentage = $workshop->capacity > 0 ? ($workshop->registrations_count / $workshop->capacity) * 100 : 0;
                                        $isFull = $percentage >= 100;
                                    @endphp
                                    <div class="w-24 bg-slate-100 dark:bg-slate-800 rounded-full h-2 overflow-hidden shadow-inner">
                                        <div class="h-2 rounded-full {{ $isFull ? 'bg-rose-500' : ($percentage > 80 ? 'bg-amber-500' : 'bg-emerald-500') }} transition-all duration-1000 relative" style="width: {{ min($percentage, 100) }}%"></div>
                                    </div>
                                    <span class="text-xs font-bold text-slate-500 dark:text-slate-400">{{ $workshop->registrations_count }}/{{ $workshop->capacity }}</span>
                                </div>
                            </flux:table.cell>
                            <flux:table.cell>
                                <span class="inline-flex items-center px-2.5 py-1 rounded-full text-xs font-medium {{ $workshop->isFull() ? 'bg-rose-100 text-rose-800 dark:bg-rose-500/10 dark:text-rose-400' : 'bg-emerald-100 text-emerald-800 dark:bg-emerald-500/10 dark:text-emerald-400' }}">
                                    {{ $workshop->isFull() ? 'ที่นั่งเต็มแล้ว' : 'เปิดรับสมัคร' }}
                                </span>
                            </flux:table.cell>
                            <flux:table.cell>
                                <div class="flex items-center gap-2">
                                    <a href="{{ route('workshop.register', $workshop) }}" target="_blank" class="p-2 text-slate-400 hover:text-blue-500 hover:bg-blue-50 dark:hover:bg-blue-500/10 rounded-lg transition-colors" title="ดูหน้าลงทะเบียน">
                                        <flux:icon.arrow-top-right-on-square class="w-4 h-4" />
                                    </a>
                                    
                                    <flux:dropdown>
                                        <flux:button variant="ghost" size="sm" icon="ellipsis-horizontal" class="hover:bg-slate-100 dark:hover:bg-slate-800" />
                                        
                                        <flux:navmenu class="dark:bg-slate-800 dark:border-slate-700">
                                            <flux:navmenu.item href="{{ route('admin.workshops.edit', $workshop) }}" wire:navigate icon="pencil" class="hover:bg-slate-50 dark:hover:bg-slate-700/50">แก้ไขข้อมูล</flux:navmenu.item>
                                            <flux:navmenu.item href="{{ route('admin.workshops.registrants', $workshop) }}" wire:navigate icon="users" class="hover:bg-slate-50 dark:hover:bg-slate-700/50">ดูรายชื่อผู้ลงทะเบียน</flux:navmenu.item>
                                            <flux:navmenu.item wire:click="confirmDelete({{ $workshop->id }})" icon="trash" class="text-rose-500 hover:bg-rose-50 dark:hover:bg-rose-500/10">ลบเวิร์กชอป</flux:navmenu.item>
                                        </flux:navmenu>
                                    </flux:dropdown>
                                </div>
                            </flux:table.cell>
                        </flux:table.row>
                    @endforeach
                </flux:table.rows>
            </flux:table>
            
            <div class="mt-4 px-4 pb-4 border-t border-slate-100 dark:border-slate-800 pt-4">
                {{ $workshops->links() }}
            </div>
        </div>
    </div>
</div>
