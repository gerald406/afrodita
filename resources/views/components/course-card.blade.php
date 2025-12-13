@props(['course'])

<div class="bg-white rounded-xl shadow-sm hover:shadow-md transition-shadow duration-300 overflow-hidden border border-gray-100 flex flex-col h-full">
    <a href="{{ route('courses.show', $course) }}" class="block relative h-48 overflow-hidden group">
        @if($course->image_path)
            <img src="{{ $course->image_path }}" alt="{{ $course->title }}" class="w-full h-full object-cover transition-transform duration-500 group-hover:scale-105">
        @else
            <div class="w-full h-full bg-gray-200 flex items-center justify-center text-gray-400">
                <i class="fas fa-image text-3xl"></i>
            </div>
        @endif
        
        <div class="absolute top-2 right-2">
            @if($course->price == 0)
                <span class="bg-green-500 text-white text-xs font-bold px-2 py-1 rounded shadow">GRATIS</span>
            @else
                <span class="bg-white text-gray-900 text-xs font-bold px-2 py-1 rounded shadow">
                    ${{ number_format($course->price, 2) }}
                </span>
            @endif
        </div>
    </a>

    <div class="p-5 flex flex-col flex-1">
        
        <h3 class="text-lg font-bold text-gray-900 mb-2 leading-tight">
            <a href="{{ route('courses.show', $course) }}" class="hover:text-indigo-600 transition-colors">
                {{ Str::limit($course->title, 40) }}
            </a>
        </h3>

        <div class="flex items-center mb-4">
            <img class="h-6 w-6 rounded-full object-cover mr-2" src="{{ $course->teacher->profile_photo_url }}" alt="{{ $course->teacher->name }}">
            <p class="text-xs text-gray-500 font-medium">{{ $course->teacher->name }}</p>
        </div>

        <div class="mt-auto"></div>

        <div class="flex items-center justify-between pt-4 border-t border-gray-100 text-xs text-gray-500">
            <div class="flex items-center text-yellow-400">
                <i class="fas fa-star mr-1"></i>
                <span class="text-gray-700 font-bold">{{ $course->rating }}</span>
                <span class="text-gray-400 ml-1">({{ $course->reviews_count ?? 0 }})</span>
            </div>
            <div class="flex items-center">
                <i class="fas fa-users mr-1.5 text-gray-300"></i>
                {{ $course->students->count() }} alumnos
            </div>
        </div>
    </div>
</div>