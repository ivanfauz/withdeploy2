<!DOCTYPE html>
<html lang="id">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Bind Now</title>
    <link rel="stylesheet" href="style.css">
    <style>
        /* Gaya untuk halaman bind */
        body {
            font-family: Arial, sans-serif;
            display: flex;
            justify-content: center;
            align-items: center;
            height: 100vh;
            margin: 0;
            background-color: #f8f9fa;
        }

        .bind-container {
            background-color: #ffffff;
            padding: 20px;
            border-radius: 8px;
            box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1);
            width: 300px;
            text-align: center;
        }

        .bind-container h2 {
            font-size: 24px;
            margin-bottom: 20px;
        }

        .bind-container label {
            display: block;
            text-align: left;
            margin-bottom: 5px;
            font-weight: bold;
        }

        .bind-container input[type="number"] {
            width: 100%;
            padding: 10px;
            margin-bottom: 15px;
            border: 1px solid #ddd;
            border-radius: 5px;
        }

        .bind-container button {
            width: 100%;
            padding: 10px;
            background-color: #4a5f39;
            color: #fff;
            font-size: 16px;
            border: none;
            border-radius: 5px;
            cursor: pointer;
            font-weight: bold;
        }

        .bind-container button:hover {
            background-color: #6b8a45;
        }

        .back-btn {
            display: block;
            margin-top: 10px;
            color: #4a5f39;
            text-decoration: none;
            cursor: pointer;
        }

        .username-display {
            margin-bottom: 20px;
            font-weight: bold;
            color: #333;
        }
    </style>
</head>

<body>
    <div class="bind-container">
        <h2>Place Your Bid</h2>
        <form action="submit_bid.php" method="POST">
            <label for="bid_amount">Bid Amount (Rp)</label>
            <input type="number" id="bid_amount" name="bid_amount" placeholder="Enter your bid" required>

            <button type="submit">Submit Bid</button>
        </form>
        <!-- Tombol Back -->
        <a class="back-btn" onclick="history.back()">Back to Previous Page</a>
    </div>
</body>

</html>
