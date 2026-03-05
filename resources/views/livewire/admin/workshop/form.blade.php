<div class="relative max-w-4xl mx-auto py-4">
    <!-- Decorative blob -->
    <div class="absolute top-0 -right-10 w-64 h-64 bg-blue-500/10 blur-[80px] rounded-full pointer-events-none"></div>
    <div class="absolute bottom-40 -left-10 w-64 h-64 bg-emerald-500/10 blur-[80px] rounded-full pointer-events-none"></div>

    <div class="mb-8 flex items-center justify-between relative z-10 border-b border-slate-200/50 dark:border-slate-700/50 pb-6">
        <div class="flex items-center gap-4">
            <flux:button href="{{ route('admin.workshops.index') }}" wire:navigate icon="arrow-left" variant="ghost" class="text-slate-500 hover:text-slate-800 dark:hover:text-slate-200" />
            <div>
                <flux:heading size="xl" class="text-slate-900 dark:text-white font-bold tracking-tight text-2xl">
                    {{ $workshop && $workshop->exists ? 'แก้ไขข้อมูลหัวข้อเวิร์กชอป' : 'เพิ่มหัวข้อเวิร์กชอปใหม่' }}
                </flux:heading>
                <flux:subheading class="text-slate-500 dark:text-slate-400 mt-1">กรอกรายละเอียดของกิจกรรมเพื่อให้ผู้เรียนลงทะเบียน</flux:subheading>
            </div>
        </div>
    </div>

    <form wire:submit.prevent="confirmSave" class="relative z-10">
        <div class="bg-white dark:bg-slate-800/60 border border-slate-200 dark:border-slate-700/50 rounded-2xl p-6 md:p-8 shadow-sm">
            <div class="space-y-10">
                <!-- ตอนที่ 1: ข้อมูลพื้นฐาน -->
                <div>
                    <div class="flex items-center gap-3 mb-6">
                        <div class="flex items-center justify-center w-8 h-8 rounded-full bg-blue-100 text-blue-700 dark:bg-blue-500/20 dark:text-blue-400 font-bold text-sm">
                            1
                        </div>
                        <flux:heading size="lg" class="font-semibold text-slate-800 dark:text-slate-200">ข้อมูลพื้นฐาน</flux:heading>
                    </div>
                    
                    <div class="grid grid-cols-1 md:grid-cols-2 gap-6 bg-slate-50 dark:bg-slate-800/40 p-6 rounded-xl border border-slate-100 dark:border-slate-700/30">
                        <div class="md:col-span-2">
                            <flux:input wire:model="title" label="ชื่อหัวข้อเวิร์กชอป" placeholder="เช่น Web Development with Laravel & Livewire" />
                        </div>
                        
                        <div class="md:col-span-2">
                            <flux:textarea wire:model="description" label="รายละเอียด / คำอธิบายแบบย่อ" rows="3" placeholder="อธิบายเกี่ยวกับสิ่งที่ผู้เข้าร่วมจะได้เรียนรู้ในหัวข้อนี้..." />
                        </div>

                        <div>
                            <flux:input wire:model="speaker_name" label="ชื่อวิทยากร" placeholder="รุ่นพี่..." />
                        </div>
                        
                        <div>
                            <flux:input wire:model="location" label="สถานที่จัดอบรม" placeholder="เช่น ห้องประชุม IT หรือ Online (Discord)" />
                        </div>
                    </div>
                </div>

                <!-- ตอนที่ 2: การจัดการที่นั่งและเวลา -->
                <div class="pt-2">
                    <div class="flex items-center gap-3 mb-6">
                        <div class="flex items-center justify-center w-8 h-8 rounded-full bg-emerald-100 text-emerald-700 dark:bg-emerald-500/20 dark:text-emerald-400 font-bold text-sm">
                            2
                        </div>
                        <flux:heading size="lg" class="font-semibold text-slate-800 dark:text-slate-200">จำกัดที่นั่ง & เวลา</flux:heading>
                    </div>
                    
                    <div class="grid grid-cols-1 md:grid-cols-3 gap-6 bg-slate-50 dark:bg-slate-800/40 p-6 rounded-xl border border-slate-100 dark:border-slate-700/30">
                        <div>
                            <flux:input wire:model="capacity" type="number" min="1" label="จำนวนที่นั่งสูงสุด (คน)" />
                        </div>

                        <div>
                            <flux:input wire:model="start_time" type="datetime-local" label="เวลาเริ่มต้น" />
                        </div>

                        <div>
                            <flux:input wire:model="end_time" type="datetime-local" label="เวลาสิ้นสุด" />
                        </div>
                    </div>
                </div>
            </div>

            <div class="mt-10 pt-6 border-t border-slate-200 dark:border-slate-700/50 flex gap-4 justify-end">
                <flux:button href="{{ route('admin.workshops.index') }}" wire:navigate variant="ghost" class="px-6">ยกเลิก</flux:button>
                <flux:button type="submit" variant="primary" class="px-8 shadow-sm shadow-blue-500/20">บันทึกข้อมูล</flux:button>
            </div>
        </div>
    </form>
</div>
