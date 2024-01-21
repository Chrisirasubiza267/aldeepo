<body>
<!-- Add this inside the Product List section or wherever you want to display the uploaded image -->
<div class="col-md-6">
    <h2>Product List</h2>
    <ul id="productList" class="list-group">
        <!-- ... (Existing code) ... -->
        <li class="list-group-item">
            <strong>Product Image:</strong>
            <button type="button" class="btn btn-link" data-toggle="modal" data-target="#imageModal">
                View Image
            </button>
        </li>
        <!-- ... (Existing code) ... -->
    </ul>
</div>

<!-- Modal for displaying large image -->
<div class="modal fade" id="imageModal" tabindex="-1" role="dialog" aria-labelledby="imageModalLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="imageModalLabel">Product Image</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <img src="" id="largeImage" class="img-fluid" alt="Product Image">
            </div>
        </div>
    </div>
</div>
</body>
<!-- Add this before the closing </body> tag -->
<script>
    (document).on('click', '[data-toggle="modal"]', function () {
        var imageUrl = $(this).data('image');
        $('#largeImage').attr('src', imageUrl);
    });
</script>

<?php
include('connection.php');

if ($_SERVER['REQUEST_METHOD'] == "POST") {
    $pname = $_POST['productName'];
    $dname = $_POST['productDescription'];
    $prname = $_POST['productPrice'];

    // Upload image
    $targetDirectory = 'uploads/';
    $targetPath = $targetDirectory . basename($_FILES['productImage']['name']);

    if (move_uploaded_file($_FILES['productImage']['tmp_name'], $targetPath)) {
        // Image uploaded successfully
        $imageName = basename($_FILES['productImage']['name']);

        // Add product to the database with image name
        $sql = "INSERT INTO products (name, description, price, image) VALUES ('$pname', '$dname', '$prname', '$imageName')";
        $connect = mysqli_query($conn, $sql);

        if ($connect) {
            echo "success";
        }
    } else {
        // Error uploading image
        echo "Error uploading image.";
    }

    $conn->close();
}

// Fetch products from the database and display them
$sql = "SELECT * FROM products";
$result = mysqli_query($conn, $sql);

while ($row = mysqli_fetch_assoc($result)) {
    // Display other product details
    echo '<li class="list-group-item">';
    echo '<strong>Product Image:</strong>';
    echo '<button type="button" class="btn btn-link" data-toggle="modal" data-target="#imageModal" data-image="uploads/' . $row['image'] . '">';
    echo 'View Image';
    echo '</button>';
    echo '</li>';
    // Display other product details
}

$conn->close();
?>

