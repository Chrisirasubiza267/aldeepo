<?php
include('connection.php');

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $pname = $_POST['pname'];
    $number = $_POST['number'];

    $sql = "UPDATE products SET rating='$number' WHERE name='$pname'";
    $connect = mysqli_query($conn, $sql);

    if ($connect) {
        echo "Rated " . $number . " stars";
    } else {
        echo "Error updating rating: " . mysqli_error($conn);
    }
}
?>
