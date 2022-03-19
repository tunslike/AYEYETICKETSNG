<?php
class Event {

    private $db;

    public function __construct() {
        $this->db = new Database;
    }


    public function verifyPaymentTransaction($reference) {

        try{

                    $curl = curl_init();
                    
                    curl_setopt_array($curl, array(
                        CURLOPT_URL => "https://api.paystack.co/transaction/verify/".$reference,
                        CURLOPT_RETURNTRANSFER => true,
                        CURLOPT_ENCODING => "",
                        CURLOPT_MAXREDIRS => 10,
                        CURLOPT_TIMEOUT => 30,
                        CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
                        CURLOPT_CUSTOMREQUEST => "GET",
                        CURLOPT_HTTPHEADER => array(
                        "Authorization: Bearer ".PAYSTACK_Test_Secret_Key,
                        "Cache-Control: no-cache",
                        ),
                    ));
                    
                    $response_result = curl_exec($curl);
                    $err = curl_error($curl);
                    curl_close($curl);
                    
                    if ($err) {

                        echo "cURL Error #:" . $err;

                    } else {
                        
                        $response = json_decode($response_result);
    
                        if($response->data->status == "success") {
            
                            $this->SavePaymentVerificationStatus($response->data->reference, $response->data->id, $response->data->status, 
                            $response->data->reference, $response->data->amount, $response->data->paid_at, $response->data->channel, 
                            $response->data->ip_address, $response->data->currency, $response->data->authorization->bank, $response->data->customer->email,
                            $response->data->customer->customer_code, $response->data->fees);
            
                            return $response->data->status;

                            echo 'Created ...';
                            exit();
            
                        }else {
                    
                            return false;
                        }

                    }
        }catch(Exception $e) {
            echo 'ERROR!';
            print_r( $e );
        }
    }


    public function GeneratePaymentLink($email, $amount, $reference) {

        try {
            
            $url = PAYSTACK_Base_Url;

            $fields = [
              'email' => $email,
              'amount' => $amount,
              'callback_url' => PAYSTACK_Callback_Url,
              'reference' => $reference,
            ];

            $fields_string = http_build_query($fields);
            //open connection
            $ch = curl_init();
            
            //set the url, number of POST vars, POST data
            curl_setopt($ch,CURLOPT_URL, $url);
            curl_setopt($ch,CURLOPT_POST, true);
            curl_setopt($ch,CURLOPT_POSTFIELDS, $fields_string);
            curl_setopt($ch, CURLOPT_HTTPHEADER, array(
              "Authorization: Bearer ".PAYSTACK_Test_Secret_Key,
              "Cache-Control: no-cache",
            ));
            
            //So that curl_exec returns the contents of the cURL; rather than echoing it
            curl_setopt($ch,CURLOPT_RETURNTRANSFER, true); 
            
            //execute post
            $result = curl_exec($ch);
            
            $response = json_decode($result);
    
            if($response->status == true) {

                $this->SavePaymentResponse($reference, $email, $amount, $response->status, $response->message, $response->data->authorization_url,
                                           $response->data->access_code, $response->data->reference);

                return $response->data->authorization_url;

            }else {
        
                return false;
            }

            
        }catch(Exception $e){
            echo 'ERROR!';
            print_r( $e );
        }
    }

    //function to create ticket order
    public function SavePaymentVerificationStatus($orderid, $transid, $payment_status, $payment_ref, 
                                        $amount, $payment_date, $channel, $ip_address, $currency, $bank, $customer_email,
                                        $customer_id, $fee) {
       
        try{
            
        $this->db->query("INSERT INTO HTNG_Payment_Status (ORDER_ID, TRANSACTION_ID, PAYMENT_STATUS, PAYMENT_REF, 
                        AMOUNT, PAYMENT_DATE, CHANNEL, IP_ADDRESS, CURRENCY, BANK, CUSTOMER_EMAIL, CUSTOMER_ID, FEES, DATE_CREATED) 
                        VALUES
                        (:orderid, :transid, :payment_status, :payment_ref, :amount, :payment_date, :channel, :ip_address, :currency,
                        :bank, :customer_email, :customer_id, :fees, :dateCreated);");

        
        $date =  date('Y-m-d H:i:s');
    
        //Bind values
        $this->db->bind(':orderid', $orderid);
        $this->db->bind(':transid', $transid);
        $this->db->bind(':payment_status', $payment_status);
        $this->db->bind(':payment_ref', $payment_ref);
        $this->db->bind(':amount', $amount/100);
        $this->db->bind(':payment_date', formateDate($payment_date));
        $this->db->bind(':channel', $channel);
        $this->db->bind(':ip_address', $ip_address);
        $this->db->bind(':currency', $currency);
        $this->db->bind(':bank', $bank);
        $this->db->bind(':customer_email', $customer_email);
        $this->db->bind(':customer_id', $customer_id);
        $this->db->bind(':fees', $fee);
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
    //end of function

     //function to create ticket order
     public function BookPurchasedTickets($seqnum, $orderid, $transRef) {

        try{

        //Prepared statement
        $this->db->query("SELECT * FROM HTNG_Event_Tickets WHERE SEQ_NUM = :seqnum;");
    
        //Bind values
        $this->db->bind(':seqnum', $seqnum);
   
        $row = $this->db->single();
   
        $this->db->query("INSERT INTO HTNG_Purchased_Tickets (ORDER_ID, EVENT_ID, TICKET_ID, TICKET_NAME, AMOUNT, 
                        QUANTITY, DATE_CREATED, TRANS_REF) 
                        VALUES
                        (:orderid, :eventid, :ticketid, :ticketname, :amount, :quantity, :date_created, :trans_ref);");
        
        $date =  date('Y-m-d H:i:s');
    
        //Bind values
        $this->db->bind(':orderid', $orderid);
        $this->db->bind(':eventid', $row->EVENT_ID);
        $this->db->bind(':ticketid', $row->TICKET_ID);
        $this->db->bind(':ticketname', $row->TICKET_NAME);
        $this->db->bind(':amount', $row->AMOUNT);
        $this->db->bind(':quantity', $row->QUANTITY);
        $this->db->bind(':date_created', $date);
        $this->db->bind(':trans_ref', $transRef);
    
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
    //end of function

    //function to create ticket order
    public function SaveEventReminder($data) {

        try{
                
            $this->db->query("INSERT INTO HTNG_Event_Reminders (EVENT_ID, EMAIL, DATE_CREATED, IP_ADDRESS) 
                            VALUES
                            (:eventid, :email, :dateCreated, :ipaddress);");
    
            
            $date =  date('Y-m-d H:i:s');
        
            //Bind values
            $this->db->bind(':eventid', $data['eventid']);
            $this->db->bind(':email', $data['emailad']);
            $this->db->bind(':dateCreated', $date);
            $this->db->bind(':ipaddress', $data['ipaddress']);
        
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
        //end of function

    //function to create ticket order
    public function SavePaymentResponse($orderReference, $email, $amount, $status, $message, $authurl, $access_code, $paymentRef) {

        try{
            
        $this->db->query("INSERT INTO HTNG_Payment_Response (ORDER_ID, EMAIL, AMOUNT, RESPONSE_STATUS, RESPONSE_MESSAGE, 
                        RESPONSE_AUTH_URL, RESPONSE_ACCESS_CODE, RESPONSE_REFERENCE, PAYMENT_DATE) 
                        VALUES
                        (:orderid, :email, :amount, :res_status, :res_message, :res_auth_url, :res_access_code, :res_reference, :payment_date);");

        
        $date =  date('Y-m-d H:i:s');
    
        //Bind values
        $this->db->bind(':orderid', $orderReference);
        $this->db->bind(':email', $email);
        $this->db->bind(':amount', $amount/100);
        $this->db->bind(':res_status', $status);
        $this->db->bind(':res_message', $message);
        $this->db->bind(':res_auth_url', $authurl);
        $this->db->bind(':res_access_code', $access_code);
        $this->db->bind(':res_reference', $paymentRef);
        $this->db->bind(':payment_date', $date);
    
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
    //end of function

    //function to load events
    public function loadAllEventsHome() {

        $start_date = date('Y-m-1',strtotime('this month'));
    
        $date = new DateTime('now');
        $date->modify('last day of this month');
        $end_date = $date->format('Y-m-d');

         //Prepared statement
         $this->db->query("SELECT EVENT_ID, EVENT_NAME, VENUE_NAME, EVENT_IMAGE, START_DATE, DATE_CREATED, 
         (SELECT MIN(AMOUNT) FROM HTNG_Event_Tickets WHERE EVENT_ID = E.EVENT_ID) AMOUNT, (SELECT MIN(TICKET_TYPE) FROM 
         HTNG_Event_Tickets WHERE EVENT_ID = E.EVENT_ID) TICKET_TYPE FROM HTNG_Events E WHERE STATUS = 0 ORDER BY DATE_CREATED 
         ASC LIMIT 6;");

        $results = $this->db->resultSet();

        return $results;

    }//end of function

    //function to load events
    public function loadAllEvents($filter) {

        $start_date = date('Y-m-1',strtotime('this month'));
    
        $date = new DateTime('now');
        $date->modify('last day of this month');
        $end_date = $date->format('Y-m-d');


        switch($filter) {
            case '':
                    //Prepared statement
                    $this->db->query("SELECT EVENT_URL, EVENT_ID, EVENT_NAME, VENUE_NAME, EVENT_IMAGE, START_DATE, DATE_CREATED,  
                    (SELECT MIN(AMOUNT) FROM HTNG_Event_Tickets WHERE EVENT_ID = E.EVENT_ID) AMOUNT,
                    (SELECT MIN(TICKET_TYPE) FROM HTNG_Event_Tickets WHERE EVENT_ID = E.EVENT_ID) TICKET_TYPE
                    FROM HTNG_Events E WHERE STATUS = 0 ORDER BY DATE_CREATED ASC;");
            break;
            case 'all':
                    //Prepared statement
                    $this->db->query("SELECT EVENT_URL, EVENT_ID, EVENT_NAME, VENUE_NAME, EVENT_IMAGE, START_DATE, DATE_CREATED,  
                    (SELECT MIN(AMOUNT) FROM HTNG_Event_Tickets WHERE EVENT_ID = E.EVENT_ID) AMOUNT,
                    (SELECT MIN(TICKET_TYPE) FROM HTNG_Event_Tickets WHERE EVENT_ID = E.EVENT_ID) TICKET_TYPE
                    FROM HTNG_Events E WHERE STATUS = 0 ORDER BY DATE_CREATED ASC;");
            break;
            case 'today':
                    //Prepared statement
                    $this->db->query("SELECT EVENT_URL, EVENT_ID, EVENT_NAME, VENUE_NAME, EVENT_IMAGE, START_DATE, DATE_CREATED,  
                    (SELECT MIN(AMOUNT) FROM HTNG_Event_Tickets WHERE EVENT_ID = E.EVENT_ID) AMOUNT,
                    (SELECT MIN(TICKET_TYPE) FROM HTNG_Event_Tickets WHERE EVENT_ID = E.EVENT_ID) TICKET_TYPE
                    FROM HTNG_Events E WHERE START_DATE = NOW() AND STATUS = 0 ORDER BY DATE_CREATED ASC;");
            break;
            case 'week':
                    //Prepared statement
                    $this->db->query("SELECT EVENT_URL, EVENT_ID, EVENT_NAME, VENUE_NAME, EVENT_IMAGE, START_DATE, DATE_CREATED,  
                    (SELECT MIN(AMOUNT) FROM HTNG_Event_Tickets WHERE EVENT_ID = E.EVENT_ID) AMOUNT,
                    (SELECT MIN(TICKET_TYPE) FROM HTNG_Event_Tickets WHERE EVENT_ID = E.EVENT_ID) TICKET_TYPE
                    FROM HTNG_Events E WHERE START_DATE BETWEEN (CURRENT_DATE - INTERVAL 7 DAY) AND NOW() AND STATUS = 0 ORDER BY DATE_CREATED ASC;");
            break;
            case 'month':
                    //Prepared statement
                    $this->db->query("SELECT EVENT_URL, EVENT_ID, EVENT_NAME, VENUE_NAME, EVENT_IMAGE, START_DATE, DATE_CREATED,  
                    (SELECT MIN(AMOUNT) FROM HTNG_Event_Tickets WHERE EVENT_ID = E.EVENT_ID) AMOUNT,
                    (SELECT MIN(TICKET_TYPE) FROM HTNG_Event_Tickets WHERE EVENT_ID = E.EVENT_ID) TICKET_TYPE
                    FROM HTNG_Events E WHERE START_DATE >= '.$start_date.' AND END_DATE <= '.$end_date.' AND STATUS = 0 ORDER BY DATE_CREATED ASC;");
            break;
            default:
                    //Prepared statement
                    $this->db->query("SELECT EVENT_ID, EVENT_NAME, VENUE_NAME, EVENT_IMAGE, START_DATE, DATE_CREATED,  
                    (SELECT MIN(AMOUNT) FROM HTNG_Event_Tickets WHERE EVENT_ID = E.EVENT_ID) AMOUNT,
                    (SELECT MIN(TICKET_TYPE) FROM HTNG_Event_Tickets WHERE EVENT_ID = E.EVENT_ID) TICKET_TYPE
                    FROM HTNG_Events E WHERE STATUS = 0 ORDER BY DATE_CREATED ASC;");
        }

        $results = $this->db->resultSet();

        return $results;

    }//end of function

    public function searchInstandEvent($search) {
              
        $this->db->query("SELECT EVENT_NAME, VENUE_NAME, DATE_FORMAT(START_DATE, '%d-%b-%y')START_DATE FROM HTNG_Events WHERE 
        EVENT_NAME LIKE :search OR EVENT_CATEGORY LIKE :search OR VENUE_NAME LIKE :search;");

        //Bind value
        $this->db->bind(':search', '%'.$search.'%');

        $results = $this->db->resultSet();

        return $results;
    }


    public function updateEventView($eventid) {

        try{

        //Prepared statement
        $this->db->query("SELECT * FROM HTNG_Events WHERE EVENT_ID = :event_id;");
    
        //Bind values
        $this->db->bind(':event_id', $eventid);
   
        $row = $this->db->single();

        $viewCount = $row->VIEWS + 1;


        $this->db->query("UPDATE HTNG_Events SET VIEWS = :viewCount WHERE EVENT_ID = :eventid");

            //Bind values
            $this->db->bind(':viewCount', $viewCount);
            $this->db->bind(':eventid', $eventid);
        
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

    //function to create ticket order
    public function createTicketOrder($data) {

        try{
            
        $this->db->query("INSERT INTO HTNG_Ticket_Orders (ORDER_ID,  EVENT_ID,  OWNED, GROSS_TOTAL, PURCHASER_FULLNAME, PURCHASER_MOBILE,  
                                                  PURCHASER_EMAIL,  OWNER_FULLNAME,  OWNER_EMAIL,  OWNER_PHONE,  COUPON_CODE,  
                                                  DATE_CREATED,  IP_ADDRESS) 
                                                  VALUES
                                                  (:orderid, :eventid, :owned, :gross_total, :p_fullname,
                                                  :p_mobile, :p_email, :own_fullname, :own_email, :own_phone, :coupon_code,
                                                  :dateCreated, :ipaddress);");

        
        $date =  date('Y-m-d H:i:s');
        $orderid = getUniqueUserID();

        //Bind values
        $this->db->bind(':orderid', $orderid);
        $this->db->bind(':eventid', $data['eventid']);
        $this->db->bind(':owned', $data['owned']);
        $this->db->bind(':gross_total', $data['gross_total']);
        $this->db->bind(':p_fullname', $data['p_fullname']);
        $this->db->bind(':p_mobile', $data['p_mobile']);
        $this->db->bind(':p_email', $data['p_email']);
        $this->db->bind(':own_fullname', $data['own_fullname']);
        $this->db->bind(':own_email', $data['own_email']);
        $this->db->bind(':own_phone', $data['own_phone']);
        $this->db->bind(':coupon_code', $data['coupon_code']);
        $this->db->bind(':dateCreated', $date);
        $this->db->bind(':ipaddress', $data['ipaddress']);

        //Execute function
        if ($this->db->execute()) {
            return $orderid;
        } else {
            return false;
        }

        }catch(PDOException $e){
            echo 'ERROR!';
            print_r( $e );
        }
    }
    //end of function



    //function to create event
    public function CreateEvent($data) {

        try{

            $this->db->query("INSERT INTO HTNG_Events (EVENT_ID, EVENT_CATEGORY, ACCOUNT_ID, EVENT_URL, EVENT_NAME, VENUE_NAME, 
                                                        VENUE_LOCATION, STATE, VENUE_LONGITUDE, VENUE_LATITUDE,
                                                        EVENT_IMAGE, START_DATE, END_DATE, START_TIME, END_TIME, DESCRIPTION, 
                                                        CATEGORY, ACCESS_TYPE, CREATED_BY, DATE_CREATED, IP_ADDRESS) 
                             VALUES (:eventid, :eventcat, :accountid, :event_url, :eventname, :venuename, :venueloc, :state, :logitude, :latitude, :eventImg, :startDate,
                                    :endDate, :startTime, :endTime, :description, :category, :eventtype, :createdby, :dateCreated, :ipaddress) ");

            $date =  date('Y-m-d H:i:s');
            $eventid = getUniqueUserID();
            $event_url = str_replace(" ", "-", $data['eventName']).'-'.generateUniqueNumbers();
    
            //Bind values
            $this->db->bind(':eventid', $eventid);
            $this->db->bind(':eventcat', $data['eventCategory']);
            $this->db->bind(':accountid', $data['accountid']);
            $this->db->bind(':event_url', $event_url);
            $this->db->bind(':eventname', $data['eventName']);
            $this->db->bind(':venuename', $data['venueName']);
            $this->db->bind(':venueloc', $data['venueAddress']);
            $this->db->bind(':state', $data['eventState']);
            $this->db->bind(':logitude', $data['venueLongtitude']);
            $this->db->bind(':latitude', $data['venueLatitude']);
            $this->db->bind(':eventImg', $data['filenameUploaded']);
            $this->db->bind(':startDate', formateDate($data['startDate']));
            $this->db->bind(':endDate', formateDate($data['endDate']));
            $this->db->bind(':startTime', $data['startTime']);
            $this->db->bind(':endTime', $data['endTime']);
            $this->db->bind(':description', $data['description']);
            $this->db->bind(':category', $data['ticketType']);
            $this->db->bind(':eventtype', $data['eventtype']);
            $this->db->bind(':createdby', $data['accountid']);
            $this->db->bind(':dateCreated', $date);
            $this->db->bind(':ipaddress', $data['ipaddress']);
    
            //Execute function
            if ($this->db->execute()) {

                //create event tickets
                $tickets = explode(';', $data['totalTickets']);
                
                $arrycount = count($tickets);

                for($x = 0; $x < $arrycount; $x++) {

                        $value = $tickets[$x];

                        if($value == ''){
                            break;
                        }

                        $this->createEventTickets($eventid, $tickets[$x], $data['accountid']);
                }

                return true;
            } else {
                return false;
            }

        }catch(PDOException $e){
            echo 'ERROR!';
            print_r( $e );
        }
    }

    public function createEventTickets($eventid, $tickets, $createdby) {


        $ticket = explode('/', $tickets);

        $ticketname = $ticket[0];
        $ticketAmt = str_replace('₦ ', '',$ticket[1]);
        $ticketQty = $ticket[2];
        $ticketType = $ticket[3];

        try{
            
            $this->db->query("INSERT INTO HTNG_Event_Tickets(TICKET_ID, EVENT_ID, TICKET_TYPE, TICKET_NAME, AMOUNT, 
                                                            QUANTITY, DATE_CREATED, CREATED_BY) 
                              VALUES (:ticketid, :eventid, :ticketType, :ticketName, :amount, :quantity, :datecreated, :createdby)");
    
            $date =  date('Y-m-d H:i:s');
            $ticketid = getUniqueUserID();

            //Bind values
            $this->db->bind(':ticketid', $ticketid);
            $this->db->bind(':eventid', $eventid);
            $this->db->bind(':ticketType', $ticketType);
            $this->db->bind(':ticketName', $ticketname);
            $this->db->bind(':amount', $ticketAmt);
            $this->db->bind(':quantity', $ticketQty);
            $this->db->bind(':createdby', $createdby);
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

    //function to return orders
    public function findEventDetails($eventid) {

            //Prepared statement
            $this->db->query("SELECT * FROM HTNG_Events WHERE EVENT_ID = :eventid;");
    
            //Bind values
            $this->db->bind(':eventid', $eventid);
    
            $row = $this->db->single();
    
            return $row;
    
    }//end of function

    public function searchEventByCategory($category) {

        //Prepared statement
        $this->db->query("SELECT * FROM HTNG_Event_Categories WHERE EVENT_CATEGORY = :category AND STATUS = 0");

        //Bind values
        $this->db->bind(':category', $category);

        $results = $this->db->resultSet();

        return $results;
   }


    public function fetchEventCategories() {

        //Prepared statement
        $this->db->query("SELECT * FROM HTNG_Event_Categories WHERE STATUS = 0");

        $results = $this->db->resultSet();

        return $results;
   }

   public function fetchStates() {

    //Prepared statement
    $this->db->query("SELECT * FROM HTNG_State WHERE STATUS = 0");

    $results = $this->db->resultSet();

    return $results;
}

public function fetchEventStates() {

    //Prepared statement
    $this->db->query("SELECT DISTINCT STATE from HTNG_Events WHERE STATUS = 0;");

    $results = $this->db->resultSet();

    return $results;
}

    public function loadEventTickets($eventid) {

         //Prepared statement
         $this->db->query("SELECT * FROM HTNG_Event_Tickets WHERE EVENT_ID = :eventid;");

         //Bind values
         $this->db->bind(':eventid', $eventid);

         $results = $this->db->resultSet();

         return $results;
    }

    public function getTicketPrice($id) {

        $this->db->query('SELECT TICKET_TYPE, TICKET_NAME, AMOUNT FROM HTNG_Event_Tickets WHERE SEQ_NUM = :seqnum;');

        //Bind value
        $this->db->bind(':seqnum', $id);

        $rowData = $this->db->single();

        $amount = $rowData->AMOUNT;

        return $amount;

    }

    public function fetchEventID($orderid) {

        $this->db->query('SELECT * FROM HTNG_Ticket_Orders WHERE ORDER_ID = :orderid;');

        //Bind value
        $this->db->bind(':orderid', $orderid);

        $rowData = $this->db->single();

        $eventid = $rowData->EVENT_ID;

        return $eventid;

    }

    

}