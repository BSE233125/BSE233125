<?php include 'db.php'; ?>
<!DOCTYPE html>
<html>
<head>
    <title>Bookings Management</title>
    <link rel="stylesheet" href="style.css">
</head>
<body>
<header>
    <h1>Bookings</h1>
    <nav>
        <ul>
            <li><a href="index.html">Home</a></li>
            <li><a href="guests.php">Guests</a></li>
            <li><a href="rooms.php">Rooms</a></li>
            <li><a href="payments.php">Payments</a></li>
            <li><a href="staff.php">Staff</a></li>
        </ul>
    </nav>
</header>
<main>
    <h2>New Booking</h2>
    <form method="post">
        <select name="GuestID">
            <option disabled selected>Select Guest</option>
            <?php
            $guests = $conn->query("SELECT GuestID, FirstName, LastName FROM Guests");
            while ($g = $guests->fetch_assoc()) {
                echo "<option value='{$g['GuestID']}'>{$g['FirstName']} {$g['LastName']}</option>";
            }
            ?>
        </select>
        <select name="RoomID">
            <option disabled selected>Select Room</option>
            <?php
            $rooms = $conn->query("SELECT RoomID, RoomNumber FROM Rooms WHERE Status = 'Available'");
            while ($r = $rooms->fetch_assoc()) {
                echo "<option value='{$r['RoomID']}'>Room {$r['RoomNumber']}</option>";
            }
            ?>
        </select>
        <input type="date" name="CheckInDate" required>
        <input type="date" name="CheckOutDate" required>
        <input type="number" name="NumberOfGuests" placeholder="Guests" required>
        <button type="submit" name="addBooking">Book Room</button>
    </form>

    <?php
    if (isset($_POST['addBooking'])) {
        $stmt = $conn->prepare("INSERT INTO Bookings (GuestID, RoomID, CheckInDate, CheckOutDate, NumberOfGuests) VALUES (?, ?, ?, ?, ?)");
        $stmt->bind_param("iissi", $_POST['GuestID'], $_POST['RoomID'], $_POST['CheckInDate'], $_POST['CheckOutDate'], $_POST['NumberOfGuests']);
        $stmt->execute();

        $conn->query("UPDATE Rooms SET Status='Booked' WHERE RoomID={$_POST['RoomID']}");

        echo "<p>Room booked successfully!</p>";
    }

    $result = $conn->query("SELECT b.BookingID, g.FirstName, g.LastName, r.RoomNumber, b.CheckInDate, b.CheckOutDate, b.NumberOfGuests FROM Bookings b JOIN Guests g ON b.GuestID = g.GuestID JOIN Rooms r ON b.RoomID = r.RoomID");
    echo "<h2>Bookings List</h2><table border='1'><tr><th>ID</th><th>Guest</th><th>Room</th><th>Check-In</th><th>Check-Out</th><th>Guests</th></tr>";
    while($row = $result->fetch_assoc()) {
        echo "<tr><td>{$row['BookingID']}</td><td>{$row['FirstName']} {$row['LastName']}</td><td>Room {$row['RoomNumber']}</td><td>{$row['CheckInDate']}</td><td>{$row['CheckOutDate']}</td><td>{$row['NumberOfGuests']}</td></tr>";
    }
    echo "</table>";
    ?>
</main>
</body>
</html>