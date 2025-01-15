<style>
    <?php include 'style/receipt.css'; ?>
</style>

<?php
if ($_SERVER['REQUEST_METHOD'] === 'GET') {
    $selectedItems = $_GET['items'] ?? [];
    $quantities = $_GET['quantity'] ?? [];
    $selectedCustomers = $_GET['selected_customers'] ?? [];
    $customerNames = $_GET['customer_names'] ?? [];
    $totalCost = 0;

    // Simulate fetching product data for the selected items
    $products = [
        'P001' => ['name' => 'Apple', 'price' => 2.5],
        'P002' => ['name' => 'Banana', 'price' => 1.2],
        'P003' => ['name' => 'Orange', 'price' => 3.0],
        // Add more products here as needed
    ];

    echo "<h1>Receipt</h1>";

    // Display selected customers
    if (!empty($selectedCustomers)) {
        echo "<h2>Customers</h2>";
        echo "<ul>";
        foreach ($selectedCustomers as $customerID) {
            $customerName = htmlspecialchars($customerNames[$customerID] ?? 'Unknown');
            echo "<li><strong>Customer ID:</strong> {$customerID}, <strong>Name:</strong> {$customerName}</li>";
        }
        echo "</ul>";
    }

    // Display the table of purchased items
    echo "<h2>Purchased Items</h2>";
    echo "<table border='1' cellpadding='10' cellspacing='0'>";
    echo "<tr><th>Product Name</th><th>Quantity</th><th>Price per Unit</th><th>Subtotal</th></tr>";

    foreach ($selectedItems as $itemId) {
        $quantity = intval($quantities[$itemId] ?? 0);
        if (isset($products[$itemId]) && $quantity > 0) {
            $product = $products[$itemId];
            $subtotal = $quantity * $product['price'];
            $totalCost += $subtotal;

            echo "<tr>";
            echo "<td>" . htmlspecialchars($product['name']) . "</td>";
            echo "<td>{$quantity}</td>";
            echo "<td>\${$product['price']}</td>";
            echo "<td>\${$subtotal}</td>";
            echo "</tr>";
        }
    }

    echo "</table>";
    echo "<h2>Total Cost: \${$totalCost}</h2>";
}

// Add a "Back to Catalog" button
echo '<p style="text-align: center; margin-top: 20px;">';
echo '<a href="catalog.php" style="display: inline-block; background-color: #4CAF50; color: white; padding: 10px 20px; border-radius: 5px; text-decoration: none; transition: 0.3s;">';
echo 'Back to Catalog';
echo '</a>';
echo '</p>';
?>
