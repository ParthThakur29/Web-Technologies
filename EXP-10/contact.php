<?php
// Define variables and set to empty values
$nameErr = $emailErr = $messageErr = "";
$name = $email = $message = "";
$success_msg = "";

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Sanitize function
    function test_input($data) {
        $data = trim($data);
        $data = stripslashes($data);
        $data = htmlspecialchars($data);
        return $data;
    }

    $valid = true;

    // Validate Name
    if (empty($_POST["name"])) {
        $nameErr = "Name is required";
        $valid = false;
    } else {
        $name = test_input($_POST["name"]);
        // check if name only contains letters and whitespace
        if (!preg_match("/^[a-zA-Z-' ]*$/",$name)) {
            $nameErr = "Only letters and white space allowed";
            $valid = false;
        }
    }

    // Validate Email
    if (empty($_POST["email"])) {
        $emailErr = "Email is required";
        $valid = false;
    } else {
        $email = test_input($_POST["email"]);
        // check if e-mail address is well-formed
        if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
            $emailErr = "Invalid email format";
            $valid = false;
        }
    }

    // Validate Message
    if (empty($_POST["message"])) {
        $messageErr = "Message is required";
        $valid = false;
    } else {
        $message = test_input($_POST["message"]);
    }
    
    if($valid) {
        $success_msg = "Your message has been sent successfully!";
        // Reset fields after successful submission
        $name = $email = $message = "";
    }
}
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Portfolio | Contact</title>
    <link rel="stylesheet" href="css/style.css">
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@400;500;700&display=swap" rel="stylesheet">
    <style>
        .error { color: #ff4d4d; font-size: 0.85rem; margin-top: 5px; display: block; }
        .success { color: #4CAF50; font-weight: bold; margin-bottom: 20px; text-align: center; padding: 10px; background-color: rgba(76, 175, 80, 0.1); border-radius: 5px; border: 1px solid #4CAF50; }
    </style>
</head>

<body>

    <header>
        <div class="container">
            <nav>
                <div class="logo">MyPortfolio.</div>
                <ul class="nav-links">
                    <li><a href="index.html">Home</a></li>
                    <li><a href="about.html">About</a></li>
                    <li><a href="projects.html">Projects</a></li>
                    <li><a href="contact.php" class="active">Contact</a></li>
                </ul>
            </nav>
        </div>
    </header>

    <main>
        <section class="container" style="padding-top: 150px;">
            <div class="contact-wrapper">
                <div class="contact-info">
                    <h2>Get In Touch</h2>
                    <p>I'm currently available for freelance projects or full-time opportunities. If you have any
                        questions or just want to say hi, feel free to drop me a message!</p>

                    <div class="contact-info-item">
                        <strong>Email:</strong>
                        <span>parththakur8293@gmail.com</span>
                    </div>
                    <div class="contact-info-item">
                        <strong>Phone:</strong>
                        <span>+91 8293431323</span>
                    </div>
                    <div class="contact-info-item">
                        <strong>Location:</strong>
                        <span>Bangalore,India</span>
                    </div>
                </div>

                <div class="contact-form">
                    <?php 
                    if(!empty($success_msg)){
                        echo "<div class='success'>" . $success_msg . "</div>";
                    }
                    ?>
                    <form action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]);?>" method="POST">
                        <div class="form-group">
                            <label for="name">Name</label>
                            <input type="text" id="name" name="name" value="<?php echo htmlspecialchars($name); ?>">
                            <span class="error"><?php echo $nameErr;?></span>
                        </div>
                        <div class="form-group">
                            <label for="email">Email</label>
                            <input type="email" id="email" name="email" value="<?php echo htmlspecialchars($email); ?>">
                            <span class="error"><?php echo $emailErr;?></span>
                        </div>
                        <div class="form-group">
                            <label for="message">Message</label>
                            <textarea id="message" name="message" rows="5"><?php echo htmlspecialchars($message); ?></textarea>
                            <span class="error"><?php echo $messageErr;?></span>
                        </div>
                        <button type="submit" class="btn" style="width: 100%; border: none; cursor: pointer;">Send Message</button>
                    </form>
                </div>
            </div>
        </section>
    </main>

    <footer>
        <div class="container">
            <p>&copy; lab work</p>
        </div>
    </footer>

</body>

</html>
