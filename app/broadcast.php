<?php

include 'header.php';

$members = $db->fetch_all("select * from member where downline != ?", 0);

?>

<div class="container">
    <br />
    <br />
    <br />

    <div align="center">
        <h3>
            Broadcast
        </h3>
    </div>

    <div class="row">
        <div class="col-md-5">
            <textarea id="message" rows="5" style="width: 100%" placeholder="Input Text"></textarea>
            <div class="pull-right">
                <button id="sendButton" class="btn btn-default btn-sm">Send</button>
            </div>
        </div>
        <div class="col-md-7">
            <table class="table table-sm table-bordered table-hover" style="width: 100%">
                <thead>
                    <tr>
                        <th width="6%" class="text-center">
                            <input class="bulk" type="checkbox">
                        </th>
                        <th>Kode</th>
                        <th>Nama</th>
                        <th>No. HP</th>
                    </tr>
                </thead>
                <tfoot>
                    <tr>
                        <th class="text-center">
                            <input class="bulk" type="checkbox">
                        </th>
                        <th>Kode</th>
                        <th>Nama</th>
                        <th>No. HP</th>
                    </tr>
                </tfoot>
                <tbody>
                    <?php foreach ($members as $member) : ?>
                        <tr>
                            <td class="text-center">
                                <input value="<?= $member['nohp'] ?>" type="checkbox">
                            </td>
                            <td><?= $member['kodeid'] ?></td>
                            <td><?= $member['nama'] ?></td>
                            <td><?= $member['nohp'] ?></td>
                        </tr>
                    <?php endforeach; ?>
                </tbody>
            </table>
        </div>
    </div>
</div>

<script>
    jQuery(function($) {
        let bulk = function(el, value) {
            for (let i = 0; i < el.length; i++) {
                el[i].checked = value;
            }
        };

        $(document).on('change', 'input.bulk', function() {
            let allCheckbox = $("input[type='checkbox']");

            if (this.checked) {
                bulk(allCheckbox, true);
            } else {
                bulk(allCheckbox, false);
            }
        });

        $(document).on('click', 'button#sendButton', function() {
            let sms = $('textarea#message').val();
            let member = $("input[type='checkbox']:not(.bulk):checked");
            let number = [];

            $("input[type='checkbox']:not(.bulk):checked").each((i, el) => {
                number.push(el.value);
            });

            if (sms == '' || number.length == 0) {
                alert("Pesan atau nomor broadcast harus terisi!");
            } else {
                $.post("ajax/broadcast.php", {message: sms, numbers: number}, response => {
                    if (response.status == 'success') {
                        alert("Message send");

                        window.location.reload();
                    }
                }, 'json');
            }
        });
    });
</script>