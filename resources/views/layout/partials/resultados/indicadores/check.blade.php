@php
    $checkup = 'data:image/png;base64,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';
@endphp

<img src="{{$checkup}}" alt="" height='10px' width='10px' style='align: center;'>