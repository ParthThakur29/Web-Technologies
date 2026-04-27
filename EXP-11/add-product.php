<?php
require 'db.php';
$msg = "";

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $title = trim($_POST["title"]);
    $category = trim($_POST["category"]);
    $price = trim($_POST["price"]);
    $image_url = trim($_POST["image_url"]);
    
    if (!empty($title) && !empty($category) && !empty($price) && !empty($image_url)) {
        $stmt = $conn->prepare("INSERT INTO products (title, category, price, image_url) VALUES (?, ?, ?, ?)");
        $stmt->bind_param("ssds", $title, $category, $price, $image_url);
        
        if ($stmt->execute()) {
            $msg = "<p style='color:green;text-align:center;'>Product added successfully! <a href='products.php'>View Products</a></p>";
        } else {
            $msg = "<p style='color:red;text-align:center;'>Error adding product: " . $conn->error . "</p>";
        }
        $stmt->close();
    } else {
        $msg = "<p style='color:red;text-align:center;'>All fields are required!</p>";
    }
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Add Product | LUMIÈRE</title>
    <link href="https://fonts.googleapis.com/css2?family=Outfit:wght@300;400;500;700&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="style.css">
    <style>
        .form-container { max-width: 600px; margin: 40px auto; padding: 20px; background: #fff; border: 1px solid #eee; border-radius: 8px; }
        .form-group { margin-bottom: 20px; }
        .form-group label { display: block; margin-bottom: 8px; font-weight: 500; }
        .form-group input { width: 100%; padding: 10px; border: 1px solid #ccc; border-radius: 4px; box-sizing: border-box;}
        .submit-btn { width: 100%; background: #000; color: #fff; padding: 12px; border: none; cursor: pointer; text-transform: uppercase; font-weight: bold;}
        .submit-btn:hover { background: #333; }
    </style>
</head>
<body>
    <header class="site-header">
        <div class="container flex-between">
            <a href="index.html" class="logo">LUMIÈRE.</a>
            <nav class="nav-links">
                <a href="index.html">Home</a>
                <a href="products.php">Shop All</a>
                <a href="add-product.php" class="active">Add Product</a>
            </nav>
        </div>
    </header>
    
    <div class="container mt-4 mb-2">
        <h1 class="section-title text-center">Add New Product</h1>
        
        <?php echo $msg; ?>
        
        <div class="form-container">
            <form action="add-product.php" method="POST">
                <div class="form-group">
                    <label for="title">Product Title</label>
                    <input type="text" id="title" name="title" required>
                </div>
                <div class="form-group">
                    <label for="category">Category</label>
                    <input type="text" id="category" name="category" required>
                </div>
                <div class="form-group">
                    <label for="price">Price ($)</label>
                    <input type="number" step="0.01" id="price" name="price" required>
                </div>
                <div class="form-group">
                    <label for="image_url">Image URL</label>
                    <input type="url" id="image_url" name="image_url" required>
                </div>
                <button type="submit" class="submit-btn">Add Product</button>
            </form>
        </div>
    </div>
</body>
</html>
