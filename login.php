<?php require_once('./config.php'); ?>
<?php require_once('./Controller/Login.php'); ?>
<?php
  $Login = new Login();
  $Response = [];
  $active = $Login->active;
  if (isset($_POST) && count($_POST) > 0) $Response = $Login->login($_POST);
?>
<!doctype html>
<html lang="en" data-bs-theme="auto">
<?php require('partials/head.php'); ?>
<body>
  <?php require('partials/nav.php'); ?>

  <main role="main" class="container">
    <div class="row justify-content-center mt-5">
      <div class="col-xs-12 col-sm-12 col-md-12 col-xl-4 col-lg-4 center-align center-block">
        <div class="card shadow-lg p-3 mb-5 bg-white rounded">
          <form method="post" action="" class="form-signin px-4 py-4">
            <svg class="logo mb-3 mt-3" width="75" height="75" viewBox="0 0 40 40" fill="none" xmlns="http://www.w3.org/2000/svg">
              <path class="custom" fill-rule="evenodd" clip-rule="evenodd" d="M10 0C15.5228 0 20 4.47715 20 10V0H30C35.5228 0 40 4.47715 40 10C40 15.5228 35.5228 20 30 20C35.5228 20 40 24.4772 40 30C40 32.7423 38.8961 35.2268 37.1085 37.0334L37.0711 37.0711L37.0379 37.1041C35.2309 38.8943 32.7446 40 30 40C27.2741 40 24.8029 38.9093 22.999 37.1405C22.9756 37.1175 22.9522 37.0943 22.9289 37.0711C22.907 37.0492 22.8852 37.0272 22.8635 37.0051C21.0924 35.2009 20 32.728 20 30C20 35.5228 15.5228 40 10 40C4.47715 40 0 35.5228 0 30V20H10C4.47715 20 0 15.5228 0 10C0 4.47715 4.47715 0 10 0ZM18 10C18 14.4183 14.4183 18 10 18V2C14.4183 2 18 5.58172 18 10ZM38 30C38 25.5817 34.4183 22 30 22C25.5817 22 22 25.5817 22 30H38ZM2 22V30C2 34.4183 5.58172 38 10 38C14.4183 38 18 34.4183 18 30V22H2ZM22 18V2L30 2C34.4183 2 38 5.58172 38 10C38 14.4183 34.4183 18 30 18H22Z" fill="#0d6efd"></path>
            </svg>
            <!-- <img class="mb-4" src="/docs/5.3/assets/brand/bootstrap-logo.svg" alt="" width="72" height="57"> -->
            <h1 class="h3 mb-3 fw-normal">Log In</h1>
            <div class="col-xs-12 col-sm-12 col-md-12 col-xl-12 col-lg-12 mt-4">
              <div class="form-floating">
                <input type="email" name="email" class="form-control" id="inputEmail" placeholder="name@example.com" required>
                <label for="inputEmail">Email address</label>
              </div>
            </div>
            <div class="col-xs-12 col-sm-12 col-md-12 col-xl-12 col-lg-12 mt-4">
              <div class="form-floating">
                <input type="password" name="password" class="form-control" id="floatingPassword" placeholder="Password" required>
                <label for="floatingPassword">Password</label>
              </div>
            </div>
            <div class="checkbox mt-3 mb-3">
              <label>
                <input type="checkbox" value="remember-me"> Remember me
              </label>
            </div>
            <div class="col-xs-12 col-sm-12 col-md-12 col-xl-12 col-lg-12 mt-4">
              <button class="w-100 btn btn-lg btn-primary" type="submit">Sign in</button>
            </div>
            <p class="mt-5 text-center mb-3 text-muted">Not a user? <a href="/registration">Sign Up</a></p>
          </form>
        </div>
      </div>
    </div>
  </main>


</body>

</html>