
<?php
include('connection.php');
if (isset($_GET['action'])) {
    switch ($_GET['action']) {
        case 'get_products':
            echo getProductList($conn);
            break;
    }
}


if ($_SERVER["REQUEST_METHOD"] == "POST") {
    switch ($_POST['action']) {
        case 'add_product':
            echo addProduct($conn, $_POST['name'], $_POST['description'], $_POST['price']);
            break;
    }
}

function getProductList($conn) {
    $result = $conn->query("SELECT * FROM Products");
    $productList = "";

    while ($row = $result->fetch_assoc()) {
        $productList .= "<li class='list-group-item'>{$row['name']} - \${$row['price']}</li>";
    }

    return $productList;
}

function addProduct($conn, $name, $description, $price) {
    $name = $conn->real_escape_string($name);
    $description = $conn->real_escape_string($description);
    $price = (float)$price;

    $sql = "INSERT INTO Products (name, description, price) VALUES ('$name', '$description', $price)";
    if ($conn->query($sql)) {
        return "Product added successfully.";
    } else {
        return "Error: " . $sql . "<br>" . $conn->error;
    }
}
?>
