@extends(Config::get('cloudflare.layout'))

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
<div id="data">
    <p class="lead"><i class="fa fa-refresh fa-spin fa-lg"></i> Loading...</p>
</div>
@stop

@section('js')
<script>
$(document).ready(function() {
    $.ajax({
        url: {{ URL::route('cloudflare.data') }},
        type: "GET",
        dataType: "html",
        timeout: 10000,
        success: function(data, status, xhr) {
            var area = $('#data');
            area.fadeOut(200, function() {
                area.html(data);
                area.fadeIn(200);
            });
        },
        error: function(xhr, status, error) {
            var area = $('#data');
            area.fadeOut(200, function() {
                area.html('<p class="lead">There was an error getting the data.</p>');
                area.fadeIn(200);
            });
        }
    });
});
</script>
@stop
