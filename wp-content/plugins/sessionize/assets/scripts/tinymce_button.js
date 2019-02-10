(function() {
    tinymce.PluginManager.add('sessionize_button', function( editor, url ) {
        editor.addButton( 'sessionize_button', {
            text: sessionize_tinyMCE_object.button_name,
            image: sessionize_tinyMCE_object.sessionize_icon,
            onclick: function() {
                editor.windowManager.open( {
                    title: sessionize_tinyMCE_object.button_title,
                    body: [
                        {
                            type: 'textbox',
                            name: 'sessionize_id',
                            label: sessionize_tinyMCE_object.event_id_title,
                            value: ( sessionize_read_cookie( 'sessionize_event_id' ) ) ? sessionize_read_cookie( 'sessionize_event_id' ) : '',
                        },
                        {
                            type   : 'listbox',
                            name   : 'sessionize_embed',
                            label  : sessionize_tinyMCE_object.embed_type_title,
                            values : sessionize_tinyMCE_object.embed_types,
                            value : '',
                            tooltip: sessionize_tinyMCE_object.embed_type_msg
                        }
                    ],
                    onsubmit: function( e ) {
                        sessionize_create_cookie( 'sessionize_event_id', e.data.sessionize_id, 2592000 );
                        editor.insertContent( '[sessionize embed_type="' + e.data.sessionize_embed + '" id="' + e.data.sessionize_id + '"]');
                    }
                });
            },
        });
    });

    // Cookies
    function sessionize_create_cookie(name, value, minutes) {
        if (minutes) {
            var date = new Date();
            date.setTime(date.getTime() + (minutes * 60 * 1000));
            var expires = "; expires=" + date.toGMTString();
        }
        else {
            var expires = "";
        }
        document.cookie = name + "=" + value + expires + "; path=/";
    }

    function sessionize_read_cookie(name) {
        var nameEQ = name + "=";
        var ca = document.cookie.split(';');
        for (var i = 0; i < ca.length; i++) {
            var c = ca[i];
            while (c.charAt(0) == ' ') c = c.substring(1, c.length);
            if (c.indexOf(nameEQ) == 0) return c.substring(nameEQ.length, c.length);
        }
        return null;
    }
})();