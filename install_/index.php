<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <meta http-equiv="x-ua-compatible" content="ie=edge">
    <title>SGP</title>
    <!-- Font Awesome -->
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min.css">
    <!-- Bootstrap core CSS -->
    <link href="../assets/css/bootstrap.min.css" rel="stylesheet">
    <!-- Material Design Bootstrap -->
    <link href="../assets/css/mdb.min.css" rel="stylesheet">
    <!-- Your custom styles (optional) -->
    <link href="../assets/css/style.css" rel="stylesheet">
</head>

<body>

    <!-- Start your project here-->
    <div style="height: 100vh">
        <br />
        <div class="col-md-6 offset-md-3">
            <!-- Default form login -->
            <form id="formInstall" class="text-center border border-light p-5">
                <p class="h4 mb-4">Install SGP</p>

                <h5 class="text-left">Database</h5>
                <div class="row">
                    <div class="col">
                        <input name="db_host" type="text" class="form-control mb-4" placeholder="Host" required="required">
                    </div>
                    <div class="col">
                        <input name="db_base" type="text" class="form-control mb-4" placeholder="Database" required="required">
                    </div>
                </div>
                <div class="row">
                    <div class="col">
                        <input name="db_user" type="text" class="form-control mb-4" placeholder="User" required="required">
                    </div>
                    <div class="col">
                        <input name="db_pass" type="text" class="form-control mb-4" placeholder="Password">
                    </div>
                </div>
                
                <h5 class="text-left">Dealer</h5>
                <div class="row">
                    <div class="col">
                        <input name="dlr_nama" type="text" class="form-control mb-4" placeholder="Nama" required="required">
                    </div>
                    <div class="col">
                        <input name="dlr_kode" type="text" class="form-control mb-4" placeholder="Kode" required="required">
                    </div>
                    <div class="col">
                        <input name="dlr_nohp" type="text" class="form-control mb-4" placeholder="No. HP" required="required">
                    </div>
                </div>

                <h5 class="text-left">Admin</h5>
                <div class="row">
                    <div class="col">
                        <input name="admin_username" type="text" class="form-control mb-4" placeholder="Username" required="required">
                    </div>
                    <div class="col">
                        <input name="admin_password" type="password" class="form-control mb-4" placeholder="Password" required="required">
                    </div>
                </div>

                <!-- Sign in button -->
                <button id="btnSubmit" class="btn btn-info btn-block my-4" type="submit">Install</button>
                <a id="loading" style="display: none;" class="btn btn-grey btn-block my-4">Installing...</a>

            </form>
            <!-- Default form login -->
        </div>
    </div>
    <!-- /Start your project here-->

    <!-- SCRIPTS -->
    <!-- JQuery -->
    <script type="text/javascript" src="../assets/js/jquery-3.3.1.min.js"></script>
    <!-- Bootstrap tooltips -->
    <script type="text/javascript" src="../assets/js/popper.min.js"></script>
    <!-- Bootstrap core JavaScript -->
    <script type="text/javascript" src="../assets/js/bootstrap.min.js"></script>
    <!-- MDB core JavaScript -->
    <script type="text/javascript" src="../assets/js/mdb.min.js"></script>

    <script>
        jQuery(function($) {
            $('#formInstall').on('submit', function(event) {
                event.preventDefault();

                $('#btnSubmit').css('display', 'none');
                $('#loading').css('display', 'block');

                $.post('proses.php', $(this).serialize(), response => {
                    alert(response.message);
                    $('#loading').css('display', 'none');
                    
                    if (response.status == 'error') {
                        $('#btnSubmit').css('display', 'block');
                    } else {
                        window.location = '/';
                    }
                }, 'json');
            });
        });
    </script>
</body>

</html>
