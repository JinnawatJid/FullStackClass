<?php
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Assuming the selected customers are passed in 'selected_customers'
    if (!empty($_POST['selected_customers'])) {
        $selectedCustomers = $_POST['selected_customers'];
        // Handle the selected customers
        // For example, you can store them in a session, or show the next page with the customer's details

        // For demonstration purposes:
        echo "You have selected the following customers: <br>";
        foreach ($selectedCustomers as $customerID) {
            echo "Customer ID: $customerID <br>";
            // You can fetch and display customer details from the database based on the selected customer ID
        }
    } else {
        echo "No customers selected.";
    }
}
?>
