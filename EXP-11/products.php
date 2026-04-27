<?php require 'db.php'; ?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Shop | LUMIÈRE</title>
    <link href="https://fonts.googleapis.com/css2?family=Outfit:wght@300;400;500;700&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="style.css">
</head>

<body>
    <header class="site-header">
        <div class="container flex-between">
            <a href="index.html" class="logo">LUMIÈRE.</a>
            <nav class="nav-links">
                <a href="index.html">Home</a>
                <a href="products.php" class="active">Shop All</a>
                <a href="add-product.php">Add Product</a>
            </nav>
            <div class="header-icons">
                <a href="#" class="icon-btn">Search</a>
                <a href="#" class="icon-btn">Account</a>
                <a href="cart.html" class="icon-btn">Cart <span class="badge">2</span></a>
            </div>
        </div>
    </header>

    <div class="container mt-4 mb-2">
        <h1 class="section-title text-center">All Products</h1>

        <div class="shop-layout mt-4">
            <!-- Sidebar Filters -->
            <aside class="filters-sidebar">
                <div class="filter-group">
                    <h3 class="sidebar-title">Categories</h3>
                    <ul class="filter-list">
                        <li><a href="#">All Products</a></li>
                        <li><a href="#">Men</a></li>
                        <li><a href="#">Women</a></li>
                        <li><a href="#">Accessories</a></li>
                        <li><a href="#">Sale</a></li>
                    </ul>
                </div>
                <div class="filter-group">
                    <h3 class="sidebar-title">Price Range</h3>
                    <ul class="filter-list">
                        <li><a href="#">Under $50</a></li>
                        <li><a href="#">$50 - $100</a></li>
                        <li><a href="#">$100 - $200</a></li>
                        <li><a href="#">Over $200</a></li>
                    </ul>
                </div>
            </aside>

            <!-- Product Grid -->
            <main class="grid product-grid">
                <?php
                $sql = "SELECT * FROM products ORDER BY id DESC";
                $result = $conn->query($sql);

                if ($result->num_rows > 0) {
                    while($row = $result->fetch_assoc()) {
                ?>
                <article class="product-card">
                    <div class="product-image">
                        <img src="<?php echo htmlspecialchars($row['image_url']); ?>" alt="<?php echo htmlspecialchars($row['title']); ?>">
                        <button class="add-to-cart-btn"></button>
                    </div>
                    <div class="product-info">
                        <h3 class="product-title"><a href="product-detail.html?id=<?php echo $row['id']; ?>"><?php echo htmlspecialchars($row['title']); ?></a></h3>
                        <p class="product-category"><?php echo htmlspecialchars($row['category']); ?></p>
                        <p class="product-price">$<?php echo number_format($row['price'], 2); ?></p>
                    </div>
                </article>
                <?php
                    }
                } else {
                    echo "<p>No products found.</p>";
                }
                $conn->close();
                ?>
            </main>
        </div>
    </div>

    <footer class="site-footer">
        <div class="container">
            <div class="footer-grid">
                <div class="footer-col">
                    <a href="#" class="logo" style="color:white; display:block; margin-bottom: 1rem;">LUMIÈRE.</a>
                    <p style="color: #999; width: 80%;">Redefining modern fashion with minimalist aesthetics and premium quality.</p>
                </div>
            </div>
            <div class="footer-bottom">
                &copy; 2024 Lumière Fashion. All rights reserved.
            </div>
        </div>
    </footer>
</body>
</html>
