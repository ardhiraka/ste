<?php
error_reporting(0);

require_once '../app/vendor/autoload.php';

use vielhuber\dbhelper\dbhelper;

$db = new dbhelper();

if ($_POST) :
    $db_error = false;

    $mysqli = new mysqli($_POST['db_host'], $_POST['db_user'], $_POST['db_pass'], $_POST['db_base']);

    if (mysqli_connect_errno()) :
        $db_error = mysqli_connect_error();
    endif;

    if (!$db_error) :
        // Start - Import
        $query  = '';
        $lines  = file('../db/installer.sql');

        foreach ($lines as $line) :
            if (substr($line, 0, 2) == '--' || $line == '' || substr($line, 0, 2) == '/*' )
                continue;

            $query .= $line;

            if (substr(trim($line), -1, 1) == ';') :
                $mysqli->query($query);
                
                $query = '';
            endif;
        endforeach;

        $mysqli->close();
        // End - Import

        $db->connect('pdo', 'mysql', $_POST['db_host'], $_POST['db_user'], $_POST['db_pass'], $_POST['db_base'], 3306);

        // Start - Insert Dealer & User
        $db->insert('member', [
            'nama'      => $_POST['dlr_nama'],
            'kodeid'    => $_POST['dlr_kode'],
            'nohp'      => $_POST['dlr_nohp'],
            'downline'  => '0'
        ]);

        $db->insert('admin', [
            'username'  => $_POST['admin_username'],
            'password'  => password_hash($_POST['admin_password'], PASSWORD_BCRYPT, ['cost' => 11]),
        ]);
        // End - Insert Dealer & User
    endif;
endif;

echo json_encode([
    'status'    => $db_error ? "error" : "success",
    'message'   => $db_error ? $db_error : "Aplikasi berhasil diinstal!",
]);

$installDir = __DIR__;

function delete_files($target) {
    if(is_dir($target)){
        $files = glob( $target . '*', GLOB_MARK );
        foreach( $files as $file )
        {
            delete_files( $file );      
        }
        rmdir( $target );
    } elseif(is_file($target)) {
        unlink( $target );  
    }
}

// For Production Only
// delete_files($installDir);