@props(['status'])

@if ($status)
<div {{ $attributes->merge(['class' => 'font-medium text-sm text-white font-bold bg-green-700 rounded-md px-6 py-3
    mb-6']) }}>
    {{ $status }}
</div>
@endif
