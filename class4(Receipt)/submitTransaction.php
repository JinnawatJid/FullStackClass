<?php
include 'condb.php';

// Check if data is submitted via POST
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    // Decode JSON-encoded hidden inputs
    $selectedCustomers = json_decode($_POST['selected_customers'], true);
    $customerNames = json_decode($_POST['customer_names'], true);
    $items = json_decode($_POST['items'], true);
    $quantities = json_decode($_POST['quantities'], true);
    $vat = floatval($_POST['vat']);
    $totalWithVAT = floatval($_POST['total_with_vat']);

    // Transaction date
    $transactionDate = date('Y-m-d H:i:s');

    // Fetch all products from fetchProduct.php
    ob_start(); // Start output buffering
    include 'fetchProduct.php'; // Include fetchProduct.php
    $productDataJSON = ob_get_clean(); // Get the JSON output from fetchProduct.php
    $products = json_decode($productDataJSON, true); // Decode JSON into an associative array

    if (!$products) {
        die("Error fetching product data.");
    }

    // Convert products array to an associative array with product ID as the key
    $productsById = [];
    foreach ($products as $product) {
        $productsById[$product['IDProduct']] = $product;
    }

    // Start the transaction
    $conn->begin_transaction();

    try {
        // Insert transactions into the database
        foreach ($selectedCustomers as $customerID) {
            $customerName = $customerNames[$customerID] ?? 'Unknown';

            foreach ($items as $itemId) {
                $quantity = intval($quantities[$itemId] ?? 0);

                if ($quantity > 0 && isset($productsById[$itemId])) {
                    $product = $productsById[$itemId];
                    $productName = $product['ProductName'];
                    $pricePerUnit = $product['PricePerUnit'];

                    // Check stock availability
                    if ($product['StockQty'] < $quantity) {
                        throw new Exception("Insufficient stock for product ID: $itemId");
                    }

                    // Calculate subtotal
                    $subtotal = $quantity * $pricePerUnit;

                    // Insert into transaction table
                    $insertTransaction = $conn->prepare("
                        INSERT INTO transaction (
                            IDCust, CustName, IDProduct, ProductName, Qty, PricePerUnit, Subtotal, Vat, Total, TransDate
                        ) VALUES (?, ?, ?, ?, ?, ?, ?, ?, ?, ?)
                    ");
                    $total = $subtotal + ($vat / count($items)); // Split VAT equally among items
                    $insertTransaction->bind_param(
                        "ssssidddds",
                        $customerID, $customerName, $itemId, $productName, $quantity, $pricePerUnit,
                        $subtotal, $vat, $total, $transactionDate
                    );
                    $insertTransaction->execute();

                    // Update stock quantity
                    $updateStock = $conn->prepare("
                        UPDATE stock SET stockQty = stockQty - ? WHERE IDProduct = ? 
                    ");
                    $updateStock->bind_param("is", $quantity, $itemId);
                    $updateStock->execute();

                    // Ensure stock was updated successfully
                    if ($conn->affected_rows <= 0) {
                        throw new Exception("Failed to update stock for product ID: $itemId");
                    }
                } else {
                    throw new Exception("Invalid product ID: $itemId or insufficient quantity.");
                }
            }
        }

        // Commit transaction
        $conn->commit();
        // Redirect to receipt.php with success=true
        header("Location: receipt.php?success=true");
        exit();

    } catch (Exception $e) {
        // Rollback on error
        $conn->rollback();
        // Redirect to receipt.php with success=false
        header("Location: receipt.php?success=false");
        exit();
    }
} else {
    echo "Invalid request method.";
}
?>
