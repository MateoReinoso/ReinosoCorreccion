<?php
    include "service/conexion.php";

?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <?php include "includes/scripts.php"; ?>
    <title>Lista Modulos</title>
</head>

<body>
    <?php include "includes/header.php"; ?>
    <section id="container">
        <h1>Lista de Modulos</h1>
        <hr>
        <a href="registro_modulo.php" class="btn_new">Crear Modulo</a>
        <hr>
        <table>
            <tr>
                <th>CODIGO MODULO</th>
                <th>NOMBRE</th>
                <th>ESTADO</th>
                <th>ACCIONES</th>
            </tr>

            <?php 
                $est = 'ACT';
                $query = mysqli_query($conection, "SELECT * FROM seg_modulo WHERE ESTADO='$est'");

                $result  = mysqli_num_rows($query);

                if ($result > 0) {
                    while ($data = mysqli_fetch_array($query)) {
                    ?>
                        <tr>
                            <td><?php echo $data['COD_MODULO'] ?></td>
                            <td><?php echo $data['NOMBRE'] ?></td>
                            <td><?php echo $data['ESTADO'] ?></td>
                            <td>
                                <a class="material-icons" class="link_delete" href="eliminar_modulo.php?id=<?php echo $data['COD_MODULO'] ?>">ELIMINAR</a>
                            </td>
                            
                        </tr>
                        <?php 
                    }
                }
            ?>


        </table>


    </section>

    <?php include "includes/footer.php"; ?>
</body>

</html>