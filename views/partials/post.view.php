<div class="col-lg-12">

    <!-- Blog Post -->

    <!-- Title -->
    <h1 class="post-title"><?= $post['Name'] ?></h1>

    <!-- Author -->
    <p class="lead">
        <?= $postsCtrl->getCategory($post['Category_id']) ?>
    </p>
    <p class="lead">
        by <?= $postsCtrl->getAuthor($post['Author_id']); ?>
    </p>
    <p>
        <?php
        // var_dump($_SESSION);
        if (isset($_SESSION['user'])) {
            if ($_SESSION['user']['Role_id'] == 1 || ($_SESSION['user']['Role_id'] == 2 && $_SESSION['user']['id'] == $post['Author_id'])) {
        ?>
                <a href="<?= $template->baseUrl . 'post/' . $post['Slug'] ?>/edit">Editar</a>
            <?php
            }

            if ($_SESSION['user']['Role_id'] == 1) {
            ?>
                <a href="<?= $template->baseUrl . 'post/' . $post['Slug'] ?>/delete">Delete</a>
        <?php
            }
        }

        ?>
    </p>

    <hr>

    <!-- Date/Time -->
    <p><span class="glyphicon glyphicon-time"></span> Posted on <?= UtilsController::formatDate($post['Creation'], 'd-M-y H:M') ?></p>

    <hr>

    <?= $post['Content'] ?>

    <hr>
    <!-- Blog Comments -->

    <!-- Comments Form -->
    <div class="well">
        <h4>Leave a Comment:</h4>
        <form role="form">
            <div class="form-group">
                <textarea class="form-control" rows="3"></textarea>
            </div>
            <button type="submit" class="btn btn-primary">Submit</button>
        </form>
    </div>

    <hr>

    <!-- Posted Comments -->

    <!-- Comment -->
    <div class="media">
        <a class="pull-left" href="#">
            <img class="media-object" src="http://placehold.it/64x64" alt="">
        </a>
        <div class="media-body">
            <h4 class="media-heading">Start Bootstrap
                <small>August 25, 2014 at 9:30 PM</small>
            </h4>
            Cras sit amet nibh libero, in gravida nulla. Nulla vel metus scelerisque ante sollicitudin commodo. Cras
            purus odio, vestibulum in vulputate at, tempus viverra turpis. Fusce condimentum nunc ac nisi vulputate
            fringilla. Donec lacinia congue felis in faucibus.
        </div>
    </div>
</div>

</div>