<?php
include 'condb.php';

// Enable error reporting for debugging
ini_set('display_errors', 1);
error_reporting(E_ALL);

// Check if data is submitted via POST
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    // Decode JSON-encoded hidden inputs
    $selectedCustomers = json_decode($_POST['selected_customers'], true);
    $customerNames = json_decode($_POST['customer_names'], true); // Decoding into associative array

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
        // Loop through selected customers and insert data for each one
        foreach ($selectedCustomers as $index => $customerID) {
            // Fetch the customer name using the customerID
            $customerName = $customerNames[$customerID] ?? 'Unknown';  // Default to 'Unknown' if no name found

            // Insert into transaction header table
            $insertTransactionHeader = $conn->prepare("
                INSERT INTO transaction_header (
                    IDCust, CustName, TransDate
                ) VALUES (?, ?, ?)
            ");

            if (!$insertTransactionHeader) {
                throw new Exception("Error preparing header statement: " . $conn->error);
            }

            // Bind the customer ID, customer name, and transaction date
            $insertTransactionHeader->bind_param("sss", $customerID, $customerName, $transactionDate);

            // Execute the query
            $insertTransactionHeader->execute();

            if ($insertTransactionHeader->affected_rows === 0) {
                throw new Exception("Failed to insert into transaction header table.");
            }

            $transactionHeaderID = $conn->insert_id; // Get the inserted transaction header ID

            // Insert transaction details and update stock for each item
            foreach ($items as $itemId) {
                $quantity = intval($quantities[$itemId] ?? 0);

                if ($quantity > 0 && isset($productsById[$itemId])) {
                    $product = $productsById[$itemId];
                    $productName = $product['ProductName'];  // Correctly retrieve the product name
                    $pricePerUnit = $product['PricePerUnit'];

                    // Check stock availability
                    if ($product['StockQty'] < $quantity) {
                        throw new Exception("Insufficient stock for product ID: $itemId");
                    }

                    // Calculate subtotal
                    $subtotal = $quantity * $pricePerUnit;

                    // Insert into transaction detail table
                    $insertTransactionDetail = $conn->prepare("
                        INSERT INTO transaction_detail (
                            IDtrans, IDProduct, ProductName, Qty, PricePerUnit, Subtotal, Vat, Total
                        ) VALUES (?, ?, ?, ?, ?, ?, ?, ?)
                    ");

                    if (!$insertTransactionDetail) {
                        throw new Exception("Error preparing detail statement: " . $conn->error);
                    }

                    // Calculate the total price for each item
                    $total = $subtotal + ($vat / count($items)); // Split VAT equally among items

                    // Bind parameters correctly (matching the number of placeholders and their types)
                    $insertTransactionDetail->bind_param(
                        "isdsdddd",  // IDtrans (int), IDProduct (string), ProductName (string), Qty (int), PricePerUnit (double), Subtotal (double), Vat (double), Total (double)
                        $transactionHeaderID,
                        $itemId,
                        $productName,
                        $quantity,
                        $pricePerUnit,
                        $subtotal,
                        $vat,
                        $total
                    );

                    // Execute the statement to insert the detail record
                    $insertTransactionDetail->execute();

                    if ($insertTransactionDetail->affected_rows === 0) {
                        throw new Exception("Failed to insert into transaction detail table.");
                    }

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
        // Log error message for debugging
        error_log("Transaction Error: " . $e->getMessage());
        // Redirect to receipt.php with success=false and error message
        header("Location: receipt.php?success=false&error=" . urlencode($e->getMessage()));
        exit();
    }
} else {
    echo "Invalid request method.";
}
