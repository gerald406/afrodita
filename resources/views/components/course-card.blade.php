@props(['course'])

<div class="bg-white rounded-xl shadow-sm hover:shadow-xl transition-all duration-300 overflow-hidden border border-gray-100 flex flex-col h-full group">
    <div class="relative h-48 overflow-hidden">
        <a href="{{ route('courses.show', $course) }}">
            @if($course->image_path)
                <img src="{{ $course->image_path }}" alt="{{ $course->title }}" class="w-full h-full object-cover transition-transform duration-500 group-hover:scale-110">
            @else
                <div class="w-full h-full bg-gray-200 flex items-center justify-center text-gray-400">
                    <i class="fas fa-image text-3xl"></i>
                </div>
            @endif
        </a>
        
        <div class="absolute top-3 left-3">
            <span class="bg-indigo-600 text-white text-[10px] font-bold px-2 py-1 rounded uppercase tracking-wider">Curso</span>
        </div>
    </div>

    <div class="p-5 flex flex-col flex-1">
        <h3 class="text-lg font-bold text-gray-800 mb-2 leading-snug line-clamp-2 hover:text-indigo-600 transition-colors">
            <a href="{{ route('courses.show', $course) }}">
                {{ $course->title }}
            </a>
        </h3>

        <p class="text-gray-500 text-sm mb-4 line-clamp-2">
            {{ Str::limit($course->description, 80) }}
        </p>

        <div class="flex items-center justify-between mb-4 text-xs">
            <div class="flex items-center text-yellow-400">
                <div class="flex">
                    @for($i=1; $i<=5; $i++)
                        <i class="fas fa-star {{ $course->rating >= $i ? '' : 'text-gray-300' }}"></i>
                    @endfor
                </div>
                <span class="text-gray-400 ml-2">({{ $course->reviews_count ?? 0 }})</span>
            </div>
            <div class="flex items-center text-gray-500">
                <i class="fas fa-user mr-1"></i> {{ $course->students->count() }}
            </div>
        </div>

        <div class="mt-auto border-t border-gray-100 pt-4 flex items-center justify-between">
            <div class="flex items-center">
                <img class="h-8 w-8 rounded-full object-cover mr-2 border border-gray-200" src="{{ $course->teacher->profile_photo_url }}" alt="{{ $course->teacher->name }}">
                <span class="text-xs font-bold text-gray-700 truncate max-w-[100px]">{{ $course->teacher->name }}</span>
            </div>

            <div>
                @if($course->price == 0)
                    <span class="text-green-600 font-extrabold text-sm bg-green-50 px-2 py-1 rounded">GRATIS</span>
                @else
                    <span class="text-indigo-600 font-extrabold text-lg">${{ number_format($course->price, 2) }}</span>
                @endif
            </div>
        </div>
    </div>
</div>