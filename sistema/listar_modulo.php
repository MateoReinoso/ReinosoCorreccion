<?php 

include './service/moduloService.php';
session_start();

$nombre = "";
$estado = "";
$codModulo = "";
$accion = "Agregar";
$eliminarMod = "Eliminar";
$moduloService = new ModuloService();

if (isset($_POST["accion"]) && ($_POST["accion"] == "Agregar")) {
    $moduloService->insert($_POST["codModulo"], $_POST["nombre"], $_POST["estado"]);
} 
else if (isset($_POST["accion"]) && ($_POST["accion"] == "Modificar")) {
    $moduloService->update($_POST["nombre"],$_POST["estado"],$_POST["codModulo"]);
} 
else if (isset($_GET["update"])) {
    $modulo = $moduloService->findByPK($_GET["update"]);
    if ($modulo!=null){
        $codModulo = $modulo["COD_MODULO"];
        $nombre = $modulo["NOMBRE"];
        $estado = $modulo["ESTADO"];
        $accion = "Modificar";
    }
} 
else if (isset($_POST["eliminarMod"])) {
    $moduloService->delete($_POST["eliminarMod"]);
}
$result = $moduloService->findAll();

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
    <div id="content-wrapper" class="d-flex flex-column">
        <div class="card-body">
        <br>
        <br>
        <H1>Agregar Modulo</H1>
            <div class="table-responsive">
                <form name="forma" id="forma" method="post" action="registro_modulo.php">
        
                    <table border="1" id="t01" class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
                
                        <tr>
                            <th class="text-center">CODIGO MODULO</th>
                            <th class="text-center">NOMBRE</th>
                            <th class="text-center">ESTADO</th>
                        </tr>
                        <?php
                    
                    if ($result->num_rows > 0) {
                        while ($row = $result->fetch_assoc()) {
                    ?>

                        <tr>
                            <td class="text-center"><a
                                    href="index.php?update=<?php echo $row["COD_MODULO"]; ?>"><?php echo $row["COD_MODULO"]; ?></a>
                            </td>
                            <td class="text-center"><?php echo $row["NOMBRE"]; ?></td>
                            <td class="text-center"><?php echo $row["ESTADO"]; ?></td>
                        </tr>
                        <?php
                        }
                    } 
                    else { ?>
                        <tr>
                            <td colspan="4" class="text-center">NO HAY DATOS</td>
                        </tr>
                        <?php } ?>
                    </table>
                   
                </form>
            </div>
        </div>
    </div>

    <?php include "includes/footer.php"; ?>
</body>

</html>