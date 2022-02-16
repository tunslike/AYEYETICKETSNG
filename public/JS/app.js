

// ADD TICKET TO EVENTS
$('#addTicket').click(function() {

    //get values
    var tname = $('#ticketName').val()
    var tamount = $('#currency-field').val()
    var tqty = $('#ticketQty').val()
    var type = ''
    var price = '';

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
        type = 1;
    }else if($("#freeticket").is(':checked')) {
        type = 2
    }

    if(type == '2') {
        price = 'FREE';
    }else {
        price = '₦ ' + tamount;
    }

    // append
    $('#ticketList').append(
        '<div class="ticketItemAuto">' + 
        '<div style="flex-basis:40%"><input readonly type="text" value="'+tname+'" name="ticketName"></div>' +
        '<div style="flex-basis:35%"><input readonly type="text" value="'+price+'" name="ticketName"></div>' +
        '<div style="flex-basis:15%;"><input readonly style="text-align:center;" type="text" value="1" name="ticketName"></div>' +
        '<div style="flex-basis:10%; text-align:center;"><a style="color:#ff2364;" href="#" title="Remove ticket!" onClick="return false;"><i class="fas fa-trash-alt"></i></a></div>' +
        '</div>'
)

    //clear fields
    $('#ticketName').val('')
    $('#currency-field').val('')
    $('#ticketQty').val('')

})