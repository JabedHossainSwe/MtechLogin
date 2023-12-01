<!DOCTYPE html>
<html>

<head>
  <meta charset="utf-8" />
  <meta name="viewport" content="initial-scale=1, width=device-width" />
  <title>Login</title>
  <link rel="stylesheet" href="./index.css" />
  <link rel="stylesheet" href="https://fonts.googleapis.com/css2?family=Poppins:wght@400;700&display=swap" />
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet"
    integrity="sha384-T3c6CoIi6uLrA9TneNEoa7RxnatzjcDSCmG1MXxSR1GAsXEV/Dwwykc2MPK8M2HN" crossorigin="anonymous">
  <link rel="stylesheet" href="./css/index.css">
</head>

<body>
  <div class="container">
    <div class="row">
      <div class="col-md-6">
        <div class="container-child">
          <b class="mtech">
            <span>mtech</span>
            <span class="span">.</span>
          </b>
          <b class="welcome-to-mtech-container">
            <p class="welcome-to-mtech">Welcome to Mtech</p>
            <p class="welcome-to-mtech">Solutions.</p>
          </b>

          <div class="b-e-y">
            B&nbsp;&nbsp;&nbsp;E&nbsp;&nbsp;&nbsp;Y&nbsp;&nbsp;&nbsp;O&nbsp;&nbsp;&nbsp;N&nbsp;&nbsp;&nbsp;D&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;T&nbsp;&nbsp;&nbsp;E&nbsp;&nbsp;&nbsp;C&nbsp;&nbsp;&nbsp;H
          </div>
        </div>

        <form class="login-form" action="/login" method="post">
          <div class="row mb-3">
            <div class="col-md-12">
              <label for="email" class="form-label">Email</label>
              <input type="email" id="email" name="email" autocomplete="off" class="form-control">
            </div>
          </div>
          <div class="row mb-3">
            <div class="col-md-12">
              <label for="password" class="form-label">Password</label>
              <input type="password" id="password" name="password" autocomplete="off" class="form-control">
            </div>
          </div>
          <div class="row mb-3">
            <div class="col-md-12">
              <div class="form-check">
                <input type="checkbox" id="remember-me" name="remember-me" class="form-check-input">
                <label for="remember-me" class="form-check-label">Remember me</label>
              </div>
            </div>
          </div>
          <div class="row">
            <div class="col-md-12 text-center">
              <button type="submit" class="btn btn-primary btn-lg">Login</button>
            </div>
          </div>
        </form>
        <div class="register">Register</div>
      </div>
    </div>
  </div>

  <div class="container2">
    <div class="circle">
      <div class="circle-text"><b class="circle-mtech">
          <span>mtech</span>
          <span class="span">.</span>
        </b>
        <div class="circle-beyond">
          B&nbsp;&nbsp;&nbsp;E&nbsp;&nbsp;&nbsp;Y&nbsp;&nbsp;&nbsp;O&nbsp;&nbsp;&nbsp;N&nbsp;&nbsp;&nbsp;D&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;T&nbsp;&nbsp;&nbsp;E&nbsp;&nbsp;&nbsp;C&nbsp;&nbsp;&nbsp;H
        </div>
      </div>
    </div>
  </div>


  <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js"
    integrity="sha384-C6RzsynM9kWDrMNeT87bh95OGNyZPhcTNXj1NW7RuBCsyN/o0jlpcV8Qyq46cDfL"
    crossorigin="anonymous"></script>

</body>

</html>