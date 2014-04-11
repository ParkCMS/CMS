@extends('parkcms-workshop::maillayout')

@section('head')
<h3>Dear {{ $fullName }}</h3>

{{ $workshop->registration_mail_body }}
@stop

@section('body')
<p>best regards</p>
<p>beauli.de</p>
@stop
