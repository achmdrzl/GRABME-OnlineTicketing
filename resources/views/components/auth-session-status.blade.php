@props(['status'])

@if ($status)
    <div {{ $attributes->merge(['class' => 'badge bg-success text-green-600']) }}>
        {{ $status }}
    </div>
@endif
