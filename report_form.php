<?php
// Start output buffering
ob_start();

// Include database connection
$host = 'localhost';
$db = 'expensetracker';
$user = 'root';
$pass = '';
$pdo = new PDO("mysql:host=$host;dbname=$db", $user, $pass);
$pdo->exec("set names utf8"); // Ensure UTF-8 encoding

require_once 'C:/xampp/htdocs/expense-tracker/libs/TCPDF-main/tcpdf.php';

// Get the selected month and year from the user
$selectedMonth = isset($_GET['month']) ? $_GET['month'] : date('Y-m');
$monthStart = $selectedMonth . "-01";
$monthEnd = date("Y-m-t", strtotime($monthStart));

// Fetch total expenses for the selected month
$stmt = $pdo->prepare("SELECT SUM(amount) as total FROM expen WHERE expense_date BETWEEN :start AND :end");
$stmt->execute(['start' => $monthStart, 'end' => $monthEnd]);
$totalExpenses = $stmt->fetch(PDO::FETCH_ASSOC)['total'] ?? 0;

// Fetch category-wise expenses for the selected month
$stmt = $pdo->prepare("SELECT category, SUM(amount) as total FROM expen WHERE expense_date BETWEEN :start AND :end GROUP BY category");
$stmt->execute(['start' => $monthStart, 'end' => $monthEnd]);
$categoryExpenses = $stmt->fetchAll(PDO::FETCH_ASSOC);

// If the user clicked on "Generate PDF"
if (isset($_POST['generate_pdf'])) {
    // Create new PDF document
    $pdf = new TCPDF();
    $pdf->SetCreator(PDF_CREATOR);
    $pdf->SetAuthor('Expense Tracker');
    $pdf->SetTitle('Monthly Expense Report');
    $pdf->SetMargins(10, 10, 10);
    $pdf->AddPage();

    // Set header
    $pdf->SetFont('helvetica', 'B', 16);
    $pdf->Cell(0, 10, 'Monthly Expense Report for ' . date('F Y', strtotime($selectedMonth)), 0, 1, 'C');

    // Total Expenses (without the rupee symbol issue)
    $pdf->Ln(10); // Line break
    $pdf->SetFont('helvetica', '', 12);
    $pdf->Cell(0, 10, 'Total Expenses: ' . number_format($totalExpenses, 2, '.', ','), 0, 1);

    // Category-wise Breakdown
    $pdf->Ln(10); // Line break
    $pdf->Cell(95, 10, 'Category', 1, 0, 'C');
    $pdf->Cell(95, 10, 'Amount ', 1, 1, 'C');

    foreach ($categoryExpenses as $expense) {
        $pdf->Cell(95, 10, $expense['category'], 1, 0, 'C');
        $pdf->Cell(95, 10, '' . number_format($expense['total'], 2, '.', ','), 1, 1, 'C');
    }

    // Output PDF
    $pdf->Output('monthly_report_' . $selectedMonth . '.pdf', 'I');
    exit(); // Stop script execution after PDF output
}

// End output buffering and discard any previous output
ob_end_clean();
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Monthly Expense Report</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            background-color: #121212;
            color: #f0f0f0;
            margin: 0;
            padding: 20px;
        }

        h1 {
            text-align: center;
            color: #00bcd4;
        }

        .container {
            max-width: 800px;
            margin: 0 auto;
            padding: 20px;
            background-color: #1e1e1e;
            border-radius: 8px;
        }

        .summary {
            text-align: center;
            margin-bottom: 20px;
        }

        .summary div {
            margin: 10px 0;
        }

        .summary h3 {
            color: #00bcd4;
        }

        table {
            width: 100%;
            border-collapse: collapse;
            margin-bottom: 20px;
        }

        th, td {
            padding: 10px;
            text-align: left;
            border: 1px solid #00bcd4;
        }

        th {
            background-color: #333;
        }

        .form-container {
            text-align: center;
            margin-bottom: 20px;
        }

        input, button {
            padding: 10px;
            margin: 5px;
            border: none;
            border-radius: 5px;
            font-size: 16px;
        }

        input {
            width: 200px;
        }

        button {
            background-color: #00bcd4;
            color: white;
            cursor: pointer;
        }

        button:hover {
            background-color: #007c7c;
        }
    </style>
</head>
<body>
    <h1>Monthly Expense Report</h1>

    <div class="container">
        <!-- Form to select the month -->
        <div class="form-container">
            <form method="GET" action="">
                <label for="month">Select Month:</label>
                <input type="month" id="month" name="month" value="<?php echo htmlspecialchars($selectedMonth); ?>" required>
                <button type="submit">Generate Report</button>
            </form>
        </div>

        <!-- Summary Section -->
        <div class="summary">
            <div>
                <h3>Total Expenses for <?php echo date('F Y', strtotime($selectedMonth)); ?>:</h3>
                <p>₹<?php echo number_format($totalExpenses, 2); ?></p>
            </div>

            <!-- Category-wise breakdown -->
            <div>
                <h3>Category-Wise Breakdown</h3>
                <table>
                    <thead>
                        <tr>
                            <th>Category</th>
                            <th>Amount (₹)</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php foreach ($categoryExpenses as $expense) : ?>
                        <tr>
                            <td><?php echo htmlspecialchars($expense['category']); ?></td>
                            <td>₹<?php echo number_format($expense['total'], 2); ?></td>
                        </tr>
                        <?php endforeach; ?>
                    </tbody>
                </table>
            </div>
        </div>

        <!-- Button to generate PDF -->
        <form method="POST" action="">
            <button type="submit" name="generate_pdf">Generate PDF</button>
        </form>
    </div>
</body>
</html>
