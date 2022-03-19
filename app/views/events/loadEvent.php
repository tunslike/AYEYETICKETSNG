<?php
   require APPROOT . '/views/includes/header.php';
?>

<div class="innerDiv">

            <div class="innerHeaderDivider">
                <div>
                <div class="breadcrumb">
        <ul>
            <li><a href="<?php echo URLROOT; ?>/index"><i class="fas fa-home"></i></a></li>
            <li><i class="fas fa-chevron-right" style="color:#ff2364; font-size: 13px; margin: 0px -2px;"></i></li>    
            <li><a href="<?php echo URLROOT; ?>/index">Events</a></li>
            <li><i class="fas fa-chevron-right" style="color:#ff2364; font-size: 13px; margin: 0px -2px;"></i></li>
        </ul>
    </div>

    <?php if($data['format'] == 'cat') { ?>

        <div class="innerfeaturedHdr">
                               <?php echo $data['category']; ?>
                </div>     
    

     <?php }else { ?>
                <div class="innerfeaturedHdr">
                               Looking for more events?
                </div>      
        <?php } ?>                  
                        <div style="margin-top:-5px;">
                                            
                        </div>
                </div>
                        <!--
                        <div class="reminderButton">
                            <a href="#" onclick="setEventReminder(); return false;" title="Load more events!">Set A Reminder <i style="margin-left:5px;" class="fas fa-bell"></i></a>
                        </div>-->
            </div>
</div>

<div class="container">
<div class="featuredHdr" style="margin-top:4%; margin-bottom: 4%;">
        You will find more exicting events
        <div class="featSubhdr">Get engaged with our list of events</div>
    </div>
<div class="eventListWindow">
<?php foreach($data['events'] as $event): ?>

<div class="eventItem">
    <a href="<?php echo URLROOT; ?>/events/find?sku=1&pid=<?php echo $event->EVENT_ID; ?>" title="<?php echo $event->EVENT_NAME; ?>">
    <div class="poster" style="background-image: url(<?php echo URLROOT; ?>/public/images/<?php echo $event->EVENT_IMAGE; ?>);"></div>
    <div class="posterContent">
        <h6><?php echo $event->EVENT_NAME; ?></h6>
        <p><i style="margin-right:10px;"class="fas fa-map-marker-alt"></i> <?php echo $event->VENUE_NAME; ?></p>
        <p style="margin-top:-5px;"><i style="margin-right:10px;"class="fas fa-calendar-check"></i> <?php echo formatEventDate($event->START_DATE); ?></p>
        <div class="posterTicket" <?php if($event->TICKET_TYPE == 'Free') { echo 'style="background-color:#ff2364;"';} ?> >
            <div class="postTicketLabel">
            <img src="<?php echo URLROOT; ?>/public/images/ticket2.png" alt=""> <span style="font-size:12px; color:#D1B2FF; margin-right:5px;">FROM </span> ₦ <?php echo number_format($event->AMOUNT,0); ?>
            </div>
            <a href="#" onclick="shareEvent('<?php echo URLROOT.'/events/buyticket/'.$event->EVENT_URL; ?>'); return false;" style="text-decoration: none;" title="Share ticket link">
                <div class="shareticket">
                <i style="margin-right:5px;" class="fas fa-share-alt"></i> Share 
                </div>
            </a>
        </div>
    </div>
    </a>
</div>

<?php endforeach; ?>
</div>

<div class="pageCount">
    <ul>
        <li><a style="text-decoration:underline; color: #404257; font-weight:600;" href="#">Previous</a></li>
          <?php for ($x = 1; $x <= $data['pageCount']; $x++) { ?>

            <?php if($x == $data['pageNo']) { ?>

            <li class="active"><a href="<?php echo URLROOT; ?>/events/loadEvent?page=<?php echo $x; ?>"><?php echo $x; ?><a></li>

            <?php }else{ ?>
                <li><a href="<?php echo URLROOT; ?>/events/loadEvent?page=<?php echo $x; ?>"><?php echo $x; ?><a></li>
            <?php } ?>
        <!--
        <li class="active"><a href="#">2</a></li>
        <li><a href="#">3</a></li>
        <li><a href="#">4</a></li>
          -->
        <?php } ?>
        <li><a style="text-decoration:underline; color: #404257; font-weight:600;" href="<?php echo URLROOT; ?>/events/loadEvent?page=<?php echo $data['pageNo'] + 1; ?>">Next</a></li>
    </ul>
</div>
</div>

</div>

<br>
<br>
<br>
<?php
   require APPROOT . '/views/includes/footer.php';
?>