@if ($iconContent)
  <svg @foreach ($svgAttributes as $attr => $value)
      {{ $attr }}="{{ $value }}"
  @endforeach xmlns="http://www.w3.org/2000/svg">
    {!! $iconContent !!}
  </svg>
@endif
