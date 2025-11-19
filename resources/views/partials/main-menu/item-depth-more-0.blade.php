{!! $args['before'] !!}
{!! sprintf('<%s%s>', $args['tag'], $attributes) !!}
@if (! empty($args['icon']))
  <div class="icon" style="mask-image: url('{{ wp_get_attachment_url($args['icon']) }}')"></div>
@endif

<div class="text">
  {!! $args['link_before'] !!}
  <p>{!! $args['title'] !!}</p>
  {!! $args['link_after'] !!}
  @if (! empty($args['description']))
    <p>{!! $args['description'] !!}</p>
  @endif
</div>
{!! "</{$args['tag']}>" !!}
{!! $args['after'] !!}
