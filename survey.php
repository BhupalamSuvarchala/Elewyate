<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Survey</title>
    <style>
        body {
            font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;
            background-color: #f7f7f7;
            color: #333;
            margin: 0;
            padding: 20px;
        }
        .container {
            max-width: 600px;
            margin: 0 auto;
            background-color: #fff;
            padding: 30px;
            border-radius: 10px;
            box-shadow: 0 2px 10px rgba(0,0,0,0.1);
        }
        h1, h2 {
            text-align: center;
            color: #007bff;
            margin-bottom: 20px;
        }
        form {
            max-width: 400px;
            margin: 0 auto;
        }
        input[type="text"],
        input[type="email"],
        textarea {
            width: 100%;
            padding: 10px;
            margin-bottom: 20px;
            border: 1px solid #ccc;
            border-radius: 5px;
            box-sizing: border-box;
            font-size: 16px;
            color: #555;
        }
        input[type="radio"] {
            margin-right: 10px;
        }
        button[type="submit"],
        button[type="reset"] {
            background-color: #28a745;
            color: #fff;
            border: none;
            padding: 12px 20px;
            border-radius: 5px;
            cursor: pointer;
            margin-right: 10px;
            font-size: 16px;
        }
        button[type="reset"] {
            background-color: #dc3545;
        }
        button[type="submit"]:hover,
        button[type="reset"]:hover {
            background-color: #218838;
        }
        hr {
            border: none;
            border-top: 1px solid #ccc;
            margin: 20px 0;
        }
    </style>
</head>
<body>
    <?php
    $insertconf = false;
    $server = "localhost";
    $user = "root";
    $password = "";
    $dbname = "survey";

    // Create connection
    $con = new mysqli($server, $user, $password, $dbname);

    // Check connection
    if ($con->connect_error) {
        die("Connection failed: " . $con->connect_error);
    }

    // Check if form is submitted
    if ($_SERVER["REQUEST_METHOD"] == "POST") {
        $name = $_POST['name'];
        $mobile = $_POST['mobile'];
        $email = $_POST['email'];
        $age = $_POST['age'];
        $gender = $_POST['gender'];
        $message = $_POST['message'];

        // Insert data into database
        $sql_query = "INSERT INTO survey (name, mobile, email, age, gender, message) VALUES ('$name', '$mobile', '$email', '$age', '$gender', '$message')";

        if ($con->query($sql_query) === TRUE) {
            $insertconf = true;
        } else {
            echo "Error: " . $sql_query . "<br>" . $con->error;
        }
    }

    // Close connection
    $con->close();
    ?>

    <div class="container">
        <h1>Survey &#9997;</h1>
        <h1>Enter your details</h1>
        <form action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]); ?>" method="POST">
            <input type="text" name="name" id="name" placeholder="Enter your name" required><hr>
            <input type="text" name="mobile" id="mobile" placeholder="Mobile number" required><hr>
            <input type="email" name="email" id="email" placeholder="Enter your email" required><hr>
            <input type="text" name="age" id="age" placeholder="Age" required><hr>
            <input type="radio" name="gender" value="Male" id="gender">Male
            <input type="radio" name="gender" value="Female" id="gender">Female
            <input type="radio" name="gender" value="Others" id="gender">Others<hr>

            <textarea id="message" name="message" cols="25" rows="20" placeholder="Your reply..."></textarea>
            <br>
            <button type="submit">Submit</button>
            <button type="reset">Reset</button>
        </form>
    </div>
</body>
</html>
