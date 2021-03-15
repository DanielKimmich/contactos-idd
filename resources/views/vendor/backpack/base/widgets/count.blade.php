
@php
  // defaults; backwards compatibility with Backpack 4.0 widgets
  $widget['wrapper']['class'] = $widget['wrapper']['class'] ?? $widget['wrapperClass'] ?? 'col-sm-6 col-lg-3';
@endphp

@includeWhen(!empty($widget['wrapper']), 'backpack::widgets.inc.wrapper_start')
  <div class="{{ $widget['class'] ?? 'card text-white bg-primary' }}">
    <div class="card-body p-3 d-flex align-items-center">
      <i class="la {!! $widget['icon'] !!} p-3 font-2xl mr-3"></i>
      <div>
        @if (isset($widget['value']))
          <div class="text-value">{!! $widget['value'] !!} </div>
        @endif

        @if (isset($widget['description']))
          @if (isset($widget['url']))
            <div> <a href="{{ $widget['url'] }}"> {!! $widget['description'] !!} </a></div>
          @else
            <div> {!! $widget['description'] !!} </div>
          @endif
        @endif
      </div>
    </div>
  </div>
@includeWhen(!empty($widget['wrapper']), 'backpack::widgets.inc.wrapper_end')

