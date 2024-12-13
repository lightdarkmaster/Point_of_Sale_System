$(document).on("click", ".proceedToPlace", function () {
  console.log("proceedToPlace");

  var cphone = $("#cphone").val();
  var payment_mode = $("#payment_mode").val();

  // Check if either phone number or payment mode is empty or null
  if (cphone == "" && payment_mode == "") {
    swal(
      "Required Fields",
      "Please select a payment mode and provide a phone number.",
      "warning"
    );
    return false;
  } else if (payment_mode == "") {
    swal("Required Fields", "Please select a payment mode.", "warning");
    return false;
  } else if (cphone == "") {
    swal("Required Fields", "Please provide phone number.", "warning");
    return false;
  }

  var data = {
    proceedToPlaceBtn: true,
    cphone: cphone,
    payment_mode: payment_mode,
  };

  $.ajax({
    type: "POST",
    url: "orders-code.php",
    data: data,
    success: function (response) {
      var res = JSON.parse(response);
      if (res.status == 200) {
        window.location.href = "order-summary.php";
      } else if (res.status == 404) {
        swal(res.message, res.message, res.status_type, {
          buttons: {
            catch: {
              text: "Add Customer",
              value: "catch",
            },
            cancel: "Cancel",
          },
        }).then((value) => {
          switch (value) {
            case "catch":
              $("#c_phone").val(cphone);
              $("#addCustomerModal").modal("show");
              //console.log('Pop the customer add modal');
              break;
            default:
          }
        });
      } else {
        swal(res.message, res.message, res.status_type);
      }
    },
  });

  //Add customer to customers table
  $(document).on("click", ".saveCustomer", function () {
    var c_name = $("#c_name").val();
    var c_phone = $("#c_phone").val();
    var c_email = $("#c_email").val();

    if (c_name != "" && c_phone != "") {
      if ($.isNumeric(c_phone)) {
        var data = {
          saveCustomerBtn: true,
          name: c_name,
          phone: c_phone,
          email: c_email,
        };

        $.ajax({
          type: "POST",
          url: "orders-code.php",
          data: data,
          success: function (response) {
            var res = JSON.parse(response);
            if (res.status == 200) {
              swal(res.message, res.message, res.status_type);
              $("#addCustomerModal").modal("hide");
            } else if (res.status == 422) {
              swal(res.message, res.message, res.status_type);
            } else {
              swal(res.message, res.message, res.status_type);
            }
          },
        });
      } else {
        swal("Enter valid phone number", "", "warning");
      }
    } else {
      swal("Please Fill required fields", "", "warning");
    }
  });

});

  //save receipt
  $(document).on('click','#saveOrder', function(){

    $.ajax({
     type: "POST",
     url: "orders-code.php",
     data: {
         'saveOrder': true
     },
     success: function(response){
         var res = JSON.parse(response);

         if(res.status == 200){
             swal(res.message, res.message, res.status_type);
             $('#orderPlaceSuccessMessage').text(res.message);
             $("#orderSuccessModal").modal("show");
         }else{
             swal(res.message, res.message, res.status_type);
         }
     }
    });
 });

