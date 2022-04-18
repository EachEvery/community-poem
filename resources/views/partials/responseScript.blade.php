<script>
    (function() {
        
        // Variables
        var url = new URL(window.location.href);
        var search_params = url.searchParams;
        var lang;

        var _updateLanguage = function() {
            lang = this.value;
            $(this).prev().find('span').text( $(this).find('option[value="'+lang+'"]').text() );
            var $response = $(this).closest('.response');
            var response_id = $response.attr('id');
            $.get('/paged/responses/translate/' + response_id + '/?lang=' + lang, function(res) {
                var data = JSON.parse(res);
                $response.find('.response-content').text(data.content); // Replace the card response content
                $response.parent().find('#print-' + response_id + ' .response-content').text(data.content); // Replace the print response content
                var $grid = $('.grid').isotope({ itemSelector: '.response', layoutMode: 'masonry' });
                // var data = JSON.parse(res);
                // data.forEach(function(el, index) {
                //     var $el = $('#' + el.id);
                //     $el.find('.response-prompt').text(el.prompt);
                //     $el.find('.response-content').text(el.content);
                //     $el.find('.response-name').text(el.name);
                //     $el.find('.response-city').text(el.city);
                //     var $pel = $('#print-' + el.id);
                //     $pel.find('.response-prompt').text(el.prompt);
                //     $pel.find('.response-content').text(el.content);
                //     $pel.find('.response-name').text(el.name);
                //     $pel.find('.response-city').text(el.city);
                // });
                // search_params.set('lang', lang);
                // url.search = search_params.toString();
                // var newUrl = url.toString();
                // var newTitle = document.title;
                // window.history.replaceState(null, newTitle, newUrl);
            });
        };

        var _stopPropagationInner = function(event) {
            event.stopPropagation();
        };

        // Events
        $('.container').on('click', '.response .inner', _stopPropagationInner);
        $('.language-switcher select').on('change', _updateLanguage)

    })();
</script>