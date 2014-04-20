@extends(Config::get('views.default', 'layouts.default'))

@section('title')
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
<div id="data">
    <p class="lead"><i class="fa fa-refresh fa-spin fa-lg"></i> Loading...</p>
</div>
@stop

@section('js')
<script>
var laravelCloudFlareURL = '{{ URL::route('cloudflare.data') }}';
</script>
{{ Asset::scripts('cloudflare') }}
@stop
