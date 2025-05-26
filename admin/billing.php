<?php
include '../config/db.con.php';
if (!isset($_GET['billingid'])) {
    die("No billing ID provided.");
}
$appointment_id = intval($_GET['billingid']);

// Fetch appointment & services data
$sql = "SELECT a.*, u.username as customer_name, s.username as staff_name
        FROM appointments a
        JOIN users u ON a.user_id = u.user_id
        LEFT JOIN users s ON a.staff_id = s.user_id
        WHERE a.appointment_id = ?";
$stmt = $conn->prepare($sql);
$stmt->bind_param("i", $appointment_id);
$stmt->execute();
$appointment = $stmt->get_result()->fetch_assoc();
$stmt->close();

if (!$appointment) {
    die("Appointment not found.");
}

$sql = "SELECT s.service_name, s.price, s.duration_minutes
        FROM appointment_services ap
        JOIN services s ON ap.service_id = s.service_id
        WHERE ap.appointment_id = ?";
$stmt = $conn->prepare($sql);
$stmt->bind_param("i", $appointment_id);
$stmt->execute();
$services = $stmt->get_result();
$total_price = 0;
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Invoice #<?= $appointment_id ?></title>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css">
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jspdf/2.5.1/jspdf.umd.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/html2canvas/1.4.1/html2canvas.min.js"></script>
    <style>
        body { background-color: #f9f9f9; font-family: 'Segoe UI', sans-serif; padding: 20px; }
        .invoice-box {
            max-width: 800px;
            margin: auto;
            padding: 30px;
            border-radius: 8px;
            background: #fff;
            box-shadow: 0 4px 20px rgba(0,0,0,0.1);
            color: #333;
        }
        .invoice-header {
            text-align: center;
            font-size: 28px;
            font-weight: bold;
            color: #4A90E2;
            margin-bottom: 20px;
        }
        .invoice-details p { margin: 0; line-height: 1.6; }
        table { width: 100%; margin-top: 20px; border-collapse: collapse; }
        table th, table td { padding: 10px; border-bottom: 1px solid #ddd; text-align: left; }
        .total { font-weight: bold; font-size: 20px; color: #4A90E2; text-align: right; }
        .print-btn, .pdf-btn {
            margin: 10px 5px;
            padding: 10px 20px;
            border: none;
            background-color: #4A90E2;
            color: #fff;
            border-radius: 5px;
            cursor: pointer;
        }
        .print-btn:hover, .pdf-btn:hover {
            background-color: #357ABD;
        }
        @media print {
            body * { visibility: hidden; }
            #invoice, #invoice * { visibility: visible; }
            #invoice { position: absolute; left: 0; top: 0; width: 100%; }
        }
    </style>
</head>
<body>

<div class="invoice-box" id="invoice">
    <div class="invoice-header">LOREAL Beauty Salon - Invoice</div>
    <div class="invoice-details">
        <p><strong>Invoice #: </strong><?= $appointment_id ?></p>
        <p><strong>Customer: </strong><?= htmlspecialchars($appointment['customer_name']) ?></p>
        <p><strong>Staff: </strong><?= htmlspecialchars($appointment['staff_name'] ?? 'Not Assigned') ?></p>
        <p><strong>Date: </strong><?= htmlspecialchars($appointment['appointment_date']) ?> at <?= htmlspecialchars($appointment['appointment_time']) ?></p>
    </div>

    <table>
        <thead>
            <tr><th>Service</th><th>Duration</th><th>Price (LKR)</th></tr>
        </thead>
        <tbody>
        <?php while($row = $services->fetch_assoc()): ?>
            <tr>
                <td><?= htmlspecialchars($row['service_name']) ?></td>
                <td><?= $row['duration_minutes'] ?> mins</td>
                <td><?= number_format($row['price'],2) ?></td>
            </tr>
            <?php $total_price += $row['price']; ?>
        <?php endwhile; ?>
        </tbody>
    </table>
    <p class="total">Total: LKR <?= number_format($total_price,2) ?></p>
    <p class="text-center text-muted"><em>Thank you for choosing LOREAL Beauty Salon!</em></p>
</div>

<div class="text-center">
    <button class="print-btn" onclick="printInvoice()">Print Invoice</button>
</div>

<script>
function printInvoice() {
    window.print();
}

</script>

</body>
</html>
