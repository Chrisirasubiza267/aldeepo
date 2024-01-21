<?php
session_start();
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Product Dashboard</title>
    <script src="https://code.jquery.com/jquery-3.5.1.slim.min.js"></script>
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
    <link href="https://fonts.googleapis.com/css2?family=Open+Sans:wght@300&display=swap" rel="stylesheet">
    <style>
        body {
            background-color: #f8f9fa;
            font-family: 'Open Sans', sans-serif;
            margin: 0;
            padding: 0;
            color: white;
        }

        .col-md-3 {
            position: absolute;
            top: 30%;
            left: 0;
            width: 17%;
            color: black;
        }

        header {
            background-color: #343a40;
            color: #ffffff;
            padding: 15px;
            text-align: center;
            color: white;
        }

        .container {
            max-width: 800px;
            margin: 20px auto;
            background-color: #ffffff;
            padding: 20px;
            box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
            border-radius: 8px;
            color: black;
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

        #productList {
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


#updateForm {
    max-width: 500px;
    margin: 20px auto;
    background-color: #fff;
    padding: 20px;
    border-radius: 8px;
    box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
}

.form-group {
    margin-bottom: 10px;
}

label {
    display: block;
    margin-bottom: 5px;
    font-weight: bold;
}

input[type="text"],
input[type="number"],
textarea,
input[type="file"] {
    width: 100%;
    padding: 12px;
    box-sizing: border-box;
    margin-bottom: 15px;
    border: 1px solid #ccc;
    border-radius: 4px;
}

}

button {
    padding: 12px 20px;
    background-color: #007bff;
    color: #fff;
    border: none;
    border-radius: 4px;
    cursor: pointer;
    transition: background-color 0.3s;
}

button:hover {
    background-color: #0056b3;
}

    </style>
</head>

<body>

<header>
    <h1>Product Dashboard</h1>
    <p><?php $firstname; ?></p>
</header>

<div class="container">
    <div id="center" class="row">
        <div class="col-md-6">
            <h2>Add Product</h2>
            <form id="addProductForm" method="post" enctype="multipart/form-data">
                <div class="form-group">
                    <label for="productName">Name:</label>
                    <input type="text" class="form-control" id="productName" name="productName" required>
                </div>
                <div class="form-group">
                    <label for="productDescription">Description:</label>
                    <textarea class="form-control" id="productDescription" name="productDescription" rows="3"></textarea>
                </div>
                <div class="form-group">
                    <label for="productPrice">Price:</label>
                    <input type="number" class="form-control" id="productPrice" name="productPrice" required>
                </div>
                <div class="form-group">
                    <label for="productImage">Image:</label>
                    <input type="file" class="form-control" id="productImage" name="productImage" required>
                </div>
                <button type="submit" class="btn btn-primary">Add Product</button>
            </form>
        </div>
        <!-- <div class="col-md-6">
            <h2>Product List</h2>
            <ul id="productList" class="list-group">
            <a href="image.php"></a>  
            </ul>
        </div> -->
    </div>
    <div class="col-md-3">
        <h2>Actions</h2>
        <ul class="list-group">
            <li class="list-group-item action" data-action="add">Add Product</li>
            <li class="list-group-item action" data-action="delete" onclick="Delete()">Delete Product</li>
            <li class="list-group-item action" data-action="update" onclick="Updated()">Update Product</li>
            <li class="list-group-item action" data-action="rate"  onclick="Rate()">Rate Product</li>
            <li class="list-group-item action" data-action="publish" onclick="Publish()">Publish Product</li>
        </ul>
    </div>
</div>

<?php
?>
<script>
    function Delete() {
        var x = document.getElementById('center');
        x.textContent = " ";
        x.innerHTML = `
        <h3>Delete Product</h3>
        <div id="productName">
            <form id="deleteProductForm" method="post">
                <input type="text" name="pname" placeholder="Product name">
                <button type="button" onclick="deleteProduct()">Delete product</button>
            </form>
        </div>
        <div id="deleteProductResult"></div>
        `;
    }

    function deleteProduct() {
        var productName = document.getElementById('deleteProductForm').elements['pname'].value;

        $.ajax({
            type: 'POST',
            url: 'deleteProduct.php',
            data: { pname: productName },
            success: function(response) {
                document.getElementById('deleteProductResult').innerHTML = response;
            },
            error: function(error) {
                console.error('Error:', error);
            }
        });
    }
    function Updated() {
    var x = document.getElementById('center');
    x.textContent = " ";
    x.innerHTML = `
    <h3>Update Product</h3>
    <div id="updateProductForm">
        <form id="updateForm" method="post" enctype="multipart/form-data">
            <div class="form-group">
                <label for="productName">Name:</label>
                <input type="text" class="form-control" id="productName" name="productName" required>
            </div>
            <div class="form-group">
                <label for="productDescription">Description:</label>
                <textarea class="form-control" id="productDescription" name="productDescription" rows="3"></textarea>
            </div>
            <div class="form-group">
                <label for="productPrice">Price:</label>
                <input type="number" class="form-control" id="productPrice" name="productPrice" required>
            </div>
            <div class="form-group">
                <label for="productImage">Image:</label>
                <input type="file" class="form-control" id="productImage" name="productImage" required>
            </div>
            <button type="submit">Update product</button>
        </form>
    </div>
    <div id="updateProductResult"></div>
    `;

    document.getElementById('updateForm').addEventListener('submit', function (event) {
        event.preventDefault();

        var form = event.target;
        var formData = new FormData(form);

        fetch('updateProduct.php', {
            method: 'POST',
            body: formData,
        })
        .then(response => response.text())
        .then(data => {
            document.getElementById('updateProductResult').innerHTML = data;
        
        })
        .catch(error => {
        
            console.error('Error:', error);
        });
    });
}
function Rate() {
    var x = document.getElementById('center');
    x.textContent = " ";
    x.innerHTML = `
    <h3>Rate Product</h3>
    <div id="productName">
        <form id="rateProductForm" method="post">
            <input type="text" name="pname" placeholder="Product name">
            <input type="number" name="number">
            <button type="submit" class="btn btn-primary">Submit</button>
        </form>
    </div>
    <div id="deleteProductResult"></div>
    `;

    document.getElementById('rateProductForm').addEventListener('submit', function (event) {
        event.preventDefault();

        var form = event.target;
        var formData = new FormData(form);

        fetch('rateProduct.php', {
            method: 'POST',
            body: formData,
        })
        .then(response => response.text())
        .then(data => {
            document.getElementById('deleteProductResult').innerHTML = data;
            
        })
        .catch(error => {
            
            console.error('Error:', error);
        });
    });
}
   
</script>

<script src="https://code.jquery.com/jquery-3.5.1.slim.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.9.3/dist/umd/popper.min.js"></script>
<script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
<script src="dashboard.js"></script>
</body>
</html>
<?php
include('connection.php');
if ($_SERVER['REQUEST_METHOD'] == "POST") {
    $pname = $_POST['productName'];
    $dname = $_POST['productDescription'];
    $prname = $_POST['productPrice'];

    
    $target_dir = "uploads/";
    $target_file = $target_dir . basename($_FILES["productImage"]["name"]);
    $imageFileType = strtolower(pathinfo($target_file, PATHINFO_EXTENSION));

    if (move_uploaded_file($_FILES["productImage"]["tmp_name"], $target_file)) {
        $iname = $target_file;

        $sql = "INSERT INTO products (name, description, price, image) VALUES ('$pname', '$dname', '$prname', '$iname')";
        $connect = mysqli_query($conn, $sql);

        if ($connect) {
            echo "success";
        } else {
            echo "Error: " . $sql . "<br>" . $conn->error;
        }
    } else {
        echo "Error uploading file.";
    }

    $conn->close();
}
?>