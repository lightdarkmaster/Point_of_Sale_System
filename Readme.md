Simple - POS System in PHP MySQL

#Requirements
1. Host : Localhost
2. PHP Version : 5.6 and above
3. Database : MySQL DB
4. Web Browser : Chrome, FireFox, Internet Explorer, MS Edge

it database ada ha folder database - 


#Login System using Session.
1. Add / Edit & Update / Delete Categories.
2. Add / Edit & Update / Delete Products.
3. Add / Edit & Update / Delete Customers.

#Customer data are used while creating orders that for whom this order is created.
Add / Edit & Update / Delete Admins, so multiple admins can manage this pos system. 

#Create Order
a. To create an order, you need to select the product from the dropdown. You can search for the product from the dropdown. (Select2)
b. After selecting a product, add the number of quantity for that product and add the item to your session cart.
c. Once the product is added, it will be listed in html table format.
d. You can increase & decrease the quantity from that list of products.
e. You can delete/remove each product from that list of products. 

7.1 To place the order 
  a. Select the payment mode
  b. Enter the customer's phone number and "proceed to place order", we have a condition, if the customer's phone number is not available in your customer record, then you will be allowed to "create the customer" on a POP UP Box / Modal and save customer data and then finally "Proceed to place order" and goes to order-summary (order review).

#Order Summary
In this order summary,
a. You can review your Customer details.
b. You can review your Invoice Details like invoice number, Invoice date
c. Review your products.
d. If you want to modify the product items, you can go back and modify product items and then come back to order summary.
e. You can SAVE the order.
f. You can Print this order.
g. You can Download this order in PDF

#Orders
In this order - you will see a list of orders like tracking no, order date, payment mode, and customer details.
a. List of all the Orders created by admin.
b. Filter the orders by "Order DATE" & "Payment Mode"
c. View each order and you will find all the customer's details, order details, and product items.
d. You can Print and download a PDF of the BILL of each order.

 Dashboard Analytics 
Dashboard Analytics: View count of today's orders, total categories, total products, total customers, etc.

<button onclick="handleClick()">Password</button>


  <script>
    function handleClick() {
      alert("barbosa");
    }
  </script>