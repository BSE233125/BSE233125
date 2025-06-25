<?php
include 'db.php';
$id = $_GET['id'];

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $number = $_POST['RoomNumber'];
    $type = $_POST['RoomType'];
    $price = $_POST['PricePerNight'];
    $status = $_POST['Status'];

    $update = "UPDATE rooms SET RoomNumber='$number', RoomType='$type', PricePerNight=$price, Status='$status' WHERE RoomID=$id";
    mysqli_query($conn, $update);
    header('Location: rooms.php');
}

$result = mysqli_query($conn, "SELECT * FROM rooms WHERE RoomID=$id");
$row = mysqli_fetch_assoc($result);
?>

<form method="post">
    <input type="text" name="RoomNumber" value="<?= $row['RoomNumber'] ?>" required>
    <input type="text" name="RoomType" value="<?= $row['RoomType'] ?>" required>
    <input type="number" name="PricePerNight" value="<?= $row['PricePerNight'] ?>" required>
    <select name="Status">
        <option value="Available" <?= $row['Status'] === 'Available' ? 'selected' : '' ?>>Available</option>
        <option value="Booked" <?= $row['Status'] === 'Booked' ? 'selected' : '' ?>>Booked</option>
        <option value="Under Maintenance" <?= $row['Status'] === 'Under Maintenance' ? 'selected' : '' ?>>Under Maintenance</option>
    </select>
    <button type="submit">Update Room</button>
</form>
