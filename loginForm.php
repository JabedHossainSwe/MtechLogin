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