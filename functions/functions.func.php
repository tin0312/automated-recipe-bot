<?php

require_once '../includes/constant.inc.php';

function getBlindIndex($string): string
{
    $index_key = base64_decode(CRYPT['indexKey']);
    return bin2hex(
        sodium_crypto_pwhash(
            32,
            $string,
            $index_key,
            SODIUM_CRYPTO_PWHASH_OPSLIMIT_MODERATE,
            SODIUM_CRYPTO_PWHASH_MEMLIMIT_MODERATE
        )
    );
}


function encrypt($string): array
{
    if (empty($string)) {
        return ['', ''];
    }

    $string_hash = getBlindIndex($string);

    $pk = base64_decode(CRYPT['privateKey']);
    $nonce = random_bytes(SODIUM_CRYPTO_SECRETBOX_NONCEBYTES);
    $string = sodium_crypto_secretbox($string, $nonce, $pk);

    $string = base64_encode($nonce . $string);

    return [$string, $string_hash];
}
;

function decrypt($string)
{
    if (empty($string)) {
        return '';
    }
    $decoded = base64_decode($string);
    $pk = base64_decode(CRYPT['privateKey']);

    $nonce = mb_substr($decoded, 0, SODIUM_CRYPTO_SECRETBOX_NONCEBYTES, '8bit');
    $ciphertext = mb_substr($decoded, SODIUM_CRYPTO_SECRETBOX_NONCEBYTES, null, '8bit');

    try {
        return sodium_crypto_secretbox_open($ciphertext, $nonce, $pk);
    } catch (Error $ex) {
        return $string;
    } catch (Exception $ex) {
        return $string;
    }
}

