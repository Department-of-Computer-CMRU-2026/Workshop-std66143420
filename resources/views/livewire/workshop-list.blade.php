<div class="min-h-screen bg-[#0f172a] text-slate-200 p-6 font-sans">
    <div class="max-w-6xl mx-auto">
        <!-- Header -->
        <header class="mb-12 text-center">
            <h1 class="text-5xl font-extrabold tracking-tight mb-4 bg-gradient-to-r from-blue-400 to-emerald-400 bg-clip-text text-transparent">
                Senior-to-Junior Workshop
            </h1>
            <p class="text-slate-400 text-lg max-w-2xl mx-auto">
                ยกระดับทักษะของคุณด้วยความรู้จากรุ่นพี่ สู่เส้นทางการเป็นนักพัฒนามือโปร
            </p>
        </header>

        <!-- Workshop Grid -->
        <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-8">
            @foreach($workshops as $workshop)
                <div class="group relative bg-slate-800/40 backdrop-blur-xl border border-slate-700/50 rounded-3xl p-6 md:p-8 hover:border-blue-500/50 transition-all duration-500 hover:shadow-[0_0_40px_-15px_rgba(59,130,246,0.3)] flex flex-col">
                    <!-- Location Badge -->
                    <div class="mb-4 flex items-center">
                        <span class="inline-flex items-center px-3 py-1.5 rounded-full text-xs font-bold bg-blue-500/10 text-blue-400 border border-blue-500/20 max-w-[85%]">
                            <svg class="w-3.5 h-3.5 mr-1.5 shrink-0" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17.657 16.657L13.414 20.9a1.998 1.998 0 01-2.827 0l-4.244-4.243a8 8 0 1111.314 0z" />
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 11a3 3 0 11-6 0 3 3 0 016 0z" />
                            </svg>
                            <span class="truncate">{{ $workshop->location ?? 'Online' }}</span>
                        </span>
                    </div>

                    <!-- Title & Description -->
                    <div class="mb-6 flex-grow">
                        <h3 class="text-xl md:text-2xl font-bold text-white mb-3 group-hover:text-blue-400 transition-colors line-clamp-2 min-h-[3rem] md:min-h-[4rem] leading-tight">
                            {{ $workshop->title }}
                        </h3>
                        <p class="text-slate-400 text-sm line-clamp-3 mb-2">
                            {{ $workshop->description }}
                        </p>
                    </div>

                    <!-- Meta Information -->
                    <div class="space-y-4 mb-8">
                        <div class="flex items-start text-slate-300">
                            <svg class="w-5 h-5 mr-3 mt-0.5 text-emerald-400 shrink-0" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M16 7a4 4 0 11-8 0 4 4 0 018 0zM12 14a7 7 0 00-7 7h14a7 7 0 00-7-7z" />
                            </svg>
                            <span class="text-sm">วิทยากร: <b>{{ $workshop->speaker_name }}</b></span>
                        </div>
                        <div class="flex items-start text-slate-300">
                            <svg class="w-5 h-5 mr-3 mt-0.5 text-blue-400 shrink-0" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 7V3m8 4V3m-9 8h10M5 21h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v12a2 2 0 002 2z" />
                            </svg>
                            <span class="text-sm font-semibold">{{ $workshop->start_time->format('d M Y, H:i') }} น.</span>
                        </div>
                        
                        <!-- Progress Bar -->
                        <div class="pt-2">
                            <div class="flex justify-between items-end mb-2">
                                <span class="text-xs font-medium text-slate-400">จำนวนที่นั่ง</span>
                                <span class="text-sm font-bold {{ $workshop->isFull() ? 'text-rose-400' : 'text-slate-300' }}">
                                    {{ $workshop->registrations_count }} / {{ $workshop->capacity }}
                                </span>
                            </div>
                            <div class="w-full bg-slate-700/50 rounded-full h-2.5 overflow-hidden border border-slate-600/50">
                                @php 
                                    $percentage = ($workshop->capacity > 0) ? ($workshop->registrations_count / $workshop->capacity) * 100 : 0;
                                    $colorClass = $percentage >= 100 ? 'bg-rose-500' : ($percentage >= 70 ? 'bg-amber-500' : 'bg-emerald-500');
                                @endphp
                                <div class="h-full {{ $colorClass }} transition-all duration-1000 relative" style="width: {{ min($percentage, 100) }}%">
                                    <div class="absolute top-0 right-0 bottom-0 left-0 bg-white/20 w-full overflow-hidden"></div>
                                </div>
                            </div>
                        </div>
                    </div>

                    <!-- Action Button -->
                    @if($workshop->isFull())
                        <div class="flex items-center justify-center w-full py-4 rounded-2xl font-bold text-center bg-slate-700/50 text-slate-400 cursor-not-allowed border border-slate-600/50">
                            <svg class="w-5 h-5 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 15v2m-6 4h12a2 2 0 002-2v-6a2 2 0 00-2-2H6a2 2 0 00-2 2v6a2 2 0 002 2zm10-10V7a4 4 0 00-8 0v4h8z" />
                            </svg>
                            Closed (เต็มแล้ว)
                        </div>
                    @else
                        <a href="{{ route('workshop.register', $workshop->id) }}" 
                           class="w-full inline-flex items-center justify-center py-4 rounded-2xl font-bold text-center transition-all duration-300 bg-gradient-to-r from-blue-600 to-blue-500 hover:from-blue-500 hover:to-blue-400 text-white shadow-lg shadow-blue-500/25 transform group-hover:translate-y(-2px)" wire:navigate>
                            ลงทะเบียนเข้าร่วม
                            <svg class="w-5 h-5 ml-2 transform group-hover:translate-x-1 transition-transform" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M14 5l7 7m0 0l-7 7m7-7H3" />
                            </svg>
                        </a>
                    @endif
                </div>
            @endforeach
        </div>
    </div>
</div>
