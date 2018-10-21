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
        $lines  = file('installer.sql');

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

        // Start - Insert Dealer & Admin
        $db->insert('admin', [
            'username'  => $_POST['admin_username'],
            'password'  => password_hash($_POST['admin_password'], PASSWORD_BCRYPT, ['cost' => 11]),
        ]);

        $db->insert('member', [
            'nama'      => $_POST['dlr_nama'],
            'kodeid'    => $_POST['dlr_kode'],
            'nohp'      => $_POST['dlr_nohp'],
            'downline'  => '0'
        ]);

        $id_dealer      = $db->last_insert_id();
        $dealer_config  = file_get_contents('config_dealer.json');

        $db->insert('member_config', [
            'member_id' => $id_dealer,
            'config'    => $dealer_config,
        ]);

        // End - Insert Dealer & Admin

        // Start - Create DB Configuration
        $fileConfig = 'db.example';
        $config     = file_get_contents($fileConfig);
        $search     = ["%DBHOST%", "%DBUSER%", "%DBPASS%", "%DBBASE%"];
        $replace    = [$_POST['db_host'], $_POST['db_user'], $_POST['db_pass'], $_POST['db_base']];
        $newConfig  = str_replace($search, $replace, $config);
        
        file_put_contents($fileConfig, $newConfig);
        copy($fileConfig, "../app/db.php");
        // End - Create DB Configuration
    endif;
endif;

echo json_encode([
    'status'    => $db_error ? "error" : "success",
    'message'   => $db_error ? $db_error : "Aplikasi berhasil diinstal!",
]);

$installDir = __DIR__;

function delete_files($target) {
    if (is_dir($target)) :
        $files = glob($target . '*', GLOB_MARK);
        
        foreach($files as $file) :
            delete_files($file);      
        endforeach;

        rmdir($target);
    elseif (is_file($target)) :
        unlink($target);  
    endif;
}

// Uncomment this For Production Only
// delete_files($installDir);
