<?php
$template = new TemplateController();
?>
<div class="col-lg-2"></div>

<!-- Login content  -->
<div class="col-lg-8 login">

  <!-- Title -->
  <h1>Login</h1>

  <!-- Login form -->
  <form action="" method="post" class="login-form">

    <?php
    if (isset($status['errors'])) {
    ?>
      <div class="alert alert-danger" role="alert">
        <ul>
          <?php
          foreach ($status['errors'] as $key => $value) {
          ?>
            <li><?= $value ?></li>
          <?php
          }
          ?>
        </ul>
      </div>
    <?php
    } elseif (isset($status['success'])) {
    ?>
      <div class="alert alert-success" role="alert">
        <ul>
          <?php
          foreach ($status['success'] as $key => $value) {
          ?>
            <li><?= $value ?></li>
          <?php
          }
          ?>
        </ul>
      </div>
    <?php
    }
    ?>

    <div class="form-group">
      <label for="email">Email</label>
      <input type="text" id="email" name="email" class="form-control">
    </div>

    <div class="form-group">
      <label for="password">Password</label>
      <input type="password" id="password" name="password" class="form-control">
    </div>

    <button type="submit" class="btn btn-primary">Log in</button>
    <p>Don't have an account? <a href="<?= $template->baseUrl ?>signup">Sign Up Now</a></p>
  </form>
  <!-- /form -->
</div>

<div class="col-lg-2"></div>