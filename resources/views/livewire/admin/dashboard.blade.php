<div class="space-y-8">
    <div class="mb-6 border-b border-slate-200/5 dark:border-slate-700/50 pb-6 flex items-center justify-between">
        <div>
            <flux:heading size="xl" class="text-slate-900 dark:text-white font-bold tracking-tight">Admin Dashboard</flux:heading>
            <flux:subheading class="text-slate-500 dark:text-slate-400 mt-1">ภาพรวมการลงทะเบียนเวิร์กชอปและผู้บรรยายทั้งหมด</flux:subheading>
        </div>
        <div class="hidden sm:block">
            <span class="inline-flex items-center gap-1.5 px-3 py-1 rounded-full bg-blue-50 text-blue-600 dark:bg-blue-500/10 dark:text-blue-400 text-sm font-medium">
                <flux:icon.server class="size-4" /> ระบบแสดงผลแบบเรียลไทม์
            </span>
        </div>
    </div>

    <!-- สถิติภาพรวม -->
    <div class="grid grid-cols-1 md:grid-cols-3 gap-6">
        <!-- Card 1: เวิร์กชอปทั้งหมด -->
        <div class="relative overflow-hidden bg-white dark:bg-slate-800/60 border border-slate-200 dark:border-slate-700/50 rounded-2xl p-6 shadow-sm hover:shadow-md dark:shadow-none transition-shadow group">
            <div class="absolute -right-6 -top-6 text-indigo-50 dark:text-indigo-900/20 group-hover:scale-110 transition-transform duration-500">
                <flux:icon.book-open class="w-32 h-32" />
            </div>
            <div class="relative z-10 flex items-start justify-between">
                <div>
                    <h3 class="text-sm font-semibold tracking-wide text-slate-500 dark:text-slate-400 uppercase mb-2">เวิร์กชอปทั้งหมด</h3>
                    <div class="flex items-baseline gap-2">
                        <span class="text-4xl font-extrabold text-slate-900 dark:text-white">{{ $totalWorkshops }}</span>
                        <span class="text-sm text-slate-500 dark:text-slate-400 font-medium">หัวข้อ</span>
                    </div>
                </div>
                <div class="p-3 bg-indigo-50 dark:bg-indigo-500/10 rounded-xl text-indigo-600 dark:text-indigo-400 shadow-inner">
                    <flux:icon.book-open class="w-6 h-6" />
                </div>
            </div>
        </div>

        <!-- Card 2: ผู้ลงทะเบียนรวม -->
        <div class="relative overflow-hidden bg-white dark:bg-slate-800/60 border border-slate-200 dark:border-slate-700/50 rounded-2xl p-6 shadow-sm hover:shadow-md dark:shadow-none transition-shadow group">
            <div class="absolute -right-6 -top-6 text-emerald-50 dark:text-emerald-900/20 group-hover:scale-110 transition-transform duration-500">
                <flux:icon.users class="w-32 h-32" />
            </div>
            <div class="relative z-10 flex items-start justify-between">
                <div>
                    <h3 class="text-sm font-semibold tracking-wide text-slate-500 dark:text-slate-400 uppercase mb-2">ผู้ลงทะเบียนรวม</h3>
                    <div class="flex items-baseline gap-2">
                        <span class="text-4xl font-extrabold text-slate-900 dark:text-white">{{ $totalRegistrations }}</span>
                        <span class="text-sm text-slate-500 dark:text-slate-400 font-medium">/ {{ $totalCapacity }} ที่นั่ง</span>
                    </div>
                </div>
                <div class="p-3 bg-emerald-50 dark:bg-emerald-500/10 rounded-xl text-emerald-600 dark:text-emerald-400 shadow-inner">
                    <flux:icon.users class="w-6 h-6" />
                </div>
            </div>
        </div>

        <!-- Card 3: อัตราการจอง -->
        <div class="relative overflow-hidden bg-white dark:bg-slate-800/60 border border-slate-200 dark:border-slate-700/50 rounded-2xl p-6 shadow-sm hover:shadow-md dark:shadow-none transition-shadow group flex flex-col justify-between">
            <div class="absolute -right-6 -top-6 text-blue-50 dark:text-blue-900/20 group-hover:scale-110 transition-transform duration-500">
                <flux:icon.chart-bar class="w-32 h-32" />
            </div>
            <div class="relative z-10 flex items-start justify-between mb-4">
                <div>
                    <h3 class="text-sm font-semibold tracking-wide text-slate-500 dark:text-slate-400 uppercase mb-2">อัตราการจอง (Occupancy)</h3>
                    <span class="text-4xl font-extrabold text-slate-900 dark:text-white">{{ $occupancyRate }}%</span>
                </div>
                <div class="p-3 bg-blue-50 dark:bg-blue-500/10 rounded-xl text-blue-600 dark:text-blue-400 shadow-inner">
                    <flux:icon.chart-bar class="w-6 h-6" />
                </div>
            </div>
            <div class="relative z-10 w-full bg-slate-100 dark:bg-slate-700/50 rounded-full h-2 overflow-hidden shadow-inner">
                <div class="bg-gradient-to-r from-blue-500 to-emerald-400 h-2 rounded-full transition-all duration-1000" style="width: {{ $occupancyRate }}%"></div>
            </div>
        </div>
    </div>

    <!-- รายชื่อเวิร์กชอปและสถานะที่นั่ง -->
    <div class="bg-white dark:bg-slate-800/60 border border-slate-200 dark:border-slate-700/50 rounded-2xl shadow-sm overflow-hidden">
        <div class="p-6 border-b border-slate-200 dark:border-slate-700/50 bg-slate-50/50 dark:bg-slate-800/80">
            <flux:heading size="lg" class="text-slate-900 dark:text-white font-bold">สถานะแต่ละหัวข้อเวิร์กชอป</flux:heading>
            <flux:subheading class="text-slate-500 dark:text-slate-400">ข้อมูลยอดการจองที่นั่งแบบแยกตามหัวข้อ แบบเรียลไทม์</flux:subheading>
        </div>

        <div class="p-2">
            <flux:table>
            <flux:table.columns>
                <flux:table.column>ชื่อหัวข้อเวิร์กชอป</flux:table.column>
                <flux:table.column>วิทยากร</flux:table.column>
                <flux:table.column>เวลา</flux:table.column>
                <flux:table.column class="w-48">สถานะที่นั่ง</flux:table.column>
                <flux:table.column class="w-24">การจอง</flux:table.column>
            </flux:table.columns>

            <flux:table.rows>
                @foreach ($workshops as $workshop)
                    @php 
                        $percentage = $workshop->capacity > 0 ? ($workshop->registrations_count / $workshop->capacity) * 100 : 0;
                        $isFull = $percentage >= 100;
                    @endphp
                    <flux:table.row class="hover:bg-slate-50 dark:hover:bg-slate-800/40 transition-colors">
                        <flux:table.cell class="font-bold text-slate-900 dark:text-white whitespace-break-spaces">
                            <a href="{{ route('admin.workshops.edit', $workshop) }}" class="hover:text-blue-500 dark:hover:text-blue-400 transition-colors flex items-center gap-2">
                                <div class="w-8 h-8 rounded-lg bg-blue-50 dark:bg-blue-500/10 flex items-center justify-center shrink-0">
                                    <flux:icon.book-open class="w-4 h-4 text-blue-600 dark:text-blue-400" />
                                </div>
                                {{ $workshop->title }}
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
                                <span class="text-slate-500 dark:text-slate-400">{{ $workshop->start_time->format('H:i') }} น.</span>
                            </span>
                        </flux:table.cell>
                        <flux:table.cell>
                            <div class="flex items-center gap-3">
                                <div class="w-full bg-slate-100 dark:bg-slate-800 rounded-full h-2 overflow-hidden shadow-inner">
                                    <div class="h-2 rounded-full {{ $isFull ? 'bg-rose-500' : ($percentage > 80 ? 'bg-amber-500' : 'bg-emerald-500') }} transition-all duration-1000 relative" style="width: {{ min($percentage, 100) }}%">
                                        <div class="absolute top-0 right-0 bottom-0 left-0 bg-white/20 w-full overflow-hidden"></div>
                                    </div>
                                </div>
                                <span class="text-xs font-bold w-10 text-right {{ $isFull ? 'text-rose-500' : 'text-slate-500 dark:text-slate-400' }}">{{ round($percentage) }}%</span>
                            </div>
                        </flux:table.cell>
                        <flux:table.cell>
                            <span class="inline-flex items-center px-2.5 py-1 rounded-full text-xs font-medium {{ $isFull ? 'bg-rose-100 text-rose-800 dark:bg-rose-500/10 dark:text-rose-400' : 'bg-emerald-100 text-emerald-800 dark:bg-emerald-500/10 dark:text-emerald-400' }}">
                                {{ $workshop->registrations_count }} / {{ $workshop->capacity }}
                            </span>
                        </flux:table.cell>
                    </flux:table.row>
                @endforeach
            </flux:table.rows>
        </flux:table>
        </div>
    </div>
</div>
