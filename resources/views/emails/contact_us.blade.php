@extends('emails.template')

@section('emails.main')
<div style="margin:0;padding:0;font-family:&quot;Helvetica Neue&quot;,&quot;Helvetica&quot;,Helvetica,Arial,sans-serif;margin-top:1em">
A customer has sent you massage
</div>
<div>
    <label>Name 	   : {{$name}}</label>
    <label>Email      : {{$email}}</label>
    <label>Telephone  : {{$telephone}}</label>
    <label>Message	   :</label>
    <p>{{$message}}</p>
</div>
@stop