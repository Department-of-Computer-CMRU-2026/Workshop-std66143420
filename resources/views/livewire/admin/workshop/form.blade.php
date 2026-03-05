<div>
    <div class="mb-6 flex items-center gap-4">
        <flux:button href="{{ route('admin.workshops.index') }}" wire:navigate icon="arrow-left" variant="ghost" class="text-slate-500" />
        <flux:header>
            <flux:heading size="xl">{{ $workshop && $workshop->exists ? 'แก้ไขข้อมูลหัวข้อเวิร์กชอป' : 'เพิ่มหัวข้อเวิร์กชอปใหม่' }}</flux:heading>
            <flux:subheading>กรอกรายละเอียดของกิจกรรมเพื่อให้ผู้เรียนลงทะเบียน</flux:subheading>
        </flux:header>
    </div>

    <form wire:submit="save">
        <flux:card>
            <div class="space-y-6">
                <!-- ตอนที่ 1: ข้อมูลพื้นฐาน -->
                <div>
                    <flux:heading size="lg" class="mb-4">ข้อมูลพื้นฐาน</flux:heading>
                    <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
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
                            <flux:input wire:model="location" label="สถานที่จัดอรม" placeholder="เช่น ห้องประชุม IT หรือ Online (Discord)" />
                        </div>
                    </div>
                </div>

                <flux:separator variant="subtle" />

                <!-- ตอนที่ 2: การจัดการที่นั่งและเวลา -->
                <div>
                    <flux:heading size="lg" class="mb-4">จำกัดที่นั่ง & เวลา</flux:heading>
                    
                    <div class="grid grid-cols-1 md:grid-cols-3 gap-6">
                        <div>
                            <flux:input wire:model="capacity" type="number" min="1" label="จำนวนที่นั่งสูงสุด" />
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

            <div class="mt-8 flex gap-4 justify-end">
                <flux:button href="{{ route('admin.workshops.index') }}" wire:navigate variant="ghost">ยกเลิก</flux:button>
                <flux:button type="submit" variant="primary">บันทึกข้อมูล</flux:button>
            </div>
        </flux:card>
    </form>
</div>
