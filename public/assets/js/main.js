'use strict';

tinymce.init({
    selector: '#desc',
    language: 'en'
});

tinymce.init({
    menubar: false,
    statusbar: false,
    toolbar: 'bold italic underline | link',
    plugins: 'link',
    selector: '#note__desc',
    setup: function (editor) {
        editor.on('change', function () {
            tinymce.triggerSave();
        });
    }
});
