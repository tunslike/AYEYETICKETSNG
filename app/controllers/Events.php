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
                'eventName' => trim($_POST['eventName']),
                'venueName' => trim($_POST['venueName']),
                'venueAddress' => trim($_POST['venueAddress']),
                'startDate' => trim($_POST['startDate']),
                'endDate' => trim($_POST['endDate']),
                'startTime' => trim($_POST['startTime']),
                'endTime' => trim($_POST['endTime']),
                'ticketType' => trim($_POST['ticketType']),
                'ipaddress' => $this->getRealIPAddr(),
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

            }

            exit();

            var_dump($data);

            exit();

        }

        $data = [
            'event' => '',
            'title' => 'Find Events'
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

    public function find() {

        $data = [
            'event' => '',
            'title' => 'Find Events'
        ];

        $this->view('events/find', $data);
    }

    public function book() {

        $data = [
            'event' => '',
            'title' => 'Find Events'
        ];

        $this->view('events/book', $data);
    }

}