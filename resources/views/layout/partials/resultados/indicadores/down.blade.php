@php
    $up_down = 'data:image/png;base64,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';
@endphp
<img src="{{$up_down}}" alt=""  height='10px' width='10px' style='align: center;'>