@props(['title', 'id'])

<div id="{{ $id }}" class="game-card relative bg-white/70 backdrop-blur rounded-[2rem] shadow-soft p-6 md:p-8 overflow-hidden h-full flex flex-col">
    <h3 class="font-display text-xl md:text-2xl text-slate-700 mb-4 text-center">{{ $title }}</h3>
    <div class="flex-1 flex flex-col">
        {{ $slot }}
    </div>
</div>