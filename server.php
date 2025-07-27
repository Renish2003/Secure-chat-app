<?php
require_once('DB.php');
session_start();

$db = DB::getInstance();
$message = "";

// Logout logic
if (isset($_SESSION['uid'])) {
    $uid = $_SESSION['uid'];
    $query = "UPDATE users SET online=0, logout_timestamp=CURRENT_TIMESTAMP() WHERE id=?";
    
    $stmt = $db->prepare($query);
    $stmt->bind_param("i", $uid);
    $stmt->execute();

    session_unset();
    session_destroy();
}

// Handle login
if (isset($_POST['login'])) {
    loginProcess($db);
    exit();
}

// Handle registration
if (isset($_POST['register'])) {
    registerProcess($db);
    exit();
}

// 🔐 Function to verify Google reCAPTCHA
function verifyCaptcha($captchaResponse) {
    $secretKey = "6LfQsGErAAAAAHGZh2RDrXPctbcHIvb3ubz_pi9G"; // Replace with your Google secret key
    $url = 'https://www.google.com/recaptcha/api/siteverify';
    
    $data = array(
        'secret' => $secretKey,
        'response' => $captchaResponse
    );

    $options = array(
        'http' => array(
            'header'  => "Content-type: application/x-www-form-urlencoded\r\n",
            'method'  => 'POST',
            'content' => http_build_query($data),
        ),
    );
    
    $context  = stream_context_create($options);
    $result = file_get_contents($url, false, $context);
    $resultJson = json_decode($result);
    
    return $resultJson->success;
}


// 🔐 Handle user login
function loginProcess($db) {
    if (!empty($_POST['username']) && !empty($_POST['password'])) {
        // Check for CAPTCHA
        if (empty($_POST['g-recaptcha-response']) || !verifyCaptcha($_POST['g-recaptcha-response'])) {
            echo "<div class='text-danger' style='font-size: 16px; text-align:center;'>CAPTCHA verification failed</div>";
            return;
        }

        $username = strtolower(trim($_POST['username']));
        $password = trim($_POST['password']);

        $stmt = $db->prepare("SELECT id, username, password FROM users WHERE username = ?");
        $stmt->bind_param("s", $username);
        $stmt->execute();
        $result = $stmt->get_result();
        
        if ($row = $result->fetch_assoc()) {
            if (password_verify($password, $row['password'])) {
                $_SESSION['uid'] = $row['id'];
                $_SESSION['username'] = $row['username'];

                // Update user status to online
                $uid = $_SESSION['uid'];
                $db->query("UPDATE users SET online=1, last_timestamp=CURRENT_TIMESTAMP() WHERE id=$uid");

                echo "<div class='text-success' style='font-size: 16px; text-align:center;'>Logging In..</div>";
                header("refresh:1;url=./chat");
            } else {
                echo "<div class='text-danger' style='font-size: 16px; text-align:center;'>Incorrect password.</div>";
            }
        } else {
            echo "<div class='text-danger' style='font-size: 16px; text-align:center;'>User not found.</div>";
        }

        $stmt->close();
    } else {
        echo "<div class='text-danger' style='font-size: 16px; text-align:center;'>Please fill in all fields.</div>";
    }
}

// 🔐 Handle user registration
function registerProcess($db) {
    if (!empty($_POST['name']) && !empty($_POST['email']) && !empty($_POST['username']) && !empty($_POST['password'])) {
        $name = trim($_POST['name']);
        $email = trim($_POST['email']);
        $username = strtolower(trim($_POST['username']));
        $password = trim($_POST['password']);

        // Validate email format
        if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
            echo "<div class='text-danger' style='font-size: 16px; text-align:center;'>Invalid email format</div>";
            return;
        }

        // Check if username or email already exists
        $stmt = $db->prepare("SELECT id FROM users WHERE username = ? OR email = ?");
        $stmt->bind_param("ss", $username, $email);
        $stmt->execute();
        $stmt->store_result();

        if ($stmt->num_rows > 0) {
            echo "<div class='text-danger' style='font-size: 16px; text-align:center;'>Username or Email already taken</div>";
        } else {
            // Hash password
            $hashedPassword = password_hash($password, PASSWORD_BCRYPT);

            // Insert user
            $stmt = $db->prepare("INSERT INTO users (name, email, username, password) VALUES (?, ?, ?, ?)");
            $stmt->bind_param("ssss", $name, $email, $username, $hashedPassword);

            if ($stmt->execute()) {
                echo "<div class='text-success' style='font-size: 16px; text-align:center;'>Successfully Registered</div>";
                header("refresh:2;url=./index.php");
            } else {
                echo "<div class='text-danger' style='font-size: 16px; text-align:center;'>Error: " . $stmt->error . "</div>";
            }
        }

        $stmt->close();
    } else {
        echo "<div class='text-danger' style='font-size: 16px; text-align:center;'>All fields are required</div>";
    }
}
?>
