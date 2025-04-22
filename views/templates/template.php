<!DOCTYPE html>
<html lang="es">

<head>

  <meta charset="utf-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <meta name="description" content="">
  <meta name="author" content="Pablo Martin Lopez">

  <title>SimpleBlogPHP</title>

  <?php
  include_once './views/templates/modules/links.php';
  ?>

</head>

<body>
  <?php include './views/templates/modules/header.php'; ?>

  <div class="container">
    <div class="row">
      <?php
      $template = new TemplateController();
      $template->whitelist(
        'signup',
        'login',
        'logout',
        'newPost',
        'post'
      );
      ?>
    </div>
  </div>

  <footer>
    <div class="container">
      <div class="row">
        <div class="col-lg-12">
          <p>Copyright &copy; Pablo Martín López - Blog <?= date('Y') ?></p>
        </div>
        <!-- /.col-lg-12 -->
      </div>
      <!-- /.row -->
    </div>
  </footer>

  <!-- Bootstrap Bundle with Popper -->
  <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js"></script>
</body>

</html>