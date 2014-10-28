@extends(Config::get('views.default', 'layouts.default'))

@section('title')
<?php $__navtype = 'admin'; ?>
CloudFlare
@stop

@section('top')
<div class="page-header">
<h1>CloudFlare</h1>
</div>
@stop

@section('content')
<p class="lead">Here are your visitor statistics from CloudFlare:</p>
<hr>
@if($data)
    <div class="well" id="data">
        @include('graham-campbell/cloudflare::data')
    </div>
@else
    <div id="data">
        <p class="lead"><i class="fa fa-refresh fa-spin fa-lg"></i> Loading...</p>
    </div>
@endif
@stop

@section('js')
@if(!$data)
    <script>
    var laravelCloudFlareURL = '{{ URL::route('cloudflare.data') }}';
    </script>
    {!! Asset::scripts('cloudflare') !!}
@endif
@stop
