<?php
class Store {

    private $db;

    public function __construct() {
        $this->db = new Database;
    }

    public function AddProduct($data) {

        try{

            $this->db->query("INSERT INTO esb_products (PRODUCT_ID, STORE_ID, NAME, AMOUNT, IMAGE, DATE_CREATED) 
            VALUES(:productid, :storeid, :name, :amount, :image, :dateCreated) ");

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

    public function loadProductRequests() {

         //Prepared statement
         $this->db->query('SELECT * FROM esb_product_requests WHERE STATUS = 0 ORDER BY DATE_CREATED DESC LIMIT 3;');
 
         $results = $this->db->resultSet();
 
         return $results; 

    }


    //Find user by email. Email is passed in by the Controller.
    public function checkProductRequestExists($product) {

        $this->db->query('SELECT COUNT(*)COUNT FROM esb_product_requests WHERE PRODUCT = :prodname;');

        //Bind values
        $this->db->bind(':prodname', $data['product']);

        $count = $this->db->single();

        //Check if email is already registered
        if($this->db->rowCount() > 0) {
            return true;
        } else {
            return false;
        }
    }

    public function submitProductRequest($data) {

        try{        
                    $this->db->query("INSERT INTO esb_product_requests (REQUEST_ID, CUSTOMER_ID, PRODUCT, DESCRIPTION, CATEGORY, STATE, DATE_CREATED, IP_ADDRESS) VALUES 
                                    (:requestid, :customerid, :product, :proddesc, :prodCat, :prodState, :dateCreated, :ipaddress)");

                    $date =  date('Y-m-d H:i:s');
                    $requestid = getUniqueUserID();
                    
                    //Bind values
                    $this->db->bind(':requestid', $requestid);
                    $this->db->bind(':customerid', $data['customerid']);
                    $this->db->bind(':product', $data['product']);
                    $this->db->bind(':proddesc', $data['proddesc']);
                    $this->db->bind(':prodCat', $data['prodCat']);
                    $this->db->bind(':prodState', $data['prodState']);
                    $this->db->bind(':dateCreated', $date);
                    $this->db->bind(':ipaddress', $data['remoteIP']);
            
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

    public function SendCustomerOrderNotification ($orderid) {
        
        $this->db->query('SELECT C.MOBILE_PHONE, O.ORDER_REF FROM esb_customer_order O LEFT JOIN esb_customers C 
                         ON O.CUSTOMER_ID = C.CUSTOMER_ID WHERE O.ORDER_REF = :orderRef;');

        //Bind value
        $this->db->bind(':orderRef', $orderid);

        $rowData = $this->db->single();

        $customer_mobile = $rowData->MOBILE_PHONE;
        $orderRef = $rowData->ORDER_REF;

        //send SMS
        SendCustomerNewOrderNotification($customer_mobile, $orderRef);

        return true;
    }

    public function createOrder($data) {

        try{

            $this->db->query('SELECT COUNT(*)COUNT FROM esb_orders');

            $count = $this->db->single();

            $id = ($count->COUNT == 0) ? '1' : $count->COUNT;

            $this->db->query("INSERT INTO esb_orders(ORDER_ID, ORDER_REF, CUSTOMER_ID, PRODUCT_ID, AMOUNT, DELIVERY_TYPE,
                            DELIVERY_NAME, DELIVERY_ADDRESS, DELIVERY_PHONE, DELIVERY_EMAIL, 
                            DELIVERY_STATE, PICKUP_STATE, PICKUP_LOCATION, ORDER_DATE) VALUES 
                            (:orderid, :orderRef, :customerid, :productid, :amount, :deltype, :delname, :deladdress, :delphone,
                            :delemail, :delstate, :pickupstate, :pickuplocation, :orderdate)");

            $date =  date('Y-m-d H:i:s');
            $orderid = getUniqueUserID();
            $orderRef = date('ynj').addLeadingZero($id);
            
            //Bind values
            $this->db->bind(':orderid', $orderid);
            $this->db->bind(':orderRef', $orderRef);
            $this->db->bind(':customerid', $data['customerid']);
            $this->db->bind(':productid', $data['productid']);
            $this->db->bind(':amount', $data['amount']);
            $this->db->bind(':deltype', $data['deliveryType']);
            $this->db->bind(':delname', $data['name']);
            $this->db->bind(':deladdress', $data['address']);
            $this->db->bind(':delphone', $data['mobile']);
            $this->db->bind(':delemail', $data['email']);
            $this->db->bind(':delstate', $data['state']);
            $this->db->bind(':pickupstate', $data['state']);
            $this->db->bind(':pickuplocation', $data['location']);
            $this->db->bind(':orderdate', $date);

    
            //Execute function
            if ($this->db->execute()) {

                //clear cart
                $this->clearCartCheckout($data['productid']);

                return true;
            } else {
                return false;
            }

        }catch(PDOException $e){
            echo 'ERROR!';
            print_r( $e );
        }
    }

    //Find user by email. Email is passed in by the Controller.
    public function loadProductSearch($search) {

        $data = explode("|", $search);

        //Prepared statement
        $this->db->query('SELECT * FROM esb_products WHERE PART_NUMBER LIKE :partNo AND STATUS = 0 AND QUANTITY > 0  
        UNION
        SELECT * FROM esb_products WHERE MODEL_NUMBER LIKE :modelNo AND STATUS = 0 AND QUANTITY > 0
        UNION
        SELECT * FROM esb_products WHERE NAME LIKE :productName AND STATUS = 0 AND QUANTITY > 0;');

        //Bind values
        $this->db->bind(':partNo', '%'.trim($data[0]).'%');
        $this->db->bind(':modelNo', '%'.trim($data[1]).'%');
        $this->db->bind(':productName', '%'.trim($data[2]).'%');
 
        $results = $this->db->resultSet();

        return $results;
    }

    //Find user by email. Email is passed in by the Controller.
    public function loadAllProducts() {

        //Prepared statement
        $this->db->query('SELECT * FROM esb_products WHERE STATUS = 0 AND QUANTITY > 0');
 
        $results = $this->db->resultSet();

        return $results;
    }

    public function clearCartCheckout($productid) {

        $this->db->query("DELETE FROM esb_cart WHERE PRODUCT_ID = :productid");

        //Bind values
        $this->db->bind(':productid', $productid);

        if($this->db->execute()) {
            return true;
        }else{
            return false;
        }   
    }

    public function updateProductOrder($orderid, $productid) {

        try{

            $this->db->query("UPDATE esb_orders SET CUSTOMER_ORDER_ID = :orderid WHERE PRODUCT_ID = :productid");

            //Bind values
            $this->db->bind(':orderid', $orderid);
            $this->db->bind(':productid', $productid);
        
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

    public function CreateCustomerOrder($customerid, $itemcount, $deltype, $delname, $deladd, $delphone, $delemail, $delstate) {

        try{

            $this->db->query('SELECT COUNT(*)COUNT FROM esb_customer_order');

            $count = $this->db->single();

            $id = ($count->COUNT == 0) ? '1' : $count->COUNT;

            $this->db->query("INSERT INTO esb_customer_order(ORDER_ID, ORDER_REF, CUSTOMER_ID, ITEM_COUNT, 
                            DELIVERY_TYPE, DELIVERY_NAME, DELIVERY_ADDRESS, DELIVERY_PHONE, 
                            DELIVERY_EMAIL, DELIVERY_STATE, DATE_CREATED) VALUES 
                            (:orderid, :orderref, :customerid, :itemcount, :deltype, :delname, :deladd, :delphone, :delemail, :delstate, :datecreated)");

            $date =  date('Y-m-d H:i:s');
            $orderid = getUniqueUserID();
            $orderRef = date('ynj').addLeadingZero($id);
            
            
            //Bind values
            $this->db->bind(':orderid', $orderid);
            $this->db->bind(':orderref', $orderRef);
            $this->db->bind(':customerid', $customerid);
            $this->db->bind(':itemcount', $itemcount);
            $this->db->bind(':deltype', $deltype);
            $this->db->bind(':delname', $delname);
            $this->db->bind(':deladd', $deladd);
            $this->db->bind(':delphone', $delphone);
            $this->db->bind(':delemail', $delemail);
            $this->db->bind(':delstate', $delstate);
            $this->db->bind(':datecreated', $date);

    
            //Execute function
            if ($this->db->execute()) {                

                    $this->db->query('SELECT * FROM esb_customer_order WHERE ORDER_ID = :customerOrderID');

                    //Bind value
                    $this->db->bind(':customerOrderID', $orderid);

                    $row = $this->db->single();

                    return $row;

            } else {
                return false;
            }

        }catch(PDOException $e){
            echo 'ERROR!';
            print_r( $e );
        }
    }

    public function fetchCustomerOrder($orderid) {

        $this->db->query('SELECT * FROM esb_customer_order WHERE ORDER_ID = :customerOrderID');

        //Bind value
        $this->db->bind(':customerOrderID', $orderid);

        $row = $this->db->single();

        return $row;

    }

    public function getCartItems($userid) {

        //Prepared statement
        $this->db->query('SELECT P.PRODUCT_ID, NAME, AMOUNT, FILE_NAME FROM 
                          esb_products P JOIN esb_cart C ON P.PRODUCT_ID = C.PRODUCT_ID WHERE C.USER_ID = :userid');

        //Bind values
        $this->db->bind(':userid', $userid);
 
        $results = $this->db->resultSet();

        return $results;
    }

    //fetch user details
    public function fetchUserDetails($customerid) {

        $this->db->query('SELECT FIRST_NAME, LAST_NAME, MOBILE_PHONE, EMAIL, STATE FROM esb_customers WHERE CUSTOMER_ID = :customerid');

        //Bind value
        $this->db->bind(':customerid', $customerid);

        $row = $this->db->single();

        return $row;
    }

      //Find user by email. Email is passed in by the Controller.
      public function findProductInCart($productid) {

        //Prepared statement
        $this->db->query('SELECT * FROM esb_cart WHERE PRODUCT_ID = :productid');
 
        //Email param will be binded with the email variable
        $this->db->bind(':productid', $productid);

        //Check if email is already registered
        if($this->db->rowCount() > 0) {
            return true;
        } else {
            return false;
        }
    
    }

    public function createCustomerCart($productid, $userid) {

        try{

            $this->db->query("INSERT INTO esb_cart (CART_ID, USER_ID, PRODUCT_ID, DATE_CREATED)
                             VALUES(:cartid, :userid, :productid, :dateCreated)");

            $date =  date('Y-m-d H:i:s');
            $cartid = getUniqueUserID();

            //Bind values
            $this->db->bind(':cartid', $cartid);
            $this->db->bind(':userid', $userid);
            $this->db->bind(':productid', $productid);
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

    public function searchProductMatch($search) {

        /*
        $this->db->query("SELECT PART_NUMBER, MODEL_NUMBER, NAME FROM esb_products WHERE 
                          PART_NUMBER LIKE '%".$search."%' OR MODEL_NUMBER LIKE '%".$search."%' OR NAME LIKE '%".$search."%';");
*/
                
        $this->db->query("SELECT PART_NUMBER, MODEL_NUMBER, NAME FROM esb_products WHERE 
        PART_NUMBER LIKE :search OR MODEL_NUMBER LIKE :search OR NAME LIKE :search;");

        //Bind value
        $this->db->bind(':search', '%'.$search.'%');

        $results = $this->db->resultSet();

        return $results;
    }


    public function getProductDetails($productid) {

        $this->db->query('SELECT PRODUCT_ID, AMOUNT, NAME, C.CATEGORY, PART_NUMBER, DESCRIPTION, FILE_NAME, MANUFACTURER, PRODUCT_CODE, QUANTITY FROM esb_products P
                          LEFT JOIN esb_product_category C ON P.CATEGORY_ID = C.SEQ_NUM 
                         WHERE STATUS = 0 AND PRODUCT_ID = :productid');

        //Bind value
        $this->db->bind(':productid', $productid);

        $row = $this->db->single();

        return $row;
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