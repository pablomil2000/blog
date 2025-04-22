<div class="col-md-12">
  <!-- Third Blog Post -->
  <?php
  if ($posts != []) {
    foreach ($posts as $key => $post) {
  ?>
      <div class="post">
        <h2 class="post-title">
          <a href="post.html"><?= $post['Name'] ?></a>
        </h2>
        <p class="lead">
          by <?= $post['Author_id'] ?>
        </p>
        <p><span class="glyphicon glyphicon-time"></span> Posted on <?= $post['Creation'] ?></p>
        <p><?= $post['Content'] ?></p>
        <a class="btn btn-default" href="post.html">Read More</a>
      </div>
    <?php
    }
  } else {
    ?>
    <div class="post">
      <h2 class="post-title">
        <a href="post.html">No hay posts disponibles</a>
      </h2>
    </div>
  <?php
  }
  ?>

  <!-- Pager -->
  <ul class="pager">
    <li class="previous">
      <a href="<?= $postsCtrl->getPaginationLink($template->baseUrl . 'home', $page - 1) ?>">Prev</a>
    </li>

    <li class="next">
      <a href="<?= $postsCtrl->getPaginationLink($template->baseUrl . 'home', $page + 1) ?>">Next</a>
    </li>
  </ul>

</div>