<?php require_once('../config.php'); ?>
<?php require_once('../Controller/Dashboard.php'); ?>
<?php
$Dashboard = new Dashboard();
$Response = [];
$active = $Dashboard->active;
if (isset($_POST) && count($_POST) > 0 && isset($_FILES)) $Response = $Dashboard->createPost($_POST, $_FILES);
?>
<!doctype html>
<html lang="en" data-bs-theme="auto">
<?php require('../partials/head.php'); ?>

<body>
  <?php require('../partials/nav.php'); ?>
  <main role="main" class="container">
    <div class="row justify-content-center mt-5">
      <div class="col-xs-12 col-sm-12 col-md-12 col-xl-4 col-lg-4 center-align center-block">
        <?php if (isset($Response['status']) && !$Response['status']) : ?>
          <br>
          <div class="alert alert-danger alert-dismissible fade show" role="alert">
            Some errors occurred in your form
            <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
          </div>
        <?php endif; ?>
        <div class="card shadow-lg p-3 mb-5 bg-white rounded">
          <form method="post" action="" class="form-signin px-4 py-4" enctype="multipart/form-data">
            <h4 class="h3 mb-3 font-weight-normal text-center">Create Post</h4>
            <div class="col-xs-12 col-sm-12 col-md-12 col-xl-12 col-lg-12 mt-4">
              <div class="form-floating">
                <input type="text" id="title" class="form-control" placeholder="Enter Post Title" name="title" required autofocus value="<?php if (isset($_POST['title'])) echo $_POST['title']; ?>">
                <label for="title">Post Title</label>
                <?php if (isset($Response['title']) && !empty($Response['title'])) : ?>
                  <small class="text-danger"><?php echo $Response['title']; ?></small>
                <?php endif; ?>
              </div>
            </div>
            <div class="col-xs-12 col-sm-12 col-md-12 col-xl-12 col-lg-12 mt-4">
              <div class="form-floating">
                <input type="email" id="inputEmail" class="form-control" placeholder="Prefered Contact Address" name="email" required autofocus value="<?= (isset($_POST['email'])) ? $_POST['email'] : $_SESSION['data']['email']; ?>">
                <label for="inputEmail">Prefered Contact Address</label>
                <?php if (isset($Response['email']) && !empty($Response['email'])) : ?>
                  <small class="text-danger"><?php echo $Response['email']; ?></small>
                <?php endif; ?>
              </div>
            </div>
            <div class="col-xs-12 col-sm-12 col-md-12 col-xl-12 col-lg-12 mt-4">
              <div class="form-floating">
                <textarea name="message" id="message" class="form-control" placeholder="Your Message" required style="height:200px;"></textarea>
                <label for="message">Message</label>
                <?php if (isset($Response['message']) && !empty($Response['message'])) : ?>
                  <small class="form-text text-danger"><?php echo $Response['message']; ?></small>
                <?php endif; ?>
              </div>
            </div>
            <div class="col-xs-12 col-sm-12 col-md-12 col-xl-12 col-lg-12 mt-4">
              <div class="form-floating">
                <input type="file" name="image" id="image" class="form-control" placeholder="Post Image" required autofocus>
                <label for="image">Post Image</label>
                <?php if (isset($Response['image']) && !empty($Response['image'])) : ?>
                  <small class="form-text text-danger"><?php echo $Response['image']; ?></small>
                <?php endif; ?>
              </div>
            </div>
            <div class="col-xs-12 col-sm-12 col-md-12 col-xl-12 col-lg-12 mt-4">
              <button class="btn btn-md btn-primary btn-block" type="submit">Create</button>
            </div>
          </form>
        </div>
      </div>
    </div>
  </main>
</body>

</html>