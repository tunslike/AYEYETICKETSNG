<?php 

//send customer order confirmation
function SendCustomerOrderConfirmation ($number, $orderNo) {

    
    $mobileNo = '+234'.substr($number, 1);

    //message
    $message = "Dear Vendor, order ".$orderNo." has been successfully received and confirmed by the customer. your order payout is being processed. Thank you. VEVOLT.NG";

    //Send SMS
    SendSMS($mobileNo, $message);
}

//send customer order notification
function SendCustomerNewOrderNotification ($number, $orderid) {

    $mobileNo = '+234'.substr($number, 1);

    //message
    $message = "Dear Customer, thank you for buying with us, your order #".$orderid." is currently being processed. Call 080903098990 for enquiries on your order. VEVOLT.NG";

    //Send SMS
    SendSMS($mobileNo, $message);
}

//send customer order notification
function SendCustomerProcessOrderNotification ($number, $locationNumber, $orderid) {

    $mobileNo = '+234'.substr($number, 1);

    //message
    $message = "Dear customer, your order ".$orderid." has been processed and is ready for pickup at the selected pick up location. Please call ".$locationNumber." for details. VEVOLTNG";

    //Send SMS
    SendSMS($mobileNo, $message);
}

//send vendor order notification
function SendVendorOrderNotification($number, $orderid, $orderDate) {

    $mobileNo = '+234'.substr($number, 1);

    //order message
    $message = "Dear Vendor, a customer order ".$orderid." has been placed on your store. Kindly log into your store to process order. Order is due by ".$orderDate.". VevoltNG";

    //Send SMS
    SendSMS($mobileNo, $message);

}

function SendSMS($sendto, $message) {

    $email = SMS_EmailID;
    $password = SMS_Password;
    $sender_name = SMS_SenderID;

    $message = $message;
    $recipients = $sendto;
    
    $forcednd = "0";

    $data = array(
        "email" => $email,
        "password" => $password,
        "message" => $message,
        "sender_name" => $sender_name,
        "recipients" => $recipients,
        "forcednd" => $forcednd
    );

    $data_string = json_encode($data);

    $ch = curl_init('https://app.multitexter.com/v2/app/sms');

    curl_setopt($ch, CURLOPT_CUSTOMREQUEST, "POST");
    curl_setopt($ch, CURLOPT_POSTFIELDS, $data_string);
    curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
    curl_setopt($ch, CURLOPT_HTTPHEADER, array(
        'Content-Type: application/json',
        'Content-Length: ' . strlen($data_string)
    ));

    $result = curl_exec($ch);
    $res_array = json_decode($result);

    return $res_array; 
}

?>
