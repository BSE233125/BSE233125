<?php
include 'db.php';
$id = $_GET['id'];
mysqli_query($conn, "DELETE FROM guests WHERE GuestID=$id");
header('Location: guests.php');
