<?php
// Include database connection
$host = 'localhost';
$db = 'expensetracker';
$user = 'root';
$pass = '';
$pdo = new PDO("mysql:host=$host;dbname=$db", $user, $pass);

// Check if ID is provided
if (!isset($_GET['id']) || empty($_GET['id'])) {
    die('No ID provided!');
}

$id = $_GET['id'];

// Fetch expense data from the database
$stmt = $pdo->prepare("SELECT * FROM expen WHERE id = ?");
$stmt->execute([$id]);
$expense = $stmt->fetch(PDO::FETCH_ASSOC);

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    // Get the updated values
    $title = $_POST['title'];
    $category = $_POST['category'];
    $amount = $_POST['amount'];
    $date = $_POST['date'];

    // Update the expense in the database
    $stmt = $pdo->prepare("UPDATE expen SET title = ?, category = ?, amount = ?, expense_date = ? WHERE id = ?");
    $stmt->execute([$title, $category, $amount, $date, $id]);

    // Redirect back to the index page after update
    header("Location: index.php");
    exit();
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Edit Expense</title>
    <style>
        /* Styles for the edit page */
        body {
            font-family: Arial, sans-serif;
            background-color: #121212;
            color: #f0f0f0;
        }

        h1 {
            color: #00bcd4;
            text-align: center;
            padding: 20px;
        }

        .container {
            max-width: 600px;
            margin: 0 auto;
            padding: 20px;
            background-color: #1e1e1e;
            border-radius: 8px;
            box-shadow: 0 4px 8px rgba(0, 0, 0, 0.5);
        }

        input, select {
            width: 100%;
            padding: 10px;
            margin: 10px 0;
            background-color: #333;
            border: 1px solid #555;
            color: #fff;
            border-radius: 5px;
        }

        button {
            background-color: #00bcd4;
            color: white;
            padding: 12px 20px;
            border: none;
            border-radius: 5px;
            cursor: pointer;
            font-size: 16px;
            transition: background-color 0.3s ease;
        }

        button:hover {
            background-color: #007c7c;
        }

        footer {
            background-color: #333;
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
        <h1>Edit Expense</h1>
    </header>

    <div class="container">
        <form method="POST">
            <label for="title">Title:</label>
            <input type="text" id="title" name="title" value="<?php echo htmlspecialchars($expense['title']); ?>" required>

            <label for="category">Category:</label>
            <select id="category" name="category" required>
                <option value="Food" <?php if ($expense['category'] == 'Food') echo 'selected'; ?>>Food</option>
                <option value="Travel" <?php if ($expense['category'] == 'Travel') echo 'selected'; ?>>Travel</option>
                <option value="Shopping" <?php if ($expense['category'] == 'Shopping') echo 'selected'; ?>>Shopping</option>
                <option value="Others" <?php if ($expense['category'] == 'Others') echo 'selected'; ?>>Others</option>
            </select>

            <label for="amount">Amount:</label>
            <input type="number" id="amount" name="amount" value="<?php echo htmlspecialchars($expense['amount']); ?>" required>

            <label for="date">Date:</label>
            <input type="date" id="date" name="date" value="<?php echo htmlspecialchars($expense['expense_date']); ?>" required>

            <button type="submit">Update Expense</button>
        </form>
    </div>

    <footer>
        <p>Expense Track
