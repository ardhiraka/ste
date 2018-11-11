<?php

include('header.php');

$admin = $db->fetch_row("SELECT * FROM `admin` WHERE id = ?", $_SESSION['uid']);
$members = $db->fetch_all("select * from member where downline != ?", 0);

?>

    <div class="container-fluid">
        <br />
        <br />
        <br />

        <div align="center">
            <h3>
                Manual
            </h3>
        </div>

        <div class="row">
            <div class="col-md-4" style="margin: auto">
                <div class="input-group">
                    <div class="input-group-prepend">
                        <div class="input-group-text">Select Member</div>
                    </div>
                    <select id="selectMember" class="form-control">
                        <?php foreach ($members as $member) : ?>
                            <option value="<?= "{$member['id']}|{$member['nohp']}" ?>"><?= "{$member['kodeid']} - {$member['nama']}" ?></option>
                        <?php endforeach; ?>
                    </select>
                </div>
            </div>
            <div class="col-md-4" style="margin: auto">
                <div class="input-group">
                    <div class="input-group-prepend">
                        <div class="input-group-text">Max. Nominal</div>
                    </div>
                    <input id="max_nominal" value="<?= $admin['max_nominal'] ?>" type="text" class="form-control" placeholder="Max. Nominal">
                </div>
            </div>
            <div class="col-md-4">
                <button id="submitSms" data-type="manual" data-message="" class="btn btn-default btn-block my-4">Submit SMS</button>
            </div>
        </div>

        <div class="row form-group">
            <div class="col-md-12">
                <div class="row form-group">
                    <div class="col-md-4">
                        <div class="card card-body mb-3">
                            <label for="smsedit">Input SMS</label>
                            <textarea class="form-control" id="smsedit" rows="10"></textarea>
                        </div>
                        <div class="card card-body mb-3">
                            <label for="smsasli">SMS Asli</label>
                            <textarea class="form-control" id="smsasli" rows="10" readonly=""></textarea>
                        </div>
                    </div>
                    <div class="col-md-4">
                        <div class="card card-body mb-3">
                            <label for="smsbenar">SMS Benar</label>
                            <textarea class="form-control" id="smsbenar" rows="10" readonly=""></textarea>
                        </div>
                        <div class="card card-body mb-3">
                            <label for="smsalah">SMS Salah</label>
                            <textarea class="form-control" id="smssalah" rows="10" readonly=""></textarea>
                        </div>
                    </div>
                    <div class="col-md-4">
                        <div class="card card-body mb-3">
                            <label for="smsbenar">Hasil</label>
                            <textarea type="text" class="form-control" id="hasildapat" name="hasildapat" rows="10" readonly></textarea>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <br />

    </div>

    <!-- SMS Parse Module - Aris - Techarea -->
    <script type="text/javascript" src="../assets/js/combinatorial.js"></script>
    <script type="text/javascript" src="../assets/js/sms.js"></script>
    <!-- Page Scripts -->
    <script src="../assets/js/pages/filter.js"></script>

    <?php
    include('footer.php');
    ?>
