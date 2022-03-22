<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Product') }}
        </h2>
    </x-slot>

    <div class="py-12">

        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 bg-white border-b border-gray-200">
                    <x-success-status class="mb-4" :status="session()->get('success')" />
                    <x-validation-errors class="mb-4" :errors="$errors" />
                    <ul
                        class="w-full text-sm font-medium text-gray-900 bg-white border border-gray-200 rounded-lg dark:bg-gray-700 dark:border-gray-600 dark:text-white">
                        <li class="w-full px-4 py-2 border-b border-gray-200 rounded-t-lg dark:border-gray-600 mb-2">
                            <h3>Product Images</h3>
                            <div class="grid grid-cols-3 gap-8 mt-4">
                                @forelse ($product->images as $image)
                                    <div class="border border-gray-500 shadow-lg rounded">
                                        <img class="w-full" src="{{ asset('storage/'.$image->image_path) }}" alt="">
                                    </div>
                                @empty
                                    No Images Found
                                @endforelse

                            </div>
                        </li>
                        <li class="w-full px-4 py-2 border-b border-gray-200 rounded-t-lg dark:border-gray-600">
                            <div class="flex justify-between">
                                <div class="w-1/2">Name</div>
                                <div class="w-1/2">{{ $product->name }}</div>
                            </div>
                        </li>
                        <li class="w-full px-4 py-2 border-b border-gray-200 rounded-t-lg dark:border-gray-600">
                            <div class="flex justify-between">
                                <div class="w-1/2">price</div>
                                <div class="w-1/2">{{ $product->price }}</div>
                            </div>
                        </li>
                        <li class="w-full px-4 py-2 border-b border-gray-200 rounded-t-lg dark:border-gray-600">
                            <div class="flex justify-between">
                                <div class="w-1/2">SubCategory Name</div>
                                <div class="w-1/2">{{ $product->subCategory->name }}</div>
                            </div>
                        </li>
                        <li class="w-full px-4 py-2 border-b border-gray-200 rounded-t-lg dark:border-gray-600">
                            <div class="flex justify-between">
                                <div class="w-1/2">Category Name</div>
                                <div class="w-1/2">{{ $product->subCategory->category->name }}</div>
                            </div>
                        </li>
                        <li class="w-full px-4 py-2 border-b border-gray-200 rounded-t-lg dark:border-gray-600">
                            <div class="flex justify-between">
                                <div class="w-1/2">Staff</div>
                                <div class="w-1/2">{{ $product->subCategory->category->staff->name }}</div>
                            </div>
                        </li>
                        <li class="w-full px-4 py-2 border-b border-gray-200 rounded-t-lg dark:border-gray-600">
                            <div class="flex justify-between">
                                <div class="w-1/2">Product Description</div>
                                <div class="w-1/2">{{ $product->description }}</div>
                            </div>
                        </li>
                        <li class="w-full px-4 py-2 border-b border-gray-200 rounded-t-lg dark:border-gray-600">
                            <div class="flex justify-between">
                                <div class="w-1/2">Product Description</div>
                                <div class="w-1/2">{{ $product->description }}</div>
                            </div>
                        </li>
                    </ul>

                    <button
                        class="block mt-6 text-white bg-blue-700 hover:bg-blue-800 focus:ring-4 focus:outline-none focus:ring-blue-300 font-medium rounded-lg text-sm px-5 py-2.5 text-center dark:bg-blue-600 dark:hover:bg-blue-700 dark:focus:ring-blue-800"
                        type="button" data-modal-toggle="defaultModal">
                        Inquire Now
                    </button>

                    <div id="defaultModal" tabindex="-1" aria-hidden="true"
                        class="hidden overflow-y-auto overflow-x-hidden fixed top-0 right-0 left-0 z-50 w-full md:inset-0 h-modal md:h-full justify-center items-center">
                        <div class="relative p-4 w-full max-w-2xl h-full md:h-auto">

                            <div class="relative bg-white rounded-lg shadow dark:bg-gray-700 p-8">

                                <form action="{{ route('home.inqueries.send',$product->id) }}" method="post">
                                    @csrf
                                    <div class="md:flex md:items-center mb-6">
                                        <div class="md:w-1/3">
                                            <label class="block text-gray-500 font-bold md:text-right mb-1 md:mb-0 pr-4" for="inline-full-name">
                                                Name
                                                <span class="text-red-700">*</span>
                                            </label>
                                        </div>
                                        <div class="md:w-2/3">
                                            <input
                                                class="bg-gray-200 appearance-none border-2 border-gray-200 rounded w-full py-2 px-4 text-gray-700 leading-tight focus:outline-none focus:bg-white focus:border-purple-500"
                                                id="inline-full-name" type="text" value="{{ auth()->user() ? auth()->user()->name : '' }}" name="name">
                                        </div>

                                    </div>
                                    <div class="md:flex md:items-center mb-6">
                                        <div class="md:w-1/3">
                                            <label class="block text-gray-500 font-bold md:text-right mb-1 md:mb-0 pr-4" for="inline-full-name">
                                                Email
                                                <span class="text-red-700">*</span>
                                            </label>
                                        </div>
                                        <div class="md:w-2/3">
                                            <input
                                                class="bg-gray-200 appearance-none border-2 border-gray-200 rounded w-full py-2 px-4 text-gray-700 leading-tight focus:outline-none focus:bg-white focus:border-purple-500"
                                                id="inline-full-name" type="email" value="{{ auth()->user() ? auth()->user()->email : '' }}" name="email">
                                        </div>

                                    </div>
                                    <div class="md:flex md:items-center mb-6">
                                        <div class="md:w-1/3">
                                            <label class="block text-gray-500 font-bold md:text-right mb-1 md:mb-0 pr-4" for="inline-full-name">
                                                Contact Number
                                            </label>
                                        </div>
                                        <div class="md:w-2/3">
                                            <input
                                                class="bg-gray-200 appearance-none border-2 border-gray-200 rounded w-full py-2 px-4 text-gray-700 leading-tight focus:outline-none focus:bg-white focus:border-purple-500"
                                                id="inline-full-name" type="text" value="" name="contact_number">
                                        </div>

                                    </div>
                                    <div class="md:flex md:items-center mb-6">
                                        <div class="md:w-1/3">
                                            <label class="block text-gray-500 font-bold md:text-right mb-1 md:mb-0 pr-4" for="inline-full-name">
                                                Questions
                                                <span class="text-red-700">*</span>
                                            </label>
                                        </div>
                                        <div class="md:w-2/3">
                                            <input
                                                class="bg-gray-200 appearance-none border-2 border-gray-200 rounded w-full py-2 px-4 text-gray-700 leading-tight focus:outline-none focus:bg-white focus:border-purple-500"
                                                id="inline-full-name" type="text" value="" name="questions">
                                        </div>

                                    </div>
                                    <div class="flex items-center p-6 space-x-2 rounded-b border-t border-gray-200 dark:border-gray-600">
                                        <button data-modal-toggle="defaultModal" type="submit"
                                            class="text-white bg-blue-700 hover:bg-blue-800 focus:ring-4 focus:outline-none focus:ring-blue-300 font-medium rounded-lg text-sm px-5 py-2.5 text-center dark:bg-blue-600 dark:hover:bg-blue-700 dark:focus:ring-blue-800">
                                            Send</button>
                                        <button data-modal-toggle="defaultModal" type="button"
                                            class="text-gray-500 bg-white hover:bg-gray-100 focus:ring-4 focus:outline-none focus:ring-blue-300 rounded-lg border border-gray-200 text-sm font-medium px-5 py-2.5 hover:text-gray-900 focus:z-10 dark:bg-gray-700 dark:text-gray-300 dark:border-gray-500 dark:hover:text-white dark:hover:bg-gray-600 dark:focus:ring-gray-600">Decline</button>
                                    </div>
                                </form>

                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>
