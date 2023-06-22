<?php require_once('./config.php'); ?>
<?php require_once('./Controller/Home.php'); ?>
<?php
$Home = new Home();
$active = $Home->active;
$Posts = $Home->getPosts();
?>
<!doctype html>
<html lang="en" data-bs-theme="auto">
<?php require('./partials/head.php'); ?>

<body>
  <?php require('./partials/nav.php'); ?>

  <main>
    <section class="py-5 text-center container banner">
      <div class="row py-lg-5">
        <div class="col-lg-6 col-md-8 mx-auto">
          <?php if (!isset($_SESSION['auth_status'])) : ?>
            <h1 class="">Community Board</h1>
            <p class="lead text-body-secondary">Discover, Connect, and Find What You Seek! Welcome to our vibrant community board, your gateway to fulfilling desires. Hunt for treasures, find trusted services, and connect with like-minded individuals. Explore, share, and make your dreams a reality.</p>
            <p>
              <a href="/registration" class="btn btn-primary my-2">Join Now!</a>
              <a href="/login" class="btn btn-outline-dark my-2">Log In</a>
            </p>
          <?php elseif (isset($_SESSION['auth_status'])) : ?>
            <h1 class="">Welcome</h1>
            <p class="lead text-body-secondary"> <?= $_SESSION['data']['name'] ?></p>
            <p>
              <a href="/dashboard" class="btn btn-primary my-2">Dashboard</a>
            </p>
          <?php endif; ?>
        </div>
      </div>
    </section>

    <div class="album py-5 bg-body-tertiary">
      <div class="container">
        <div class="row row-cols-1 row-cols-sm-2 row-cols-md-3 g-3">
          <?php if ($Posts['status']) : ?>
            <?php foreach ($Posts['data'] as $post) :  ?>
              <div class="col">
                <div class="card shadow-sm">
                  <div class="img-container mw-100" style="height:200px; overflow-y:hidden;">
                    <img class="mw-100" src="uploads/<?= $post['image'] ?>" alt="<?= $post['title'] ?>">
                  </div>
                  <div class="card-body">
                    <h3><?= $post['title'] ?></h3>
                    <p class="card-text"><?= substr($post['content'], 0, 30) ?>...</p>
                    <div class="d-flex justify-content-between align-items-center">
                      <div class="btn-group">
                        <a href="/post/read.php?id=<?= $post['id'] ?>" class="btn btn-outline-primary">View</a>
                      </div>
                      <small class="text-body-secondary"><?= (date('Ymd') == date('Ymd', strtotime($post['date_posted']))) ? 'Today' : date("d.m.Y", strtotime($post['date_posted'])) ?></small>
                    </div>
                  </div>
                </div>
              </div>
            <?php endforeach; ?>
          <?php endif;  ?>
        </div>
      </div>
    </div>

  </main>

  <?php require('./partials/footer.php'); ?>


</body>

</html>