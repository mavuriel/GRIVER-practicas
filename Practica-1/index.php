<?php include('./template/header.php'); ?>
<?php include('./items.php'); ?>
<?php
$valitem = (isset($_POST['valor'])) ? $_POST['valor'] : "";
$busq = (isset($_POST['busqueda'])) ? $_POST['busqueda'] : "";
$indice = $valitem <= 3 ? 0 : ($valitem <= 6 && $valitem > 3 ? 1 : 2);
$sindice = in_array($valitem, $uno) ? 0 : (in_array($valitem, $dos) ? 1 : 2);

?>
<form method="POST">
    <?php
    if (isset($_POST['busqueda'])) {
        $error = [];
        if (empty($busq)) {
            array_push($error, 'Campo vacio, se mostraran todos los items');
        }
        if (count($error) > 0) {
            echo '<ul>';
            foreach ($error as $e) {
                echo "<small class='text-primary fw-light'> $e </small>";
            }
            echo '</ul>';
            foreach ($items as $i) {
                foreach ($i as $cat) {
                    $c++;
    ?>
                    <button type="submit" class="btn btn-outline-light" name="valor" value="<?php echo $c ?>">
                        <img class="icon" src="./assets/img/espada1.svg">
                    </button>
                <?php
                }
            }
        } else {
        }
    } else {
        foreach ($items as $i) {
            foreach ($i as $cat) {
                $c++;
                ?>
                <button type="submit" class="btn btn-outline-light" name="valor" value="<?php echo $c ?>">
                    <img class="icon" src="./assets/img/espada1.svg">
                </button>
    <?php
            }
        }
    }
    ?>
</form>
</div><!-- Contenedor de item -->
<div class="col">

    <?php include('./pdatos.php') ?>

</div><!-- Contenedor de datos -->

<?php include('./template/footer.php') ?>