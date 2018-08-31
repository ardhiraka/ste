jQuery(function($) {
    let ajaxTo = file => {
        return 'ajax/rekap/' + file + '.php';
    }

    $('#formRekap').on('submit', function(event) {
        event.preventDefault();

        $.post(ajaxTo('getData'), $(this).serialize(), response => {
            $('tbody#showRekapData').html(response);
        }, 'html');
    });
});
