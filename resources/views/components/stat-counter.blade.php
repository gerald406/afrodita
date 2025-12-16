@props(['icon', 'target', 'label', 'suffix' => ''])

<div x-data="{ 
        current: 0, 
        target: {{ $target }}, 
        time: 2000, 
        started: false,
        init() {
            let observer = new IntersectionObserver((entries) => {
                if (entries[0].isIntersecting && !this.started) {
                    this.start();
                    this.started = true;
                }
            }, { threshold: 0.5 });
            observer.observe(this.$el);
        },
        start() {
            let step = this.target / (this.time / 16);
            let timer = setInterval(() => {
                this.current += step;
                if (this.current >= this.target) {
                    this.current = this.target;
                    clearInterval(timer);
                }
            }, 16);
        }
    }" 
    class="p-6">
    
    <div class="text-indigo-400 text-4xl mb-4 transform hover:scale-110 transition duration-300">
        <i class="fas {{ $icon }}"></i>
    </div>
    
    <div class="text-5xl font-extrabold mb-2 font-mono">
        <span x-text="Math.round(current)">0</span>{{ $suffix }}
    </div>
    
    <div class="text-gray-400 uppercase text-sm font-bold tracking-widest">{{ $label }}</div>
</div>