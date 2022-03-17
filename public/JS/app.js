// Global Variables
var ticketData = '';
var ticketTotal = 0;

product = [];

// function to restrict number
function numericFilter(txb) {
    txb.value = txb.value.replace(/[^\1-9]/ig, "");
 }

 function ValidateQuantityField(count) {
    if(count.trim() == '') {
        $('#ticketQty').val('1');
    }else if(count.trim() == '0') {
        $('#ticketQty').val('1');
    }
}

// FUNCTION TO SET REMINDER
function setEventReminder() {
    
    swal({
        button: "Submit",
        title: 'Set Event Reminder',
        content: {
          element: "input",
          attributes: {
            placeholder: "Enter your email address",
            type: "text",
          },
        },
      }).then(name => {

        var eventid = $('#eventid').val()

        if(name.trim() == '') {
            alert('Please enter your email address!')
            return false;
        }
    
        $.ajax({
            type: "POST",
            data: { emailad: name, eventid: eventid },
            url: "http://localhost:8080/helloticketsng/events/submitReminderRequest",
            success: function (data) {
                
                if(data == 1) {
                    swal("Set Event Reminder", "Thank you! A reminder has been set for this event", "success");
                    return false;
                }

            },
        });

      })

}
//END OF FUNCTION

// FUNCTION TO SUBMIT EVENT FORM
$('#btnSubmit').click(function() {

    //check values
    var evtname = $('#eventName').val()
    var venue = $('#venueName').val()
    var address = $('#venueAddress').val()

    var startDate = $('#startDate').val()
    var endDate = $('#endDate').val()

    var startTime = $('#startTime').val()
    var endTime = $('#endTime').val()

    var display = $('#display').val()
    var organizer = $('#organizer').val()
    var eventtype = $('#eventtype').val()
    var totalTickets = $('#totalTickets').val()

    if(evtname.trim() == '' || venue.trim() == '' || address.trim() == '' || startDate.trim() == '' || 
        endDate.trim() == '' || startTime.trim() == '' || endTime.trim() == '') {

            swal("Create Event Ticket", "All fields are compulsory!", "error");
            return false;

        }

    if(document.getElementById("eventimage").files.length == 0 ) {
        swal("Create Event Ticket", "Provide upload event image!", "error");
        return false;
    }

    if(totalTickets == '') {
        swal("Create Event Ticket", "Please add your tickets!", "error");
        return false;
    }

    var editor = $('#editor-container').html();
    if(editor.trim() == '') {
        swal("Create Event Ticket", "Provide Ticket description!", "error");
        return false;
    }

    if(!$("#termscondition").is(':checked')) {
        swal("Create Event Ticket", "Please select the terms and conditions to proceed!", "error");
        return false;
    }

    $('#editorValue').val(editor);
    $("#eventform").submit();
    
})
// END OF FUNCTION

//function to submit buy now 
$('#btnBuyNow').click(function() {

    var data = JSON.stringify(product);

    if(product == '') {
        swal("Buy Event Ticket", "Please select your tickets to proceed", "error");
        return false;
    }

    $('#tickets').val(data)

    $("#bookingForm").submit();
})
//end of function

$('#btnMakePayment').click(function() {

    var p_fullname = $('#p_fullname').val()
    var p_phone = $('#p_phone').val()
    var p_email = $('#p_email').val()

    var  own_fullname = $('#own_fullname').val()
    var own_phone = $('#own_phone').val()
    var own_email = $('#own_email').val()

    var ownerticker = $('#ownerticker').val()

     //check paid ticket
     if(p_fullname.trim() == '' || p_phone.trim() == '' || p_email.trim() == '') {
        swal("Make Payment", "Please provide your details to proceed", "error");
        return false;
    }

    //check paid ticket
    if($("#ownerticker").is(':checked')) {

        if(own_fullname.trim() == '' || own_phone.trim() == '' || own_email.trim() == '') {
            swal("Make Payment", "Please provide owner's details!", "error");
            return false;
        }
    }

    $('#paymentform').submit()
    
})

function formatNumberCurrency(value) {
    return (value).toFixed(0).replace(/\d(?=(\d{3})+\.)/g, '$&,');
}

//function to show owner's ticker
function showOwnerTicker() {

    if($("#ownerticker").is(':checked')){
        $('#ownerDetailsWindow').show()
    }else {
        $('#ownerDetailsWindow').hide()
    }
}

function Ticket(name, count, seqnum) {
    this.name = name;
    this.count = count;
    this.SeqNum = seqnum;
  }

// ADD MORE TICKET
function addTickets(id) {

    var jsonProduct = JSON.stringify(product);

    let formatCurrency = Intl.NumberFormat('en-US');

    var name = $('#ticketCounter_'+id).data('ticketname'); 
    var price = $('#ticketCounter_'+id).data('ticketprice'); 

    var ticket = {
        name: name,
        count: 1,
        SeqNum: id,
    };

    var counter = $('#countVal_'+id).html();

    counter = Number(counter) + 1;
    price = Number(price) * counter;

    $('#countVal_'+id).html(counter)

    if(Number(counter) == 1) {

        ticketTotal = Number(price);

        $('#ticketList').append('<div style="margin-top:5px;" id="ticketList_'+id+'" class="amtVals_'+id+'">['+name+'] x '+ counter +'</div>')
        $('#ticktgAmt').append('<div style="margin-top:5px;" id="ticktgAmt_'+id+'" class="amtVals_'+id+'">₦ '+ formatCurrency.format(price) +'</div>')

        $('#totalLabel').show()
        $('#totalAmt').show()

    }else{

        ticketTotal = Number(price);

        $('#ticketList_'+id).html('[' + name + '] x ' + counter);
        $('#ticktgAmt_'+id).html('₦ ' + formatCurrency.format(price));

    }

    $('#totalAmt').html('₦ ' + formatCurrency.format(ticketTotal))

    //update data

    if(product.length == 0) {
        
        var ticket = new Ticket(name, 1, id);
        product.push(ticket)

    }else{
       
        for(var ticket in product) {

            if(product[ticket].name === name) {
            
                product[ticket].count ++;
                return;
            }
        }

        var ticket = new Ticket(name, 1, id);
        product.push(ticket)
    }
}

function removeTickets(id) {

    var counter = $('#countVal_'+id).html();

    if(Number(counter) > 0) {
        counter = Number(counter) - 1;
        $('#ticketList').html('Regular x ' + counter)
    }

    $('#countVal_'+id).html(counter)

    
}

// ADD TICKET TO EVENTS
$('#addTicket').click(function() {

    //get values
    var tname = $('#ticketName').val()
    var tamount = $('#currency-field').val()
    var tqty = $('#ticketQty').val()
    var type = ''
    var price = '';
    var counter = $('#tickCounter').html()
    
    //check paid ticket
    if(!$("#paidticket").is(':checked') && !$("#freeticket").is(':checked')) {
        swal("Add Ticket", "Please select ticket type!", "error");
        return false;
    }

    //check fields
    if(tname.trim() == '' || tamount.trim() == '' || tqty.trim() == '') {
        swal("Add Ticket", "Provide Ticket name, price and quantity!", "error");
        return false;
    }

    //hide 
    $('#noTicketAlert').hide()

    if($("#paidticket").is(':checked')) {
        type = 'Paid';
    }else if($("#freeticket").is(':checked')) {
        type = 'Free';
    }

    if(type == '2') {
        price = 'FREE';
    }else {
        price = '₦ ' + tamount;
    }

    // append
    $('#ticketList').append(
        '<div class="ticketItemAuto">' + 
        '<div style="flex-basis:40%"><input readonly type="text" value="'+tname+'" name="ticketname"></div>' +
        '<div style="flex-basis:35%"><input readonly type="text" value="'+price+'" name="ticketprice"></div>' +
        '<div style="flex-basis:15%;"><input readonly style="text-align:center;" type="text" value="1" name="ticketqty"></div>' +
        '<div style="flex-basis:10%; text-align:center;"><a style="color:#ff2364;" href="#" title="Remove ticket!" onClick="return false;"><i class="fas fa-trash-alt"></i></a></div>' +
        '</div>'
    )

    $('#ticketQty').val(1);

    ticketData = ticketData + tname + '/' + price + '/' + 1 + '/' + type +  ';';

    $('#totalTickets').val(ticketData);

    /*
    if(counter == 0) {
        counter = 1;
        $('#tickCounter').html(counter)
    }else {
        counter = counter + 1;
        $('#tickCounter').html(counter);
    }
    */

    //clear fields
    $('#ticketName').val('')
    $('#currency-field').val('')
    $('#ticketQty').val('')

})