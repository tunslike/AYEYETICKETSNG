<?php
class Event {

    private $db;

    public function __construct() {
        $this->db = new Database;
    }

    public function CreateEvent($data) {

        try{

            $this->db->query("INSERT INTO HTNG_Events (EVENT_ID, ACCOUNT_ID, EVENT_NAME, VENUE_NAME, VENUE_LOCATION, 
                             EVENT_IMAGE, START_DATE, END_DATE, START_TIME, END_TIME, DESCRIPTION, CATEGORY, ACCESS_TYPE, 
                             DATE_CREATED, CREATED_BY, IP_ADDRESS) 
                             VALUES (:eventid, :storeid, :name, :amount, :image, :dateCreated) ");

            $date =  date('Y-m-d H:i:s');
            $productid = getUniqueUserID();

            //Bind values
            $this->db->bind(':name', $data['name']);
            $this->db->bind(':amount', $data['amount']);
            $this->db->bind(':image', convertImageToBlob($data['image']));
            $this->db->bind(':dateCreated', $date);
            $this->db->bind(':productid', $productid);
            $this->db->bind(':storeid', $data['storeid']);

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

    public function getCustomerOrderItems($orderRef) {

         //Prepared statement
         $this->db->query("SELECT O.ORDER_REF, P.NAME, P.AMOUNT  FROM esb_orders O LEFT JOIN esb_products P 
                            ON O.PRODUCT_ID = P.PRODUCT_ID WHERE ORDER_REF = :orderRef");

         //Bind values
         $this->db->bind(':orderRef', $orderRef);

         $results = $this->db->resultSet();

         return $results;
    }

     //function to return orders
     public function getCustomerOrderswithID($orderRef) {

        //Prepared statement
        $this->db->query("SELECT ORDER_ID, DELIVERY_NAME, L.ADDRESS, DELIVERY_PHONE, DELIVERY_EMAIL, ORDER_REF, DELIVERY_TYPE, DELIVERY_STATE, ITEM_COUNT, O.DATE_CREATED FROM esb_customer_order O LEFT JOIN esb_PICKUP_LOCATION L ON O.DELIVERY_ADDRESS = L.CODE WHERE ORDER_REF = :orderRef");

        //Bind values
        $this->db->bind(':orderRef', $orderRef);

        $row = $this->db->single();

        return $row;

    }//end of function

    //function to return orders
    public function getCustomerOrders() {

        //Prepared statement
        $this->db->query("SELECT ORDER_ID, ORDER_REF, DELIVERY_TYPE, DELIVERY_STATE, ITEM_COUNT, DATE_CREATED, STATUS FROM esb_customer_order 
                         ORDER BY DATE_CREATED DESC;");

        $results = $this->db->resultSet();

        return $results;

    }//end of function


    public function loadUploadTempData($vendorid) {
        
        //Prepared statement
        $this->db->query("SELECT T.PRODUCT_CODE, P.NAME, P.AMOUNT, T.QUANTITY FROM esb_temp_product_upload 
                          T LEFT JOIN esb_products P ON T.PRODUCT_CODE = P.PRODUCT_CODE WHERE T.VENDOR_ID = :vendorid");

        //Bind values
        $this->db->bind(':vendorid', $vendorid);

        $results = $this->db->resultSet();

        return $results;
   }

   public function clearTempUploadData ($uploadid) {

    try{
        
            $this->db->query("DELETE FROM esb_temp_product_upload WHERE UPLOAD_ID = :uploadid");

            //Bind values
            $this->db->bind(':uploadid', $uploadid);
        
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

   public function getUploadTempData($uploadid) {
        
    //Prepared statement
    $this->db->query("SELECT P.PRODUCT_ID, T.PRODUCT_CODE, P.NAME, P.AMOUNT, T.QUANTITY FROM esb_temp_product_upload 
                      T LEFT JOIN esb_products P ON T.PRODUCT_CODE = P.PRODUCT_CODE WHERE T.UPLOAD_ID = :uploadid");

    //Bind values
    $this->db->bind(':uploadid', $uploadid);

    $results = $this->db->resultSet();

    return $results;
}

    public function insertTempUpload($vendorid, $product_code, $product_name, $quantity, $uploadid) {

        try{
            
            $this->db->query("INSERT INTO esb_temp_product_upload (UPLOAD_ID, VENDOR_ID, PRODUCT_CODE, PRODUCT_NAME, QUANTITY, DATE_CREATED) 
                              VALUES (:uploadid, :vendorid, :product_code, :product_name, :quantity, :datecreated)");
    
            $date =  date('Y-m-d H:i:s');
            
            //Bind values
            $this->db->bind(':uploadid', $uploadid);
            $this->db->bind(':vendorid', $vendorid);
            $this->db->bind(':product_code', $product_code);
            $this->db->bind(':product_name', $product_name);
            $this->db->bind(':quantity', $quantity);
            $this->db->bind(':datecreated', $date);
    
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

    public function updateCustomerOrderItems($orderRef, $storeid) {

        try{
            
            $this->db->query("UPDATE esb_orders SET STATUS = 1, STORE_ID = :storeid, SERVICED_BY = :storeid, SERVICED_DATE = :service_date WHERE ORDER_REF = :orderRef");

            $date =  date('Y-m-d H:i:s');

            //Bind values
            $this->db->bind(':storeid', $storeid); 
            $this->db->bind(':orderRef', $orderRef);        
            $this->db->bind(':service_date', $date);
    
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

    public function completeCustomerOrder($orderRef, $storeid) {

        try{
            
            $this->db->query("UPDATE esb_customer_order SET STATUS = 1, SERVICED_BY = :storeid, SERVICED_DATE = :serdate WHERE ORDER_REF = :orderRef");

            $date =  date('Y-m-d H:i:s');

            //Bind values
            $this->db->bind(':storeid', $storeid);  
            $this->db->bind(':orderRef', $orderRef);       
            $this->db->bind(':serdate', $date);
    
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

    public function loadVendorStoreProducts($vendorid) {
        
         //Prepared statement
         $this->db->query('SELECT P.NAME, P.PRODUCT_CODE, P.CATEGORY_ID, P.AMOUNT, SUM(V.QUANTITY)QUANTITY, P.MANUFACTURER, P.STATUS
                           FROM esb_vendor_product_setup V LEFT JOIN esb_products P ON V.PRODUCT_ID = P.PRODUCT_ID 
                           WHERE V.VENDOR_ID = :vendorid GROUP BY P.NAME, P.CATEGORY_ID, P.AMOUNT, P.MANUFACTURER, P.STATUS
                           ORDER BY V.DATE_CREATED DESC;');

         //Bind values
         $this->db->bind(':vendorid', $vendorid);
 
         $results = $this->db->resultSet();
 
         return $results;
    }

    //function to add new product
    public function addNewProduct($data) {

        try{

            $this->db->query("INSERT INTO esb_vendor_product_setup (VENDOR_ID, STORE_ID, PRODUCT_ID, QUANTITY, DATE_CREATED, IP_ADDRESS) 
                            VALUES(:vendorid, :storeid, :productid, :quantity, :dateCreated, :ipaddr) ");

            $date =  date('Y-m-d H:i:s');
        
            //Bind values
            $this->db->bind(':vendorid', $data['vendorid']);
            $this->db->bind(':storeid', $data['storeid']);
            $this->db->bind(':productid', $data['productid']);
            $this->db->bind(':quantity', $data['quantity']);
            $this->db->bind(':dateCreated', $date);
            $this->db->bind(':ipaddr', $data['ipaddress']);
            

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

    //function to get product detail
    public function getProductDetails($productid) {

        $this->db->query('SELECT AMOUNT, QUANTITY, DESCRIPTION FROM esb_products WHERE PRODUCT_ID = :productid');

        //Bind value
        $this->db->bind(':productid', $productid);

        $row = $this->db->single();

        return $row;
    }


    //function to create new store
    public function createNewStore($data) {

        try{

            $this->db->query('SELECT COUNT(*)COUNT FROM esb_store');

            $count = $this->db->single();

            $id = ($count->COUNT == 0) ? '1' : $count->COUNT;

            $this->db->query("INSERT INTO esb_store (STORE_ID, STORE_REF, ACCESS_ID, NAME, ADDRESS, STATE, MOBILE, EMAIL, CATEGORY, DATE_CREATED) 
            VALUES(:storeid, :storeref, :accessid, :name, :address, :state, :mobile, :email, :category, :dateCreated) ");

            $date =  date('Y-m-d H:i:s');
            $storeid = getUniqueUserID();
            $storeRef = 'V-'.date('ynj').addLeadingZero($id);

            //Bind values
            $this->db->bind(':accessid', $data['accessid']);
            $this->db->bind(':name', $data['name']);
            $this->db->bind(':address', $data['address']);
            $this->db->bind(':mobile', $data['mobile']);
            $this->db->bind(':email', $data['email']);
            $this->db->bind(':state', $data['state']);
            $this->db->bind(':category', $data['category']);
            $this->db->bind(':dateCreated', $date);
            $this->db->bind(':storeid', $storeid);
            $this->db->bind(':storeref', $storeRef);

            //Execute function
            if ($this->db->execute()) {

                
                //query
                $this->db->query("UPDATE esb_vendor SET STORE_ID = :storeuid WHERE VENDOR_ID = :vendoruid;");

                //Bind values
                $this->db->bind(':vendoruid', $data['accessid']);
                $this->db->bind(':storeuid', $storeid);
   
                $this->db->execute();

                return true;

            } else {
                return false;
            }

        }catch(PDOException $e){
            echo 'ERROR!';
            print_r( $e );
        }
    }

    public function fetchStoreDetails($vendorid) {

        try {

            $this->db->query('SELECT V.FIRSTNAME, V.LASTNAME, V.MOBILE, V.EMAIL, S.STORE_REF, S.STATUS, A.LAST_LOGIN_DATE 
                              FROM esb_vendor V LEFT JOIN esb_store S ON V.STORE_ID = S.STORE_ID LEFT JOIN esb_access A 
                              ON V.VENDOR_ID = A.CUSTOMER_ID WHERE V.VENDOR_ID = :vendorid;');

            //Bind value
            $this->db->bind(':vendorid', $vendorid);

            $row = $this->db->single();

            return $row;

        }catch(PDOException $e){
            echo 'ERROR!';
            print_r( $e );
        }
    }

    public function login($username, $password, $ipaddr) {

        $this->db->query('SELECT V.VENDOR_ID, A.ID_TYPE, V.FIRSTNAME, V.MOBILE, V.EMAIL, V.STORE_ID FROM esb_vendor V 
                         LEFT JOIN esb_access A ON V.VENDOR_ID = A.CUSTOMER_ID WHERE V.STATUS = 0 AND V.EMAIL = :username;');

        //Bind value
        $this->db->bind(':username', $username);

        $rowData = $this->db->single();

        $customerid = $rowData->VENDOR_ID;
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
     public function findExistStore($storeName) {

        //Prepared statement
        $this->db->query('SELECT * FROM esb_store WHERE NAME = :name');
 
        //Email param will be binded with the email variable
        $this->db->bind(':name', $storeName);

        //Check if email is already registered
        if($this->db->rowCount() > 0) {
            return true;
        } else {
            return false;
        }
    }

    public function register($data) {

        try{
            
        $this->db->query("INSERT INTO esb_vendor (FIRSTNAME, LASTNAME, MOBILE, EMAIL, STATE, DATE_CREATED, VENDOR_ID, IP_ADDRESS) 
                        VALUES(:fname, :lname, :mobile, :email, :state, :dateCreated, :vendorid, :ipAddr) ");

        $date =  date('Y-m-d H:i:s');
        $vendorid = getUniqueUserID();

        //Bind values
        $this->db->bind(':fname', $data['firstname']);
        $this->db->bind(':lname', $data['lastname']);
        $this->db->bind(':mobile', $data['mobile']);
        $this->db->bind(':email', $data['email']);
        $this->db->bind(':state', $data['state']);
        $this->db->bind(':dateCreated', $date);
        $this->db->bind(':vendorid', $vendorid);
        $this->db->bind(':ipAddr', $data['remoteIP']);
        
        //Execute function
        if ($this->db->execute()) {

            //generate password
            $this->setupPassword($vendorid, $data['password'], 'VENDOR');

        return true;
        } else {
        return false;
        }

        }catch(PDOException $e){
            echo 'ERROR!';
            print_r( $e );
        }
    }

    //funtion to load all products
     public function loadAllProducts() {

        //Prepared statement
        $this->db->query('SELECT PRODUCT_ID, NAME, AMOUNT, MANUFACTURER FROM esb_products WHERE STATUS = 0 AND QUANTITY > 0');
 
        $results = $this->db->resultSet();

        return $results;

    }
    //end of function

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

}