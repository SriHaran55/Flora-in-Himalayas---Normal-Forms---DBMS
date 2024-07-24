<?php
// Establish a database connection (replace these variables with your database credentials)
$servername = "localhost";
$username = "root";
$password = "";
$dbname = "new";

$conn =  mysqli_connect($servername, $username, $password, $dbname);

// Check the connection
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

// Process the form data when the form is submitted
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Escape user inputs for security
    $email = mysqli_real_escape_string($conn, $_POST['email']);
    $password = mysqli_real_escape_string($conn, $_POST['password']); // Escape the password as well

    // Retrieve the user record from the database
    $sql = "SELECT * FROM student WHERE email='$email'";
    $result = $conn->query($sql);

    if ($result->num_rows > 0) {
        $row = $result->fetch_assoc();

        // Verify the entered password against the stored password (no hashing)
        if ($password === $row['password']) {
            // Password is correct, redirect to the home page
            header("Location: home.html");
            exit();
        } else {
            echo "Incorrect password. Please try again.";
        }
    } else {
        echo "User not found. Please check your email.";
    }
}

// Close the database connection
$conn->close();
?>
