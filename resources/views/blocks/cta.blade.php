@if (! empty($use_global_settings))
  <x-cta />
@else
  <x-cta :subtitle="$subtitle" :title="$title" :button="$button ?: null" />
@endif
