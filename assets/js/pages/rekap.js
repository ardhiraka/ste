jQuery(function($) {
    let ajaxTo = file => {
        return 'ajax/rekap/' + file + '.php';
    }

    $('#formRekap').on('submit', function(event) {
        event.preventDefault();
        $('#totalNominal').html('');

        $.post(ajaxTo('getData'), $(this).serialize(), response => {
            $('tbody#showRekapData').html(response);
            let nominal = $('tbody#showRekapData').find('tr td:last-child');
            let noms = [];

            nominal.each((el, item) => {
                noms.push(parseInt($(item).text()));
            });

            let totalNominal = noms.reduce((accumulator, currentValue) => accumulator + currentValue);

            $('#totalNominal').html(totalNominal);
        }, 'html');
    });
});
