<?php

function GenerateUniqueSEQ(string $customPrefix = "", int $length = 256)
{
    // Method By hackan@gmail.com from 7 years ago. :)
    if (function_exists("random_bytes")){

        $bytes_ = random_bytes(ceil($length / 2));
    }elseif (function_exists("openssl_random_pseudo_bytes")) {
    
        $bytes_ = openssl_random_pseudo_bytes(ceil($length / 2));
    }else{
        
        throw new Exception("no cryptographically secure random function available");
    }

    return ($customPrefix . substr(bin2hex($bytes_), 0, $length));
}