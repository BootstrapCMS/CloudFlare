$(document).ready(function() {
    $.ajax({
        url: laravelCloudFlareURL,
        type: "GET",
        dataType: "html",
        timeout: 10000,
        success: function(data, status, xhr) {
            var area = $('#data');
            area.fadeOut(200, function() {
                area.addClass('well');
                area.html(data);
                area.fadeIn(200);
            });
        },
        error: function(xhr, status, error) {
            var area = $('#data');
            area.fadeOut(200, function() {
                area.html('<p class="lead">There was an error getting the data</p>');
                area.fadeIn(200);
            });
        }
    });
});
