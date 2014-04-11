@section('head')
@show

<hr>

<p>
    The following information has been received:
</p>

<table width="100%">
@foreach($fields as $field)
@if($registration->{$field} != '')
    <tr>
        <td width="50%">{{ Lang::get('parkcms-workshop::fields.' . $field) }}</td>
        <td width="50%">{{ $registration->{$field} }}</td>
    </tr>
@endif
@endforeach
</table>

<hr>

<table width="100%">
@foreach($registration->parts as $part)
@if($part->pivot->value > 0)
    <tr>
        <td width="50%">{{ $part->title }}</td>
        <td>{{ round($part->price, 2) * $part->pivot->value }}&euro;</td>
    </tr>
@endif
@endforeach
    <tr><td colspan="2">&nbsp;</td></tr>
    <tr>
        <td width="50%">Total:</td>
        <td>{{ round($registration->total_amount, 2) }}&euro;</td>
    </tr>
</table>

@section('body')
@show