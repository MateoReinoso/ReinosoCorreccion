<?php 
    if (!empty($_POST)) {
        $alert='';
        if (empty($_POST['COD_MODULO']) || empty($_POST['NOMBRE']) || empty($_POST['ESTADO'])) {
            $alert='<p class="msg_error">Campos incompletos</p>';
        }else {
            include "../conexion.php";
            $codmodulo = $_POST['COD_MODULO'];
            $name = $_POST['NOMBRE'];
            $est = $_POST['ESTADO'];

            //echo "SELECT * FROM seg_nodulo WHERE COD_MODULO = '$codmodulo' OR ESTADO = '$est'";
            $query = mysqli_query($conection, "SELECT * FROM seg_modulo WHERE COD_MODULO = '$codmodulo'");
            $result = mysqli_fetch_array($query);
            if ($result > 0) {
                $alert='<p class="msg_error">El codigo de modulo ya existe</p>';
            }else {
                $query_insert = mysqli_query($conection, "INSERT INTO seg_modulo (COD_MODULO, NOMBRE, ESTADO) VALUES 
                                                            ('$codmodulo', '$name', '$est')");
                if ($query_insert) {
                    $alert='<p class="msg_save">Registro Exitoso</p>';
                }else {
                    $alert='<p class="msg_error">Fallo en el registro</p>';
                }
            }
        }
    }
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <?php include "includes/scripts.php"; ?>
    <title>Correccion Examen</title>
</head>

<body>
    <?php include "includes/header.php"; ?>
    <section id="container">
        <div class="from_register">
            <h1>Registro Modulo </h1>
        </div>
        <hr>
        <div class="alert"> <?php echo isset($alert) ? $alert : ''; ?> </div>

        <form action="" method="post">
            <label for="COD_MODULO">Codigo del Modulo</label>
            <input type="text" name="COD_MODULO" id="COD_MODULO" placeholder="Codigo Modulo">
            <label for="NOMBRE">Nombre</label>
            <input type="text" name="NOMBRE" id="NOMBRE" placeholder="Nombre">
            <label for="ESTADO">Estado Modulo</label>
            <input type="text" name="ESTADO" id="ESTADO" placeholder="Estado">
            <input type="submit" value="Crear Usuario" class="btn_save">
        </form>
    </section>

    <?php include "includes/footer.php"; ?>
</body>

</html>