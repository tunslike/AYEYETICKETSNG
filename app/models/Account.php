<?php
class Account {
    private $db;
    public function __construct() {
        $this->db = new Database;
    }

    public function getCustomerID(){
        return $guid = bin2hex(openssl_random_pseudo_bytes(16));
    } 

    public function register($data) {

        try{
            
        $this->db->query("INSERT INTO HTNG_Accounts (ACCOUNT_ID, FIRST_NAME, LAST_NAME, MOBILE_PHONE, EMAIL, STATE, DATE_CREATED, CREATED_BY) 
                        VALUES (:accountid, :fname, :lname, :mobile, :email, :state, :dateCreated, 'SYSTEM') ");

        $date =  date('Y-m-d H:i:s');
        $accountid = $this->getCustomerID();
        
        //Bind values
        $this->db->bind(':fname', $data['firstname']);
        $this->db->bind(':lname', $data['lastname']);
        $this->db->bind(':mobile', $data['mobile']);
        $this->db->bind(':email', $data['email']);
        $this->db->bind(':state', $data['state']);
        $this->db->bind(':dateCreated', $date);
        $this->db->bind(':accountid', $accountid);


        //Execute function
        if ($this->db->execute()) {

            //generate password
            $this->setupPassword($accountid, $data['password'], $data['remoteIP']);

            $fullname = $data['firstname'].' '.$data['lastname'];
            $newpass = $data['password'];
            $email = $data['email'];
            $username = $custNo;

            //send notification
           // sendRegistrationNotification($fullname, '123456', $email, $username);

        return true;
        } else {
        return false;
        }

        }catch(PDOException $e){
            echo 'ERROR!';
            print_r( $e );
        }
    }

    public function setupPassword($customerid, $password, $ipadres) {

        try{
            
        $this->db->query("INSERT INTO HTNG_Access (ACCOUNT_ID, ACCESS_CODE, DATE_CREATED, IP_ADDRESS) 
                        VALUES(:customerid, :accessid, :dateCreated, :ipaddress)");

        $date =  date('Y-m-d H:i:s');

        //Bind values
        $this->db->bind(':customerid', $customerid);
        $this->db->bind(':accessid', $password);
        $this->db->bind(':dateCreated', $date);
        $this->db->bind(':ipaddress', $ipadres);

        //Execute function
        if ($this->db->execute()) {
        return true;
        } else {
        return false;
        }

        }catch(PDOException $e){
            echo 'ERROR!';
            print_r( $e );
        }
    }

    public function login($username, $password, $ipaddr) {

            $this->db->query('SELECT ACCOUNT_ID, FIRST_NAME, LAST_NAME, MOBILE_PHONE, EMAIL, FIRST_LOGIN_DATE FROM HTNG_Accounts 
                              WHERE STATUS = 0 AND EMAIL = :username');

            //Bind value
            $this->db->bind(':username', $username);

            $rowData = $this->db->single();

            $accountid = $rowData->ACCOUNT_ID;
            $email = $rowData->EMAIL;
            $firstLogin = $rowData->FIRST_LOGIN_DATE;  

            //get password
            $this->db->query('SELECT ACCESS_CODE FROM HTNG_Access 
                              WHERE STATUS = 0 AND ACCOUNT_ID = :accountid');

            //Bind value
            $this->db->bind(':accountid', $accountid);

            $row = $this->db->single();

            $hashedPassword = $row->ACCESS_CODE;
            
            if (password_verify($password, $hashedPassword)) {

                $this->ActivateUserLogin($accountid, $firstLogin, $ipaddr);

                return $rowData;
                
            } else {
                return false;
            }
    }

    public function logout($customerid) {

        //update access login
        $this->db->query("UPDATE HTNG_Accounts SET IS_LOGGED = 0 WHERE ACCOUNT_ID = :customerid");

        //Bind values
        $this->db->bind(':customerid', $customerid);
        
        //Execute function
        $this->db->execute();
    }

    //update user login details
    public function ActivateUserLogin($accountid, $firstLogin, $ipaddr){
        
        if($firstLogin == ''){
            $sql = "UPDATE HTNG_Accounts SET FIRST_LOGIN_DATE = :logindate, LAST_LOGIN_DATE = :logindate, IP_ADDRESS = :ipaddress, IS_LOGGED = 1 WHERE ACCOUNT_ID = :accountid";
        }else{
            $sql = "UPDATE HTNG_Accounts SET LAST_LOGIN_DATE = :logindate, IP_ADDRESS = :ipaddress, IS_LOGGED = 1 WHERE ACCOUNT_ID = :accountid";
        }

        //update access login
        $this->db->query($sql);

        $date =  date('Y-m-d H:i:s');

        //Bind values
        $this->db->bind(':accountid', $accountid);
        $this->db->bind(':logindate', $date);
        $this->db->bind(':ipaddress', $ipaddr);
        
        //Execute function
        $this->db->execute();
    }

    //Find user by email. Email is passed in by the Controller.
    public function findUserByEmail($email) {
        //Prepared statement
        $this->db->query('SELECT * FROM users WHERE email = :email');

        //Email param will be binded with the email variable
        $this->db->bind(':email', $email);

        //Check if email is already registered
        if($this->db->rowCount() > 0) {
            return true;
        } else {
            return false;
        }
    }
}
