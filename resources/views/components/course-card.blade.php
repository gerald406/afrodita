@props(['course'])

<div class="group bg-white rounded-2xl border border-gray-100 shadow-lg hover:shadow-xl transition-all duration-300 flex flex-col h-full overflow-hidden relative">
    <div class="relative h-48 overflow-hidden">
        <img src="{{ $course->image_url ?? asset('images/default-course.jpg') }}" 
             alt="{{ $course->title }}" 
             class="w-full h-full object-cover transform group-hover:scale-110 transition duration-500">
        
        <div class="absolute top-3 left-3">
            <span class="bg-indigo-600 text-white text-[10px] font-bold px-3 py-1 rounded-full uppercase tracking-wide shadow-md">
                {{ $course->category->name ?? 'General' }}
            </span>
        </div>

        <div class="absolute inset-0 bg-slate-900/40 flex items-center justify-center opacity-0 group-hover:opacity-100 transition duration-300">
            <a href="{{ route('courses.show', $course) }}" class="w-12 h-12 bg-white rounded-full flex items-center justify-center text-indigo-600 hover:scale-110 transition">
                <i class="fas fa-play ml-1"></i>
            </a>
        </div>
    </div>

    <div class="p-5 flex flex-col flex-grow">
        <h3 class="font-heading font-bold text-lg text-slate-800 mb-2 line-clamp-2 hover:text-indigo-600 transition">
            <a href="{{ route('courses.show', $course) }}">
                {{ $course->title }}
            </a>
        </h3>

        <div class="flex items-center text-xs text-slate-500 mb-4 space-x-4">
            <span class="flex items-center"><i class="fas fa-book-open text-indigo-400 mr-1"></i> {{ $course->lessons_count ?? 0 }} Módulos</span>
            <span class="flex items-center"><i class="fas fa-users text-indigo-400 mr-1"></i> {{ $course->students_count ?? 0 }} Alumnos</span>
        </div>

        <div class="mt-auto pt-4 border-t border-gray-100 flex items-center justify-between">
            <div class="flex items-center gap-2">
                <img src="{{ $course->teacher->profile_photo_url }}" class="w-8 h-8 rounded-full border border-gray-200" alt="{{ $course->teacher->name }}">
                <span class="text-xs font-semibold text-slate-600 truncate max-w-[100px]">{{ $course->teacher->name }}</span>
            </div>
            
            <div class="text-right">
                @if($course->discount_price)
                    <span class="text-xs text-slate-400 line-through block">S/. {{ number_format($course->price, 2) }}</span>
                    <span class="text-lg font-extrabold text-indigo-600">S/. {{ number_format($course->discount_price, 2) }}</span>
                @else
                    <span class="text-lg font-extrabold text-indigo-600">{{ $course->price == 0 ? 'GRATIS' : 'S/. ' . number_format($course->price, 2) }}</span>
                @endif
            </div>
        </div>
    </div>
</div>