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
                <div class="group relative bg-slate-800/40 backdrop-blur-xl border border-slate-700/50 rounded-3xl p-8 hover:border-blue-500/50 transition-all duration-500 hover:shadow-[0_0_40px_-15px_rgba(59,130,246,0.3)] flex flex-col">
                    <div class="absolute top-0 right-0 p-6">
                        <span class="px-4 py-1.5 rounded-full text-xs font-bold bg-blue-500/10 text-blue-400 border border-blue-500/20">
                            {{ $workshop->location ?? 'Online' }}
                        </span>
                    </div>

                    <div class="mb-6">
                        <h3 class="text-2xl font-bold text-white mb-2 group-hover:text-blue-400 transition-colors">
                            {{ $workshop->title }}
                        </h3>
                        <p class="text-slate-400 text-sm line-clamp-3 mb-4">
                            {{ $workshop->description }}
                        </p>
                    </div>

                    <div class="space-y-4 mb-8 flex-grow">
                        <div class="flex items-center text-slate-300">
                            <svg class="w-5 h-5 mr-3 text-emerald-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M16 7a4 4 0 11-8 0 4 4 0 018 0zM12 14a7 7 0 00-7 7h14a7 7 0 00-7-7z" />
                            </svg>
                            <span class="text-sm">วิทยากร: <b>{{ $workshop->speaker_name }}</b></span>
                        </div>
                        <div class="flex items-center text-slate-300">
                            <svg class="w-5 h-5 mr-3 text-blue-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 7V3m8 4V3m-9 8h10M5 21h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v12a2 2 0 002 2z" />
                            </svg>
                            <span class="text-sm">{{ $workshop->start_time->format('d M Y, H:i') }}</span>
                        </div>
                        <div class="flex items-center">
                            <div class="flex-grow bg-slate-700/50 rounded-full h-2 mr-4 overflow-hidden">
                                @php 
                                    $percentage = ($workshop->registrations_count / $workshop->capacity) * 100;
                                    $colorClass = $percentage >= 90 ? 'bg-rose-500' : ($percentage >= 70 ? 'bg-amber-500' : 'bg-emerald-500');
                                @endphp
                                <div class="h-full {{ $colorClass }} transition-all duration-1000" style="width: {{ $percentage }}%"></div>
                            </div>
                            <span class="text-xs font-medium {{ $percentage >= 100 ? 'text-rose-400' : 'text-slate-400' }}">
                                {{ $workshop->registrations_count }}/{{ $workshop->capacity }}
                            </span>
                        </div>
                    </div>

                    @if($workshop->isFull())
                        <div class="w-full py-4 rounded-2xl font-bold text-center bg-slate-700 text-slate-500 cursor-not-allowed">
                            Closed
                        </div>
                    @else
                        <a href="{{ route('workshop.register', $workshop->id) }}" 
                           class="w-full inline-block py-4 rounded-2xl font-bold text-center transition-all duration-300 bg-gradient-to-r from-blue-600 to-blue-500 hover:from-blue-500 hover:to-blue-400 text-white shadow-lg shadow-blue-500/25" wire:navigate>
                            ลงทะเบียนเข้าร่วม
                        </a>
                    @endif
                </div>
            @endforeach
        </div>
    </div>
</div>
