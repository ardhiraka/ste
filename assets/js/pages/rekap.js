jQuery(function($) {
    let ajaxTo = file => {
        return 'ajax/rekap/' + file + '.php';
    }

    $('#formRekap').on('submit', function(event) {
        event.preventDefault();
        $('#totalNominal').html('');

        $.post(ajaxTo('getData'), $(this).serialize(), response => {
            $('tbody#showRekapData').html(response);
            let nominal     = $('tbody#showRekapData').find('tr td:last-child');
            let split_id    = $('tbody#showRekapData').find('tr');
            let noms    = [];
            let splits  = [];

            nominal.each((el, item) => {
                noms.push(parseInt($(item).text()));
            });

            split_id.each((el, item) => {
                splits.push(parseInt($(item).data('id')));
            });

            let totalNominal = noms.reduce((accumulator, currentValue) => accumulator + currentValue);

            $('#totalNominal').html(totalNominal);
            $('input[name="ids"]').val(splits);
        }, 'html');
    });
});
