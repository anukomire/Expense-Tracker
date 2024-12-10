<?php
// Include database connection
$host = 'localhost';
$db = 'expensetracker';
$user = 'root';
$pass = '';
$pdo = new PDO("mysql:host=$host;dbname=$db", $user, $pass);

// Fetch expenses data for the summary (total amount and categories)
$stmt = $pdo->query("SELECT * FROM expen");
$expenses = $stmt->fetchAll(PDO::FETCH_ASSOC);

$totalAmount = 0;
$categories = ['Food' => 0, 'Travel' => 0, 'Shopping' => 0, 'Others' => 0];

// Calculate total amount and amounts per category
foreach ($expenses as $expense) {
    $totalAmount += $expense['amount'];
    if (array_key_exists($expense['category'], $categories)) {
        $categories[$expense['category']] += $expense['amount'];
    } else {
        $categories[$expense['category']] = $expense['amount'];
    }
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Expense Tracker - Dashboard</title>
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

        .container {
            max-width: 1200px;
            margin: 20px auto;
            padding: 20px;
            background-color: #1e1e1e;
            border-radius: 8px;
            box-shadow: 0 4px 8px rgba(0, 0, 0, 0.5);
        }

        .summary {
            display: flex;
            justify-content: space-around;
            margin-bottom: 30px;
        }

        .summary div {
            background-color: #333;
            padding: 20px;
            border-radius: 8px;
            width: 22%;
            text-align: center;
            box-shadow: 0 4px 8px rgba(0, 0, 0, 0.3);
        }

        .summary div h3 {
            color: #00bcd4; /* Aqua color for headings */
        }

        button {
            background-color: #00bcd4; /* Aqua color */
            color: white;
            padding: 12px 20px;
            border: none;
            border-radius: 5px;
            cursor: pointer;
            font-size: 16px;
            transition: background-color 0.3s ease;
        }

        button:hover {
            background-color: #007c7c; /* Darker Aqua on hover */
        }

        .chart-container {
            margin-top: 30px;
            background-color: #333;
            padding: 20px;
            border-radius: 8px;
            max-width: 350px; /* Max width to make it smaller */
            margin-left: auto; /* Centering the chart */
            margin-right: auto; /* Centering the chart */
        }

        .expense-table {
            margin-top: 40px;
            width: 100%;
            border-collapse: collapse;
        }

        .expense-table th, .expense-table td {
            padding: 12px;
            text-align: left;
            border: 1px solid #00bcd4;
        }

        .expense-table th {
            background-color: #444;
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
            .summary {
                flex-direction: column;
            }

            .summary div {
                width: 100%;
                margin-bottom: 15px;
            }
        }
    </style>
</head>
<body>
    <header>
        <h1>Expense Tracker - Dashboard</h1>
    </header>

    <div class="container">
        <!-- Expense Summary -->
        <div class="summary">
            <div>
                <h3>Total Amount</h3>
                <p>₹<?php echo number_format($totalAmount, 2); ?></p>
            </div>
            <?php foreach ($categories as $category => $amount) : ?>
            <div>
                <h3><?php echo $category; ?> Expenses</h3>
                <p>₹<?php echo number_format($amount, 2); ?></p>
            </div>
            <?php endforeach; ?>
        </div>

        <!-- Button to navigate to Add Expense Page -->
        <a href="add_expense.php">
            <button>Add Expense</button>
        </a>

        <!-- Button to navigate to View All Expenses -->
        <a href="index.php">
            <button>View All Expenses</button>
        </a>

        <div class="chart-container">
            <!-- Chart for Expenses by Category (using Chart.js) -->
            <canvas id="expenseChart" width="300" height="150"></canvas>
        </div>

        <!-- Expense List Table -->
        <h2>All Expenses</h2>
        <table class="expense-table">
            <thead>
                <tr>
                    <th>Title</th>
                    <th>Category</th>
                    <th>Amount (₹)</th>
                    <th>Date</th>
                    <th>Actions</th>
                </tr>
            </thead>
            <tbody>
                <?php foreach ($expenses as $expense) : ?>
                <tr>
                    <td><?php echo htmlspecialchars($expense['title']); ?></td>
                    <td><?php echo htmlspecialchars($expense['category']); ?></td>
                    <td>₹<?php echo number_format($expense['amount'], 2); ?></td>
                    <td><?php echo htmlspecialchars($expense['expense_date']); ?></td>
                    <td>
                        <!-- Edit Expense Button -->
                        <a href="edit_expense.php?id=<?php echo $expense['id']; ?>">
                            <button>Edit</button>
                        </a>
                        <!-- Delete Expense Button -->
                        <a href="delete_expense.php?id=<?php echo $expense['id']; ?>" onclick="return confirm('Are you sure you want to delete this expense?');">
                            <button>Delete</button>
                        </a>
                    </td>
                </tr>
                <?php endforeach; ?>
            </tbody>
        </table>
    </div>

    <footer>
        <p>Expense Tracker &copy; 2024</p>
    </footer>

    <!-- Load Chart.js -->
    <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
    <script>
        // Data for the chart
        const categories = <?php echo json_encode(array_keys($categories)); ?>;
        const amounts = <?php echo json_encode(array_values($categories)); ?>;

        const ctx = document.getElementById('expenseChart').getContext('2d');
        const expenseChart = new Chart(ctx, {
            type: 'pie',
            data: {
                labels: categories,
                datasets: [{
                    label: 'Expenses by Category',
                    data: amounts,
                    backgroundColor: ['#00bcd4', '#007c7c', '#333333', '#444444'],
                    borderColor: '#333',
                    borderWidth: 1
                }]
            },
            options: {
                responsive: true
            }
        });
    </script>
</body>
</html>
