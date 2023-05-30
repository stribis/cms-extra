<?php require_once('./config.php'); ?>
<?php require_once('Controller/Dashboard.php'); ?>
<?php
  $Dashboard = new Dashboard();
  // $Response = [];
  $active = $Dashboard->active;
  $Posts = $Dashboard->getPosts($_SESSION['data']['id']);
  if (isset($_GET['delete'])) $Dashboard->deletePost($_GET['delete']);
?>
<!doctype html>
<html lang="en" data-bs-theme="auto">
<?php require('partials/head.php'); ?>
<body>
  <?php require('partials/nav.php'); ?>

  <main>

    <section class="py-5 text-center container banner">
      <div class="row py-lg-5">
        <div class="col-lg-6 col-md-8 mx-auto">
          <h1 class="text-body-light">Dashboard</h1>
          <p class="lead text-body-light">Create and manage posts for the community Board.</p>
          <a href="/post/create" class="btn btn-primary my-2">Create Post</a>
        </div>
      </div>
    </section>
    
    <div class="container">
    
    <div class="row">
      <h2 class="my-4 text-center col-xs-12 col-sm-12 col-md-12 col-xl-12 col-lg-12">Your Posts</h2>
      <?php if (isset($_GET['deleted'])): ?>
        <div class="alert alert-danger alert-dismissible fade show" role="alert">
          Your post has been deleted!
          <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
        </div>
      <?php elseif (isset($_GET['created'])): ?>
        <div class="alert alert-success alert-dismissible fade show" role="alert">
          Your post has been created!
          <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
        </div>
      <?php elseif (isset($_GET['updated'])): ?>
        <div class="alert alert-info alert-dismissible fade show" role="alert">
          Your post has been updated!
          <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
        </div>
      <?php endif;  ?>
      <?php if ($Posts['status']) : ?>
        <?php foreach ($Posts['data'] as $post) :  ?>
          <div class="col-xs-12 col-sm-12 col-md-12 col-xl-4 col-lg-4">
            <div class="card shadow-lg p-3 mb-5 bg-white rounded">
              <div class="post-image w-50 mx-auto">
                <img class="img-thumbnail" src="<?= BASE_URL;?>uploads/<?= $post['image'];?>" alt="<?= $post['title']; ?>">
              </div>
              <div class="post_title my-3">
                <h3><?php echo ucwords($post['title']); ?></h3>
              </div>
              <div class="post_body">
                <p><?php echo $post['content']; ?></p>
                <a href="<?= BASE_URL ?>post/edit.php?id=<?= $post['id'] ?>" class="btn btn-primary">Edit</a>
                <a href="?delete=<?=$post['id']; ?>" class="btn btn-danger">Delete</a>
              </div>
            </div>
          </div>
        <?php endforeach; ?>
      <?php endif;  ?>
      </div>
    </div>

  </main>

  <?php require('partials/footer.php'); ?>


</body>

</html>