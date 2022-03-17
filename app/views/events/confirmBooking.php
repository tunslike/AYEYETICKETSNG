<?php
   require APPROOT . '/views/includes/header.php';
?>

<div class="innerDiv">

            <div class="innerHeaderDivider">
                <div>
                <div class="innerfeaturedHdr">
                               <?php echo $data['event']->EVENT_NAME; ?>
                        </div>
                        <div style="margin-top:-5px;">
                        <p><i style="margin-right:10px;" class="fas fa-home"></i> <?php echo $data['event']->VENUE_NAME; ?></p>                        
<p><i style="margin-right:10px;" class="fas fa-map-marker-alt"></i> <?php echo $data['event']->VENUE_LOCATION; ?></p>
<p style="margin-top:-5px;"><i style="margin-right:10px;"class="fas fa-calendar-check"></i> 05:00pm - Saturday, 22nd January, 2022</p>
                        </div>
                </div>
                        
                        <div class="reminderButton">
                            <a href="#" title="Load more events!">Set A Reminder <i style="margin-left:5px;" class="fas fa-bell"></i></a>
                        </div>
            </div>
</div>

<form id="paymentform" action="<?php echo URLROOT; ?>/events/makePayment" method ="POST" enctype="multipart/form-data">

<div class="displayDivider">

 <div class="leftDisplay">
 <div class="eventhdr">
            <div style="display:flex; flex-direction: row; justify-content: space-between; align-items: center;">
                <div>
                Enter your Details <i class="fas fa-long-arrow-alt-right"></i>
                </div>
                <div style="font-weight: 400; color: #303030; font-size: 13px;">
                    All fields are compulsory!
                </div>
            </div>
        </div>

        <div style="margin-right:60px; margin-top:30px;">

        <input type="hidden" id="eventid" name="eventid" value="<?php echo $data['event']->EVENT_ID; ?>">
        
        <div class="loginform">
            <label for="usern">Full Name:</label>
            <input type="text" name="p_fullname" id="p_fullname">
        </div>

        <div class="dateTime">
            <div class="div">
                <div class="loginform">
                    <label for="usern">Phone:</label>
                    <input type="text" name="p_phone" id="p_phone">
                </div>
            </div>
            <div class="div">
                <div class="loginform">
                    <label for="usern">Email:</label>
                    <input type="text" name="p_email" id="p_email">
                </div>
            </div>
        </div>

    </div>

    <div class="otherTicket">
    <input type="hidden" name="ownerticket" value="0" />
    <input type="checkbox" onchange="showOwnerTicker(); return false;" value="1" id="ownerticker" name="ownerticket">
            <label for="showticker">Are you buying this ticket for someone?</label>
    </div>

    <div id="ownerDetailsWindow" style="margin-top:20px; width:92%; display:none;">
    <h6 class="ownerDetails">Enter Owner's Details below</h6>
            <div class="loginform" style="margin-top:-20px;">
                    <label for="usern">Full Name:</label>
                    <input type="text" name="own_fullname" id="own_fullname">
                </div>

                <div class="dateTime">
            <div class="div">
                <div class="loginform">
                    <label for="usern">Phone:</label>
                    <input type="text" name="own_phone" id="own_phone">
                </div>
            </div>
            <div class="div">
                <div class="loginform">
                    <label for="usern">Email:</label>
                    <input type="text" name="own_email" id="own_email">
                </div>
            </div>
        </div>
    </div>
    <h6 class="ownerDetails">Apply Coupon below</h6>
    <div style="display:flex; flex-direction: row;  margin-top: -20px; justify-content:flex-start; align-items: center; column-gap:20px;">
    <div class="loginform" style="margin-top:-20px;">
                    <label for="usern">Coupon Code:</label>
                    <input type="text" name="coupon_code" id="coupon_code">
                </div>
        <div>
            <button class="btnApplyCoupon">Apply Coupon</button>
        </div>
    </div>
</div>
 <div class="rightDisplay">
    <div class="gettickets">
        <div class="ticketHdr">
            Order Information
        </div>

        <div style="height:400px; margin:5px; border-radius:5px; background-position: center; background-repeat: no-repeat; background-size: 100% 100%; background-image: url('<?php echo URLROOT; ?>/public/images/<?php echo $data['event']->EVENT_IMAGE; ?>');">
        
        </div>

        <div class="bookSummary">
            <h6><i class="far fa-calendar-check"></i> Booking Summary</h6>
            <div class="ticketItem" style="margin-top:-20px;">
                <div>
                    <div class="amtTitles">Quantity</div>
                    
                    <?php foreach($data['tickets'] as $ticket): ?>

                        <div id="ticketList" style="margin-bottom:5px;" class="amtVals">
                            [<?php echo $ticket['name']; ?>] x <?php echo $ticket['count']; ?>
                        </div>

                    <?php endforeach; ?>

                    <div style="margin-top:25px;font-weight:300; color:#000;" id="totalLabel" class="amtVals">Total:</div>
                </div>
                <div style="text-align:right;">
                    <div class="amtTitles">Amount</div>

                        <div id="ticktgAmt" class="amtVals">0.00</div>

                    <div style="margin-top:25px; font-weight:300; color:#000;"  id="totalAmt" class="amtVals">₦ <?php echo number_format($data['gross_total'],2); ?></div>
                    <input type="hidden" name="gross_total" value="<?php echo $data['gross_total']; ?>" />
                </div>
            </div>
        </div>

        <div class="bookEventNow">
                <a href="#" id="btnMakePayment" onclick="return false;" title="Proceed to make payment!">Make Payment</a>
        </div>
    </div>

    <div style="display:none;" class="owner">
        <div class="ownerTitle"> 
            <h6>About the Organizer</h6>
            <i class="fas fa-user-tie"></i>
        </div>
        <div class="ownercontent">
            <ul>
                <li><i class="fas fa-user-alt"></i> Jide Awotekun</li>
                <li><i class="fab fa-facebook-square"></i> <span style="color: #4267B2;">Facebook</span></li>
                <li><i class="fab fa-twitter-square"></i> <span style="color: #00acee;">Twitter</span></li>
                <li><i class="fab fa-instagram-square"></i> <span style="color: #3f729b;">Instagram</span></li>
                <li><i class="fab fa-youtube-square"></i> <span style="color: #FF0000;">Youtube</span></li>
            </ul>
            <a href="#" title="Report or Flag this event!"><div class="reportEvent">
            <i class="fas fa-exclamation-triangle"></i> Report or Flag this Event
            </div></a>
        </div>
    </div>
</div>
</div>

                    </form>

<?php
   require APPROOT . '/views/includes/footer.php';
?>