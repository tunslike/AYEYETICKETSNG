<?php
   require APPROOT . '/views/includes/header.php';
?>

<main>

    <div class="display">
    <div class="displayContents animate__bounceIn animate__infinite	infinite">
        Looking for an <span style="color:#ffe400;">Event?</span> <br><span style="font-weight:400;">search with almost <span style="color:#ffe400;">anything!</span></span>
        </div>
        <div class="mainsearch">
        <form action="<?php echo URLROOT; ?>/events/searchEvent?index=instant&return=1" method="POST" id="instantSearch">
            <div class="iconsearch"><i class="fas fa-search"></i></div>
            <input type="text" id="searchValueField" onKeyUp="ValidateInstantSearch(this.value); return;" placeholder="Event name, Location, State, Landmark, Organizer or Artist" name="searchValueField" />
            <!--
            <select name="category" id="">
                <option selected="selected" value="0">Category</option>
                <option value="0">Option 1</option>
                <option value="0">Option 2</option>
            </select>
            -->
            <button type="submit" form="instantSearch" value="Submit">Search</button>
</form>
        </div>
        <div class="searchDropWindow">
            <ul id="searchdata">
            </ul>
        </div>

        <div class="category">
            <ul>
                <a href="<?php echo URLROOT; ?>/events/loadEvent?format=cat&category=Music and Entertainment" title="Music and Entertainment"><li>
                    <div><img src="<?php echo URLROOT; ?>/public/images/icon1.png" /><div>
                        <div class="catItemTitle">
                    Music and Entertainment</div>
                </li></a>
                <a href="<?php echo URLROOT; ?>/events/loadEvent?format=cat&category=Sport and Fitness" title="Sport and Fitness"><li>
                    <div><img width="48" src="<?php echo URLROOT; ?>/public/images/icon2.png" /><div>
                        <div class="catItemTitle">
                        Sport and <br> Fitness</div>
                </li></a>
                <a href="<?php echo URLROOT; ?>/events/loadEvent?format=cat&category=Arts and Culture" title="Arts and Culture"><li>
                    <div><img src="<?php echo URLROOT; ?>/public/images/icon3.png" /><div>
                    <div class="catItemTitle">
                        Arts and <br> Culture</div>
                </li></a>
                <a href="<?php echo URLROOT; ?>/events/loadEvent?format=cat&category=Business and Corporate" title="Business and Corporate"><li>
                    <div><img src="<?php echo URLROOT; ?>/public/images/icon4.png" /><div>
                    <div class="catItemTitle">
                        Business and <br> Corporate</div>
                </li></a>
                <a href="<?php echo URLROOT; ?>/events/loadEvent?format=cat&category=NGOs and Community" title="NGOs and Community"><li>
                    <div><img src="<?php echo URLROOT; ?>/public/images/icon5.png" /><div>
                    <div class="catItemTitle">
                        NGOs and <br> Community</div>
                </li></a>
                <a href="<?php echo URLROOT; ?>/events/loadEvent?format=cat&category=Conference and Seminar" title="Conference and Seminar"><li>
                    <div><img src="<?php echo URLROOT; ?>/public/images/icon6.png" /><div>
                    <div class="catItemTitle"> 
                    Conference and <br> Seminar</div>
                </li></a>
            </ul>
        </div>
    </div>

</main>

<div class="container" style="margin-top:2.5%;">
    <div class="featuredHdr">
        Featured Events
        <div class="featSubhdr">Events you don't want to miss!</div>
    </div>

    <div class="row" style="margin-top:5%;">
        <div class="featurecol">
                <div class="autoplay">
                        <div class="featureSlide" style="background-image: url(<?php echo URLROOT; ?>/public/images/evntimg1.jpeg);"> 
                            <div class="featHighlight">
                                <div>
                                    <h6 class="featHdr">Vibes on the Beach with Biz Wiz</h6>
                                    <h6 class="featDesc"><i style="margin-right:5px;"class="fas fa-map-marker-alt"></i> Landmark Beach Oniru, Lagos </h6>
                                </div>
                                <div style="padding-top: 35px; padding-right: 10px;">
                                <a class="signin" style="height: 55px; border-radius: 10px;" href="<?php echo URLROOT; ?>/account/register">Book Now <i style="margin-left:7px;" class="fa fa-arrow-right"></i></a>
                                </div>                                
                            </div>
                        </div>
                        <div class="featureSlide" style="background-image: url(<?php echo URLROOT; ?>/public/images/eventimg2.jpeg);"> 
                        <div class="featHighlight">
                                <div>
                                    <h6 class="featHdr">Burna Boy - Twice as ALL</h6>
                                    <h6 class="featDesc"><i style="margin-right:5px;"class="fas fa-map-marker-alt"></i> Eko Hotel Victoria, Lagos </h6>
                                </div>
                                <div style="padding-top: 35px; padding-right: 10px;">
                                <a class="signin" style="height: 55px; border-radius: 10px;" href="<?php echo URLROOT; ?>/account/register">Book Now <i style="margin-left:7px;" class="fa fa-arrow-right"></i></a>
                                </div>                                
                            </div>
                        </div>
                        <div class="featureSlide" style="background-image: url(<?php echo URLROOT; ?>/public/images/eventimg3.png);"> 
                        <div class="featHighlight">
                                <div>
                                    <h6 class="featHdr">PSQUARE - Reactivated</h6>
                                    <h6 class="featDesc"><i style="margin-right:5px;"class="fas fa-map-marker-alt"></i> Eko Hotel Victoria, Lagos </h6>
                                </div>
                                <div style="padding-top: 35px; padding-right: 10px;">
                                <a class="signin" style="height: 55px; border-radius: 10px;" href="<?php echo URLROOT; ?>/account/register">Book Now <i style="margin-left:7px;" class="fa fa-arrow-right"></i></a>
                                </div>                                
                            </div>
                        </div>
                        <div class="featureSlide" style="background-image: url(<?php echo URLROOT; ?>/public/images/eventimg4.png);"> 
                        <div class="featHighlight">
                                <div>
                                    <h6 class="featHdr">TIWA SAVAGE Reloaded</h6>
                                    <h6 class="featDesc"><i style="margin-right:5px;"class="fas fa-map-marker-alt"></i> Landmark Beach Oniru, Lagos </h6>
                                </div>
                                <div style="padding-top: 35px; padding-right: 10px;">
                                <a class="signin" style="height: 55px; border-radius: 10px;" href="<?php echo URLROOT; ?>/account/register">Book Now <i style="margin-left:7px;" class="fa fa-arrow-right"></i></a>
                                </div>                                
                            </div>
                        </div>
                </div>
        </div>
        <div class="featurecol">
            
                <div class="subFeatCol"> 
                <a href="#" title="Laycon Fierce Fiesta 2021">
                <div class="subFeaturecol">
                    <div class="postImg" style="background-image: url(<?php echo URLROOT; ?>/public/images/eventimg5.jpeg);">
                        
                    </div> 
                
                    <div class="postContent">
                        <h6>Laycon Fierce Fiesta 2021</h6>
                        <p><i style="margin-right:5px;"class="fas fa-map-marker-alt"></i> Eko Conventional Centre</p>
                        <div class="postAddress">
                                <div class="postCalender">
                                <i class="far fa-calendar-alt"></i> 18 Dec
                                </div>
                                <div class="ticketDiv">
                                    <img src="<?php echo URLROOT; ?>/public/images/ticket.png" alt=""> <span style="font-size:11px; color:#8568af; margin-right:5px;">FROM </span> N5,000
                                </div>
                        </div>
                    </div>
                    </a>
                </div>
        
            <div class="subFeaturecol">
            <div class="postImg" style="background-image: url(<?php echo URLROOT; ?>/public/images/eventimg6.png);">
                    
                    </div> 
                
                    <div class="postContent">
                        <h6>The FALZ Experience 2021</h6>
                        <p><i style="margin-right:5px;"class="fas fa-map-marker-alt"></i> Eko Conventional Centre</p>
                        <div class="postAddress">
                            <div class="postCalender">
                            <i class="far fa-calendar-alt"></i> 18 Dec
                            </div>
                            <div class="ticketDiv">
                                <img src="<?php echo URLROOT; ?>/public/images/ticket.png" alt=""> <span style="font-size:11px; color:#8568af; margin-right:5px;">FROM </span> N5,000
                            </div>
                        </div>
                    </div>
            </div>
            </div>
        </div>
    </div>
</div>

<div class="ticketList" id="eventList">

    <div class="container">
    <div class="featuredHdr">
        Upcoming Events Near You
        <div class="featSubhdr">Get engaged with our list of events</div>
    </div>
    <div class="listFilter">
            <a href="<?php echo URLROOT; ?>/?filter=all#eventList" title="Search all events!">
            <div class="<?php echo ($data['filter'] == 'all') ? 'filterractive' : 'filterDiv'; ?> ">
                All
            </div></a>
            <a href="<?php echo URLROOT; ?>/?filter=today#eventList" title="Events today!"><div class="<?php echo ($data['filter'] == 'today') ? 'filterractive' : 'filterDiv'; ?>">
                Happening Today
            </div></a>
            <a href="<?php echo URLROOT; ?>/?filter=week#eventList" title="Happening this week!"><div class="<?php echo ($data['filter'] == 'week') ? 'filterractive' : 'filterDiv'; ?>">
                Happening This Week
            </div></a>
            <a href="<?php echo URLROOT; ?>/?filter=month#eventList" title="This month!"><div class="<?php echo ($data['filter'] == 'month') ? 'filterractive' : 'filterDiv'; ?>">
                This Month only
            </div></a>
    </div>

    <?php if($data['loadData'] == false) : ?>
        <div class="infoAlert">
        <span style="font-weight:600;"><i class="fa fa-circle-info"></i> Sorry!</span> No event was found for <?php echo $data['filter']; ?>, please retry
        </div>
    <?php endif; ?>

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

       <!--
        <div class="eventItem">
        <a href="<?php echo URLROOT; ?>/events/find?sku=1&pid=<?php echo $product->PRODUCT_ID; ?>" title="Burna Boy - Twice as ALL">
        <div class="poster" style="background-image: url(<?php echo URLROOT; ?>/public/images/eventimg7.jpeg);"></div>
            <div class="posterContent">
                <h6>SPILLNAL Part of the Dream</h6>
                <p><i style="margin-right:10px;"class="fas fa-map-marker-alt"></i> Eko Atlantic Centre</p>
                <p style="margin-top:-5px;"><i style="margin-right:10px;"class="fas fa-calendar-check"></i> Friday, 19 December</p>
                <div class="posterTicket">
                    <div class="postTicketLabel">
                    <img src="<?php echo URLROOT; ?>/public/images/ticket2.png" alt=""> <span style="font-size:12px; color:#D1B2FF; margin-right:5px;">FROM </span> ₦ 1,500
                    </div>
                    <a href="#" style="text-decoration: none;" title="Share ticket link">
                        <div class="shareticket">
                        <i style="margin-right:5px;" class="fas fa-share-alt"></i> Share 
                        </div>
                    </a>
                </div>
            </div>
            </a>
        </div>
        <div class="eventItem">
        <a href="<?php echo URLROOT; ?>/events/find?sku=1&pid=<?php echo $product->PRODUCT_ID; ?>" title="Burna Boy - Twice as ALL">
        <div class="poster" style="background-image: url(<?php echo URLROOT; ?>/public/images/eventimg8.jpeg);"></div>
            <div class="posterContent">
                <h6>QUILOX 6000 - 6 Years Annissary</h6>
                <p><i style="margin-right:10px;"class="fas fa-map-marker-alt"></i> Eko Conventional Centre</p>
                <p style="margin-top:-5px;"><i style="margin-right:10px;"class="fas fa-calendar-check"></i> Tuesday, 25 December</p>
                <div class="posterTicket" style="background-color:#ff2364;">
                    <div class="postTicketLabel">
                    <img src="<?php echo URLROOT; ?>/public/images/ticket_free.png" alt=""> <span style="font-size:13px;">FREE EVENT</span>
                    </div>
                    <a href="#" style="text-decoration: none;" title="Share ticket link">
                        <div class="shareticket_free">
                        <i style="margin-right:5px;" class="fas fa-share-alt"></i> Share 
                        </div>
                    </a>
                </div>
            </div>
            </a>
        </div>
        <div class="eventItem">
        <div class="poster" style="background-image: url(<?php echo URLROOT; ?>/public/images/eventimg10.jpeg);"></div>
            <div class="posterContent">
                <h6>QUILOX 6000 - 6 Years Annissary</h6>
                <p><i style="margin-right:10px;"class="fas fa-map-marker-alt"></i> Eko Conventional Centre</p>
                <p style="margin-top:-5px;"><i style="margin-right:10px;"class="fas fa-calendar-check"></i> Tuesday, 25 December</p>
                <div class="posterTicket" style="background-color:#ff2364;">
                    <div class="postTicketLabel">
                    <img src="<?php echo URLROOT; ?>/public/images/ticket_free.png" alt=""> <span style="font-size:13px;">FREE EVENT</span>
                    </div>
                    <a href="#" style="text-decoration: none;" title="Share ticket link">
                        <div class="shareticket_free">
                        <i style="margin-right:5px;" class="fas fa-share-alt"></i> Share 
                        </div>
                    </a>
                </div>
            </div>
        </div>
        <div class="eventItem">
            <div class="poster" style="background-image: url(<?php echo URLROOT; ?>/public/images/eventimg11.jpeg);"></div>
            <div class="posterContent">
                <h6>Burna Boy - Twice as ALL</h6>
                <p><i style="margin-right:10px;"class="fas fa-map-marker-alt"></i> Eko Conventional Centre</p>
                <p style="margin-top:-5px;"><i style="margin-right:10px;"class="fas fa-calendar-check"></i> Tuesday, 25 December</p>
                <div class="posterTicket">
                    <div class="postTicketLabel">
                    <img src="<?php echo URLROOT; ?>/public/images/ticket2.png" alt=""> <span style="font-size:12px; color:#D1B2FF; margin-right:5px;">FROM </span> ₦ 1,500
                    </div>
                    <a href="#" style="text-decoration: none;" title="Share ticket link">
                        <div class="shareticket">
                        <i style="margin-right:5px;" class="fas fa-share-alt"></i> Share 
                        </div>
                    </a>
                </div>
            </div>
        </div>
        <div class="eventItem">
        <div class="poster" style="background-image: url(<?php echo URLROOT; ?>/public/images/eventimg9.jpeg);"></div>
            <div class="posterContent">
                <h6>Burna Boy - Twice as ALL</h6>
                <p><i style="margin-right:10px;"class="fas fa-map-marker-alt"></i> Eko Conventional Centre</p>
                <p style="margin-top:-5px;"><i style="margin-right:10px;"class="fas fa-calendar-check"></i> Tuesday, 25 December</p>
                <div class="posterTicket">
                    <div class="postTicketLabel">
                    <img src="<?php echo URLROOT; ?>/public/images/ticket2.png" alt=""> <span style="font-size:12px; color:#D1B2FF; margin-right:5px;">FROM </span> ₦ 1,500
                    </div>
                    <a href="#" style="text-decoration: none;" title="Share ticket link">
                        <div class="shareticket">
                        <i style="margin-right:5px;" class="fas fa-share-alt"></i> Share 
                        </div>
                    </a>
                </div>
            </div>
        </div>
    -->
    </div>

    </div>

    <div class="loadmoreHome">
        <a href="<?php echo URLROOT; ?>/events/loadEvent?page=1" title="Load more events!">See More Events <i style="margin-left:5px;" class="fas fa-location-arrow"></i></a>
    </div>

</div>

<div class="cityTickets">
  <div class="container">
        
    <div class="cityRow">
        <div class="cityColumn">
            <h1>
                Find Events in your Favorite cities
            </h1>
            <h6>
                We make finding events in cities more easier
            </h6>
            
        <a href="#" title="Load more events!">See All Cities <i style="margin-left:5px;" class="fas fa-location-arrow"></i></a>
        
        </div>
        <div class="cityColumn">

            <div class="cityColumnRow">

                    <div class="cityWall" style="margin-top:-20px;">
                        <img src="<?php echo URLROOT; ?>/public/images/lagos.png" alt="">
                        <h2>Lagos</h2>
                    </div>
                    <div class="cityWall" style="margin-top:10px;">
                        <img src="<?php echo URLROOT; ?>/public/images/abuja.png" alt="">
                        <h2>Abuja</h2>
                    </div>
                
            </div>
            <div class="cityColumnRow">

                    <div class="cityWall" style="margin-top:-15px;">
                        <img src="<?php echo URLROOT; ?>/public/images/ph.png" alt="">
                        <h2>PH City</h2>
                    </div>
                    <div class="cityWall" style="margin-top:20px;">
                        <img src="<?php echo URLROOT; ?>/public/images/city.png" alt="">
                        <h2>More Cities</h2>
                    </div>

            </div>
        </div>
    </div>

  </div>
</div>


<div class="testimonies">
    <div class="testimonyBg">
            <div class="featuredHdr" style="font-size:30px;">
                What People Are Saying
                <div class="featSubhdr">Learn more from our clients</div>
            </div>
            <div class="testyWindow">
                <div class="testyCard">
                    <p>Organising my events and selling tickets have been seamless than ever with hellotickets.ng</p>
                    <h6>Jessica, Victoria Island</h6>
                </div>
                <div class="testyCard">
                    <p>They are just my plug when it comes to getting tickets for events, sure they are!</p>
                    <h6>Sammie, Abuja City</h6>
                </div>
                <div class="testyCard">
                    <p>They brought the A-Game to buying and selling event tickets both online and offline. Quiet amazing!</p>
                    <h6>Mrs Ajebo, Lekki</h6>
                </div>
            </div>
    </div>
</div>

<?php
   require APPROOT . '/views/includes/footer.php';
?>