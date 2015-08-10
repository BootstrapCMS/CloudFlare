<p class="lead">There have been {{ $data['pageviews']['all'] }} pageviews in the last 30 days from {{ $data['uniques']['all'] }} unique visitors.</p>
<p class="lead">The total number of requests served was {{ $data['requests']['all'] }}, using {{ round($data['bandwidth']['all']/1024/1024) }} MB of bandwidth.</p>
