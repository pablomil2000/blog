<?php
$template = new TemplateController();
?>
<div class="col-lg-2"></div>

<!-- Signup content  -->
<div class="col-lg-8 signup">

  <!-- Title -->
  <h1>Sign up</h1>

  <!-- Login form -->
  <form action="" method="post" class="signup-form">

    <?php include_once './views/components/showStatus.php' ?>

    <div class="form-group">
      <label for="username">Username</label>
      <input type="text" id="username" name="username" class="form-control">
    </div>

    <div class="form-group">
      <label for="username">Email</label>
      <input type="email" id="email" name="email" class="form-control">
    </div>

    <div class="form-group">
      <label for="password">Password</label>
      <input type="password" id="password" name="password" class="form-control">
    </div>

    <div class="form-group">
      <label for="password">Password Confirmation</label>
      <input type="password" id="confirmation" name="confirmation" class="form-control">
    </div>


    <button type="submit" class="btn btn-primary">Sign up</button>
    <p>Already have an account? <a href="<?= $template->baseUrl ?>login">Login Now</a></p>
  </form>
  <!-- /form -->
</div>

<div class="col-lg-2"></div>