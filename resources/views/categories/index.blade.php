<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Categories') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 bg-white border-b border-gray-200">
                    <x-success-status class="mb-4" :status="session()->get('success')" />

                    <a href="{{ route('categories.create') }}"
                        class="text-white bg-gray-700 hover:bg-gray-800 px-6 py-3 mt-5 rounded"> Add New</a>
                    <div class="flex flex-col mt-6">
                        <div class="overflow-x-auto shadow-md sm:rounded-lg">
                            <div class="inline-block min-w-full align-middle">
                                <div class=" ">
                                    <table
                                        class="min-w-full w-full divide-y divide-gray-200 table-fixed dark:divide-gray-700">
                                        <thead class="bg-gray-100 dark:bg-gray-700">
                                            <tr>
                                                <th scope="col"
                                                    class="py-3 px-6 text-xs font-medium tracking-wider text-left text-gray-700 uppercase dark:text-gray-400">
                                                    Image
                                                </th>
                                                </a>
                                                <th scope="col"
                                                    class="py-3 px-6 text-xs font-medium tracking-wider text-left text-gray-700 uppercase dark:text-gray-400">
                                                    Category Name
                                                </th>
                                                <th scope="col" class="p-4">
                                                </th>
                                            </tr>
                                        </thead>
                                        <tbody
                                            class="bg-white divide-y divide-gray-200 dark:bg-gray-800 dark:divide-gray-700">
                                            @forelse ($categories as $category)
                                            <tr class="hover:bg-gray-100 dark:hover:bg-gray-700">
                                                <td
                                                    class="py-4 px-6 text-sm font-medium text-gray-900 whitespace-nowrap dark:text-white">
                                                    <img src="{{ asset('storage/'.$category->image_path) }}"
                                                        class="w-12 h-12 rounded-full shadow-lg" alt="" srcset="">
                                                </td>
                                                <td
                                                    class="py-4 px-6 text-sm font-medium text-gray-500 whitespace-nowrap dark:text-white">
                                                    {{ $category->name }}</td>

                                                <td class="py-4 px-6 text-sm font-medium text-right whitespace-nowrap">
                                                    <div class="flex space-x-4">
                                                        <a href="{{ route('categories.edit',$category->id) }}"
                                                            class="text-blue-600 dark:text-blue-500 hover:underline">Edit</a>

                                                        @can('admin_request')
                                                            <form action="{{ route('categories.destroy',$category->id) }}"
                                                                method="post"
                                                                onsubmit="return confirm('Are sure to perform delete action?')">
                                                                @csrf
                                                                @method('delete')
                                                                <button type="submit"
                                                                    class="text-red-600 dark:text-blue-500 hover:underline">Delete</button>
                                                            </form>
                                                        @endcan
                                                    </div>
                                                </td>
                                            </tr>
                                            @empty
                                            <tr>
                                                <td colspan="6" class="text-gray-700 text-center py-6">
                                                    There have no records found
                                                </td>
                                            </tr>
                                            @endforelse
                                        </tbody>
                                    </table>
                                    {{ $categories->links() }}
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>
