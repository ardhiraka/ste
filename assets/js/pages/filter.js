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

        SMS.setData(message.data).filter().parse().setNumber(finalNum).match();

        $('#smsedit').val(SMS.data);
        $('#smsasli').val(SMS.data);
        $('#smssalah').val(SMS.filtered.inCorrect.join("\n"));
        $('#smsbenar').val(SMS.filtered.correct.join("\n"));

        $.post(ajaxTo('getDataByNumber'), {number: container.data('number')}, response => {
            if (response) {
                $('#smsedit').attr('data-config', JSON.stringify(response.config));
                
                calcMessages(SMS, response.config);
            } else {
                alert('Nomor belum terdaftar di database!');
                
                $('#hasildapat').val('Nomor belum terdaftar di database!');
            }
        }, 'json');
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

    /*
    $(document).on('click', '[message-view]', function() {
        let container   = $(this).closest('tr');
        let finalNum    = $('#angkaout').val();
        let message     = {
            id: container.data('id'),
            data: container.data('message')
        };

        $('#submitSms').attr('data-id', message.id).attr('data-message', message.data);

        SMS.setData(message.data).filter().parse().setNumber(finalNum).match();

        $('#smsedit').val(SMS.data);
        $('#smsasli').val(SMS.data);
        $('#smssalah').val(SMS.filtered.inCorrect.join("\n"));
        $('#smsbenar').val(SMS.filtered.correct.join("\n"));

        $.post(ajaxTo('getDataByNumber'), {number: container.data('number')}, response => {
            if (response) {
                $('#smsedit').attr('data-user', JSON.stringify(response));
                
                calcMessages(SMS, response);
            } else {
                alert('Nomor belum terdaftar di database!');
                
                $('#hasildapat').val('Nomor belum terdaftar di database!');
            }
        }, 'json');
    });
    */

    let calcMessages = (SMS, response) => {
        let hasil       = [];
        let result      = SMS.matchResult;
        let totalWin    = 0;
        let totalLose   = 0;
        let totalPWin   = 0;
        let totalPLose  = 0;

        for (var i in result) {
            let theCode = SMS.searchCode(i, true);
            let thePrice = SMS.searchPrice(i);

            if (theCode.code == 'N/A') {
                let iWin        = 0;
                let iLose       = 0;
                let hasilWin    = 0;
                let hasilLose   = 0;
                let hasilTotal  = 0;

                for (let code in result[i]) {
                    let icode   = result[i][code];
                    totalWin    += icode.win.length;
                    totalLose   += icode.lose.length;
                    hasilWin    += icode.win.length * thePrice * response['WIN_'+code];
                    hasilLose   += (icode.lose.length * thePrice) - ((icode.lose.length * thePrice) * (response['DISC_'+code] / 100));
                    let cWin    = icode.win.length * thePrice * response['WIN_'+code];
                    let cLose   = (icode.lose.length * thePrice) - ((icode.lose.length * thePrice) * (response['DISC_'+code] / 100));

                    hasil.push(code + ": " + icode.win.length + "/" + icode.lose.length + " | " + formatNumber(cWin) + "/" + formatNumber(cLose));
                }

                totalPWin   += hasilWin;
                totalPLose  += hasilLose;
                hasilTotal  = hasilWin - hasilLose;
            } else {
                totalWin    += result[i].win.length;
                totalLose   += result[i].lose.length;
                let theNewCode;

                if (['TS', 'TT', 'JP', 'JJ'].includes(theCode.code)) {
                    theNewCode  = theCode.head ? theCode.full.split('.').join('_') : theCode.code;
                } else {
                    theNewCode  = SMS.code.head.includes(theCode.head) ? theCode.full.split('.').join('_') : theCode.code;
                }
                // console.log(theNewCode);

                // let theCodeRumusWin     = SMS.code.head.includes(theCode.head) ? 'Jitu' : theCode.code == 'CM' ? 'CM' : theCode.code;
                // let theCodeRumusLose    = SMS.code.head.includes(theCode.head) ? 'Jitu' : theCode.code;
                let unique      = ['J', 'P', 'T', 'S', 'H', 'PING', 'TENG', 'TS', 'TT', 'JP', 'JJ'];
                let rumusWin    = 0;
                let rumusLose   = 0;

                if (unique.includes(theCode.code)) {
                    rumusWin    = result[i].win.length > 0 ? result[i].win.length * thePrice : 0;
                    rumusLose   = result[i].win.length > 0 ? 0 : (result[i].lose.length * thePrice) + ((result[i].lose.length * thePrice) * (response['DISC_'+theNewCode] / 100));
                } else {
                    rumusWin    = result[i].win.length * thePrice * response['WIN_'+theNewCode];
                    rumusLose   = (result[i].lose.length * thePrice) - ((result[i].lose.length * thePrice) * (response['DISC_'+theNewCode] / 100));
                }

                let rumus   = rumusWin - rumusLose;
                totalPWin   += rumusWin;
                totalPLose  += rumusLose;

                hasil.push(theCode.full + ": " + result[i].win.length + "/" + result[i].lose.length + " | " + formatNumber(rumusWin) + "/" + formatNumber(rumusLose));
            }
        }

        hasil.push("Total: " + totalWin + "/" + totalLose + " | " + formatNumber(totalPWin) + "/" + formatNumber(totalPLose) + " | " + formatNumber(totalPWin - totalPLose));

        $('#hasildapat').val(hasil.join("\n"));
    }

    /*
    $(document).on('click', '[message-delete]', function() {
        let container   = $(this).closest('tr');
        let message     = {
            id: container.data('id'),
            data: container.data('message')
        };
        let hapus       = confirm('Anda yakin ingin menghapusnya?');

        if (hapus) {
            $.post(ajaxTo('deleteMessage'), {id: message.id}, response => {
                if (response.status == 'success') {
                    alert('Data berhasil dihapus!');
                    dataTable.ajax.reload(null, false);
                } else {
                    alert('Error: ' + response.error);
                }
            }, 'json');
        }
    });
    */

    let wait = null;
    $('#smsedit').keyup(function() {
        let message     = $(this).val().split("\n").join('..');
        let finalNum    = $('#angkaout').val();
        let dataConfig  = $(this).data('config');

        if (wait != null) clearTimeout(wait);

        wait = setTimeout(function() {
            SMS.setData(message).filter().parse().setNumber(finalNum).match();

            $('#submitSms').attr('data-message', message);

            $('#smsasli').val(SMS.data);
            $('#smssalah').val(SMS.filtered.inCorrect.join("\n"));
            $('#smsbenar').val(SMS.filtered.correct.join("\n"));

            calcMessages(SMS, dataConfig);
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
