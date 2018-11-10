<?php

class Machine
{

    private static $method      = "AES-128-ECB";
    private static $password    = "ZRorfNRF9u8ue1pSWtcViuiWQxitk7qY";
    
    public static function uuid()
    {
        $getUuid    = shell_exec("echo | {$_ENV['SystemRoot']}\System32\wbem\wmic.exe path win32_computersystemproduct get uuid");
        $split      = explode("\n", trim($getUuid));
        $uuid       = $split[1];

        return $uuid;
    }

    public static function encrypt($plaintext)
    {
        return openssl_encrypt($plaintext, self::$method, self::$password);
    }

    public static function decrypt($chipertext)
    {
        return openssl_decrypt($chipertext, self::$method, self::$password);
    }

    public static function license()
    {
        $uuid = self::uuid();
        $file = __DIR__ . "/../../app.lcs";

        file_put_contents($file, self::encrypt($uuid));
    }

    public static function getLicense()
    {
        $file = __DIR__ . "/../../app.lcs";

        return file_get_contents($file);
    }

    public static function validate()
    {
        $uuid       = self::uuid();
        $license    = self::getLicense();
        $decrypt    = self::decrypt($license);

        return $uuid == $decrypt;
    }
}