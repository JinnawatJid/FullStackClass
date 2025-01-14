<?php

include 'condb.php';
// Query to fetch products
$sql = "SELECT IDProduct, ProductName, ProductDesc, PricePerUnit FROM stock"; // Replace 'products' with your table name
$result = $conn->query($sql);

// Prepare response
if ($result->num_rows > 0) {
    $products = array();
    while ($row = $result->fetch_assoc()) {
        $products[] = $row;
    }
    // Send the result as JSON
    echo json_encode($products);
} else {
    // Return an empty array if no products found
    echo json_encode([]);
}

// Close the database connection
$conn->close();
?>


<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>For Sale</title>

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
    <!-- Selected Customers Section -->
    <div class="selected-customers">
        <button class="dropdown-button" onclick="toggleCustomerList()">Show/Hide Selected Customers</button>
        <div class="customer-list">
            <?php
            // Check if there are selected customers passed through the URL
            if (isset($_GET['selected_customers']) && !empty($_GET['selected_customers'])) {
                $selectedCustomers = $_GET['selected_customers']; // Array of selected customer IDs
                $customerNames = $_GET['customer_names']; // Array of customer names

                // Loop through the selected customers and display them
                foreach ($selectedCustomers as $customerID) {
                    if (isset($customerNames[$customerID])) {
                        $customerName = $customerNames[$customerID];
                        echo '<div class="customer-item">';
                        echo '<div class="customer-id">Customer ID: ' . htmlspecialchars($customerID) . '</div>';
                        echo '<div class="customer-name">Name: ' . htmlspecialchars($customerName) . '</div>';
                        echo '</div>';
                    }
                }
            } else {
                echo '<div class="empty-message">No customers selected.</div>';
            }
            ?>
        </div>
    </div>

    <!-- Catalog Section -->
    <h1>Items for Sale</h1>
    <form method="POST">
        <div class="item-container">
            <div class="item-box">
                <img src="https://organicmandya.com/cdn/shop/files/Apples_bf998dd2-0ee8-4880-9726-0723c6fbcff3.jpg?v=1721368465&width=1000" alt="Item 1">
                <h3>Organic Apple</h3>
                <p>Organic Apple, also known as Sebu, is a highly nutritious fruit celebrated for its numerous health benefits.</p>
                <p>Price: $2.58</p>
                <label>
                    Quantity:
                    <input type="number" name="quantity[item1]" value="1" min="1">
                </label>
                <br>
                <label>
                    <input type="checkbox" name="items[]" value="item1">
                    Select Item
                </label>
            </div>
            <div class="item-box">
                <img src="https://organicmandya.com/cdn/shop/files/BananaElakki.jpg?v=1721369681&width=1000" alt="Item 2">
                <h3>Organic Banana</h3>
                <p>Organic Banana Elakki, also known as Small Banana or Elaichi Banana, is a delightful and nutrient-rich fruit cherished.</p>
                <p>Price: $6.80</p>
                <label>
                    Quantity:
                    <input type="number" name="quantity[item2]" value="1" min="1">
                </label>
                <br>
                <label>
                    <input type="checkbox" name="items[]" value="item2">
                    Select Item
                </label>
            </div>
            <div class="item-box">
                <img src="https://organicmandya.com/cdn/shop/files/OotyCarrot.jpg?v=1721371505&width=1000" alt="Item 3">
                <h3>Organic Carrot</h3>
                <p>Organic Carrot, is renowned for its exceptional quality and flavor. Grown in the pristine environment of Ooty</p>
                <p>Price: $8.20</p>
                <label>
                    Quantity:
                    <input type="number" name="quantity[item3]" value="1" min="1">
                </label>
                <br>
                <label>
                    <input type="checkbox" name="items[]" value="item3">
                    Select Item
                </label>
            </div>
        </div>

        <br>
        <p style="text-align: center;">
            <button type="submit" style="display: inline-block; background-color: #4CAF50; color: white; padding: 10px 20px; border-radius: 5px; cursor: pointer; transition: 0.3s;">
                Submit
            </button>
        </p>
    </form>

    <p style="text-align: center;">
        <a href="index.php" style="display: inline-block; background-color: #4CAF50; color: white; padding: 10px 20px; border-radius: 5px; text-decoration: none; transition: 0.3s;">
            Back to Select Customer
        </a>
    </p>
</body>

</html>