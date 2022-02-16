<?php

class Accounts extends Controller {

    public function __construct(){

        error_reporting(E_ALL);
        ini_set('display_errors', 'On');

        $this->userModel = $this->model('Account');
    }

    public function login() {

        //Check for post
        if($_SERVER['REQUEST_METHOD'] == 'POST') {

            //Sanitize post data
            $_POST = filter_input_array(INPUT_POST, FILTER_SANITIZE_STRING);

            $data = [
                'username' => trim($_POST['username']),
                'password' => trim($_POST['entry']),
                'fieldError' => '',
                'remoteIP' => $this->getRealIPAddr(),
            ];

            //Validate username
            if (empty($data['username'])) {
                $data['fieldError'] = 'Username or password cannot be empty!';
            }

            //Validate username
            if (empty($data['password'])) {
                $data['fieldError'] = 'Username or password cannot be empty!';
            }

            //Check if all errors are empty
            if ($data['fieldError'] == '') {

                $loggedInUser = $this->userModel->login($data['username'], $data['password'], $data['remoteIP']);

                if ($loggedInUser) {

                    $this->createUserSession($loggedInUser);

                } else {

                    $data['passwordError'] = 'Password or username is incorrect. Please try again.';
                    $this->view('account/login', $data);
                }

            }else {

                $this->view('account/login', $data);
            }

        }

        $data = [
            'event' => '',
            'title' => 'Account Login'
        ];

        $this->view('account/login', $data);
    }


    public function resetPassword() {

        $data = [
            'event' => '',
            'title' => 'Find Events'
        ];

        $this->view('account/resetPassword', $data);
    }


    public function register() {


        if($_SERVER['REQUEST_METHOD'] == 'POST') {

            $data = [
                'firstname' => trim($_POST['fname']),
                'lastname' => trim($_POST['lname']),
                'email' => trim($_POST['email']),
                'mobile' => trim($_POST['phone']),
                'state' => trim($_POST['state']),
                'password' => '',
                'errorMessage' => '',
                'remoteIP' => $this->getRealIPAddr(),
                'status' => 'false'
            ];

              // Hash password
           $data['password'] = password_hash('1234567', PASSWORD_DEFAULT);

           //Register user from model function
           if ($this->userModel->register($data)) { 

               $data['status'] = 'true';

               //Redirect to the login page
               $this->view('account/register', $data);

           } else {

               die('Something went wrong.');
           }

        }

        $data = [
            'event' => '',
            'title' => 'Create a New Account'
        ];

        $this->view('account/register', $data);
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

    public function createUserSession($user) {

        //set session values
        $_SESSION['user_id'] = $user->ACCOUNT_ID;
        $_SESSION['firstname'] = $user->FIRST_NAME;
        $_SESSION['mobile'] = $user->MOBILE_PHONE;
        $_SESSION['email'] = $user->EMAIL;

        //redirect to home page
        header('location:' . URLROOT . '/pages/index');
    }

    public function logout() {

        $customerid = $_SESSION['user_id'];

        $this->userModel->logout($customerid);

        //unset
        unset($_SESSION['user_id']);
        unset($_SESSION['firstname']);
        unset($_SESSION['mobile']);
        unset($_SESSION['email']);
    
        //redirect to login
        header('location:' . URLROOT . '/accounts/login?r=1');
    }

}