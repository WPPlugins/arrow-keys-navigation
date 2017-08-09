jQuery(document).ready(function ($) {


    $(document).on('keydown',function(e) {

        /*if (e.keyCode == 27)
            msg = 'Esc key pressed. GO TO FIRST post';
        if ( e.ctrlKey && ( e.which === 27 ) )
            msg = "You pressed CTRL + Esc: QUIT THE PLUGIN" ;*/

        var kpress = e.keyCode;
        if (kpress == 37 || kpress == 39 ) {
            //37 'Left arrow key pressed. GO PREVIOUS post';
            //39 'Right arrow key pressed. GO NEXT post';

            /**** AJAX request ****/
            var wildcard = $('#akeynav_wildcard').text();
            console.log(wildcard);
            $.ajax({
                url: ajaxurl,
                type:'POST',
                data: { action: 'akeynav_reqs', todo: 'go_post', kpress: kpress, wildcard: wildcard },
                success:function(results){
                    console.log("key--->"+ kpress + ' res-->' + results);
                    if (results)
                        document.location.href = results;
                }
            });

        }

    });

});
