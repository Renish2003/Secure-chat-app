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
    /* 🌟 Elegant Background */
    body {
      background: linear-gradient(135deg, #1e3c72, #2a5298);
      color: white;
      font-family: 'Poppins', sans-serif;
      display: flex;
      justify-content: center;
      align-items: center;
      height: 100vh;
      margin: 0;
    }

    /* 🌟 Modern Glassmorphism Card */
    .card {
      width: 400px;
      padding: 30px;
      border-radius: 15px;
      backdrop-filter: blur(15px);
      background: rgba(255, 255, 255, 0.15);
      box-shadow: 0px 15px 30px rgba(0, 0, 0, 0.3);
      border: 1px solid rgba(255, 255, 255, 0.2);
      text-align: center;
    }

    /* 🌟 Title Styling */
    .card h1 {
      font-size: 30px;
      font-weight: 700;
      color: #ffffff;
      margin-bottom: 20px;
    }

    /* 🌟 Input Fields */
    .form-control {
      background: rgba(255, 255, 255, 0.3);
      border: none;
      color: #fff;
      border-radius: 10px;
      padding: 12px;
      font-size: 16px;
      transition: all 0.3s ease;
    }

    .form-control::placeholder {
      color: rgba(255, 255, 255, 0.7);
    }

    /* 🌟 Smooth Glowing Effect on Focus */
    .form-control:focus {
      outline: none;
      background: rgba(255, 255, 255, 0.4);
      box-shadow: 0 0 15px #00e6e6;
    }

    /* 🌟 Stylish Register Button */
    .btn-custom {
      background: #00e6e6;
      color: #000;
      font-weight: bold;
      border-radius: 10px;
      transition: 0.3s;
      padding: 12px;
      width: 100%;
      font-size: 16px;
      box-shadow: 0px 7px 20px rgba(0, 230, 230, 0.4);
    }

    .btn-custom:hover {
      background: #00b3b3;
      box-shadow: 0px 10px 25px rgba(0, 230, 230, 0.6);
    }

    /* 🌟 Login Link */
    .text-small {
      text-align: center;
      margin-top: 15px;
    }

    .text-small a {
      color: #00e6e6;
      font-weight: bold;
      text-decoration: none;
    }

    .text-small a:hover {
      text-decoration: underline;
    }
  </style>
</head>

<body>
  <div class="card">
    <h1>Register</h1>

    <form action="" method="POST">
      <div class="form-group">
        <input type="text" class="form-control" placeholder="Name" required name="name">
      </div>
      <div class="form-group">
        <input type="text" class="form-control" placeholder="Email" required name="email">
      </div>
      <div class="form-group">
        <input type="text" class="form-control" placeholder="Username" required name="username">
      </div>

      <div class="form-group mt-3">
        <input type="password" class="form-control" placeholder="Password" required name="password">
      </div>

      <div class="form-group mt-4">
        <button type="submit" class="btn btn-custom" name="register">Register</button>
      </div>
    </form>

    <div class="text-small">
      <small>Already have an account? <a href="index.php">Login</a></small>
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
</html>
