<?php include 'db.php'; ?>
<!DOCTYPE html>
<html>
<head>
    <title>Rooms Management</title>
    <link rel="stylesheet" href="style.css">
</head>
<body>
<header>
    <h1>Rooms</h1>
    <nav>
        <ul>
            <li><a href="index.html">Home</a></li>
            <li><a href="guests.php">Guests</a></li>
            <li><a href="bookings.php">Bookings</a></li>
            <li><a href="payments.php">Payments</a></li>
            <li><a href="staff.php">Staff</a></li>
        </ul>
    </nav>
</header>
<main>
    <h2>Add Room</h2>
    <form method="post">
        <input type="text" name="RoomNumber" placeholder="Room Number" required>
        <select name="RoomType">
            <option value="Single">Single</option>
            <option value="Double">Double</option>
            <option value="Suite">Suite</option>
        </select>
        <input type="number" name="PricePerNight" placeholder="Price per Night" step="0.01">
        <select name="Status">
            <option value="Available">Available</option>
            <option value="Booked">Booked</option>
            <option value="Under Maintenance">Under Maintenance</option>
        </select>
        <button type="submit" name="addRoom">Add Room</button>
    </form>

    <?php
    if (isset($_POST['addRoom'])) {
        $stmt = $conn->prepare("INSERT INTO Rooms (RoomNumber, RoomType, PricePerNight, Status) VALUES (?, ?, ?, ?)");
        $stmt->bind_param("ssds", $_POST['RoomNumber'], $_POST['RoomType'], $_POST['PricePerNight'], $_POST['Status']);
        $stmt->execute();
        echo "<p>Room added successfully!</p>";
    }

    $result = $conn->query("SELECT * FROM Rooms");
    echo "<h2>Room List</h2><table border='1'><tr><th>ID</th><th>Room No</th><th>Type</th><th>Price</th><th>Status</th></tr>";
    while($row = $result->fetch_assoc()) {
        echo "<tr><td>{$row['RoomID']}</td><td>{$row['RoomNumber']}</td><td>{$row['RoomType']}</td><td>{$row['PricePerNight']}</td><td>{$row['Status']}</td></tr>";
    }
    echo "</table>";
    ?>
</main>
</body>
</html>
