<?php
// shows what cipher methods are available for this installation:
//echo implode(', ', openssl_get_cipher_methods());

// encrypt using AES, key size 256, XTS mode
$plainText = 'Super Secret Credentials';
$method = 'aes-256-xts';
$key = random_bytes(16);
$iv  = random_bytes(16);
$cipherText = openssl_encrypt($plainText, $method, $key, 0, $iv);
$cipherText = base64_encode($cipherText);
echo "ENCODED: \n";
echo $cipherText . PHP_EOL;

// decrypt using AES, key size 256, GCM mode
$plainText = openssl_decrypt(base64_decode($cipherText), $method, $key, 0, $iv);
echo "\nDECODED: \n";
echo $plainText . PHP_EOL;

