@extends('layouts.master')

@section('main')
<main role="main" id="site-content" class="margin-top-85">
    <div class="container-fluid container-fluid-90 min-height">
        {!! $content !!}
    </div>
    <br>
</main>
@stop

<style>
    img {
        width:100%;
        height: auto;
    }
</style>