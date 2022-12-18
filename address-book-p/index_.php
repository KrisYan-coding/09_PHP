<!-- model $ controller -->
<?php
require './parts/connect_db.php'

?>

<!-- view -->
<?php require './parts/html-head.php'; ?>
<?php require './parts/html-navbar.php'; ?>

<div class="container">
    <div class="row">
        <div class="col">
            <h2>index_.html</h2>
            <?php
            echo strlen('1234567890');
            echo '<br>';
            
            echo strlen('abcdefghijklmnopqrstuvwxyz');
            echo '<br>';

            echo strlen('嗨');
            echo '<br>';
            
            echo strlen('你好');
            echo '<br>';
            
            echo mb_strlen('嗨');
            echo '<br>';
            
            echo mb_strlen('你好');
            echo '<br>';
            // strlen() returns the number of bytes rather than the number of characters in a string.
            ?>
        </div>
    </div>
</div>

<?php require './parts/html-scripts.php'; ?>
<?php require './parts/html-foot.php'; ?>