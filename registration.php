<?php require_once('./config.php'); ?>
<?php require_once('./Controller/Register.php'); ?>
<?php
  $Register = new Register();
  $Response = [];
  $active = $Register->active;
  if (isset($_POST) && count($_POST) > 0) $Response = $Register->register($_POST);
?>
<!doctype html>
<html lang="en" data-bs-theme="auto">
<?php require('partials/head.php'); ?>
<body>
  <?php require('partials/nav.php'); ?>
  <main role="main" class="container">
    <div class="row justify-content-center mt-5">
      <div class="col-xs-12 col-sm-12 col-md-12 col-xl-4 col-lg-4 center-align center-block">
        <?php if (isset($Response['status']) && !$Response['status']) : ?>
          <br>
          <div class="alert alert-danger" role="alert">
            <span><B>Oops!</B> Some errors occurred in your form.</span>
            <button type="button" class="close" data-dismiss="alert" aria-label="Close">
              <span aria-hidden="true" class="text-danger">&times;</span>
            </button>
          </div>
        <?php endif; ?>
        <div class="card shadow-lg p-3 mb-5 bg-white rounded">
          <form method="post" action="" class="form-signin px-4 py-4">
            <h4 class="h3 mb-3 font-weight-normal text-center">Register</h4>
            <div class="col-xs-12 col-sm-12 col-md-12 col-xl-12 col-lg-12 mt-4">
              <div class="form-floating">
                <input type="text" id="inputName" class="form-control" placeholder="Enter Full Name" name="name" required autofocus value="<?php if (isset($_POST['name'])) echo $_POST['name']; ?>">
                <label for="inputName">Full Name</label>
                <?php if (isset($Response['name']) && !empty($Response['name'])) : ?>
                  <small class="text-danger"><?php echo $Response['name']; ?></small>
                <?php endif; ?>
              </div>
            </div>
            <div class="col-xs-12 col-sm-12 col-md-12 col-xl-12 col-lg-12 mt-4">
              <div class="form-floating">
                <input type="email" id="inputEmail" class="form-control" placeholder="Enter Email Address" name="email" required autofocus value="<?php if (isset($_POST['email'])) echo $_POST['email']; ?>">
                <label for="inputEmail">Email</label>
                <?php if (isset($Response['email']) && !empty($Response['email'])) : ?>
                  <small class="text-danger"><?php echo $Response['email']; ?></small>
                <?php endif; ?>
              </div>
            </div>
            <div class="col-xs-12 col-sm-12 col-md-12 col-xl-12 col-lg-12 mt-4">
              <div class="form-floating">
                <input type="password" name="password" id="inputPassword" class="form-control" placeholder="Password" required>
                <label for="inputPassword">Password</label>
                <?php if (isset($Response['password']) && !empty($Response['password'])) : ?>
                  <small class="text-danger"><?php echo $Response['password']; ?></small>
                <?php endif; ?>
              </div>
            </div>
            <div class="col-xs-12 col-sm-12 col-md-12 col-xl-12 col-lg-12 mt-4">
              <div class="form-floating">
                <input type="password" name="passwordRepeat" id="passwordRepeat" class="form-control" placeholder="Repeat Password" required>
                <label for="passwordRepeat">Repeat Password</label>
                <?php if (isset($Response['repeat']) && !empty($Response['repeat'])) : ?>
                  <small class="text-danger"><?php echo $Response['repeat']; ?></small>
                <?php endif; ?>
              </div>
            </div>
            <div class="col-xs-12 col-sm-12 col-md-12 col-xl-12 col-lg-12 mt-4">
              <button class="btn btn-md btn-primary btn-block" type="submit">Register</button>
            </div>
            <p class="mt-5 text-center mb-3 text-muted">Already a user? <a href="/login">Log In</a></p>
          </form>
        </div>
      </div>
    </div>
  </main>
</body>

</html>