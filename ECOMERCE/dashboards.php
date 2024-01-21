<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Product Dashboard</title>
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
    <link href="https://fonts.googleapis.com/css2?family=Open+Sans:wght@300&display=swap" rel="stylesheet">
    <style>
        body {
            background-color: #f8f9fa;
            font-family: 'Open Sans', sans-serif;
            margin: 0;
            padding: 0;
        }

        header {
            background-color: #343a40;
            color: #ffffff;
            padding: 15px;
            text-align: center;
        }

        .container {
            max-width: 800px;
            margin: 20px auto;
            background-color: #ffffff;
            padding: 20px;
            box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
            border-radius: 8px;
        }

        .form-group {
            margin-bottom: 20px;
        }

        label {
            font-weight: bold;
        }

        .btn-primary {
            background-color: #007bff;
            border: none;
        }

        .btn-primary:hover {
            background-color: #0056b3;
        }

        #productDetails {
            max-height: 300px;
            overflow-y: auto;
        }

        .list-group-item {
            display: flex;
            justify-content: space-between;
            align-items: center;
        }

        .list-group-item img {
            max-width: 50px;
            max-height: 50px;
            border-radius: 50%;
        }
    </style>
</head>
<body>

<header>
    <h1>Product Dashboard</h1>
    <p><?php echo $_SESSION['names'] ?? ''; ?></p>
</header>

<div class="container mt-5">
    <div class="row">
        <!-- Left Section: Actions -->
        <div class="col-md-3">
            <h2>Actions</h2>
            <ul class="list-group">
                <li class="list-group-item action" data-action="add">Add Product</li>
                <li class="list-group-item action" data-action="delete">Delete Product</li>
                <li class="list-group-item action" data-action="update">Update Product</li>
                <li class="list-group-item action" data-action="rate">Rate Product</li>
                <li class="list-group-item action" data-action="publish">Publish Product</li>
            </ul>
        </div>
        
        <!-- Right Section: Product Details -->
        <div class="col-md-9" id="productDetails">
            <!-- Product details will be displayed here dynamically -->
        </div>
    </div>
</div>

<?php
include('connection.php');

// Handle left section actions
if ($_SERVER['REQUEST_METHOD'] == "GET" && isset($_GET['action'])) {
    $action = $_GET['action'];
    switch ($action) {
        case 'add':
            echo '<h2>Add Product Section</h2>';
            echo '<form id="addProductForm" method="post" enctype="multipart/form-data">';
            // Add your form fields for adding a product
            echo '<button type="submit" class="btn btn-primary">Add Product</button>';
            echo '</form>';
            break;
        case 'delete':
            echo '<h2>Delete Product Section</h2>';
            // Add your logic for deleting a product
            break;
        case 'update':
            echo '<h2>Update Product Section</h2>';
            // Add your logic for updating a product
            break;
        case 'rate':
            echo '<h2>Rate Product Section</h2>';
            // Add your logic for rating a product
            break;
        case 'publish':
            echo '<h2>Publish Product Section</h2>';
            // Add your logic for publishing a product
            break;
        default:
            // Handle unknown actions or provide a default view
            echo '<p>Select an action from the left to view details.</p>';
    }
}
?>

<script src="https://code.jquery.com/jquery-3.5.1.slim.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.9.3/dist/umd/popper.min.js"></script>
<script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
<script src="dashboard.js"></script>

<script>
$(document).ready(function () {
    // Handle left section actions
    $(".action").click(function () {
        var action = $(this).data("action");
        loadActionDetails(action);
    });

    // Load action details dynamically
    function loadActionDetails(action) {
        $.get("dashboard.php", { action: action }, function (data) {
            $("#productDetails").html(data);
        });
    }
});
</script>

</body>
</html>
