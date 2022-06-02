{{-- $attributes we can merge our css with --}}
<div {{ $attributes(['class' => 'rounded-xl border border-gray-200 p-6']) }}>
    {{ $slot }}
</div>
