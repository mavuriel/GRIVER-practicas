<?php

foreach ($items[$indice][$sindice] as $k => $v) {
    if ($k == "nombre") {
?>
        <p class="text-warning fw-bold">
            Nombre: <small class="text-secondary"><?php echo $v; ?></small>
        </p>
    <?php
    } else if ($k == "desc") {
    ?>
        <p class="text-warning fw-bold">
            Descripcion: <small class="text-secondary"><?php echo $v; ?></small>
        </p>
    <?php
    } else if ($k == "nivel") {
    ?>
        <p class="text-warning fw-bold">
            Nivel: <small class="text-secondary"><?php echo $v; ?></small>
        </p>
<?php
    }
}
?>