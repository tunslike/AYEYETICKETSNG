<?php
   require APPROOT . '/views/includes/header.php';
?>


<div class="innerDiv2">

<div class="innerHeaderDivider">

<div>
<div class="breadcrumb">
        <ul>
            <li><a href="<?php echo URLROOT; ?>/index"><i class="fas fa-home"></i></a></li>
            <li><i class="fas fa-chevron-right" style="color:#ff2364; font-size: 13px; margin: 0px -2px;"></i></li>
            <li><a href="<?php echo URLROOT; ?>/index">Event</a></li>
            <li><i class="fas fa-chevron-right" style="color:#ff2364; font-size: 13px; margin: 0px -2px;"></i></li>
    
        </ul>
    </div>

    <div style="margin-top:-5px;" class="innerfeaturedHdr">
    Create Event Ticket
    </div>
</div>
<div>
<div class="reminderButton">
    <a href="<?php echo URLROOT; ?>/account/login" title="Load more events!">Manage Events <i style="margin-left:5px;" class="fas fa-calendar-check"></i></a>
</div>

</div>

</div>
</div>

<form action="<?php echo URLROOT; ?>/events/createTicket" onsubmit="return validateLoginForm();" method ="POST" enctype="multipart/form-data">
<div class="displayDivider">
    <div class="leftDisplay">
    
        <div class="eventhdr">
            Event Details <i class="fas fa-long-arrow-alt-right"></i>
        </div>
        <div style="margin-right:60px; margin-top:30px;">

        <div class="loginform">
            <label for="usern">Event Name:</label>
            <input type="text" name="eventName" id="usern">
        </div>
        <div class="loginform">
            <label for="usern">Venue Name:</label>
            <input type="text" name="venueName" id="usern">
        </div>
        <div class="loginform">
            <label for="usern">Venue Address:</label>
            <input type="text" name="venueAddress" id="usern">
        </div>
        <div class="loginform">
            <label for="usern">Event Image:</label>
            <input type="file" name="evemtImage" id="usern">
        </div>
        <div class="imgInfo"><h6> <i class="fas fa-exclamation-circle"></i> Recommended image size is 1500 by 1256 pixels. Only .jpg, .jpeg, .gif, .png formats. Image size must not be more than 10MB</h6></div>
        <div class="dateTime">
            <div class="div">
                <div class="loginform">
                    <label for="usern">Start Date:</label>
                    <input type="text" name="startDate" id="startDate">
                </div>
            </div>
            <div class="div">
                <div class="loginform">
                    <label for="usern">End Date:</label>
                    <input type="text" name="endDate" id="endDate">
                </div>
            </div>
        </div>

        <div class="dateTime">
            <div class="div">
                <div class="loginform">
                    <label for="usern">Start Time:</label>
                    <input type="text" name="startTime" id="startTime">
                </div>
            </div>
            <div class="div">
                <div class="loginform">
                    <label for="usern">End Time:</label>
                    <input type="text" name="endTime" id="endTime">
                </div>
            </div>
        </div>


        <div class="editor">
            <h3>Event Description:</h3>
        <div id="standalone-container">
  <div id="toolbar-container">
    <span class="ql-formats">
      <select class="ql-font"></select>
      <select class="ql-size"></select>
    </span>
    <span class="ql-formats">
      <button class="ql-bold"></button>
      <button class="ql-italic"></button>
      <button class="ql-underline"></button>
      <button class="ql-strike"></button>
    </span>
    <span class="ql-formats">
      <select class="ql-color"></select>
      <select class="ql-background"></select>
    </span>
    <span class="ql-formats">
      <button class="ql-script" value="sub"></button>
      <button class="ql-script" value="super"></button>
    </span>
    <span class="ql-formats">
      <button class="ql-header" value="1"></button>
      <button class="ql-header" value="2"></button>
      <button class="ql-blockquote"></button>
      <button class="ql-code-block"></button>
    </span>
    <span class="ql-formats">
      <button class="ql-list" value="ordered"></button>
      <button class="ql-list" value="bullet"></button>
      <button class="ql-indent" value="-1"></button>
      <button class="ql-indent" value="+1"></button>
    </span>
    <span class="ql-formats">
      <button class="ql-direction" value="rtl"></button>
      <select class="ql-align"></select>
    </span>
    <span class="ql-formats">
      <button class="ql-link"></button>
      <button class="ql-image"></button>
      <button class="ql-video"></button>
      <button class="ql-formula"></button>
    </span>
    <span class="ql-formats">
      <button class="ql-clean"></button>
    </span>
  </div>
  <div name="editor-container" id="editor-container"></div>
</div>
        </div>

</div>

<div class="eventhdr" style="margin-top:40px;">
    Event Settings <i class="fas fa-long-arrow-alt-right"></i>
</div>      
<br>
<div class="settingRow">
            <input type="checkbox" name="display">
            <label for="showticker">Show Remaining Ticket</label>
            <h6>Display the number of remaining tickets on your events</h6>
</div>
<div class="settingRow">
            <input type="checkbox" name="organizer">
            <label for="showticker">Show Organizer Details</label>
            <h6>Display the details of the organizer on your events.</h6>
</div>
<div class="settingRow">
            <input type="radio" checked="checked" name="eventtype">
            <label for="showticker">Public Event</label>
            <h6>Event will be available on our event listing page, our promotion partners, and search engines</h6>
</div>
<div class="settingRow">
            <input type="radio" name="eventtype">
            <label for="showticker">Private Event</label>
            <h6>Event will be accessed privately and only invited people can see event</h6>
</div>

    </div>
    <div class="rightDisplay">
    <div class="gettickets">
        <div class="ticketHdr">
        <i class="fas fa-plus-square"></i>  Add Ticket
            </div>
            <div id="noTicketAlert" class="ticketItemEmpty">
            <i style="margin-right:5px;" class="fas fa-exclamation-circle"></i> No Ticket has been added!
            </div>
            <div id="ticketList" class="ticketList">
                
            </div>
            <div>
                <div class="ticketType">
                    <div>
                    <input checked="checked" value="1" type="radio" id="paidticket" name="ticketType">
                    <label for="showticker">Paid Ticket</label>
                    </div>
                    <div>
                    <input type="radio" value="2" id="freeticket" name="ticketType">
                    <label for="showticker">Free Ticket</label>
                    </div>
                </div>
                <div class="ticketItemNew">
                    <div style="flex-basis:50%"><input type="text" id="ticketName" placeholder="Ticket Name" name="ticketName"></div>
                    <div style="flex-basis:35%"><input type="text"  name="currency-field" id="currency-field" pattern="^\$\d{1,3}(,\d{3})*(\.\d+)?$" value="" data-type="currency" placeholder="₦1,000.00"></div>
                    <div style="flex-basis:15%"><input style="text-align:center;" type="number" id="ticketQty" value="1" placeholder="Qty" name="Amt"></div>
                </div>
            </div>
            <div class="addTicket">
            <a href="#" id="addTicket" onclick="return false;" title="Add Ticket!">Add Ticket</a>
        </div>
            <div class="feeSettings">
                <div class="terms">
                        <input type="checkbox" name="eventtype">
                        <label for="showticker">I agree to the <a href="#">terms and conditions</a></label>
                </div>
                <button type="submit" class="createTicketButton">Create Event Tickets <i class="fas fa-check-square"></i></button>
                
            </div>
        </div>
        </div>
    </div>
</div>
</form>

<?php
   require APPROOT . '/views/includes/footer.php';
?>