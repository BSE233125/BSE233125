<?php
include 'db.php';
$id = $_GET['id'];

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $fname = $_POST['FirstName'];
    $lname = $_POST['LastName'];
    $phone = $_POST['PhoneNumber'];
    $email = $_POST['Email'];
    $address = $_POST['Address'];

    $update = "UPDATE guests SET FirstName='$fname', LastName='$lname', PhoneNumber='$phone', Email='$email', Address='$address' WHERE GuestID=$id";
    mysqli_query($conn, $update);
    header('Location: guests.php');
}

$result = mysqli_query($conn, "SELECT * FROM guests WHERE GuestID=$id");
$row = mysqli_fetch_assoc($result);
?>

<form method="post">
    <input type="text" name="FirstName" value="<?= $row['FirstName'] ?>" required>
    <input type="text" name="LastName" value="<?= $row['LastName'] ?>" required>
    <input type="text" name="PhoneNumber" value="<?= $row['PhoneNumber'] ?>" required>
    <input type="email" name="Email" value="<?= $row['Email'] ?>" required>
    <input type="text" name="Address" value="<?= $row['Address'] ?>" required>
    <button type="submit">Update Guest</button>
</form>
