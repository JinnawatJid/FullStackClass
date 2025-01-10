<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Item Box</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            margin: 20px;
            text-align: center;
        }
        h1 {
            color: #743e8e;
        }
        .item-box {
            display: inline-block;
            vertical-align: top;
            width: 300px;
            margin: 15px;
            border-radius: 8px;
            background-color: #f2f2f2;
            padding: 15px;
        }
        .item-box img {
            max-width: 100%;
            height: auto;
            border-radius: 8px;
        }
        .item-box h3 {
            margin-top: 0;
        }
        .item-box p {
            margin: 10px 0;
        }
        .item-box input[type="number"] {
            width: 50px;
            text-align: center;
        }
        .item-box label {
            display: block;
        }
        button[type="submit"] {
            background-color: #743e8e;
            color: white;
            padding: 10px 20px;
            border: none;
            border-radius: 5px;
            cursor: pointer;
        }
    </style>
</head>
<body>
    <h1>Items for Sale</h1>
    <form method="POST" action="process_items.php">
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
        <br>
        <button type="submit">Submit</button>
    </form>

<p style="text-align: center;">
    <a href="index.php" style="display: inline-block; background-color: #4CAF50; color: white; padding: 10px 20px; border-radius: 5px; text-decoration: none; transition: 0.3s;">
        Back to Select Customer
    </a>
</p>


</body>
</html>

