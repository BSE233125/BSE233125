<?php
session_start();
if (!isset($_SESSION['loggedin'])) {
    header("Location: login.php");
    exit();
}
include 'db.php';

// Get counts
$guest_count = $conn->query("SELECT COUNT(*) AS total FROM Guests")->fetch_assoc()['total'];
$room_count = $conn->query("SELECT COUNT(*) AS total FROM Rooms")->fetch_assoc()['total'];

// Get lists
$guests = $conn->query("SELECT * FROM Guests ORDER BY GuestID DESC LIMIT 5");
$rooms = $conn->query("SELECT * FROM Rooms ORDER BY RoomID DESC LIMIT 5");
?>
<!DOCTYPE html>
<html>
<head>
    <title>Admin Dashboard</title>
    <link rel="stylesheet" href="style.css">
</head>
<body>
<header><h1>Admin Dashboard</h1></header>
<nav>
    <ul>
        <li><a href="guests.php">Guests</a></li>
        <li><a href="rooms.php">Rooms</a></li>
        <li><a href="bookings.php">Bookings</a></li>
        <li><a href="payments.php">Payments</a></li>
        <li><a href="staff.php">Staff</a></li>
        <li><a href="logout.php">Logout</a></li>
    </ul>
</nav>
<main>
    <section class="welcome">
        <h2>Overview</h2>
        <p><strong>Total Guests:</strong> <?= $guest_count ?></p>
        <p><strong>Total Rooms:</strong> <?= $room_count ?></p>
    </section>

    <section class="welcome">
        <h2>Recent Guests</h2>
        <table>
            <tr><th>Name</th><th>Phone</th><th>Email</th></tr>
            <?php while ($g = $guests->fetch_assoc()): ?>
                <tr><td><?= $g['FirstName'] . ' ' . $g['LastName'] ?></td><td><?= $g['PhoneNumber'] ?></td><td><?= $g['Email'] ?></td></tr>
            <?php endwhile; ?>
        </table>
    </section>

    <section class="welcome">
        <h2>Recent Rooms</h2>
        <table>
            <tr><th>Room No.</th><th>Type</th><th>Status</th></tr>
            <?php while ($r = $rooms->fetch_assoc()): ?>
                <tr><td><?= $r['RoomNumber'] ?></td><td><?= $r['RoomType'] ?></td><td><?= $r['Status'] ?></td></tr>
            <?php endwhile; ?>
        </table>
    </section>
</main>
</body>
</html>
