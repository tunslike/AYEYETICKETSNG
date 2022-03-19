<?php
    //Database params
    define('DB_HOST', 'localhost'); //Add your db host
    define('DB_USER', 'root'); // Add your DB root
    define('DB_PASS', ''); //Add your DB pass
    define('DB_NAME', 'HelloTicketsNG'); //Add your DB Name

    //APPROOT
    define('APPROOT', dirname(dirname(__FILE__)));

    //URLROOT (Dynamic links)
    define('URLROOT', 'http://localhost:8080/helloticketsng');

    //Sitename
    define('SITENAME', 'Get the buzz | Hellotickets.ng');

    //Event display row count
    define('DisplayCount', 9);

    //Email Configuration
    define('EMAIL_USERNAME', 'tunslike@gmail.com');
    define('EMAIL_API_KEY', '3dc0b88c-71e0-451c-8f7b-884e32d411e2');

    define('SMS_SenderID', 'VevoltNG');
    define('SMS_EmailID', 'tunslike@yahoo.com');
    define('SMS_Password', '@Dmin123$');


    //PAYSTACK CONFIGURATION
    define('PAYSTACK_Base_Url', 'https://api.paystack.co/transaction/initialize');
    define('PAYSTACK_Test_Secret_Key', 'sk_test_785bec1ec7a487f89843335a8d06cc74d1082115');
    define('PAYSTACK_Test_Public_Key', 'pk_test_36b0e503069e33cdcc4620147cdde8f4b4515700');
    define('PAYSTACK_Callback_Url', URLROOT.'/events/validatePaymentResponse');

    //GOOGLE API KEYS
    define('GoogleAPIKeys', 'AIzaSyAsV6TozhWhUnNklfQg8w2uPKSCXgX7wac');
    


