<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Items for Sale</title>

    <style>
        <?php include 'style/catalog.css'; ?>
    </style>

    <script>
        fetch("fetchProduct.php")
            .then((response) => response.json())
            .then((data) => {
                data.forEach((product) => {
                    const itemBox = `
        <div class="item-box">
            <img src="${product.ImageURL}" alt="${product.ProductName}">
            <h3>${product.ProductName}</h3>
            <p>${product.ProductDesc}</p>
            <p><strong class="price">Price:$${product.PricePerUnit}</strong></p>
            <label>
                Quantity:
                <input type="number" name="quantity[${product.IDProduct}]" value="1" min="1" max="${product.StockQty}" ${product.StockQty === 0 ? 'disabled' : ''}>
                <span class="stock-error" style="color: red; display: none;">Cannot order more than available stock.</span>
            </label>
            <br>
            <p><strong>In Stock:</strong> ${product.StockQty} left</p> <!-- Display stock quantity -->
            <br>
            <label>
                <input type="checkbox" name="items[]" value="${product.IDProduct}">
                Select Item
            </label>
        </div>
      `;

                    // Append itemBox to the catalog (assuming you have a container for the items)
                    document.querySelector('.item-container').innerHTML += itemBox;

                    // Add event listener to input field to ensure it doesn't exceed stock
                    const quantityInput = document.querySelector(`[name="quantity[${product.IDProduct}]"]`);
                    const errorSpan = quantityInput.nextElementSibling; // Get the error span

                    if (quantityInput) {
                        quantityInput.addEventListener('input', (event) => {
                            if (parseInt(event.target.value) > product.StockQty) {
                                event.target.value = product.StockQty; // Set the value to max if it exceeds stock
                                errorSpan.style.display = 'inline'; // Show error message
                            } else {
                                errorSpan.style.display = 'none'; // Hide error message
                            }
                        });
                    }
                });
            });
    </script>
</head>

<body>
    <h1>Items for Sale</h1>
    <form method="POST">
        <div class="item-container">
            <!-- Items will be dynamically injected here -->
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