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


 
function printMyBillingArea(){
    
  var divContents = document.getElementById("myBillingArea").innerHTML;
  var a = window.open('','');
  a.document.write('<html><title>POS System</title>');
  a.document.write('<body style="font-family: fangsong;"></body>');
  a.document.write(divContents);
  a.document.write('</body></html>');
  a.document.close();
  a.print();
}



window.jsPDF = window.jspdf.jsPDF;
var docPDF = new jsPDF;

function downloadPDF(invoiceNo){

  var elementHTML = document.querySelector("#myBillingArea");
  docPDF.html(elementHTML,{
      callback: function(){
          docPDF.save(invoiceNo+'.pdf');
      },
      x: 15,
      y: 15,
      width: 170,
      windowWidth: 650
  });
}
//added for my chart
    // Wait for the DOM to load
    document.addEventListener("DOMContentLoaded", function () {
      // Get the context of the canvas
      const ctx = document.getElementById('myAreaChart').getContext('2d');

      // Define the data
      const data = {
          labels: ["January", "February", "March", "April", "May", "June"],
          datasets: [{
              label: "Monthly Sales",
              data: [500, 1000, 750, 1250, 1750, 1500], // Replace with your data
              fill: true,
              backgroundColor: "rgba(75, 192, 192, 0.2)", // Area color
              borderColor: "rgba(75, 192, 192, 1)", // Line color
              pointBackgroundColor: "rgba(75, 192, 192, 1)",
              pointBorderColor: "#fff"
          }]
      };

      // Configure the chart
      const config = {
          type: 'line', // 'line' is commonly used for area charts
          data: data,
          options: {
              responsive: true,
              plugins: {
                  legend: {
                      display: true,
                      position: 'top'
                  }
              },
              scales: {
                  x: {
                      title: {
                          display: true,
                          text: "Months"
                      }
                  },
                  y: {
                      title: {
                          display: true,
                          text: "Sales ($)"
                      },
                      beginAtZero: true
                  }
              }
          }
      };

      // Create and render the chart
      new Chart(ctx, config);
  });
