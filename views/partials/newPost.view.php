<div class="col-lg-12 newpost">

    <!-- Title -->
    <h1>New post</h1>

    <!-- Newpost form -->
    <form action="" method="post" class="newpost-form">
        <?php include_once './views/components/showStatus.php' ?>
        <div class="form-group">
            <label for="subject">Subject</label>
            <input type="text" id="subject" name="subject" class="form-control">
        </div>

        <div class="form-group">
            <label for="content">Content</label>
            <textarea rows="5" id="content" name="content" class="form-control"></textarea>
        </div>

        <div class="form-group">
            <label for="content">Categoria</label>
            <ul>

            </ul>
            <?php
            foreach ($categories as $category) {
            ?>
                <li>
                    <input required="required" type="radio" value="<?= $category['Id'] ?>" name="category_id">
                    <label><?= $category['Name'] ?></label>
                </li>
            <?php
            }

            ?>
            <li>
                <input required="required" type="radio" value="<?= $category['Id'] + 1 ?>" name="category_id">
                <input type="text" placeholder="Nueva categoria" name="newCategory">
                <input type="hidden" value="<?= $category['Id'] ?>" name="lastCat">
            </li>
        </div>

        <button type="submit" class="btn btn-primary">Post</button>
    </form>
    <!-- /form -->
</div>