<?php
// Include database connection
$host = 'localhost';
$db = 'expensetracker';
$user = 'root';
$pass = '';
$pdo = new PDO("mysql:host=$host;dbname=$db", $user, $pass);

$stmt = $pdo->query("SELECT * FROM expen");
$expenses = $stmt->fetchAll(PDO::FETCH_ASSOC);

if ($_SERVER['REQUEST_METHOD'] == 'POST' && isset($_POST['delete_id'])) {
    $delete_id = $_POST['delete_id'];

    // Delete the expense from the database
    $stmt = $pdo->prepare("DELETE FROM expen WHERE id = ?");
    $stmt->execute([$delete_id]);

    // Redirect back to the index page after deletion
    header("Location: index.php");
    exit();
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Expense Tracker</title>
    <style>
        /* General page styles */
        body {
            font-family: Arial, sans-serif;
            background-color: #121212; /* Dark background for a universe feel */
            color: #f0f0f0;
            margin: 0;
            padding: 0;
        }

        h1 {
            color: #00bcd4; /* Aqua color for headings */
            text-align: center;
            padding: 20px;
        }

        table {
            width: 100%;
            margin: 20px auto;
            border-collapse: collapse;
            box-shadow: 0 4px 8px rgba(0, 0, 0, 0.3);
        }

        table, th, td {
            border: 1px solid #333;
        }

        th, td {
            padding: 15px;
            text-align: center;
        }

        th {
            background-color: #2a2a2a;
        }

        td {
            background-color: #333;
        }

        button {
            background-color: #00bcd4; /* Aqua color */
            color: white;
            padding: 10px 20px;
            border: none;
            border-radius: 5px;
            cursor: pointer;
            font-size: 14px;
            transition: background-color 0.3s ease;
        }

        button:hover {
            background-color: #007c7c; /* Darker Aqua on hover */
        }

        form {
            display: inline;
        }

        .container {
            max-width: 1200px;
            margin: 20px auto;
            padding: 20px;
            background-color: #1e1e1e;
            border-radius: 8px;
            box-shadow: 0 4px 8px rgba(0, 0, 0, 0.5);
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

        /* Make it mobile-friendly */
        @media (max-width: 768px) {
            table, th, td {
                font-size: 14px;
            }

            button {
                font-size: 12px;
            }
        }
    </style>
</head>
<body>
    <header>
        <h1>Expense Tracker</h1>
    </header>

    <div class="container">
        <h2>Expense List</h2>
        <table>
            <thead>
                <tr>
                    <th>Title</th>
                    <th>Category</th>
                    <th>Amount</th>
                    <th>Date</th>
                    <th>Actions</th>
                </tr>
            </thead>
            <tbody>
                <?php foreach ($expenses as $expense) : ?>
                    <tr>
                        <td><?php echo htmlspecialchars($expense['title']); ?></td>
                        <td><?php echo htmlspecialchars($expense['category']); ?></td>
                        <td><?php echo htmlspecialchars($expense['amount']); ?></td>
                        <td><?php echo htmlspecialchars($expense['expense_date']); ?></td>
                        <td>
                            <!-- Edit button -->
                            <a href="edit_expense.php?id=<?php echo $expense['id']; ?>">
                                <button>Edit</button>
                            </a>
                            <!-- Delete button inside a form -->
                            <form method="POST">
                                <input type="hidden" name="delete_id" value="<?php echo $expense['id']; ?>">
                                <button type="submit" onclick="return confirm('Are you sure you want to delete this expense?')">Delete</button>
                            </form>
                        </td>
                    </tr>
                <?php endforeach; ?>
            </tbody>
        </table>
    </div>

    <footer>
        <p>Expense Tracker &copy; 2024</p>
    </footer>
</body>
</html>
