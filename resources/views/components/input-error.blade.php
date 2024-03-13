@props(['messages'])

@if ($messages)
    <ul {{ $attributes->merge(['class' => 'error_msg']) }}>
        @foreach ((array) $messages as $message)
            <li>{{ $message }}</li>
        @endforeach
    </ul>
@endif
