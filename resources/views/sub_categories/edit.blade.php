<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Edit Sub Category') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 bg-white border-b border-gray-200">
                    <x-success-status class="mb-4" :status="session()->get('success')" />
                    <x-validation-errors class="mb-4" :errors="$errors" />

                    <form action="{{ route('sub-categories.update',$sub_category->id) }}" method="post" enctype="multipart/form-data">
                        @csrf
                        @method('PUT')
                        <img src="{{ asset('storage/'.$sub_category->image_path) }}" class="w-24 h-24 rounded-full shadow-lg" alt="" srcset="">

                        <div class="mb-6 mt-4">
                            <label class="block mb-2 text-sm font-medium text-gray-900 dark:text-gray-300" for="image">Image</label>
                            <input
                                class="block w-full text-sm text-gray-900 bg-gray-50 rounded-lg border border-gray-300 cursor-pointer dark:text-gray-400 focus:outline-none focus:border-transparent dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400"
                                aria-describedby="user_avatar_help" id="image" type="file" name="image">
                            <div class="mt-1 text-sm text-gray-500 dark:text-gray-300" id="user_avatar_help">A image
                                is useful to confirm sub category</div>
                        </div>

                        <div class="mb-6">
                            <label for="name"
                                class="block mb-2 text-sm font-medium text-gray-900 dark:text-gray-300">Sub Category
                                Name
                                <span class="text-red-600">*</span></label>
                            <input type="text" id="name" name="name"
                                class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500"
                                placeholder="Enter Sub Category Name" value="{{ $sub_category->name }}" required>
                        </div>

                        <div class="mb-6">
                            <label for="category"
                                class="block mb-2 text-sm font-medium text-gray-900 dark:text-gray-300">Category</label>
                            <select
                                class="block appearance-none w-full bg-white border-gray-400 hover:border-gray-500 px-4 py-2 pr-8 rounded shadow leading-tight focus:outline-none focus:shadow-outline"
                                name="category" id="category" value="{{ $sub_category->category_id }}">
                                @foreach ($categories as $category)
                                    <option value="{{ $category->id }}">{{ $category->name }}</option>
                                @endforeach
                            </select>
                        </div>

                        <button type="submit"
                            class="text-white bg-blue-700 hover:bg-blue-800 focus:ring-4 focus:ring-blue-300 font-medium rounded-lg text-sm w-full sm:w-auto px-5 py-2.5 text-center dark:bg-blue-600 dark:hover:bg-blue-700 dark:focus:ring-blue-800">Submit</button>
                    </form>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>
