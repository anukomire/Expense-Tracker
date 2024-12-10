<?php
// database connection
$host = 'localhost';
$db = 'expensetracker';
$user = 'root';
$pass = '';
$pdo = new PDO("mysql:host=$host;dbname=$db", $user, $pass);

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $title = $_POST['title'];
    $category = $_POST['category'];
    $amount = $_POST['amount'];
    $date = $_POST['expense_date'];

    $stmt = $pdo->prepare("INSERT INTO expen (title, category, amount, expense_date) VALUES (?, ?, ?, ?)");
    $stmt->execute([$title, $category, $amount, $date]);

    header("Location: index.php");
    exit();
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Add Expense</title>
    <style>
        /* Add styles here */
        body {
            font-family: Arial, sans-serif;
            background-color: #181818;
            color: #f0f0f0;
        }

        .container {
            width: 60%;
            margin: auto;
        }

        form {
            background-color: #333;
            padding: 20px;
            border-radius: 8px;
        }

        label {
            display: block;
            margin: 10px 0;
        }

        input, select {
            width: 100%;
            padding: 10px;
            margin-bottom: 10px;
            background-color: #555;
            color: #fff;
            border-radius: 5px;
            border: none;
        }

        button {
            background-color: #00bcd4; /* Aqua color */
            color: white;
            padding: 10px 20px;
            border: none;
            border-radius: 5px;
            cursor: pointer;
        }

        button:hover {
            background-color: #007c7c;
        }

        footer {
            background-color: #2d2d2d;
            color: white;
            text-align: center;
            padding: 10px;
            position: fixed;
            bottom: 0;
            width: 100%;
        }
    </style>
</head>
<body>
    <header>
        <h1>Add Expense</h1>
    </header>

    <div class="container">
        <form method="post">
            <label for="title">Title</label>
            <input type="text" name="title" required>

            <label for="category">Category</label>
            <select name="category" required>
                <option value="Food">Food</option>
                <option value="Travel">Travel</option>
                <option value="Shopping">Shopping</option>
                <option value="Others">Others</option>
            </select>

            <label for="amount">Amount</label>
            <input type="number" name="amount" required>

            <label for="expense_date">Date</label>
            <input type="date" name="expense_date" required>

            <button type="submit">Add Expense</button>
        </form>
    </div>

    <footer>
        <p>Expense Tracker &copy; 2024</p>
    </footer>
</body>
</html>
