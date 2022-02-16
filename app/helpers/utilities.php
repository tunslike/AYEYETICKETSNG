<?php
    
    function getUniqueUserID(){
        return $guid = bin2hex(openssl_random_pseudo_bytes(16));
    }

    function convertImageToBlob($file) {

        if(file_exists($file)){
            return file_get_contents($file);
        }else{
            return 'false';
        }
    }

    function generateCustomerNo () {
        return mt_rand(1000,9999);
    }

    function addLeadingZero($value){
        return str_pad($value, '5', '0', STR_PAD_LEFT);
    }

    function setCartCookie ($cookieName, $cookieValue) {        
        setcookie($cookieName, $cookieValue, time() + 3600, '/' ); // set cookie for 1 hour
    }

    function retrieveCartCookie () {
        return $_COOKIE["cartItem"];
    }

    function time_elapsed_string($datetime, $full = false) {
        $now = new DateTime;
        $ago = new DateTime($datetime);
        $diff = $now->diff($ago);
    
        $diff->w = floor($diff->d / 7);
        $diff->d -= $diff->w * 7;
    
        $string = array(
            'y' => 'year',
            'm' => 'month',
            'w' => 'week',
            'd' => 'day',
            'h' => 'hour',
            'i' => 'minute',
            's' => 'second',
        );
        foreach ($string as $k => &$v) {
            if ($diff->$k) {
                $v = $diff->$k . ' ' . $v . ($diff->$k > 1 ? 's' : '');
            } else {
                unset($string[$k]);
            }
        }
    
        if (!$full) $string = array_slice($string, 0, 1);
        return $string ? implode(', ', $string) . ' ago' : 'just now';
    }