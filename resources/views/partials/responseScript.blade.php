<script src="https://ajax.googleapis.com/ajax/libs/webfont/1.6.26/webfont.js"></script>
<script>
    (function() {
        
        // Variables
        var url = new URL(window.location.href);
        var search_params = url.searchParams;
        var lang;
        var fonts = [];

        // Reflow
        var reflow = function(data, $response) {
            if ( data.hasOwnProperty('font') ) {
                $response.find('.response-content').css('font-family', data.font);
            }
            if ( data.hasOwnProperty('alignment') ) {
                $response.find('.response-content').css('text-align', data.alignment);
            }
            if ( data.hasOwnProperty('weight') ) {
                $response.find('.response-content').css('font-weight', data.weight);
            }
            if ( data.hasOwnProperty('size') ) {
                $response.find('.response-content').css('font-size', data.size);
            }
            setTimeout(() => {
                var $grid = $('.grid').isotope({ itemSelector: '.response', layoutMode: 'masonry' });
            }, 200);
        }

        var loadFont = function(data, $response) {
            WebFont.load({
                google: {
                    families: [data.font + ':' + data.weight]
                },
                active: function() {
                    reflow(data, $response);
                }
            });
        };

        var _updateLanguage = function() {
            lang = this.value;
            $(this).prev().find('span').text( $(this).find('option[value="'+lang+'"]').text() );
            var $response = $(this).closest('.response');
            var response_id = $response.attr('id');
            $.get('/paged/responses/translate/' + response_id + '/?lang=' + lang, function(res) {
                var data = JSON.parse(res);

                // Set translated content
                $response.find('.response-content').text(data.content); // Replace the card response content
                $response.parent().find('#print-' + response_id + ' .response-content').text(data.content); // Replace the print response content

                // Update Font
                if (data.hasOwnProperty('font') && ! fonts.includes(data.font) ) {
                    fonts.push(data.font);
                    loadFont(data, $response);
                } else {
                    reflow(data, $response);
                }
                
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