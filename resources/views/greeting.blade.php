<div>
    <p>{{ __('sample.greeting') }}, {{ $name }}.</p>
    <p>This is {{ $sitename }} site.</p>
    <p>Time: {{ $time }}</p>
</div>

@include('greeting.sub')