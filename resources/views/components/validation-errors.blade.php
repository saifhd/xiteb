@props(['errors'])

@if ($errors->any())
<div {{ $attributes }}>
    <div class="font-medium text-red-600 mb-3">
        {{ __('Whoops! Something went wrong.') }}
    </div>

    @foreach ($errors->all() as $error)
    <div class="text-sm text-white bg-red-600 px-6 py-4 mb-1 font-bold rounded-md">
        {{ $error }}
    </div>
    @endforeach
</div>
@endif
