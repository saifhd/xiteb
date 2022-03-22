<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Home') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 bg-white border-b border-gray-200">
                    <h1 class="text-3xl font-bold text-center mt-5 mb-8">Categories </h1>
                    <div class="grid grid-cols-4 gap-8 mb-8">
                        @forelse ($categories as $category)
                            <div class=" card border border-gray-100 shadow-lg rounded-md text-center">
                                <a class="w-full py-3 font-bold text-lg" href="{{ route('home.categories.show',$category->id) }}">
                                    <img class="h-48"  src="{{ asset('storage/'.$category->image_path) }}" alt="" srcset="">
                                    <div>{{ $category->name }}</div>
                                </a>
                            </div>

                        @empty
                            There have No Categories Found
                        @endforelse
                    </div>
                    {{ $categories->links() }}
                </div>
            </div>
        </div>
    </div>
</x-app-layout>
