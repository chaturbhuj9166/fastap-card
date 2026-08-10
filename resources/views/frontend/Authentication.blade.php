<?php
class AesCipher {
 
    private const OPENSSL_CIPHER_NAME = "aes-128-cbc";
    private const CIPHER_KEY_LEN = 16;
    private static function fixKey($key) {
        
        // echo "key=". $key;
        // die;
        
        if (strlen($key) < AesCipher::CIPHER_KEY_LEN) {

            return str_pad("$key", AesCipher::CIPHER_KEY_LEN, "0");
        }

        if (strlen($key) > AesCipher::CIPHER_KEY_LEN) {

            return substr($key, 0, AesCipher::CIPHER_KEY_LEN);
        }
        return $key;
    }

    static function encrypt($key, $iv, $data) {
        //echo "key". $key;
        //die;
        //echo 'Data value is :' .$data;
        //echo "<br>";
        $encodedEncryptedData = base64_encode(openssl_encrypt($data, AesCipher::OPENSSL_CIPHER_NAME, AesCipher::fixKey($key), OPENSSL_RAW_DATA, $iv));
        $encodedIV = base64_encode($iv);
        $encryptedPayload = $encodedEncryptedData.":".$encodedIV;
        //echo '$encryptedPayload value is :' .$encryptedPayload;
        return $encryptedPayload;
    }

    static function decrypt($key,$iv, $data) {
        
        //echo "key==". $key;
      // die;
        //$key='2g3g4SG0aXGoIXI6';
       // $iv='3WFfiQ1I3VRruUVO';
        
        $parts = explode(':', $data);
        //print_r($parts);                     //Separate Encrypted data from iv.
        
        //die;
        //echo "<br>";
        $encrypted = $parts[0];
        $iv = $parts[1];
        
        //echo "encrypted=". $encrypted;
        //echo "<br/>";
        //echo "iv=". $iv;
        //die;
        
        $decryptedData = openssl_decrypt(base64_decode($encrypted), AesCipher::OPENSSL_CIPHER_NAME, AesCipher::fixKey($key), OPENSSL_RAW_DATA, base64_decode($iv));
        return $decryptedData;
    }

}

?>

<!--@php-->
<!--    function decryptData($key, $iv, $data) {-->
<!--        $parts = explode(':', $data);-->
        
<!--        if (isset($parts[0]) && isset($parts[1])) {-->
<!--            $encrypted = $parts[0];-->
<!--            $iv = $parts[1];-->
            
<!--            $decryptedData = openssl_decrypt(base64_decode($encrypted), config('app.openssl_cipher_name'), fixKey($key), OPENSSL_RAW_DATA, base64_decode($iv));-->
<!--            return $decryptedData;-->
<!--        } else {-->
<!--            return 'Invalid data format'; // Handle the case where data is not in the expected format-->
<!--        }-->
<!--    }-->

<!--    function fixKey($key) {-->
<!--        $length = 16;-->
<!--        return str_pad(substr($key, 0, $length), $length, "\0");-->
<!--    }-->

<!--    $key = '2g3g4SG0aXGoIXI6';-->
<!--    $iv = '3WFfiQ1I3VRruUVO';-->
<!--    $data = ''; // Provide your encrypted data here-->
<!--    $decrypted = decryptData($key, $iv, $data);-->
<!--@endphp-->
