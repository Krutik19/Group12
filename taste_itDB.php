<?php
$servername = "localhost";
$username = "root"; 
$password = ""; 

// Create connection
$conn = new mysqli($servername, $username, $password);

// Check connection
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

// Create database
$sql = "CREATE DATABASE IF NOT EXISTS taste_itDB";
if ($conn->query($sql) === TRUE) {
    echo "Database created successfully\n";
} else {
    echo "Error creating database: " . $conn->error;
}

// Select the database
$conn->select_db('taste_itDB');

// SQL to create tables
$tables = [
    "CREATE TABLE IF NOT EXISTS Users (
        user_id INT AUTO_INCREMENT PRIMARY KEY,
        email VARCHAR(255) NOT NULL UNIQUE,
        password_hash VARCHAR(255) NOT NULL,
        created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP
    )",
    "CREATE TABLE IF NOT EXISTS Profiles (
        profile_id INT AUTO_INCREMENT PRIMARY KEY,
        user_id INT NOT NULL,
        first_name VARCHAR(255),
        last_name VARCHAR(255),
        phone_number VARCHAR(20),
        address TEXT,
        FOREIGN KEY (user_id) REFERENCES Users(user_id)
    )",
    "CREATE TABLE IF NOT EXISTS Reservations (
        reservation_id INT AUTO_INCREMENT PRIMARY KEY,
        customer_name VARCHAR(100) NOT NULL,
        email VARCHAR(255) NOT NULL,
        reservation_date DATETIME NOT NULL,
        number_of_guests INT NOT NULL,
        special_requests TEXT,
        created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP
    )",
    "CREATE TABLE IF NOT EXISTS Reviews (
        review_id INT AUTO_INCREMENT PRIMARY KEY,
        customer_name VARCHAR(100) NOT NULL,
        email VARCHAR(255) NOT NULL,
        review_text TEXT,
        rating INT CHECK (rating BETWEEN 1 AND 5),
        created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP
    )",
    "CREATE TABLE IF NOT EXISTS CheckOut (
        CheckOut_id INT AUTO_INCREMENT PRIMARY KEY,
        FirstName VARCHAR(100) NOT NULL,
        LastName VARCHAR(100) NOT NULL,
        billingNumber INT,
        Email VARCHAR(255) NOT NULL,
        billingAddress VARCHAR(255) NOT NULL,
        city TEXT,
        zip VARCHAR(100),
        totalAmount DECIMAL(10, 2) NOT NULL,
        created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP
    )",
    "CREATE TABLE IF NOT EXISTS Categories (
        category_id INT AUTO_INCREMENT PRIMARY KEY,
        category_name VARCHAR(255) NOT NULL
    )",
    "CREATE TABLE IF NOT EXISTS Menu_Items (
        item_id INT AUTO_INCREMENT PRIMARY KEY,
        category_id INT NOT NULL,
        item_name VARCHAR(255) NOT NULL,
        description TEXT,
        price DECIMAL(10, 2) NOT NULL,
        image_url VARCHAR(255),
        FOREIGN KEY (category_id) REFERENCES Categories(category_id)
    )",
    "CREATE TABLE IF NOT EXISTS Chefs (
        chef_id INT AUTO_INCREMENT PRIMARY KEY,
        name VARCHAR(255) NOT NULL,
        bio TEXT,
        specialty VARCHAR(255),
        image_url VARCHAR(255)
    )",
    "CREATE TABLE IF NOT EXISTS Cart_Items (
        cart_item_id INT AUTO_INCREMENT PRIMARY KEY,
        user_id INT NOT NULL,
        item_id INT NOT NULL,
        quantity INT NOT NULL,
        created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
        FOREIGN KEY (user_id) REFERENCES Users(user_id),
        FOREIGN KEY (item_id) REFERENCES Menu_Items(item_id)
    )",
    "CREATE TABLE IF NOT EXISTS Orders (
        order_id INT AUTO_INCREMENT PRIMARY KEY,
        user_id INT NOT NULL,
        total_amount DECIMAL(10, 2) NOT NULL,
        order_date TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
        FOREIGN KEY (user_id) REFERENCES Users(user_id)
    )",
    "CREATE TABLE IF NOT EXISTS Order_Items (
        order_item_id INT AUTO_INCREMENT PRIMARY KEY,
        order_id INT NOT NULL,
        item_id INT NOT NULL,
        quantity INT NOT NULL,
        price DECIMAL(10, 2) NOT NULL,
        FOREIGN KEY (order_id) REFERENCES Orders(order_id),
        FOREIGN KEY (item_id) REFERENCES Menu_Items(item_id)
    )"
];

// Execute each table creation query
foreach ($tables as $table_sql) {
    if ($conn->query($table_sql) === TRUE) {
        echo "Table created successfully: " . $table_sql . "\n";
    } else {
        echo "Error creating table: " . $conn->error . "\n";
    }
}

// Add initial user to Users table
$default_user_email = 'admin@example.com';
$default_user_password_hash = password_hash('password123', PASSWORD_DEFAULT); // Hashed password

$insert_user_sql = "INSERT INTO Users (email, password_hash) VALUES (?, ?)";
$stmt = $conn->prepare($insert_user_sql);
$stmt->bind_param('ss', $default_user_email, $default_user_password_hash);

if ($stmt->execute()) {
    echo "Default user inserted successfully\n";
} else {
    echo "Error inserting default user: " . $conn->error . "\n";
}


// Add initial values to Categories
$categories = [
    "INSERT INTO Categories (category_name) VALUES ('Appetizers')",
    "INSERT INTO Categories (category_name) VALUES ('Main Courses')",
    "INSERT INTO Categories (category_name) VALUES ('Desserts')"
];

foreach ($categories as $category_sql) {
    if ($conn->query($category_sql) === TRUE) {
        echo "Category inserted successfully: " . $category_sql . "\n";
    } else {
        echo "Error inserting category: " . $conn->error . "\n";
    }
}

// Add initial values to Menu_Items
$menu_items = [
    "INSERT INTO Menu_Items (category_id, item_name, description, price, image_url) VALUES (1, 'Spring Rolls', 'Crispy vegetarian spring rolls.', 5.99, 'https://cdn.pixabay.com/photo/2018/03/15/12/16/food-3228057_640.jpg')",
    "INSERT INTO Menu_Items (category_id, item_name, description, price, image_url) VALUES (1, 'Garlic Bread', 'Toasted bread with garlic and herbs.', 3.99, 'https://i0.wp.com/comfortandpeasant.com/wp-content/uploads/2023/11/Garlic-bread-2-2036.jpg?resize=640%2C427&ssl=1')",
    "INSERT INTO Menu_Items (category_id, item_name, description, price, image_url) VALUES (2, 'Spaghetti Carbonara', 'Classic Italian pasta dish with creamy sauce.', 12.99, 'https://i0.wp.com/chefmimiblog.com/wp-content/uploads/2022/02/MG_2540.jpg?fit=640%2C427&ssl=1')",
    "INSERT INTO Menu_Items (category_id, item_name, description, price, image_url) VALUES (2, 'Grilled Chicken', 'Juicy grilled chicken with side vegetables.', 15.99, 'https://i0.wp.com/smittenkitchen.com/wp-content/uploads/2019/05/img_0540.jpg?resize=640%2C427&ssl=1')",
    "INSERT INTO Menu_Items (category_id, item_name, description, price, image_url) VALUES (3, 'Chocolate Cake', 'Rich chocolate cake with frosting.', 6.99, 'https://i0.wp.com/live.staticflickr.com/65535/53041757984_80d08ba74e_z.jpg?resize=640%2C427&ssl=1')"
];

foreach ($menu_items as $menu_item_sql) {
    if ($conn->query($menu_item_sql) === TRUE) {
        echo "Menu item inserted successfully: " . $menu_item_sql . "\n";
    } else {
        echo "Error inserting menu item: " . $conn->error . "\n";
    }
}

// Add initial values to Chefs
$chefs = [
    "INSERT INTO Chefs (name, bio, specialty, image_url) VALUES ('Hiroshi Tanaka', 'Sushi and Sashimi. Chef Tanaka is famous for his meticulous knife skills and innovative sushi rolls, blending traditional Japanese techniques with modern flavors.', 'Japanese Food', 'https://pbs.twimg.com/media/GRo35jea4AAYMRa.jpg')",
    "INSERT INTO Chefs (name, bio, specialty, image_url) VALUES ('Isabella Rossi', 'Traditional Italian Cuisine, particularly homemade pasta and classic sauces. Chef Rossi is renowned for her authentic lasagna and tiramisu.', 'Italian Food', 'https://culinarylabschool.com/wp-content/uploads/2019/06/Pros-and-cons-to-working-in-culinary-arts-CulinaryLab-School.jpg')",
    "INSERT INTO Chefs (name, bio, specialty, image_url) VALUES ('Axer Patel', 'French Patisserie and Fusion Desserts. Chef Patel excels in creating delicate pastries such as macarons, éclairs, and fusion desserts that incorporate flavors from his Indian heritage.', 'French Food', 'https://t3.ftcdn.net/jpg/02/65/16/18/360_F_265161867_nUORzZ1sfwADG6RoOsCPdf81KKYQdD3G.jpg')"
];

foreach ($chefs as $chef_sql) {
    if ($conn->query($chef_sql) === TRUE) {
        echo "Chef inserted successfully: " . $chef_sql . "\n";
    } else {
        echo "Error inserting chef: " . $conn->error . "\n";
    }
}

$stmt->close();
$conn->close();
?>
