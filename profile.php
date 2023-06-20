<?php require_once('./config.php'); ?>
<?php require_once('./Controller/Profile.php'); ?>
<?php
  $Profile = new Profile();
  $Response = [];
  $active = $Profile->active;
  $UserData = $Profile->getUser();
  if (isset($_POST['profile_edit']) && count($_POST) > 0) $Response = $Profile->editUser($_POST);
  if (isset($_POST['reset_password']) && count($_POST) > 0) $Response = $Profile->changePassword($_POST);

 
?>
<!doctype html>
<html lang="en" data-bs-theme="auto">
<?php require('partials/head.php'); ?>
<body>
  <?php require('partials/nav.php'); ?>
  <main role="main" class="container">
    <div class="row justify-content-center mt-5">
      <?php if (isset($_GET['updated'])): ?>
        <div class="alert alert-info alert-dismissible fade show" role="alert">
          Your user profile has been updated !
          <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
        </div>
      <?php endif;  ?>
      <div class="col-xs-12 col-sm-12 col-md-12 col-xl-4 col-lg-4 center-align center-block">
        <?php if (isset($Response['status']) && !$Response['status']) : ?>
          <br>
          <div class="alert alert-danger alert-dismissible fade show" role="alert">
          Some errors occurred in your form
            <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
          </div>
        <?php endif; ?>
        <div class="card shadow-lg p-3 mb-5 bg-white rounded">
          <form method="post" action="" class="form-signin px-4 py-4">
            <h4 class="h3 mb-3 font-weight-normal text-center">Edit Profile</h4>
            <div class="col-xs-12 col-sm-12 col-md-12 col-xl-12 col-lg-12 mt-4">
              <div class="form-floating">
                <input type="text" id="name" class="form-control" placeholder="Full Name" name="name" required autofocus value="<?php echo $UserData['data']['name']; ?>">
                <label for="name">Full Name</label>
                <?php if (isset($Response['name']) && !empty($Response['name'])) : ?>
                  <small class="text-danger"><?php echo $Response['name']; ?></small>
                <?php endif; ?>
              </div>
            </div>
            <div class="col-xs-12 col-sm-12 col-md-12 col-xl-12 col-lg-12 mt-4">
              <div class="form-floating">
                <input type="email" id="inputEmail" class="form-control" placeholder="Email Address" name="email" required autofocus value="<?php echo $UserData['data']['email']; ?>">
                <label for="inputEmail">Email Address</label>
                <?php if (isset($Response['email']) && !empty($Response['email'])) : ?>
                  <small class="text-danger"><?php echo $Response['email']; ?></small>
                <?php endif; ?>
              </div>
            </div>
            <div class="col-xs-12 col-sm-12 col-md-12 col-xl-12 col-lg-12 mt-4">
              <button class="btn btn-md btn-primary btn-block" type="submit" name="profile_edit">Update</button>
            </div>
          </form>
        </div>
        <div class="card shadow-lg p-3 mb-5 bg-white rounded">
          <form method="post" action="" class="form-signin px-4 py-4">
            <h4 class="h3 mb-3 font-weight-normal text-center">Change Password</h4>
            <div class="col-xs-12 col-sm-12 col-md-12 col-xl-12 col-lg-12 mt-4">
              <div class="form-floating">
                <input type="password" id="password" class="form-control" placeholder="New Password" name="password" required>
                <label for="password">New Password</label>
                <?php if (isset($Response['password']) && !empty($Response['password'])) : ?>
                  <small class="text-danger"><?php echo $Response['password']; ?></small>
                <?php endif; ?>
              </div>
            </div>
            <div class="col-xs-12 col-sm-12 col-md-12 col-xl-12 col-lg-12 mt-4">
              <div class="form-floating">
                <input type="password" id="passwordRepeat" class="form-control" placeholder="Repeat Password" name="passwordRepeat" required>
                <label for="passwordRepeat">Repeat Password</label>
                <?php if (isset($Response['passwordRepeat']) && !empty($Response['passwordRepeat'])) : ?>
                  <small class="text-danger"><?php echo $Response['passwordRepeat']; ?></small>
                <?php endif; ?>
              </div>
            </div>
       
            <div class="col-xs-12 col-sm-12 col-md-12 col-xl-12 col-lg-12 mt-4">
              <button class="btn btn-md btn-primary btn-block" type="submit" name="reset_password">Change</button>
            </div>
          </form>
        </div>
      </div>
    </div>
  </main>
</body>

</html>