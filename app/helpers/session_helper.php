<?php
    session_start();

    function isLoggedIn() {
        if (isset($_SESSION['user_id'])) {
            return true;
        } else {
            return false;
        }
    }


    function isVendorLoggedIn() {
        if (isset($_SESSION['vendor_id'])) {
            return true;
        } else {
            return false;
        }
    }
