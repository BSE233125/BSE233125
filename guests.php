<?php include 'db.php'; ?>
<!DOCTYPE html>
<html>
<head>
    <title>Guests Management</title>
    <link rel="stylesheet" href="style.css">
</head>
<body>
    <header>
        <h1>Guests</h1>
        <nav>
            <ul>
                <li><a href="index.html">Home</a></li>
                <li><a href="rooms.php">Rooms</a></li>
                <li><a href="bookings.php">Bookings</a></li>
                <li><a href="payments.php">Payments</a></li>
                <li><a href="staff.php">Staff</a></li>
            </ul>
        </nav>
    </header>
    <main>
        <h2>Add New Guest</h2>
        <form method="post" action="guests.php">
            <input type="text" name="FirstName" placeholder="First Name" required>
            <input type="text" name="LastName" placeholder="Last Name" required>
            <input type="text" name="PhoneNumber" placeholder="Phone Number">
            <input type="email" name="Email" placeholder="Email">
            <textarea name="Address" placeholder="Address"></textarea>
            <button type="submit" name="addGuest">Add Guest</button>
        </form>

        <?php
        if (isset($_POST['addGuest'])) {
            $stmt = $conn->prepare("INSERT INTO Guests (FirstName, LastName, PhoneNumber, Email, Address) VALUES (?, ?, ?, ?, ?)");
            $stmt->bind_param("sssss", $_POST['FirstName'], $_POST['LastName'], $_POST['PhoneNumber'], $_POST['Email'], $_POST['Address']);
            $stmt->execute();
            echo "<p>Guest added successfully!</p>";
        }

        $result = $conn->query("SELECT * FROM Guests");
        echo "<h2>Guest List</h2><table border='1'><tr><th>ID</th><th>Name</th><th>Phone</th><th>Email</th><th>Address</th></tr>";
        while($row = $result->fetch_assoc()) {
            echo "<tr><td>{$row['GuestID']}</td><td>{$row['FirstName']} {$row['LastName']}</td><td>{$row['PhoneNumber']}</td><td>{$row['Email']}</td><td>{$row['Address']}</td></tr>";
        }
        echo "</table>";
        ?>
    </main>
</body>
</html>
