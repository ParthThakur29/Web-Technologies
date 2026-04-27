<?php
$servername = "localhost";
$username = "root";
$password = "";

// Create connection without db first
mysqli_report(MYSQLI_REPORT_ERROR | MYSQLI_REPORT_STRICT);
try {
    $conn = new mysqli($servername, $username, $password);
} catch (mysqli_sql_exception $e) {
    die("Connection failed: " . $e->getMessage());
}

// Create database
$sql = "CREATE DATABASE IF NOT EXISTS exp11_shop";
if ($conn->query($sql) === TRUE) {
    echo "Database created successfully<br>\n";
} else {
    echo "Error creating database: " . $conn->error . "<br>\n";
}

$conn->select_db("exp11_shop");

// Create table
$sql = "CREATE TABLE IF NOT EXISTS products (
    id INT(6) UNSIGNED AUTO_INCREMENT PRIMARY KEY,
    title VARCHAR(255) NOT NULL,
    category VARCHAR(100) NOT NULL,
    price DECIMAL(10,2) NOT NULL,
    image_url VARCHAR(500) NOT NULL,
    reg_date TIMESTAMP DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP
)";

if ($conn->query($sql) === TRUE) {
    echo "Table 'products' created successfully<br>\n";
} else {
    echo "Error creating table: " . $conn->error . "<br>\n";
}

// Check if empty, then seed
$result = $conn->query("SELECT id FROM products LIMIT 1");
if ($result->num_rows == 0) {
    $products = [
        ['Classic Oversized Tee', 'T-Shirts', 45.00, 'https://images.unsplash.com/photo-1521572163474-6864f9cf17ab?ixlib=rb-4.0.3&auto=format&fit=crop&w=400&q=80'],
        ['Utility Cargo Pants', 'Bottoms', 89.00, 'https://images.unsplash.com/photo-1624378439575-d8705ad7ae80?ixlib=rb-4.0.3&auto=format&fit=crop&w=400&q=80'],
        ['Essential Hoodie', 'Outerwear', 120.00, 'https://images.unsplash.com/photo-1556905055-8f358a7a47b2?ixlib=rb-4.0.3&auto=format&fit=crop&w=400&q=80'],
        ['Minimalist Cap', 'Accessories', 30.00, 'https://images.unsplash.com/photo-1588850561407-ed78c282e89b?ixlib=rb-4.0.3&auto=format&fit=crop&w=400&q=80'],
        ['Denim Jacket', 'Outerwear', 110.00, 'https://images.unsplash.com/photo-1591047139829-d91aecb6caea?ixlib=rb-4.0.3&auto=format&fit=crop&w=400&q=80'],
        ['Urban Sneakers', 'Footwear', 150.00, 'https://images.unsplash.com/photo-1542291026-7eec264c27ff?ixlib=rb-4.0.3&auto=format&fit=crop&w=400&q=80']
    ];

    $stmt = $conn->prepare("INSERT INTO products (title, category, price, image_url) VALUES (?, ?, ?, ?)");
    foreach ($products as $p) {
        $stmt->bind_param("ssds", $p[0], $p[1], $p[2], $p[3]);
        $stmt->execute();
    }
    echo "Seed data inserted.<br>\n";
} else {
    echo "Data already exists.<br>\n";
}

$conn->close();
echo "Setup is complete. You can now use the shop.";
?>
