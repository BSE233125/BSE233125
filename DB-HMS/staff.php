<?php include 'db.php'; ?>
<!DOCTYPE html>
<html>
<head>
    <title>Staff Management</title>
    <link rel="stylesheet" href="style.css">
</head>
<body>
<header>
    <h1>Staff</h1>
    <nav>
        <ul>
            <li><a href="index.html">Home</a></li>
            <li><a href="guests.php">Guests</a></li>
            <li><a href="rooms.php">Rooms</a></li>
            <li><a href="bookings.php">Bookings</a></li>
            <li><a href="payments.php">Payments</a></li>
        </ul>
    </nav>
</header>
<main>
    <h2>Add Staff</h2>
    <form method="post">
        <input type="text" name="FirstName" placeholder="First Name" required>
        <input type="text" name="LastName" placeholder="Last Name" required>
        <select name="Role">
            <option value="Receptionist">Receptionist</option>
            <option value="Housekeeping">Housekeeping</option>
            <option value="Manager">Manager</option>
        </select>
        <input type="text" name="PhoneNumber" placeholder="Phone Number">
        <input type="email" name="Email" placeholder="Email">
        <button type="submit" name="addStaff">Add Staff</button>
    </form>

    <?php
    if (isset($_POST['addStaff'])) {
        $stmt = $conn->prepare("INSERT INTO Staff (FirstName, LastName, Role, PhoneNumber, Email) VALUES (?, ?, ?, ?, ?)");
        $stmt->bind_param("sssss", $_POST['FirstName'], $_POST['LastName'], $_POST['Role'], $_POST['PhoneNumber'], $_POST['Email']);
        $stmt->execute();
        echo "<p>Staff added!</p>";
    }

    $result = $conn->query("SELECT * FROM Staff");
    echo "<h2>Staff List</h2><table border='1'><tr><th>ID</th><th>Name</th><th>Role</th><th>Phone</th><th>Email</th></tr>";
    while ($row = $result->fetch_assoc()) {
        echo "<tr><td>{$row['StaffID']}</td><td>{$row['FirstName']} {$row['LastName']}</td><td>{$row['Role']}</td><td>{$row['PhoneNumber']}</td><td>{$row['Email']}</td></tr>";
    }
    echo "</table>";
    ?>
</main>
</body>
</html>
