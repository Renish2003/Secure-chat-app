<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  
  <title>Register | Secured Chat App</title>
  
  <!-- Font Awesome for Icons -->
  <script src="https://kit.fontawesome.com/4733528720.js" crossorigin="anonymous"></script>
  
  <!-- Bootstrap & Custom Styles -->
  <link rel="stylesheet" type="text/css" href="vendors/css/bootstrap.min.css">
  
  <style>
    /* 🌟 Beautiful Background */
    body {
    background: linear-gradient(to right,rgb(42, 74, 114), #009ffd);
    color: white;
    font-family: 'Poppins', sans-serif;
      display: flex;
      justify-content: center;
      align-items: center;
      height: 100vh;
      margin: 0;
    }

    /* 🌟 Glassmorphism Card */
    .card {
      width: 400px;
      padding: 30px;
      border-radius: 15px;
      backdrop-filter: blur(10px);
      background: rgba(255, 255, 255, 0.1);
      box-shadow: 0px 10px 25px rgba(0, 0, 0, 0.2);
      border: 1px solid rgba(255, 255, 255, 0.2);
      text-align: center;
    }

    /* 🌟 Title Styling */
    .card h1 {
      font-size: 28px;
      font-weight: 700;
      color: #ffffff;
      margin-bottom: 20px;
    }

    /* 🌟 Input Fields */
    .form-control {
      background: rgba(255, 255, 255, 0.2);
      border: none;
      color: #fff;
      border-radius: 8px;
      padding: 12px;
      font-size: 16px;
      transition: all 0.3s ease;
    }

    .form-control::placeholder {
      color: rgba(255, 255, 255, 0.6);
    }

    /* 🌟 Glowing Effect on Focus */
    .form-control:focus {
      outline: none;
      background: rgba(255, 255, 255, 0.3);
      box-shadow: 0 0 10px #00f2ff;
    }

    /* 🌟 Register Button */
    .btn-custom {
      background: #00f2ff;
      color: #000;
      font-weight: bold;
      border-radius: 8px;
      transition: 0.3s;
      padding: 12px;
      width: 100%;
      font-size: 16px;
      box-shadow: 0px 5px 15px rgba(0, 242, 255, 0.3);
    }

    .btn-custom:hover {
      background: #00c3ff;
      box-shadow: 0px 10px 25px rgba(0, 242, 255, 0.5);
    }

    /* 🌟 Login Link */
    .text-small {
      text-align: center;
      margin-top: 15px;
    }

    .text-small a {
      color: #00f2ff;
      font-weight: bold;
      text-decoration: none;
    }

    .text-small a:hover {
      text-decoration: underline;
    }
  </style>
</head>

<body>
  <div class="card animate__animated animate__fadeIn">
    <h1>Login</h1>
    <form action="" method="POST">
      <div class="form-group">
        <input type="text" class="form-control" placeholder="Username" required name="username">
      </div>
      <div class="form-group mt-3">
        <input type="password" class="form-control" placeholder="Password" required name="password">
      </div>
      <div class="g-recaptcha mt-3" data-sitekey="6LfQsGErAAAAADmqTLKhfVS0P4e8GXYr-ZWN89El"></div>
      <div class="form-group mt-4">
        <button type="submit" class="btn btn-custom" name="login">Login</button>
      </div>
    </form>
    <div class="text-small mt-3">
      <small>Don't have an account? <a href="register.php">Register</a></small>
    </div>
  </div>
  <!-- PHP Backend -->
  <?php require_once 'server/server.php'; ?>
  <!-- Prevent Form Resubmission -->
  <script>
    if (window.history.replaceState) {
      window.history.replaceState(null, null, window.location.href);
    }
  </script>
</body>

<script src="https://www.google.com/recaptcha/api.js" async defer></script>
</html>
