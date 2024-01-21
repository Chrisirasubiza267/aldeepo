<?php
include('connection.php');

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    if (isset($_POST['pname'])) {
        $productName = $_POST['pname'];

        $sql = "DELETE FROM products WHERE name = '$productName'";
        $result = mysqli_query($conn, $sql);

        if ($result) {
            echo "Product deleted successfully.";
        } else {
            echo "Error deleting product: " . mysqli_error($conn);
        }
    } else {
        echo "Product name not provided.";
    }
} else {
    echo "Invalid request method.";
}

$conn->close();
?>
