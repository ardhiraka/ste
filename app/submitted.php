<?php

include 'header.php';

$members = $db->fetch_all("select * from member where downline != ?", 0);

if (isset($_GET['member'])) :
    $memberId = $_GET['member'];

    $messages = $db->fetch_all("SELECT i.ID, i.textDecoded FROM `inbox` AS i LEFT JOIN split as s on s.inbox_id = i.ID WHERE s.tanggal = ? AND s.member_id = ? GROUP BY i.ID", date('Y-m-d'), $memberId);
endif;

?>

<div class="container">
    <br />
    <br />
    <br />

    <div align="center">
        <h3>
            Submitted Data
        </h3>
    </div>

    <style scoped>
        tr.in-select {
            cursor: pointer;
        }
    </style>

    <div class="row">
        <div class="col-sm-12 col-md-5">
            <table class="table table-sm table-bordered table-hover" style="width: 100%">
                <thead>
                    <tr>
                        <th>Kode</th>
                        <th>Nama</th>
                        <th>No. HP</th>
                    </tr>
                </thead>
                <tfoot>
                    <tr>
                        <th>Kode</th>
                        <th>Nama</th>
                        <th>No. HP</th>
                    </tr>
                </tfoot>
                <tbody>
                    <?php foreach ($members as $member) : ?>
                        <tr class="in-select" data-id="<?= $member['id'] ?>">
                            <td><?= $member['kodeid'] ?></td>
                            <td><?= $member['nama'] ?></td>
                            <td><?= $member['nohp'] ?></td>
                        </tr>
                    <?php endforeach; ?>
                </tbody>
            </table>
        </div>
        <div class="col-sm-12 col-md-7">
            <table class="table table-sm table-bordered table-hover" style="width: 100%">
                <thead>
                    <tr>
                        <th width="10%">ID</th>
                        <th>Text</th>
                        <th width="10%">Hapus</th>
                    </tr>
                </thead>
                <tfoot>
                    <tr>
                        <th>ID</th>
                        <th>Text</th>
                        <th>Hapus</th>
                    </tr>
                </tfoot>
                <tbody>
                    <?php if (!isset($_GET['member'])) : ?>
                        <tr>
                            <td colspan="3">Silahkan pilih member terlebih dahulu!</td>
                        </tr>
                    <?php else : foreach ($messages as $sms) : ?>
                        <tr data-sms="<?= $sms['ID'] ?>">
                            <td><?= $sms['ID'] ?></td>
                            <td><?= strlen($sms['textDecoded']) > 50 ? substr($sms['textDecoded'], 0, 50) . '...' : $sms['textDecoded'] ?></td>
                            <td>
                                <a href="javascript:;" class="delete-sms btn btn-sm btn-default">hapus</a>
                            </td>
                        </tr>
                    <?php endforeach; endif; ?>
                </tbody>
            </table>
        </div>
    </div>
</div>

<script>
    jQuery(function($) {
        $(document).on('click', 'tr.in-select', function() {
            let id = $(this).data('id');

            window.location = '?member=' + id;
        });

        $(document).on('click', '.delete-sms', function() {
            let tr = $(this).closest('tr');
            let id = $(tr).data('sms');
            let hapus = confirm("Apa anda yakin ingin menghapusnya?");

            if (hapus) {
                $.post("ajax/submitted/hapus.php", {id: id}, response => {
                    if (response.status == 'success') {
                        alert('data berhasil dihapus');

                        window.location.reload();
                    }
                }, 'json');
            }
        });
    });
</script>