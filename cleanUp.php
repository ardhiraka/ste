<?php

if (isset($_GET['install'])) :
    $installDir = __DIR__.'/install';

    // Remove File Inside
    array_map('unlink', glob("$installDir/*.*"));

    // Remove Folder
    rmdir($installDir);

    // function delete_files($target) {
    //     if (is_dir($target)) :
    //         $files = glob($target . '*', GLOB_MARK);
            
    //         foreach($files as $file) :
    //             delete_files($file);      
    //         endforeach;

    //         rmdir($target);
    //     elseif (is_file($target)) :
    //         unlink($target);  
    //     endif;
    // }

    // Uncomment this For Production Only
    // delete_files($installDir);
endif;

header("location: index.php");