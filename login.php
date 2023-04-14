<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <meta http-equiv="X-UA-Compatible" content="ie=edge">
  <title>DCS:Login</title>

  <!-- Bootstrap 5 CSS -->
<link rel="stylesheet" href="npm/node_modules/bootstrap/dist/css/bootstrap.css">
  <!-- Custom CSS -->
</head>
<body>
  <div class="container">
    <div class="row justify-content-center mt-5">
      <div class="col-md-6">
        <div class="card">
          <div class="card-header bg-primary text-white">Login</div>
          <div class="card-body">
            <form action="validate.php" method="post">
              <div class="form-group mb-3">
                <label for="username">username</label>
                <input type="text" class="form-control" id="username" name="username" placeholder="Enter Username" required>
              </div>
              <div class="form-group mb-3">
                <label for="password">password</label>
                <input type="password" class="form-control" id="password" name="password" placeholder="Password" required>
              </div>
              <button type="submit" class="btn btn-primary w-100">Login</button>
            </form>
          </div>
        </div>
      </div>
    </div>
  </div>

  <!-- Bootstrap 5 JS -->
<script src="npm/node_modules/bootstrap/dist/js/bootstrap.bundle.js"></script>
</body>
</html>
