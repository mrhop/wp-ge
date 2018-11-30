(function ($) {
    wp.customizerCtrlEditor = {

        init: function () {

            $(window).load(function () {

                $('textarea.wp-editor-area').each(function () {
                    var tArea = $(this),
                        id = tArea.attr('id'),
                        editor = tinyMCE.get(id),
                        setChange,
                        changeFunction,
                        content;
                    changeFunction = function (ed, e) {
                        ed.save();
                        content = editor.getContent();
                        clearTimeout(setChange);
                        setChange = setTimeout(function () {
                            tArea.val(content).trigger('change');
                        }, 500);
                    }
                    if (editor) {
                        editor.onChange.add(changeFunction);
                        editor.onUndo.add(changeFunction);
                        editor.onRedo.add(changeFunction);
                    }

                    tArea.css({
                        visibility: 'hidden', display: 'block', width: '0', height: '0'
                    }).on('keyup', function () {
                        content = tArea.val();
                        clearTimeout(setChange);
                        setChange = setTimeout(function () {
                            content.trigger('change');
                        }, 500);
                    });
                });
            });
        }

    };

    wp.customizerCtrlEditor.init();

})(jQuery);