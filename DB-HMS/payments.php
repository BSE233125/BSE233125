<?php include 'db.php'; ?>
<!DOCTYPE html>
<html>
<head>
    <title>Payments</title>
    <link rel="stylesheet" href="style.css">
</head>
<body>
<header>
    <h1>Payments</h1>
    <nav>
        <ul>
            <li><a href="index.html">Home</a></li>
            <li><a href="guests.php">Guests</a></li>
            <li><a href="rooms.php">Rooms</a></li>
            <li><a href="bookings.php">Bookings</a></li>
            <li><a href="staff.php">Staff</a></li>
        </ul>
    </nav>
</header>
<main>
    <h2>Record Payment</h2>
    <form method="post">
        <select name="BookingID">
            <option disabled selected>Select Booking</option>
            <?php
            $bookings = $conn->query("SELECT BookingID FROM Bookings");
            while ($b = $bookings->fetch_assoc()) {
                echo "<option value='{$b['BookingID']}'>Booking #{$b['BookingID']}</option>";
            }
            ?>
        </select>
        <input type="date" name="PaymentDate" required>
        <input type="number" name="Amount" step="0.01" placeholder="Amount" required>
        <select name="PaymentMethod">
            <option value="Cash">Cash</option>
            <option value="Card">Card</option>
            <option value="Online">Online</option>
        </select>
        <button type="submit" name="addPayment">Submit Payment</button>
    </form>

    <?php
    if (isset($_POST['addPayment'])) {
        $stmt = $conn->prepare("INSERT INTO Payments (BookingID, PaymentDate, Amount, PaymentMethod) VALUES (?, ?, ?, ?)");
        $stmt->bind_param("isds", $_POST['BookingID'], $_POST['PaymentDate'], $_POST['Amount'], $_POST['PaymentMethod']);
        $stmt->execute();
        echo "<p>Payment recorded!</p>";
    }

    $result = $conn->query("SELECT p.PaymentID, p.BookingID, p.PaymentDate, p.Amount, p.PaymentMethod FROM Payments p");
    echo "<h2>Payments List</h2><table border='1'><tr><th>ID</th><th>Booking</th><th>Date</th><th>Amount</th><th>Method</th></tr>";
    while ($row = $result->fetch_assoc()) {
        echo "<tr><td>{$row['PaymentID']}</td><td>#{$row['BookingID']}</td><td>{$row['PaymentDate']}</td><td>{$row['Amount']}</td><td>{$row['PaymentMethod']}</td></tr>";
    }
    echo "</table>";
    ?>
</main>
</body>
</html>
