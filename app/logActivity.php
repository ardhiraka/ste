<?php

include('header.php');

$logActivity = $db->fetch_all("select * from log_activity where DATE(time) = ? order by time desc", date('Y-m-d'));

?>

<div class="container">
    <br />
    <br />
    <br />

    <div align="center">
        <h3>
            Log Activity
        </h3>
    </div>

    <div class="row">
        <div class="col-sm-12">
            <table class="table table-sm table-bordered table-hover" width="100%">
                <thead>
                    <tr>
                        <th width="10%">Date</th>
                        <th width="10%">Time</th>
                        <th>Log</th>
                    </tr>
                </thead>
                <tfoot>
                    <tr>
                        <th>Date</th>
                        <th>Time</th>
                        <th>Log</th>
                    </tr>
                </tfoot>
                <tbody>
                    <?php foreach ($logActivity as $log) : ?>
                        <tr>
                            <td><?= date("Y-m-d", strtotime($log['time'])) ?></td>
                            <td><?= date("H:i:s", strtotime($log['time'])) ?></td>
                            <td><?= $log['log'] ?></td>
                        </tr>
                    <?php endforeach; ?>
                </tbody>
            </table>
        </div>
    </div>
</div>