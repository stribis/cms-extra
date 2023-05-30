<?php require_once('../config.php'); ?>
<?php require_once('../Controller/Dashboard.php'); ?>
<?php
  $Dashboard = new Dashboard();
  $Response = [];
  $active = $Dashboard->active;
  $Post = $Dashboard->getPost($_GET['id']);
?>
<!doctype html>
<html lang="en" data-bs-theme="auto">
<?php require('../partials/head.php'); ?>
<body>
  <?php require('../partials/nav.php'); ?>
  <main role="main" class="container">
  <section class="py-5">
    <div class="container px-4 px-lg-5 my-5">
      <div class="row gx-4 gx-lg-5 align-items-center">
        <div class="col-md-6"><img class="card-img-top mb-5 mb-md-0" src="../uploads/<?= $Post['data']['image'] ?>" alt="<?= $Post['data']['title'] ?>" /></div>
        <div class="col-md-6">
          <div class="small mb-1">Posted on <?= date("d.m.Y", strtotime($Post['data']['date_posted'])); ?> at <?= date("H:m:s", strtotime($Post['data']['date_posted'])); ?></div>
          <h1 class="display-5 fw-bolder"><?= $Post['data']['title'] ?></h1>
          <p class="lead"><?= nl2br($Post['data']['content']); ?></p>
          <div class="d-flex">
            <p>The original poster has left the following contact address: <a href="mailto:<?= $Post['data']['contact']; ?>"><?=$Post['data']['contact'] ?></a></p>
          </div>
        </div>
      </div>
    </div>
    </section>
  </main>
  <?php require('../partials/footer.php'); ?>
</body>

</html>