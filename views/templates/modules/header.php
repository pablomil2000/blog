<?php
$template = new TemplateController();
?>
<nav class="navbar navbar-inverse navbar-fixed-top" role="navigation">
  <div class="container">
    <!-- Brand and toggle get grouped for better mobile display -->
    <div class="navbar-header">
      <button type="button" class="navbar-toggle" data-toggle="collapse" data-target="#bs-example-navbar-collapse-1">
        <span class="sr-only">Toggle navigation</span>
        <span class="icon-bar"></span>
        <span class="icon-bar"></span>
        <span class="icon-bar"></span>
      </button>
      <a class="navbar-brand" href="<?= $template->baseUrl ?>">Simple Blog</a>
    </div>
    <!-- Collect the nav links, forms, and other content for toggling -->
    <div class="collapse navbar-collapse" id="bs-example-navbar-collapse-1">
      <ul class="nav navbar-nav navbar-right">


        <li>
          <a href="<?= $template->baseUrl ?>about">About</a>
        </li>
        <?php
        if (isset($_SESSION['user'])) {
          if ($_SESSION['user']['Role_id'] == 1) {
        ?>
            <li>
              <a href="<?= $template->baseUrl ?>newPost">Nuevo post</a>
            </li>
          <?php
          }
          ?>



          <li>
            <a href="#profilePage">
              <?= $_SESSION['user']['Name'] ?>
            </a>
          </li>

          <li>
            <a href="<?= $template->baseUrl ?>logout">Logout</a>
          </li>
        <?php
        } else {
        ?>
          <li>
            <a href="<?= $template->baseUrl ?>login">Login</a>
          </li>
          <li>
            <a href="<?= $template->baseUrl ?>signup">Sign up</a>
          </li>
        <?php
        }
        ?>
      </ul>
    </div>
    <!-- /.navbar-collapse -->
  </div>
  <!-- /.container -->
</nav>