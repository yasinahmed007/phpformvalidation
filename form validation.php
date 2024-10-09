<?php
// Define variables and set empty values
$name = $email = $mobile = $website = $comment = $gender = $password = $repeat_password = "";
$nameErr = $emailErr = $mobileErr = $websiteErr = $passwordErr = $genderErr = "";

// Function to sanitize input data
function test_input($data) {
    return htmlspecialchars(stripslashes(trim($data)));
}

if ($_SERVER["REQUEST_METHOD"] == "POST") {

    // Validate name (no spaces or special characters)
    if (empty($_POST["name"])) {
        $nameErr = "Name is required";
    } elseif (!preg_match("/^[a-zA-Z0-9]+$/", $_POST["name"])) {
        $nameErr = "Name cannot contain spaces or special characters";
    } else {
        $name = test_input($_POST["name"]);
    }

    // Validate email
    if (empty($_POST["email"])) {
        $emailErr = "Email is required";
    } elseif (!filter_var($_POST["email"], FILTER_VALIDATE_EMAIL)) {
        $emailErr = "Invalid email format";
    } else {
        $email = test_input($_POST["email"]);
    }

    // Validate mobile number (only numbers and '+')
    if (empty($_POST["mobile"])) {
        $mobileErr = "Mobile number is required";
    } elseif (!preg_match("/^\+?[0-9]+$/", $_POST["mobile"])) {
        $mobileErr = "Mobile number can only contain numbers and '+'";
    } else {
        $mobile = test_input($_POST["mobile"]);
    }

    // Validate website (optional)
    if (!empty($_POST["website"])) {
        if (!preg_match("/\b(?:https?|ftp):\/\/[a-z0-9+&@#\/%?=~_|!:,.;]*[a-z0-9+&@#\/%=~_|]/i", $_POST["website"])) {
            $websiteErr = "Invalid URL format";
        } else {
            $website = test_input($_POST["website"]);
        }
    }

    // Validate gender
    if (empty($_POST["gender"])) {
        $genderErr = "Gender is required";
    } else {
        $gender = test_input($_POST["gender"]);
    }

    // Validate password and repeat password
    if (empty($_POST["password"])) {
        $passwordErr = "Password is required";
    } elseif ($_POST["password"] !== $_POST["repeat_password"]) {
        $passwordErr = "Passwords do not match";
    } else {
        $password = test_input($_POST["password"]);
    }
}

?>

<h2>Your Submitted Data:</h2>
<?php
if ($_SERVER["REQUEST_METHOD"] == "POST" && empty($nameErr) && empty($emailErr) && empty($mobileErr) && empty($websiteErr) && empty($passwordErr) && empty($genderErr)) {
    echo "Name: $name<br>";
    echo "Email: $email<br>";
    echo "Mobile: $mobile<br>";
    echo "Website: $website<br>";
    echo "Comment: $comment<br>";
    echo "Gender: $gender<br>";
}
?>
