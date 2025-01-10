<?php
// Include the database connection
include 'condb.php';

// Step 1: SQL query to fetch customers
$sql = "SELECT IDCust, CustName, Tel FROM customer"; // Replace with your actual table name
$result = $conn->query($sql);  // Store the result of the query in the $result variable

// Set the number of records per page
$recordsPerPage = 5;

// Get the total number of records
$totalRecords = $result->num_rows;

// Calculate the number of pages
$numPages = ceil($totalRecords / $recordsPerPage);

// Get the current page number
if (isset($_GET['page'])) {
    $currentPage = $_GET['page'];
} else {
    $currentPage = 1;
}

// Calculate the starting record number
$startRecord = ($currentPage - 1) * $recordsPerPage;

// Add the LIMIT clause to the SQL query
$sql .= " LIMIT $startRecord, $recordsPerPage";

// Re-run the query with the LIMIT clause
$result = $conn->query($sql);
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Select Customer</title>
    <style>
        * {
            font-family: 'Arial', sans-serif;
            margin: 0;
            padding: 0;
            box-sizing: border-box;
        }

        body {
            background-color: #f4f7fc;
            color: #333;
            text-align: center;
            padding-top: 30px;
        }

        h1 {
            font-size: 36px;
            color: #333;
            margin-bottom: 20px;
        }

        .container {
            display: flex;
            flex-direction: column;  /* Align customer boxes vertically */
            align-items: center;     /* Center the boxes horizontally */
            gap: 20px;
            padding: 10px;
        }

        .customer-box {
            background-color: #fff;
            padding: 20px;
            border-radius: 10px;
            box-shadow: 0 4px 10px rgba(0, 0, 0, 0.1);
            width: 280px;
            text-align: center;
            transition: transform 0.3s, box-shadow 0.3s;
            display: flex;
            flex-direction: column;
            align-items: center;
        }

        .customer-box:hover {
            transform: translateY(-5px);
            box-shadow: 0 8px 20px rgba(0, 0, 0, 0.15);
        }

        .customer-box img {
            width: 80px;
            height: 80px;
            border-radius: 50%;
            margin-bottom: 15px;
        }

        .customer-box h3 {
            font-size: 20px;
            margin-bottom: 5px;
        }

        .customer-box p {
            font-size: 14px;
            color: #555;
        }

        .customer-box input[type="checkbox"] {
            margin-top: 10px;
        }

        .button-container {
            margin-top: 30px;
        }

        .button-container button {
            background-color: #4CAF50;
            color: white;
            padding: 14px 25px;
            border: none;
            border-radius: 5px;
            cursor: pointer;
            transition: 0.3s;
            font-size: 16px;
        }

        .button-container button:hover {
            background-color: #3e8e41;
        }

        .page-selector {
            margin-top: 20px;
            display: flex;
            justify-content: center;
            gap: 10px;
        }

        .page-selector a {
            color: #007bff;
            text-decoration: none;
            padding: 10px 15px;
            border-radius: 5px;
            transition: 0.3s;
        }

        .page-selector a:hover {
            background-color: #f1f1f1;
        }

        .page-selector a.active {
            background-color: #007bff;
            color: white;
        }

    </style>
</head>

<body>
    <h1>Select a Customer</h1>
    <form method="POST" action="select_customer.php">
        <div class="container">
            <?php
            // Step 2: Check if there are any customers
            if ($result->num_rows > 0) {
                // Loop through the result
                while ($row = mysqli_fetch_array($result)) {
                    $customerID = $row["IDCust"];
                    $customerName = $row["CustName"];
                    $customerTel = $row["Tel"];
            ?>
                    <div class="customer-box">
                        <!-- Customer Image -->
                        <img src="https://cdn.pixabay.com/photo/2015/10/05/22/37/blank-profile-picture-973460_640.png" alt="Customer Image">
                        <!-- Customer Details -->
                        <h3><?php echo $customerID; ?></h3>
                        <p><?php echo $customerName; ?>, Tel: <?php echo $customerTel; ?></p>
                        <!-- Checkbox -->
                        <label>
                            <input type="checkbox" name="selected_customers[]" value="<?php echo $customerID; ?>"> Select this Customer
                        </label>
                    </div>
            <?php
                }
            } else {
                echo "<p>No customers found.</p>";
            }
            ?>
        </div>
        <div class="button-container">
            <button type="submit" formaction="forSale.php">Proceed to Order</button>
        </div>
        <div class="page-selector">
            <?php
            if ($currentPage > 1) {
                echo "<a href='?page=" . ($currentPage - 1) . "'>Previous Page</a>";
            }

            for ($i = 1; $i <= $numPages; $i++) {
                if ($i == $currentPage) {
                    echo "<a href='?page=$i' class='active'>$i</a>";
                } else {
                    echo "<a href='?page=$i'>$i</a>";
                }
            }

            if ($currentPage < $numPages) {
                echo "<a href='?page=" . ($currentPage + 1) . "'>Next Page</a>";
            }
            ?>
        </div>
    </form>
</body>
</html>

<?php
// Close the database connection
$conn->close();
?>
