<?php
include('connection.php');

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $pname = $_POST['productName'];
    $dname = $_POST['productDescription'];
    $prname = $_POST['productPrice'];

    // File upload logic
    $target_dir = "uploads/";
    $target_file = $target_dir . basename($_FILES["productImage"]["name"]);
    $imageFileType = strtolower(pathinfo($target_file, PATHINFO_EXTENSION));

    if (move_uploaded_file($_FILES["productImage"]["tmp_name"], $target_file)) {
        $iname = $target_file;

        $sql = "UPDATE products SET description='$dname', price='$prname', image='$iname' WHERE name='$pname'";
        $connec = mysqli_query($conn, $sql);

        if ($connec) {
            echo "Product updated successfully.";
        } else {
            echo "Error updating product: " . mysqli_error($conn);
        }
    } else {
        echo "Error uploading file.";
    }

    $conn->close();
} else {
    echo "Invalid request method.";
}
?>
