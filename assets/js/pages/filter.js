jQuery(function($) {
    let ajaxTo = file => {
        return 'ajax/filter/' + file + '.php';
    }

    let formatNumber = number => {
        return new Intl.NumberFormat('id-ID', { style: 'currency', currency: 'IDR' }).format(number * 1000);
    }

    let dataTable = $('#tablesms').DataTable({
        scrollY: "200px",
        scrollCollapse: true,
        ajax: {
            url: ajaxTo('getMessages')
        },
        order: [[0, "desc"]],
        columns: [
            { data: 'ID' },
            { data: 'SenderNumber' },
            { data: 'userName' },
            {
                data: 'TextDecoded',
                render(data) {
                    let maxString   = 50;
                    let strLength   = data.length;
                    let preview     = '';

                    if (strLength > maxString) {
                        preview = data.substr(0, maxString) + '...';
                    } else {
                        preview = data;
                    }

                    return preview;
                }
            }
        ],
        fnCreatedRow: (el, data, iDataIndex) => {
            $(el).attr('data-id', data.ID);
            $(el).attr('data-message', data.TextDecoded);
            $(el).attr('data-number', data.SenderNumber);
        },
        fnInitComplete() {
            return filterSms();
        }
    });

    let filterSms = function() {
        let container   = $('#tablesms').find('tbody tr').first();
        let finalNum    = $('#angkaout').val();
        let message     = {
            id: container.data('id'),
            data: container.data('message')
        };

        $('#submitSms').attr('data-id', message.id).attr('data-message', message.data);

        SMS.setData(message.data).filter().parse().inGroup();

        let hasilGroup = [];

        Object.keys(SMS.groups).forEach(kode => {
            hasilGroup.push(kode + ": " + SMS.groups[kode]);
        });

        $('#smsedit').val(SMS.data);
        $('#smsasli').val(SMS.data);
        $('#smssalah').val(SMS.filtered.inCorrect.join("\n"));
        $('#smsbenar').val(SMS.filtered.correct.join("\n"));
        $('#hasildapat').val(hasilGroup.join("\n"));
    }

    $('.dataTables_length').addClass('bs-select');

    $('#newMessageForm').on('submit', function(event) {
        event.preventDefault();

        $.post(ajaxTo('newMessage'), $(this).serialize(), response => {
            if (response.status == 'success') {
                alert('Data berhasil disimpan!');
                $('#newMessageForm').trigger('reset');
                dataTable.ajax.reload(null, false);
            } else {
                alert('Error: ' + response.error);
            }
        }, 'json');
    });
    
    let wait = null;
    $('#smsedit').keyup(function() {
        let message     = $(this).val().split("\n").join('..');
        let finalNum    = $('#angkaout').val();
        let dataConfig  = $(this).data('config');

        if (wait != null) clearTimeout(wait);

        wait = setTimeout(function() {
            SMS.setData(message).filter().parse().inGroup();

            let hasilGroup = [];

            Object.keys(SMS.groups).forEach(kode => {
                hasilGroup.push(kode + ": " + SMS.groups[kode]);
            });

            $('#submitSms').attr('data-message', message);

            $('#smsasli').val(SMS.data);
            $('#smssalah').val(SMS.filtered.inCorrect.join("\n"));
            $('#smsbenar').val(SMS.filtered.correct.join("\n"));
            $('#hasildapat').val(hasilGroup.join("\n"));
        }, 500);
    });

    $(document).on('click', '#submitSms', function() {
        let data        = this.dataset;
        let finalNum    = $('#angkaout').val();
        
        SMS.setData(data.message).filter().parse().setNumber(finalNum).match();

        $.post(ajaxTo('storeSplitData'), {id: data.id, result: SMS.matchResult}, response => {
            if (response.status == 'success') {
                alert("Data berhasil disimpan!");
                window.location.reload();
            } else {
                alert(response.error);
            }
        }, 'json');
    });
});
