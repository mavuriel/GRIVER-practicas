<?php include('./template/header.php'); ?>
<?php include('./items.php'); ?>
<?php
$sindice = (isset($_POST['valor'])) ? $_POST['valor'] : "";

$indice = 1; ?>
<form method="POST">
    <?php
    $c = 0;
    foreach ($items[2] as $i) {
    ?>
        <button type="submit" class="btn btn-outline-light" name="valor" value="<?php echo $c ?>">
            <img class="icon" src="./assets/img/espada1.svg">
        </button>
    <?php
        $c++;
    }
    ?>
</form>
</div><!-- Contenedor de item -->

<div class="col">
    <?php include('./pdatos.php') ?>
</div><!-- Contenedor de datos -->

<?php include('./template/footer.php') ?>