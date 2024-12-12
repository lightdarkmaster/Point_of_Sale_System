$(document).on('click', '.proceedToPlace', function() {
    console.log('proceedToPlace');

    var cphone = $('#cphone').val();
    var payment_mode = $('#payment_mode').val();

    // Check if either phone number or payment mode is empty or null
    if ((cphone === '' || cphone === null) || (payment_mode === '' || payment_mode === null)) {
        swal("Required Fields", "Please select a payment mode and provide a phone number.", "warning");
        return false;
    }
    
    var data = {

        'proceedToPlaceBtn': true,
        'cphone': cphone,
        'payment_mode': payment_mode,

    }

    $.ajax({
        type: "POST",
        url: "orders-code.php",
        data: data,
        success: function(response){

        }
    });

});