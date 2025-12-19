@props(['icon', 'target', 'label', 'suffix' => ''])

<div class="p-6" data-aos="fade-up">
    <div class="w-16 h-16 mx-auto bg-indigo-500/20 rounded-full flex items-center justify-center mb-4 text-indigo-400 text-2xl">
        <i class="fas {{ $icon }}"></i>
    </div>
    <div class="text-4xl font-extrabold mb-2 font-heading">
        {{ $target }}{{ $suffix }}
    </div>
    <div class="text-slate-400 font-medium uppercase tracking-wider text-xs">
        {{ $label }}
    </div>
</div>