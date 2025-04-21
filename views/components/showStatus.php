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