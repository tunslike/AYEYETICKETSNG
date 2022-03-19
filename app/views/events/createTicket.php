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

<?php if($data['status'] == 'true') : ?>
<div class="successAlert">
<i class="fas fa-check"></i> Congratulations! Your event has been created successfully. Please check your email for further details
</div>
<?php endif; ?>


<form id="eventform" action="<?php echo URLROOT; ?>/events/createTicket" method ="POST" enctype="multipart/form-data">
<div class="displayDivider">
    <div class="leftDisplay">
    
        <div class="eventhdr">
            <div style="display:flex; flex-direction: row; justify-content: space-between; align-items: center;">
                <div>
                Event Details <i class="fas fa-long-arrow-alt-right"></i>
                </div>
                <div style="font-weight: 400; color: #303030; font-size: 13px;">
                    All fields are compulsory!
                </div>
            </div>
        </div>
        <div style="margin-right:60px; margin-top:30px;">

        <div class="loginform">
            <label for="usern">Event Category:</label>
            <select name="eventCategory" id="">
                    <option default value="">Select here</option>
                    <?php foreach($data['categories'] as $category): ?>
                        <option value="<?php echo $category->CATEGORY_NAME; ?>"><?php echo $category->CATEGORY_NAME; ?></option>
                    <?php endforeach; ?>
            </select>
        </div>
        <div class="loginform">
            <label for="usern">Event Name:</label>
            <input type="text" name="eventName" id="eventName">
        </div>
        <div class="loginform">
            <label for="usern">Venue Name:</label>
            <input type="text" name="venueName" id="venueName">
        </div>
        <div class="loginform">
            <label for="usern">Venue Address:</label>
            <input type="text" required name="venueAddress" id="venueAddress">
            <input type="hidden" id="venue_loc_lat" name="venue_loc_lat" value="">
            <input type="hidden" id="venue_loc_long" name="venue_loc_long" value="">
        </div>
        <div class="loginform">
            <label for="usern">State:</label>
            <select name="eventState" id="eventState">
                    <option default value="">Select here</option>
                    <?php foreach($data['states'] as $state): ?>
                        <option value="<?php echo $state->STATE_NAME; ?>"><?php echo $state->STATE_NAME; ?></option>
                    <?php endforeach; ?>
            </select>
        </div>
        <h6 class="autocomplete_alert"><i style="margin-right:5px;" class="fa-regular fa-circle-info"></i> Autocomplete is enabled</h6>
        <div class="loginform">
            <label for="usern">Event Image:</label>
            <input type="file" required id="eventimage" name="evemtImage">
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
  <input type="hidden" id="editorValue" name="editorValue" value="">
</div>
        </div>

</div>

<div class="eventhdr" style="margin-top:40px;">
    Event Settings <i class="fas fa-long-arrow-alt-right"></i>
</div>      
<br>
<div class="settingRow">
            <input type="checkbox" value="1" id="display" name="display">
            <label for="showticker">Show Remaining Ticket</label>
            <h6>Display the number of remaining tickets on your events</h6>
</div>
<div class="settingRow">
            <input type="checkbox" value="1" id="organizer" name="organizer">
            <label for="showticker">Show Organizer Details</label>
            <h6>Display the details of the organizer on your events.</h6>
</div>
<div class="settingRow">
            <input type="radio" value="public" checked="checked" name="eventtype">
            <label for="showticker">Public Event</label>
            <h6>Event will be available on our event listing page, our promotion partners, and search engines</h6>
</div>
<div class="settingRow">
            <input type="radio" value="private" name="eventtype">
            <label for="showticker">Private Event</label>
            <h6>Event will be accessed privately and only invited people can see event</h6>
</div>

    </div>
    <div class="rightDisplay">
    <div class="gettickets">
        <div class="ticketHdr">
            <div class="splitTicket">
                <div>
                <i class="fas fa-plus-square"></i>  Add Ticket
                </div>
                <div style="color:#edb7c7;">No of Tickets: <span id="tickCounter" class="circlePointer">0</span></div>
            </div>
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
                    <div style="flex-basis:35%"><input type="text"  name="currency-field" id="currency-field" onKeyUp="numericFilter(this);" pattern="^\$\d{1,3}(,\d{3})*(\.\d+)?$" value="" data-type="currency" placeholder="₦1,000"></div>
                    <div style="flex-basis:15%"><input style="text-align:center;" onchange="ValidateQuantityField(this.value)" type="number" onkeypress="return (event.charCode == 8 || event.charCode == 0) ? null : event.charCode >= 48 && event.charCode <= 57" id="ticketQty" value="1" placeholder="Qty" name="Amt"></div>
                </div>
            </div>
            <input type="hidden" id="totalTickets" name="totalTickets" value="">
            <div class="addTicket">
            <a href="#" id="addTicket" onclick="return false;" title="Add Ticket!">Add Ticket</a>
        </div>
            <div class="feeSettings">
                <div class="terms">
                        <input type="checkbox" id="termscondition" required value="1" name="termscondition">
                        <label for="showticker">I agree to the <a href="#">terms and conditions</a></label>
                </div>
                <button type="button" id="btnSubmit" class="createTicketButton">Create Event Tickets <i class="fas fa-check-square"></i></button>
            </div>
        </div>
        </div>
    </div>
</div>
</form>

<?php
   require APPROOT . '/views/includes/footer.php';
?>