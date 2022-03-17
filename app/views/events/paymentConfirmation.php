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
                            
                        </div>
            </div>
</div>

<form id="eventform" action="<?php echo URLROOT; ?>/events/createTicket" method ="POST" enctype="multipart/form-data">

<div class="displayDivider">

 <div class="leftDisplay">

 <?php if($data['status'] == 'true') : ?>
    <div class="paymentSuccessAlert">
    <img style="width:48px; height:48px;" src="<?php echo URLROOT; ?>/public/images/success.png"/> 
    <div>Congratulations! Your payment was successful and your tickets have been booked. <br> Please check your email for ticket details and other information</div>
    </div>
<?php endif; ?>  

<br>
<br>
<h3 class="paymentHeader">
    The tickets below have been booked for you.
</h3>

<?php foreach($data['tickets'] as $ticket): ?>
<div class="paidItems">
    <h3 style="color:#ff2364;"><i style="margin-right:7px;" class="fa fa-money-bill-wave"></i> <?php echo $ticket->name; ?></h3>
    <h3><?php echo $ticket->count; ?> Ticket(s)</h3>
    <h3>₦ 25,000.00</h3>
</div>

<?php endforeach; ?>

<br>
<br>
<div class="shareEvent">
    <h3>Share this Event</h3>
        <div class="shareitem">
        <a href="#" title="Events today!"><div style="color: #4267B2; border-color:#4267B2;" class="shareDiv">
        <i class="fab fa-facebook-f"></i> Facebook
            </div></a>
            <a href="#" title="Happening this week!"><div style="color: #00acee; border-color:#00acee;" class="shareDiv">
            <i class="fab fa-twitter"></i> Twitter
            </div></a>
            <a href="#" title="This month!"><div style="color: #ff2364; border-color:#ff2364;" class="shareDiv">
            <i class="fab fa-whatsapp"></i> Share
            </div></a>
        </div>
    </div>

</div>
 <div class="rightDisplay">
    <div class="gettickets">
        <div class="ticketHdr">
            Event Poster
        </div>

        <div style="height:400px; margin:5px; border-radius:5px; background-position: center; background-repeat: no-repeat; background-size: 100% 100%; background-image: url('<?php echo URLROOT; ?>/public/images/<?php echo $data['event']->EVENT_IMAGE; ?>');">
        
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