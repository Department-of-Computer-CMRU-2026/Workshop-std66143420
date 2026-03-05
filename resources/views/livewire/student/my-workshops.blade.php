<div>
    <div class="mb-6">
        <flux:heading size="xl" level="1">เวิร์กชอปของฉัน</flux:heading>
        <flux:subheading size="lg" class="mb-6">ที่นี่คุณสามารถดูรายละเอียดกิจกรรมที่ได้ลงทะเบียนหรือยกเลิกการลงทะเบียนได้ ({{ $registrations->count() }}/3 หัวข้อ)</flux:subheading>
        <flux:separator variant="subtle" />
    </div>

    @if (session('success'))
        <div class="mb-6 p-4 bg-emerald-50 dark:bg-emerald-500/10 border border-emerald-200 dark:border-emerald-500/20 rounded-xl text-emerald-600 dark:text-emerald-400 font-medium flex items-center">
            <flux:icon.check-circle class="size-5 mr-3" />
            {{ session('success') }}
        </div>
    @endif

    @if ($registrations->isEmpty())
        <flux:card class="flex flex-col items-center justify-center py-16 text-center">
            <div class="w-16 h-16 bg-slate-100 dark:bg-slate-800 rounded-full flex items-center justify-center mb-4">
                <flux:icon.book-open class="size-8 text-slate-400" />
            </div>
            <flux:heading size="lg" class="mb-2">ยังไม่มีเวิร์กชอปที่ลงทะเบียน</flux:heading>
            <flux:subheading class="mb-6">คุณสามารถเลือกลงทะเบียนเวิร์กชอปที่น่าสนใจได้จากหน้าหลัก</flux:subheading>
            <flux:button href="{{ route('home') }}" variant="primary" icon="arrow-right" wire:navigate>เรียกดูเวิร์กชอปทั้งหมด</flux:button>
        </flux:card>
    @else
        <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-6">
            @foreach ($registrations as $registration)
                <flux:card class="flex flex-col relative overflow-hidden group">
                    <div class="absolute top-0 right-0 p-4 opacity-10 transform translate-x-4 -translate-y-4 group-hover:scale-110 transition-transform duration-500">
                        <flux:icon.briefcase class="w-24 h-24 text-blue-500" />
                    </div>
                    
                    <div class="relative z-10 flex-grow">
                        <div class="inline-flex items-center gap-1.5 px-2.5 py-1 rounded-full bg-blue-50 text-blue-600 dark:bg-blue-500/10 dark:text-blue-400 text-xs font-medium mb-3">
                            <flux:icon.check-circle class="size-3.5" /> ลงทะเบียนแล้ว
                        </div>
                        
                        <h3 class="text-xl font-bold text-slate-900 dark:text-white mb-2 leading-tight">
                            {{ $registration->workshop->title }}
                        </h3>
                        
                        <p class="text-slate-500 dark:text-slate-400 text-sm mb-4 line-clamp-2">
                            {{ $registration->workshop->description }}
                        </p>
                        
                        <div class="space-y-2 mb-6">
                            <div class="flex items-center text-sm text-slate-600 dark:text-slate-300">
                                <flux:icon.user class="size-4 mr-2 text-slate-400" />
                                <span>{{ $registration->workshop->speaker_name }}</span>
                            </div>
                            <div class="flex items-center text-sm text-slate-600 dark:text-slate-300">
                                <flux:icon.map-pin class="size-4 mr-2 text-slate-400" />
                                <span>{{ $registration->workshop->location }}</span>
                            </div>
                            <div class="flex items-center text-sm text-slate-600 dark:text-slate-300">
                                <flux:icon.clock class="size-4 mr-2 text-slate-400" />
                                <span>
                                    {{ $registration->workshop->start_time->format('d M y') }} •
                                    {{ $registration->workshop->start_time->format('H:i') }} - {{ $registration->workshop->end_time->format('H:i') }} น.
                                </span>
                            </div>
                        </div>
                    </div>
                    
                    <div class="relative z-10 pt-4 border-t border-slate-100 dark:border-slate-800 flex justify-between items-center">
                        <flux:button href="{{ route('workshop.register', $registration->workshop) }}" variant="ghost" size="sm" icon="eye" wire:navigate class="text-slate-500 hover:text-blue-500">ดูรายละเอียด</flux:button>
                        
                        <flux:modal.trigger :name="'cancel-modal-'.$registration->id">
                            <flux:button variant="danger" size="sm" icon="trash">ยกเลิก</flux:button>
                        </flux:modal.trigger>
                        
                        <flux:modal :name="'cancel-modal-'.$registration->id" class="min-w-[22rem]">
                            <form wire:submit="cancelRegistration({{ $registration->id }})" class="space-y-6">
                                <div>
                                    <flux:heading size="lg">ยืนยันการยกเลิก</flux:heading>
                                    <flux:subheading>
                                        <p>คุณแน่ใจหรือไม่ว่าต้องการยกเลิกการลงทะเบียน <br><b class="text-slate-800 dark:text-slate-200">{{ $registration->workshop->title }}</b> ?</p>
                                        <p class="text-rose-500 mt-2 text-sm">* หากยกเลิกแล้วคุณอาจเสียที่นั่งให้กับผู้อื่นที่สนใจ</p>
                                    </flux:subheading>
                                </div>

                                <div class="flex space-x-2">
                                    <flux:spacer />
                                    <flux:modal.close>
                                        <flux:button variant="ghost">ปิด</flux:button>
                                    </flux:modal.close>
                                    <flux:button type="submit" variant="danger" @click="$dispatch('modal-close')">ยืนยันยกเลิก</flux:button>
                                </div>
                            </form>
                        </flux:modal>
                    </div>
                </flux:card>
            @endforeach
        </div>
    @endif
</div>
