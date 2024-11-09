<?php

namespace App\Providers\Helper;

use Illuminate\Support\Facades\Crypt;
use Illuminate\Contracts\Encryption\DecryptException;


class Encrypt
{
    /********************************************************  encrypt *************************************************/
    public static function encrypt($value)
    {
        $encryptedValue = Crypt::encryptString($value, false, SECT_KEY);
        return $encryptedValue;
    }


    /********************************************************  decrypt *************************************************/
    public static function decrypt($value)
    {
        try {
            $decryptedValue = Crypt::decryptString($value, false, SECT_KEY);
            return $decryptedValue;
        } catch (DecryptException $e) {
            return null;
        }
    }
}
