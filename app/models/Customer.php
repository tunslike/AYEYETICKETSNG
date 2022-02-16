<?php

class Customer {
    private $db;

    public function __construct() {
        $this->db = new Database;
    }

    public function getCustomerID(){
        return $guid = bin2hex(openssl_random_pseudo_bytes(16));
    } 

    public function register($data) {

        try{
            
        $this->db->query("INSERT INTO esb_customers (CUSTOMER_ID, CUSTOMER_NUMBER, FIRST_NAME, LAST_NAME, MOBILE_PHONE, EMAIL, STATE, DATE_CREATED, IP_ADDRESS) 
                        VALUES(:customerid, :customerNo, :fname, :lname, :mobile, :email, :state, :dateCreated, :ipAddr) ");

        $date =  date('Y-m-d H:i:s');
        $customerid = $this->getCustomerID();
        $custNo = generateCustomerNo();

        //Bind values
        $this->db->bind(':fname', $data['firstname']);
        $this->db->bind(':lname', $data['lastname']);
        $this->db->bind(':mobile', $data['mobile']);
        $this->db->bind(':email', $data['email']);
        $this->db->bind(':state', $data['state']);
        $this->db->bind(':dateCreated', $date);
        $this->db->bind(':ipAddr', $data['remoteIP']);
        $this->db->bind(':customerid', $customerid);
        $this->db->bind(':customerNo', $custNo);

        //Execute function
        if ($this->db->execute()) {

            //generate password
            $this->setupPassword($customerid, $data['password'], 'CUSTOMER');

            $fullname = $data['firstname'].' '.$data['lastname'];
            $newpass = $data['password'];
            $email = $data['email'];
            $username = $custNo;

            //send notification
            sendRegistrationNotification($fullname, '123456', $email, $username);

        return true;
        } else {
        return false;
        }

        }catch(PDOException $e){
            echo 'ERROR!';
            print_r( $e );
        }
    }

    public function setupPassword($customerid, $password, $idtype) {

        try{
            
        $this->db->query("INSERT INTO esb_access (ID_TYPE, CUSTOMER_ID, ACCESS_ID, DATE_CREATED) 
                        VALUES(:idtype, :customerid, :accessid, :dateCreated)");

        $date =  date('Y-m-d H:i:s');

        //Bind values
        $this->db->bind(':idtype', $idtype);
        $this->db->bind(':customerid', $customerid);
        $this->db->bind(':accessid', $password);
        $this->db->bind(':dateCreated', $date);

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

    public function SendCustomerOrderConfirmation ($orderSeqnum) {
        
        $this->db->query('SELECT O.ORDER_REF, (SELECT MOBILE FROM esb_vendor WHERE STORE_ID = S.STORE_ID)VENDOR_MOBILE 
                         FROM esb_orders O LEFT JOIN esb_store S ON O.SERVICED_BY = S.STORE_REF WHERE O.SEQ_NUM = :seqnum;');

        //Bind value
        $this->db->bind(':seqnum', $orderSeqnum);

        $rowData = $this->db->single();

        $vendormobile = $rowData->VENDOR_MOBILE;
        $orderRef = $rowData->ORDER_REF;

        //send SMS
        SendCustomerOrderConfirmation($vendormobile, $orderRef);

        return true;
    }

    public function LoadCustomerOrders ($customerid) {

            //Prepared statement
            $this->db->query("SELECT O.SEQ_NUM, O.STATUS, O.ORDER_RECEIVED, O.ORDER_DATE, O.DELIVERY_TYPE, O.ORDER_REF, P.NAME, P.AMOUNT  FROM esb_orders O LEFT JOIN esb_products P 
                               ON O.PRODUCT_ID = P.PRODUCT_ID WHERE CUSTOMER_ID = :customerid ORDER BY O.ORDER_DATE DESC");
   
            //Bind values
            $this->db->bind(':customerid', $customerid);
   
            $results = $this->db->resultSet();
   
            return $results;
    }

    public function ConfirmCustomerOrder ($customerid, $productid) {

        try{
            
            $this->db->query("UPDATE esb_orders SET ORDER_RECEIVED = 1, DATE_RECEIVED = :date_received WHERE SEQ_NUM = :seqnum AND CUSTOMER_ID = :customerid");
    
            $date =  date('Y-m-d H:i:s');
    
            //Bind values
            $this->db->bind(':customerid', $customerid);
            $this->db->bind(':seqnum', $productid);
            $this->db->bind(':date_received', $date);
    
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

    public function resetPassword ($customerid, $password, $ipaddress) {

        try{
            
            $this->db->query("UPDATE esb_access SET ACCESS_ID = :accessid, RESET_DATE = :resetDate, RESET_PWD_IP = :ipaddress WHERE CUSTOMER_ID = :customerid");
    
            $date =  date('Y-m-d H:i:s');
    
            //Bind values
            $this->db->bind(':customerid', $customerid);
            $this->db->bind(':accessid', $password);
            $this->db->bind(':ipaddress', $ipaddress);
            $this->db->bind(':resetDate', $date);
    
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

    public function logout($customerid) {

        //update access login
        $this->db->query("UPDATE esb_access SET IS_LOGGED = 0 WHERE CUSTOMER_ID = :customerid");

        //Bind values
        $this->db->bind(':customerid', $customerid);
        
        //Execute function
        $this->db->execute();
    }

    public function loadCustomerProfile($customerid) {

        $this->db->query('SELECT * FROM esb_customers WHERE CUSTOMER_ID = :customerid');

        //Bind value
        $this->db->bind(':customerid', $customerid);

        $row = $this->db->single();

        return $row;

    }
    
    public function login($username, $password, $ipaddr) {

        if(strlen($username) == 4) {
            $this->db->query('SELECT CUSTOMER_ID, CUSTOMER_NUMBER, FIRST_NAME, MOBILE_PHONE, EMAIL FROM esb_customers WHERE STATUS = 0 AND CUSTOMER_NUMBER = :username');
        }else {
            $this->db->query('SELECT CUSTOMER_ID, CUSTOMER_NUMBER, FIRST_NAME, MOBILE_PHONE, EMAIL FROM esb_customers WHERE STATUS = 0 AND EMAIL = :username');
        }

        //Bind value
        $this->db->bind(':username', $username);

        $rowData = $this->db->single();

        $customerid = $rowData->CUSTOMER_ID;
        $email = $rowData->EMAIL;

        //get password
        $this->db->query('SELECT ACCESS_ID, FIRST_LOGIN_DATE FROM esb_access WHERE STATUS = 0 AND CUSTOMER_ID = :customerid');

        //Bind value
        $this->db->bind(':customerid', $customerid);

        $row = $this->db->single();

        $hashedPassword = $row->ACCESS_ID;
        $firstLogin = $row->FIRST_LOGIN_DATE;  

        if (password_verify($password, $hashedPassword)) {

            $this->ActivateUserLogin($customerid, $firstLogin, $ipaddr);

            return $rowData;
        } else {
            return false;
        }
    }

    //update user login details
    public function ActivateUserLogin($customerid, $firstLogin, $ipaddr){
        
        if($firstLogin == ''){
            $sql = "UPDATE esb_access SET FIRST_LOGIN_DATE = :logindate, LAST_LOGIN_DATE = :logindate, IP_ADDRESS = :ipaddress, IS_LOGGED = 1 WHERE CUSTOMER_ID = :customerid";
        }else{
            $sql = "UPDATE esb_access SET LAST_LOGIN_DATE = :logindate, IP_ADDRESS = :ipaddress, IS_LOGGED = 1 WHERE CUSTOMER_ID = :customerid";
        }

        //update access login
        $this->db->query($sql);

        $date =  date('Y-m-d H:i:s');

        //Bind values
        $this->db->bind(':customerid', $customerid);
        $this->db->bind(':logindate', $date);
        $this->db->bind(':ipaddress', $ipaddr);
        
        //Execute function
        $this->db->execute();
    }

    //Find user by email. Email is passed in by the Controller.
    public function findUserByEmail($email) {

        //Prepared statement
        $this->db->query('SELECT * FROM esb_customers WHERE EMAIL = :email');
 
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