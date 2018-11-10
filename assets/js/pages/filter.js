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
        let message     = {
            id: container.data('id'),
            data: container.data('message'),
            number: container.data('number')
        };

        $('#submitSms').attr('data-id', message.id).attr('data-message', message.data);

        SMS.setData(message.data).filter().parse().inGroup(message.number, function() {
            let groups      = SMS.groups;
            let hasilGroup  = [];
            let total       = 0;

            for (let kode in groups) {
                let data = groups[kode];

                if (['2D', '3D', '4D'].includes(kode)) {
                    hasilGroup.push(kode + ": " + data.jumlah + " = " + SMS.formatNumber(data.nominal) + "/" + SMS.formatNumber(data.hasil));
                } else {
                    hasilGroup.push(kode + ": " + SMS.formatNumber(data.nominal) + "/" + SMS.formatNumber(data.hasil));
                }

                total += data.hasil;
            }

            hasilGroup.push("Total: " + SMS.formatNumber(total));
            hasilGroup.push("Credit: " + SMS.formatNumber(SMS.deposit, false));
            hasilGroup.push("Saldo: " + SMS.formatNumber((SMS.deposit - (total * 1000)), false));

            $('#smsedit').val(SMS.data).attr('data-number', message.number);

            fillDOM(SMS, hasilGroup, total);
        });
    }

    let fillDOM = function(sms, hasilGroup, total) {
        $('#smsasli').val(sms.data);
        $('#smssalah').val(sms.filtered.inCorrect.join("\n"));
        $('#smsbenar').val(sms.filtered.correct.join("\n"));
        $('#hasildapat').val(hasilGroup.join("\n"));
        $('#submitSms').attr('data-total', (total * 1000));
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
        let number      = $(this).data('number');
        let total       = 0;

        if (wait != null) clearTimeout(wait);

        wait = setTimeout(function() {
            SMS.setData(message).filter().parse().inGroup(number, function() {
                let groups      = SMS.groups;
                let hasilGroup  = [];

                for (let kode in groups) {
                    let data = groups[kode];

                    if (['2D', '3D', '4D'].includes(kode)) {
                        hasilGroup.push(kode + ": " + data.jumlah + " = " + SMS.formatNumber(data.nominal) + "/" + SMS.formatNumber(data.hasil));
                    } else {
                        hasilGroup.push(kode + ": " + data.nominal + "/" + SMS.formatNumber(data.hasil));
                    }

                    total += data.hasil;
                }

                hasilGroup.push("Total: " + SMS.formatNumber(total));
                hasilGroup.push("Credit: " + SMS.formatNumber(SMS.deposit, false));
                hasilGroup.push("Saldo: " + SMS.formatNumber((SMS.deposit - (total * 1000)), false));

                $('#submitSms').attr('data-message', message);

                fillDOM(SMS, hasilGroup, total);
            });
        }, 500);
    });

    let maxWait = null;
    $(document).on('keyup', 'input#max_nominal', function() {
        let max_nominal = $(this).val();

        if (maxWait != null) clearTimeout(maxWait);

        maxWait = setTimeout(function() {
            $.post(ajaxTo('setMaxNominal'), {max: max_nominal}, response => {
                // do something
            }, 'json');
        }, 500);
    });

    $(document).on('click', '#submitSms', function() {
        let data    = this.dataset;
        let max     = parseInt($('input#max_nominal').val());
        
        SMS.setData(data.message).filter().parse().inCluster();

        let dataMax = Math.max.apply(null, SMS.nominalStore);
        let confirmSubmit = true;

        if (dataMax > max) {
            confirmSubmit = confirm('There is a nominal that exceeds the maximum limit!');
        }

        if (confirmSubmit) {
            $.post(ajaxTo('storeSplitData'), {id: data.id, new_message: data.message, total: data.total, result: SMS.clusters}, response => {
                if (response.status == 'success') {
                    alert("Data berhasil disimpan!");
                    window.location.reload();
                } else {
                    alert(response.error);
                }
            }, 'json');
        }
    });

    $(document).on('click', '#deleteSMS', function() {
        let container   = $('#tablesms').find('tbody tr').first();
        let smsID       = container.data('id');
        let hapus       = confirm('Apa anda ingin mengapus sms tersebut?');

        if (hapus) {
            $.post(ajaxTo('hapusDataSms'), {id: smsID}, response => {
                if (response.status == 'success') {
                    alert("Data berhasil dihapus!");
                    window.location.reload();
                } else {
                    alert(response.error);
                }
            }, 'json');
        }
    });
});
