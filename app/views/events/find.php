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
<p style="margin-top:-5px;"><i style="margin-right:10px;"class="fas fa-calendar-check"></i> <?php echo $data['event']->START_TIME; ?> - <?php echo formatEventDate($data['event']->START_DATE); ?></p>
                        </div>
                </div>
                        
                        <div class="reminderButton">
                            <a href="#" onclick="setEventReminder(); return false;" title="Load more events!">Set A Reminder <i style="margin-left:5px;" class="fas fa-bell"></i></a>
                        </div>
            </div>
</div>


<div class="displayDivider">

 <div class="leftDisplay">
     <div class="picDisplay">
        <img src="<?php echo URLROOT; ?>/public/images/<?php echo $data['event']->EVENT_IMAGE; ?>">
    </div>
    <div style="display:flex; margin-top:-20px; flex-direction:row; justify-content:space-between; align-items: center;">

    <div class="thumbImgs">
        <h6>Event Banners</h6>
        <div class="thumbRow">
            <div class="picThumb">
            <img src="<?php echo URLROOT; ?>/public/images/<?php echo $data['event']->EVENT_IMAGE; ?>">
            </div>
        </div>
    </div>

    <div class="viewDisplay">
    <h6 title="<?php echo $data['event']->VIEWS; ?> People viewed this event!"><i class="fas fa-eye"></i> <?php echo $data['event']->VIEWS; ?></h6>
    </div>
    </div>
    

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

    <div class="description">
        <div class="titleLine">
        <h3>Event Description</h3>
        </div>
        <p>
        Lorem ipsum dolor sit amet, consectetur adipiscing elit. Quisque ex tortor, varius at libero a, vestibulum venenatis mauris. 
        Vivamus viverra felis vitae posuere tincidunt. Nunc viverra est et magna pharetra, facilisis vestibulum odio bibendum. 
        Ut vestibulum ipsum vel bibendum porta. Suspendisse potenti. Fusce tristique et ex at condimentum. 
        Quisque tincidunt pulvinar orci in euismod. Integer libero lectus, pulvinar vitae erat vitae, dictum scelerisque lorem. 
        Aenean congue consequat tincidunt. Praesent iaculis, metus in vehicula blandit, purus quam pharetra metus, eget hendrerit erat 
        augue sit amet ex. Nam vitae semper urna. Fusce dolor lorem, sagittis a tortor eleifend, egestas efficitur turpis. 
        Fusce vehicula ante vitae sagittis condimentum. Nam sed eros et magna pharetra fringilla. Cras placerat enim et gravida 
        vulputate. Suspendisse potenti.<br><br>

Sed id mi vitae metus maximus venenatis. Aenean nec risus venenatis, lacinia sapien vel, accumsan enim. Nullam rhoncus nec urna non blandit. Sed quis orci nulla. Etiam sed nisl rutrum, vulputate nibh vitae, tincidunt sem. Proin orci lorem, dictum a fringilla et, ullamcorper at augue. Mauris mollis leo a libero fermentum sodales.
<br><br>
Nulla facilisi. Fusce nec neque in orci sagittis lobortis. Nulla mauris enim, luctus id pretium ultrices, molestie quis arcu. Pellentesque eu justo malesuada, porttitor est quis, mattis mi. Mauris semper lorem scelerisque elementum posuere. Aenean interdum a sapien non rhoncus. Mauris molestie volutpat mi, at volutpat massa pellentesque eget. Vivamus vel velit non arcu molestie pretium sit amet ac diam. Maecenas aliquam odio et lorem efficitur iaculis. Sed consequat convallis dui, et accumsan elit tincidunt in. Nulla sed pharetra tortor.
        </p>
    </div>

    <div class="location">
        <div class="titleLine">
            <h3>Find Location on Map</h3>
            </div>
        <div>

</div>
<div class="mapouter"><div class="gmap_canvas"><iframe width="700" height="500" id="gmap_canvas" src="https://maps.google.com/maps?q=2880%20Broadway,%20New%20York&t=&z=13&ie=UTF8&iwloc=&output=embed" frameborder="0" scrolling="no" marginheight="0" marginwidth="0"></iframe><a href="https://fmovies-online.net"></a><br><style>.mapouter{position:relative;text-align:right;height:500px;width:600px;}</style><a href="https://www.embedgooglemap.net">embed custom google map</a><style>.gmap_canvas {overflow:hidden;background:none!important;height:500px;width:600px;}</style></div></div>
    </div>
</div>
 <div class="rightDisplay">


    <div class="gettickets">
        <div class="ticketHdr">
            Available Tickets
        </div>

        <?php foreach($data['tickets'] as $ticket): ?>
                
            <div class="ticketItem">
                <div class="priceItem">
                    <div><?php echo $ticket->TICKET_NAME; ?></div>
                    <i class="fas fa-long-arrow-alt-right"></i>
                    <div>₦ <?php echo number_format($ticket->AMOUNT,0); ?></div>
                </div>

                <div class="counter" id="ticketCounter_<?php echo $ticket->SEQ_NUM;?>" data-ticketname="<?php echo $ticket->TICKET_NAME; ?>" data-ticketprice="<?php echo $ticket->AMOUNT; ?>">
                <div class="remove">
                    <a href="#" onclick="removeTickets(<?php echo $ticket->SEQ_NUM;?>); return false;" title="Remove"><i class="fas fa-minus-square"></i></a>
                    </div>
                    <div class="countVal" id="countVal_<?php echo $ticket->SEQ_NUM;?>">0</div>
                    <div class="plus">
                        <a href="#" onclick="addTickets(<?php echo $ticket->SEQ_NUM;?>); return false;" title="Add"><i class="fas fa-plus-square"></i></a>
                    </div>
                </div>
            </div>
        <?php endforeach; ?>

<!--
        <div class="ticketItem">
            <div class="priceItem">
                <div>VIP Class</div>
                <i class="fas fa-long-arrow-alt-right"></i>
                <div>₦ 10,000</div>
            </div>

            <div class="counter">
                <div class="plus">
                    <a href="#" title="Add"><i class="fas fa-plus-square"></i></a>
                </div>
                <div class="countVal">1</div>
                <div class="remove">
                   <a href="#" title="Remove"><i class="fas fa-minus-square"></i></a>
                </div>
            </div>
        </div>
        <div class="ticketItem">
            <div class="priceItem">
                <div>VVIP Class</div>
                <i class="fas fa-long-arrow-alt-right"></i>
                <div>₦ 50,000</div>
            </div>

            <div class="counter">
                <div class="plus">
                    <a href="#" title="Add"><i class="fas fa-plus-square"></i></a>
                </div>
                <div class="countVal">1</div>
                <div class="remove">
                   <a href="#" title="Remove"><i class="fas fa-minus-square"></i></a>
                </div>
            </div>
        </div>
        -->
        <form id="bookingForm" action="<?php echo URLROOT; ?>/events/confirmBooking" method ="POST"> 
        <div class="bookSummary">
            <h6><i class="far fa-calendar-check"></i> Booking Summary</h6>
            <div class="ticketItem" style="margin-top:-20px;">
                <div>
                    <div class="amtTitles">Quantity</div>
                    <div id="ticketList" class="amtVals"></div>

                    <div style="margin-top:25px; display:none; font-weight:300; color:#000;" id="totalLabel" class="amtVals">Total:</div>
                </div>
                <div style="text-align:right;">
                    <div class="amtTitles">Amount</div>
                    <div id="ticktgAmt" class="amtVals"></div>
                    <div style="margin-top:25px; display:none; font-weight:300; color:#000;"  id="totalAmt" class="amtVals">₦ 0.00</div>
                </div>
            </div>
        </div>
        <input type="hidden" id="tickets" name="tickets" value="">
        <input type="hidden" name="eventid" id="eventid" value="<?php echo $data['event']->EVENT_ID; ?>">
        <div class="bookEventNow">
            <a id="btnBuyNow" onclick="return false;" href="#" title="Load more events!">Buy Now</a>
        </div>
        </form>

        <div class="ticketCount">
            234 Tickets Remaining
        </div>
    </div>

    <div class="owner">
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

<?php
   require APPROOT . '/views/includes/footer.php';
?>