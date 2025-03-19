(function($){
    $('#search-input').on('keyup', function() {
        let query = $(this).val();

        if (query.length < 3) {
            $('#search-results').html('');
            return;
        }

        $.ajax({
            url: ajax_object.ajax_url,
            type: 'POST',
            data: {
                action: 'ajax_search_post', // This MUST match your PHP function
                query: query
            },
            beforeSend: function() {
                $('#search-results').html('<p>Searching...</p>');
            },
            success: function(response) {
                if (response.success) {
                    let output = '<ul>';
                    response.data.forEach(post => {
                        output += `<li><a href="${post.link}">${post.title}</a></li>`;
                    });
                    output += '</ul>';
                    $('#search-results').html(output);
                } else {
                    $('#search-results').html('<p>' + response.data.message + '</p>');
                }
            },
        });
    });
})(jQuery);
