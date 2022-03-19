<?php

class Events extends Controller {

    public function __construct(){


        error_reporting(E_ALL);
        ini_set('display_errors', 'On');

        $this->userModel = $this->model('Event');
    }

    public function createTicket() {

        if(isLoggedIn()){
            
            $customerid = $_SESSION['user_id'];
            
        }else{

            header("Location: " . URLROOT . "/accounts/login?isLogged=0");
        }


        if($_SERVER['REQUEST_METHOD'] == 'POST') {

            //Sanitize post data
            $_POST = filter_input_array(INPUT_POST, FILTER_SANITIZE_STRING);

            $data = [

                'accountid' => $customerid,
                'eventCategory' => trim($_POST['eventCategory']),
                'eventName' => trim($_POST['eventName']),
                'venueName' => trim($_POST['venueName']),
                'venueAddress' => trim($_POST['venueAddress']),
                'venueLatitude' => trim($_POST['venue_loc_lat']),
                'venueLongtitude' => trim($_POST['venue_loc_long']),
                'startDate' => trim($_POST['startDate']),
                'endDate' => trim($_POST['endDate']),
                'startTime' => trim($_POST['startTime']),
                'endTime' => trim($_POST['endTime']),
                'ticketType' => trim($_POST['ticketType']),
                'ipaddress' => $this->getRealIPAddr(),
                'totalTickets' => $_POST['totalTickets'],
                'description' => $_POST['editorValue'],
                'eventtype' => $_POST['eventtype'],
                'status' => '',
                'errorMessage' => '',
                'title' => 'Events'
            ];

            if(isset($_FILES["evemtImage"]) && $_FILES["evemtImage"]["error"] == 0){ 
                
                
                $allowed = array("jpg" => "image/jpg", "jpeg" => "image/jpeg", "gif" => "image/gif", "png" => "image/png");

                $filename = $_FILES["evemtImage"]["name"];
                $filetype = $_FILES["evemtImage"]["type"];
                $filesize = $_FILES["evemtImage"]["size"];

                // Verify file extension
                $ext = pathinfo($filename, PATHINFO_EXTENSION);
                if(!array_key_exists($ext, $allowed)){
                    $data['errorMessage'] = "Error: Please select a valid file format";
                };

                // Verify file size - 5MB maximum
                $maxsize = 10 * 1024 * 1024;
                if($filesize > $maxsize) {
                    $data['errorMessage'] = "Error: File size is larger than the allowed limit.";
                };

                $data['filenameUploaded'] = $filename;
            }

                 //Register user from model function
                if ($this->userModel->CreateEvent($data)) { 

                    //set status
                    $data['status'] = 'true';

                    //Redirect to the login page
                    $this->view('events/createTicket', $data);

                    } else {

                            //set status
                        $data['status'] = 'false';
                        $data['errorMessage'] = 'Unable to complete you request, please retry.';

                        //Redirect to the login page
                        $this->view('events/createTicket', $data);
                    }

                    exit();
        }

        $categories = $this->userModel->fetchEventCategories();

        $data = [
            'status' => 'false',
            'title' => 'Find Events',
            'categories' => $categories,
        ];

        $this->view('events/createTicket', $data);

    }

    public function getRealIPAddr()
    {
        //check ip from share internet
        if (!empty($_SERVER['HTTP_CLIENT_IP'])) 
        {
            $ip = $_SERVER['HTTP_CLIENT_IP'];
        }
        //to check ip is pass from proxy
        elseif (!empty($_SERVER['HTTP_X_FORWARDED_FOR']))  
        {
            $ip = $_SERVER['HTTP_X_FORWARDED_FOR'];
        }
        else
        {
            $ip = $_SERVER['REMOTE_ADDR'];
        }
        return $ip;
    }

       //get product details
       public function submitReminderRequest () {


            if($_SERVER['REQUEST_METHOD'] == 'POST') {

                $data = [
                    'eventid' => trim($_POST['eventid']),
                    'emailad' => trim($_POST['emailad']),
                    'ipaddress' => $this->getRealIPAddr(),
                ];

                $result = $this->userModel->SaveEventReminder($data);
            }

        //response*********************************************
	    echo $result;

    }

    //get product details
    public function returnEventListName () {

        //get product id
        if(isset($_GET['searchVal'])) {
            $searchVal = $_GET['searchVal'];
        }

        $result = $this->userModel->searchInstandEvent($searchVal);

        //response*********************************************
	    echo json_encode($result);

    }

    public function find() {

        if(isset($_GET['pid'])) {
            $eventid = $_GET['pid'];
        }

        //get product id
        if(trim($eventid) == '') {
            header("Location: " . URLROOT . "/index");
        }

        $view = $this->userModel->updateEventView($eventid);
        
        $events = $this->userModel->findEventDetails($eventid);
        $tickets = $this->userModel->loadEventTickets($eventid);

        $data = [
            'title' => 'Find Details',
            'event' => $events,
            'tickets' => $tickets
        ];

        $this->view('events/find', $data);
    }

    public function loadEvent() {

        if(isset($_GET['category'])) {
            $search = $_GET['category'];
        }else{
            $search = '';
        }

        if(isset($_GET['format'])) {
            $format = $_GET['format'];
        }else{
            $format = '';
        }


        if(isset($_GET['page'])) {
            $pageNo = $_GET['page'];
        }else{
            $pageNo = 1;
        }
    
        $events = $this->userModel->loadAllEvents('all');

        $pageCount = count($events) / DisplayCount;

        $data = [
            'title' => 'Find Details',
            'events' => $events,
            'pageCount' => 5,
            'pageNo' => $pageNo,
            'format' => $format,
            'category' => $search,
        ];

        $this->view('events/loadEvent', $data);
    }

    public function makePayment() {


        if($_SERVER['REQUEST_METHOD'] == 'POST') {

            //Sanitize post data
            $_POST = filter_input_array(INPUT_POST, FILTER_SANITIZE_STRING);

            $data = [
                'gross_total' => trim($_POST['gross_total']),
                'eventid' => trim($_POST['eventid']),
                'p_fullname' => trim($_POST['p_fullname']),
                'p_mobile' => trim($_POST['p_phone']),
                'p_email' => trim($_POST['p_email']),
                'own_fullname' => trim($_POST['own_fullname']),
                'own_phone' => trim($_POST['own_phone']),
                'own_email' => trim($_POST['own_email']),
                'coupon_code' => trim($_POST['coupon_code']),
                'owned' => trim($_POST['ownerticket']),
                'ipaddress' => $this->getRealIPAddr(),
                'status' => '',
                'errorMessage' => '',
                'title' => 'Events'
            ];

            $paymentRef = $this->userModel->createTicketOrder($data);

            if($paymentRef != '') {
                
                $amount = $data['gross_total'] * 100;

                //generate payment link
                $paymentlink = $this->userModel->GeneratePaymentLink(($data['owned'] == '0') ? $data['p_email'] : $data['own_email'], $amount, $paymentRef);

                if($paymentlink != '') {
                    
                    header("Location: " . $paymentlink);
                    exit();

                }else{

                     //data
                    $data = [

                        'title' => 'Payment Confirmation - ',
                        'status' => 'false',
                    ];

                    $this->view('events/paymentConfirmation', $data);

                }

            }

            exit();

        }else{

            header("Location: " . URLROOT . "/index");
            exit();
        }

    }

    public function validatePaymentResponse() {

        if($_SERVER['REQUEST_METHOD'] == 'GET') {

            if(isset($_GET['reference'])) {
                $reference = $_GET['reference'];
            }

            if(isset($_GET['trxref'])) {
                $transRef = $_GET['trxref'];
            }
        }

        $status = $this->userModel->verifyPaymentTransaction($transRef);

        if($status == 'success') {

            if(isset($_SESSION['ticketList'])) {


                // ticket bookings happens here
                $tickets = json_decode($_SESSION['ticketList'], TRUE);            

                foreach($tickets as $ticket) {
    
                    $seq_num = $ticket['SeqNum'];
                    $count = $ticket['count'];     
                    
                    $booking = $this->userModel->BookPurchasedTickets($seq_num, $reference, $transRef);
                }
                // ticket bookings happens here

            }

            $_SESSION['reference'] = $reference;
            
            header("Location: " . URLROOT . "/events/paymentConfirmation?stat=1&complete=true");
            exit();

        }
        
    }

    public function paymentConfirmation() {

        if($_SERVER['REQUEST_METHOD'] == 'GET') {

            if(isset($_GET['stat'])) {
                $status = $_GET['stat'];
            }
        }

        if(isset($_SESSION['ticketList'])) {
            $tickets = $_SESSION['ticketList'];
        }

        if($status == 1) {
            $reference = $_SESSION['reference'];
        }

        $eventid = $this->userModel->fetchEventID($reference);
        $events = $this->userModel->findEventDetails($eventid);

        //data
        $data = [
            'event' => $events,
            'title' => 'Payment Confirmation - ',
            'status' => 'true',
            'tickets' => json_decode($tickets),
        ];

        $this->view('events/paymentConfirmation', $data);

    }

    public function purchasedTickets() {

        $data = [
            'title' => 'purchase',
        ];

        $this->view('events/purchasedTickets', $data);
    }

    public function confirmBooking() {

        if($_SERVER['REQUEST_METHOD'] == 'POST') {

            $data = [

                'eventid' => trim($_POST['eventid']),
                'ticketList' => trim($_POST['tickets']),
            ];

            $_SESSION['ticketList'] = $data['ticketList'];

            $tickets = json_decode($data['ticketList'], TRUE);

            $gross_total = 0;

            foreach($tickets as $ticket) {

                $seq_num = $ticket['SeqNum'];
                $count = $ticket['count'];
                $amount = $this->userModel->getTicketPrice($seq_num);

                $total = $amount * $count;

                $gross_total = $gross_total + $total;                        
            }

        }

        $events = $this->userModel->findEventDetails($data['eventid']);

        $data = [
            'event' => $events,
            'title' => 'Confirm Ticket Booking - ',
            'tickets' => $tickets,
            'gross_total' => $gross_total,
        ];

        /*
        var_dump($data['tickets']);
        exit();
        */

        $this->view('events/confirmBooking', $data);
    }

}