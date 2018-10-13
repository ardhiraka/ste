jQuery(function($) {
    let ajaxTo = file => {
        return 'ajax/rekap/' + file + '.php';
    }

    $('#formRekap').on('submit', function(event) {
        event.preventDefault();
        $('#totalNominal').html('');
        $('#totalMakan').html('');
        $('#totalDealer').html('');

        $.post(ajaxTo('getData'), $(this).serialize(), response => {
            $('tbody#showRekapData').html(response);
            let nominal     = $('tbody#showRekapData').find('tr td:nth-child(3)');
            let nom_makan   = $('tbody#showRekapData').find('tr td:nth-child(4)');
            let nom_dealer  = $('tbody#showRekapData').find('tr td:nth-child(5)');
            let split_id    = $('tbody#showRekapData').find('tr');
            let noms    = [];
            let splits  = [];
            let nom_makans  = [];
            let nom_dealers = [];

            nominal.each((el, item) => {
                noms.push(parseInt($(item).text()));
            });

            nom_makan.each((el, item) => {
                nom_makans.push(parseInt($(item).text()));
            });

            nom_dealer.each((el, item) => {
                nom_dealers.push(parseInt($(item).text()));
            });

            split_id.each((el, item) => {
                splits.push(parseInt($(item).data('id')));
            });

            let totalNominal    = noms.reduce((accumulator, currentValue) => accumulator + currentValue);
            let totalNomMakan   = nom_makans.reduce((accumulator, currentValue) => accumulator + currentValue);
            let totalNomDealer  = nom_dealers.reduce((accumulator, currentValue) => accumulator + currentValue);

            $('#totalNominal').html(totalNominal);
            $('#totalMakan').html(totalNomMakan);
            $('#totalDealer').html(totalNomDealer);
            $('input[name="ids"]').val(splits);
        }, 'html');
    });
});
