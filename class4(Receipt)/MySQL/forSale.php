<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Selected Customers</title>

    <style>
        <?php include 'style/forSale.css'; ?>
    </style>

    <script>
        // JavaScript to toggle the visibility of the customer list
        function toggleCustomerList() {
            const customerList = document.querySelector('.customer-list');
            if (customerList.style.display === 'none' || customerList.style.display === '') {
                customerList.style.display = 'block';
            } else {
                customerList.style.display = 'none';
            }
        }
    </script>
</head>

<body>

    <div class="selected-customers">
        <button class="dropdown-button" onclick="toggleCustomerList()">Show/Hide Selected Customers</button>
        <div class="customer-list">
            <?php
            // Check if there are selected customers passed through the URL
            if (isset($_GET['selected_customers']) && !empty($_GET['selected_customers'])) {
                $selectedCustomers = $_GET['selected_customers']; // This will be an array of selected customer IDs
                $customerNames = $_GET['customer_names']; // This will be the array of customer names

                // Loop through the selected customer IDs and display them
                foreach ($selectedCustomers as $customerID) {
                    // Get the customer name from the customer_names array using the customerID
                    if (isset($customerNames[$customerID])) {
                        $customerName = $customerNames[$customerID];
                        echo '<div class="customer-item">';
                        echo '<div class="customer-id">Customer ID: ' . htmlspecialchars($customerID) . '</div>';
                        echo '<div class="customer-name">Name: ' . htmlspecialchars($customerName) . '</div>';
                        echo '</div>';
                    }
                }
            } else {
                // Display a message if no customers were selected
                echo '<div class="empty-message">No customers selected.</div>';
            }
            ?>
        </div>
    </div>

</body>

</html>
