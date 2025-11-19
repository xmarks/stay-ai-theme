@php
  if (empty($table['body'])) {
    return;
  }

  $active_column--;

  $empty_row = '';
  $empty_colgroup = '';

  foreach ($table['body'][0] as $cell) {
    $empty_row .= '<td></td>';
    $empty_colgroup .= '<col />';
  }

  $empty_row = "<tr class=\"empty\">{$empty_row}</tr>";
  $empty_colgroup = "<colgroup>{$empty_colgroup}</colgroup>";

  $check_icon = Blade::renderComponent(new \App\View\Components\Icon('table-check'));
  $cross_icon = Blade::renderComponent(new \App\View\Components\Icon('table-cross'));

  $table_cell = function ($content) use ($check_icon, $cross_icon) {
    return match (trim($content)) {
      '+' => $check_icon,
      '-' => $cross_icon,
      default => $content,
    };
  };
@endphp

<section @class([
  'table',
  'table_frame' => $table_frame,
  'table_shadows' => $table_shadows,
])>
  <div class="container">
    <div class="row">
      <div class="col-12">
        <div class="table__container">
          <div class="table__frame"></div>
          <table>
            {!! $empty_colgroup !!}

            @if (! empty($table['header']))
              <thead>
                <tr>
                  @foreach ($table['header'] as $index => $header)
                    <th
                      scope="col"
                      @class([
                        'active' => $index === $active_column,
                      ])
                    >
                      {{ $header['c'] }}
                    </th>
                  @endforeach
                </tr>
              </thead>
            @endif

            <tbody>
              @foreach ($table['body'] as $row)
                <tr>
                  @foreach ($row as $index => $cell)
                    @if ($index === 0 && $first_column_as_header)
                      <th
                        scope="row"
                        @class([
                          'active' => $index === $active_column,
                        ])
                      >
                        {{ $cell['c'] }}
                      </th>
                      @continue
                    @endif

                    <td @class([
                      'active' => $index === $active_column,
                    ])>
                      {!! $table_cell($cell['c']) !!}
                    </td>
                  @endforeach
                </tr>
              @endforeach

              {!! $empty_row !!}
            </tbody>
          </table>
        </div>
      </div>
    </div>
  </div>
</section>
