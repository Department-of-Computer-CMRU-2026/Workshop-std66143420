<div>
    <flux:header class="mb-6">
        <flux:heading size="xl">Admin Dashboard</flux:heading>
        <flux:subheading>ภาพรวมการลงทะเบียนเวิร์กชอปทั้งหมด</flux:subheading>
    </flux:header>

    <!-- สถิติภาพรวม -->
    <div class="grid grid-cols-1 md:grid-cols-3 gap-6 mb-8">
        <flux:card class="bg-gradient-to-br from-indigo-50 to-white dark:from-indigo-950/20 dark:to-transparent border-indigo-100 dark:border-indigo-900/50">
            <div class="flex items-center justify-between">
                <div>
                    <flux:subheading class="text-indigo-600 dark:text-indigo-400 font-medium">เวิร์กชอปทั้งหมด</flux:subheading>
                    <flux:heading size="2xl" class="mt-2">{{ $totalWorkshops }} <span class="text-sm font-normal text-slate-500">หัวข้อ</span></flux:heading>
                </div>
                <div class="p-3 bg-indigo-100 dark:bg-indigo-900/50 rounded-xl text-indigo-600 dark:text-indigo-400">
                    <flux:icon.book-open class="w-6 h-6" />
                </div>
            </div>
        </flux:card>

        <flux:card class="bg-gradient-to-br from-emerald-50 to-white dark:from-emerald-950/20 dark:to-transparent border-emerald-100 dark:border-emerald-900/50">
            <div class="flex items-center justify-between">
                <div>
                    <flux:subheading class="text-emerald-600 dark:text-emerald-400 font-medium">ผู้ลงทะเบียนรวม</flux:subheading>
                    <flux:heading size="2xl" class="mt-2">{{ $totalRegistrations }} <span class="text-sm font-normal text-slate-500">/ {{ $totalCapacity }} ที่นั่ง</span></flux:heading>
                </div>
                <div class="p-3 bg-emerald-100 dark:bg-emerald-900/50 rounded-xl text-emerald-600 dark:text-emerald-400">
                    <flux:icon.users class="w-6 h-6" />
                </div>
            </div>
        </flux:card>

        <flux:card class="bg-gradient-to-br from-blue-50 to-white dark:from-blue-950/20 dark:to-transparent border-blue-100 dark:border-blue-900/50">
            <div class="flex items-center justify-between">
                <div>
                    <flux:subheading class="text-blue-600 dark:text-blue-400 font-medium">อัตราการจอง (Occupancy)</flux:subheading>
                    <div class="flex items-baseline mt-2">
                        <flux:heading size="2xl">{{ $occupancyRate }}%</flux:heading>
                    </div>
                </div>
                <div class="p-3 bg-blue-100 dark:bg-blue-900/50 rounded-xl text-blue-600 dark:text-blue-400">
                    <flux:icon.chart-bar class="w-6 h-6" />
                </div>
            </div>
            <div class="mt-4 h-2 w-full bg-slate-200 dark:bg-slate-700/50 rounded-full overflow-hidden">
                <div class="h-full bg-blue-500 rounded-full" style="width: {{ $occupancyRate }}%"></div>
            </div>
        </flux:card>
    </div>

    <!-- รายชื่อเวิร์กชอปและสถานะที่นั่ง -->
    <flux:card>
        <div class="mb-4">
            <flux:heading>สถานะแต่ละหัวข้อเวิร์กชอป</flux:heading>
            <flux:subheading>ข้อมูลยอดการจองที่นั่งแบบแยกตามหัวข้อ</flux:subheading>
        </div>

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
                    <flux:table.row>
                        <flux:table.cell class="font-medium whitespace-break-spaces">
                            <a href="#" class="hover:text-amber-500 transition-colors">{{ $workshop->title }}</a>
                        </flux:table.cell>
                        <flux:table.cell>{{ $workshop->speaker_name }}</flux:table.cell>
                        <flux:table.cell>
                            <span class="text-sm text-slate-500">{{ $workshop->start_time->format('d M y, H:i') }}</span>
                        </flux:table.cell>
                        <flux:table.cell>
                            <div class="flex items-center gap-3">
                                <div class="w-full bg-slate-200 dark:bg-slate-700 rounded-full h-1.5 overflow-hidden">
                                    <div class="h-1.5 rounded-full {{ $isFull ? 'bg-rose-500' : ($percentage > 80 ? 'bg-amber-500' : 'bg-emerald-500') }}" style="width: {{ min($percentage, 100) }}%"></div>
                                </div>
                                <span class="text-xs font-medium w-8 text-right {{ $isFull ? 'text-rose-500' : '' }}">{{ round($percentage) }}%</span>
                            </div>
                        </flux:table.cell>
                        <flux:table.cell>
                            <flux:badge size="sm" color="{{ $isFull ? 'danger' : 'success' }}" variant="solid">
                                {{ $workshop->registrations_count }} / {{ $workshop->capacity }}
                            </flux:badge>
                        </flux:table.cell>
                    </flux:table.row>
                @endforeach
            </flux:table.rows>
        </flux:table>
    </flux:card>
</div>
