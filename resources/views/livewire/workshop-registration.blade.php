<div class="min-h-screen bg-[#0f172a] text-slate-200 p-6 font-sans flex items-center justify-center">
    <div class="max-w-2xl w-full bg-slate-800/40 backdrop-blur-2xl border border-slate-700/50 rounded-[2.5rem] p-10 md:p-16 shadow-2xl relative overflow-hidden">
        <!-- Background Glow -->
        <div class="absolute -top-24 -left-24 w-64 h-64 bg-blue-500/10 rounded-full blur-[100px]"></div>
        <div class="absolute -bottom-24 -right-24 w-64 h-64 bg-emerald-500/10 rounded-full blur-[100px]"></div>

        <div class="relative">
            <a href="{{ route('home') }}" class="inline-flex items-center text-slate-400 hover:text-white mb-8 transition-colors group">
                <svg class="w-5 h-5 mr-2 transform group-hover:-translate-x-1 transition-transform" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10 19l-7-7m0 0l7-7m-7 7h18" />
                </svg>
                กลับสู่หน้าหลัก
            </a>

            <div class="mb-10">
                <h2 class="text-4xl font-black text-white mb-4 tracking-tight leading-tight">
                    ลงทะเบียนเข้าร่วม<br>
                    <span class="bg-gradient-to-r from-blue-400 to-emerald-400 bg-clip-text text-transparent">
                        {{ $workshop->title }}
                    </span>
                </h2>
                <div class="flex flex-wrap gap-4 text-sm text-slate-400">
                    <span class="flex items-center">
                        <svg class="w-4 h-4 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M16 7a4 4 0 11-8 0 4 4 0 018 0zM12 14a7 7 0 00-7 7h14a7 7 0 00-7-7z" />
                        </svg>
                        วิทยากร: <b>{{ $workshop->speaker_name }}</b>
                    </span>
                    <span class="flex items-center">
                        <svg class="w-4 h-4 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8v4l3 3m6-3a9 9 0 11-18 0 9 9 0 0118 0z" />
                        </svg>
                        {{ $workshop->start_time->format('H:i') }} - {{ $workshop->end_time->format('H:i น.') }}
                    </span>
                </div>
            </div>

            @if($successMessage)
                <div class="mb-8 p-6 bg-emerald-500/10 border border-emerald-500/20 rounded-3xl text-emerald-400 flex items-center animate-bounce-short">
                    <svg class="w-6 h-6 mr-4 flex-shrink-0" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z" />
                    </svg>
                    <p class="font-bold">{{ $successMessage }}</p>
                </div>
            @endif

            @if($errorMessage)
                <div class="mb-8 p-6 bg-rose-500/10 border border-rose-500/20 rounded-3xl text-rose-400 flex items-center">
                    <svg class="w-6 h-6 mr-4 flex-shrink-0" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8v4m0 4h.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z" />
                    </svg>
                    <p class="font-bold">{{ $errorMessage }}</p>
                </div>
            @endif

            @auth
            <form wire:submit="save" class="space-y-6">
                <!-- Data from user profile, read-only -->
                <div class="space-y-2 opacity-70">
                    <label class="block text-sm font-bold text-slate-300 ml-1">รหัสนักศึกษา (อ้างอิงจากบัญชีผู้ใช้)</label>
                    <input type="text" wire:model="student_id" readonly
                           class="w-full bg-slate-900/40 border border-slate-700/50 rounded-2xl py-4 px-6 text-slate-400 cursor-not-allowed focus:outline-none">
                    @error('student_id') <span class="text-rose-400 text-xs ml-1">{{ $message }}</span> @enderror
                </div>

                <div class="space-y-2 opacity-70">
                    <label class="block text-sm font-bold text-slate-300 ml-1">ชื่อ-นามสกุล (อ้างอิงจากบัญชีผู้ใช้)</label>
                    <input type="text" wire:model="student_name" readonly
                           class="w-full bg-slate-900/40 border border-slate-700/50 rounded-2xl py-4 px-6 text-slate-400 cursor-not-allowed focus:outline-none">
                    @error('student_name') <span class="text-rose-400 text-xs ml-1">{{ $message }}</span> @enderror
                </div>

                <div class="pt-4">
                    @if($workshop->isFull())
                        <button type="button" disabled
                                class="w-full py-5 bg-slate-700 text-slate-500 font-black text-xl rounded-2xl cursor-not-allowed border border-slate-600 flex items-center justify-center">
                            <svg class="w-6 h-6 mr-3" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 15v2m-6 4h12a2 2 0 002-2v-6a2 2 0 00-2-2H6a2 2 0 00-2 2v6a2 2 0 002 2zm10-10V7a4 4 0 00-8 0v4h8z" />
                            </svg>
                            Closed (ที่นั่งเต็มแล้ว)
                        </button>
                    @else
                        <button type="submit" 
                                wire:loading.attr="disabled"
                                class="w-full py-5 bg-gradient-to-r from-blue-600 to-emerald-500 hover:from-blue-500 hover:to-emerald-400 text-white font-black text-xl rounded-2xl shadow-2xl shadow-blue-500/20 transition-all duration-300 transform hover:-translate-y-1 active:scale-95 disabled:opacity-50 disabled:cursor-not-allowed">
                            <span wire:loading.remove>ยืนยันการลงทะเบียน</span>
                            <span wire:loading>กำลังบันทึกข้อมูล...</span>
                        </button>
                    @endif
                    
                    <div class="mt-6 text-center">
                        <p class="text-xs text-slate-500">
                            ที่นั่งว่างปัจจุบัน: <b class="text-blue-400">{{ $workshop->remainingSeats() }}</b> จาก {{ $workshop->capacity }} ที่นั่ง
                        </p>
                    </div>
                </div>
            </form>
            @else
            <div class="py-10 px-6 text-center bg-slate-900/40 rounded-3xl border border-slate-700/50 shadow-inner">
                <div class="w-16 h-16 bg-blue-500/10 text-blue-400 rounded-full flex items-center justify-center mx-auto mb-5 border border-blue-500/20">
                    <svg class="w-8 h-8" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 15v2m-6 4h12a2 2 0 002-2v-6a2 2 0 00-2-2H6a2 2 0 00-2 2v6a2 2 0 002 2zm10-10V7a4 4 0 00-8 0v4h8z"/>
                    </svg>
                </div>
                <h3 class="text-2xl font-bold text-white mb-3">เข้าสู่ระบบเพื่อลงทะเบียน</h3>
                <p class="text-slate-400 mb-8 max-w-sm mx-auto leading-relaxed">กรุณาเข้าสู่ระบบก่อนทำการลงทะเบียน เพื่อให้ระบบจำกัดสิทธิ์ได้อย่างถูกต้อง (1 คนลงได้ 3 หัวข้อ)</p>
                <div class="flex flex-col sm:flex-row gap-4 justify-center">
                    <a href="{{ route('login') }}" class="inline-flex items-center justify-center px-8 py-4 bg-gradient-to-r from-blue-600 to-blue-500 hover:from-blue-500 hover:to-blue-400 text-white font-bold rounded-xl shadow-lg shadow-blue-500/20 transition-all duration-300 transform hover:-translate-y-1">
                        เข้าสู่ระบบ
                    </a>
                    <a href="{{ route('register') }}" class="inline-flex items-center justify-center px-8 py-4 bg-slate-800 hover:bg-slate-700 text-white border border-slate-700 font-bold rounded-xl shadow-lg transition-all duration-300 transform hover:-translate-y-1">
                        สมัครสมาชิก
                    </a>
                </div>
            </div>
            @endauth
        </div>
    </div>
</div>

<style>
    @keyframes bounce-short {
        0%, 100% { transform: translateY(0); }
        50% { transform: translateY(-5px); }
    }
    .animate-bounce-short {
        animation: bounce-short 1s ease-in-out infinite;
    }
</style>
