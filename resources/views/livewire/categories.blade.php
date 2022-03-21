<div>
    <div class="mb-6">
        <label for="category" class="block mb-2 text-sm font-medium text-gray-900 dark:text-gray-300">Category</label>
        <select
            class="block appearance-none w-full bg-white border-gray-400 hover:border-gray-500 px-4 py-2 pr-8 rounded shadow leading-tight focus:outline-none focus:shadow-outline"
            name="category" wire:model="selectedCategory">
            <option value=""> Select a Category</option>
            @if($categories)
                @foreach ($categories as $category)
                    <option  value="{{ $category->id }}">{{ $category->name }}</option>
                @endforeach
            @endif
        </select>
    </div>

    <div class="mb-6">
        <label for="category" class="block mb-2 text-sm font-medium text-gray-900 dark:text-gray-300">Category</label>
        <select
            class="block appearance-none w-full bg-white border-gray-400 hover:border-gray-500 px-4 py-2 pr-8 rounded shadow leading-tight focus:outline-none focus:shadow-outline"
            name="sub_category" id="category" wire:model="selectedSubCategory">
            @if($sub_categories)
                @foreach ($sub_categories as $sub_category)
                    <option value="{{ $sub_category->id }}">{{ $sub_category->name }}</option>
                @endforeach
            @endif
        </select>
    </div>
</div>
