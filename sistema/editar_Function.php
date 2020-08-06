<?php
include './service/moduloService.php';
session_start();

$nombre = "";
$url = "";
$modulo="";
$codModulo = "";
$codFuncionalidad ="";
$descripcion = "";
$accion = "Agregar";
$eliminarMod = "Eliminar";
$moduloService = new ModuloService();

if (isset($_POST["accion"]) && ($_POST["accion"] == "Modificar")) {
    $moduloService->updateFun($_POST["nombre"],$_POST["url"], $_POST["descripcion"], $_POST["codFuncionalidad"]);
} 
else if (isset($_GET["update"])) {
    $modulo = $moduloService->findByPKFun($_GET["update"]);
    if ($modulo!=null){
        $codFuncionalidad =$modulo["COD_FUNCIONALIDAD"];
        $nombre = $modulo["NOMBRE"];
        $url = $modulo["URL_PRINCIPAL"];
        $descripcion = $modulo["DESCRIPCION"];
        $accion = "Modificar";
    }
} 

$result = $moduloService->findAll();

?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <?php include "includes/scripts.php"; ?>
    <title>Sisteme Ventas</title>
</head>

<body>
    <?php include "includes/header.php"; ?>
    <div id="wrapper">
       

        <div id="content-wrapper" class="d-flex flex-column">
            <div class="card-body">
                
                <div class="table-responsive">
                    <form name="forma" id="forma" method="post" action="editar_Funcionalidad.php">
                        
                        <br>
                        <table border="1" id="t01"  class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
                            <br>
                            <br>
                            <br>
                            <tr>
                                <th class="text-center">NOMBRE</th>
                                <th class="text-center">URL</th>
                                <th class="text-center">DESCRIPCION</th>
                            </tr>
                            <?php
                            $res = $moduloService->findByPKFun2($_GET['update']);                           
                                if($res->num_rows>0){
                                    while($row1 = $res->fetch_assoc()) {
                            ?>                            
                            <!-- IMPRESIÓN DE LA TABLA CON LOS DATOS DESDE LA BASE -->
                                    <tr>
                                        <td class="text-center"><?php echo $row1["NOMBRE"]; ?></td>
                                        <td class="text-center"><?php echo $row1["URL_PRINCIPAL"]; ?></td>
                                        <td class="text-center"><?php echo $row1["DESCRIPCION"]; ?></td>
                                    </tr>
                                <?php
                                } ?>
                                <input type="hidden" name="codFuncionalidad" value="<?php echo $codFuncionalidad ?>">
                                    <!-- CAMPOS PARA NUEVO MODULO -->
                                    <table border="0">
                                        <tr>
                                            <td colspan=2 class="text-primary"><h1>Modificar Datos</h1></td>
                                        </tr>
                                        <tr>
                                            <td><label id="lblModulo" for="nombre">Nombre: </label></td>
                                            <td><input type="text" name="nombre" id="nombre" value="<?php echo $nombre ?>" size="25" ></td>
                                        </tr>
                                        <tr>
                                            <td><label id="lblNombre" for="url">URL: </label></td>
                                            <td><input type="text" name="url" id="url" value="<?php echo $url ?>" maxlength="100" size="25" ></td>
                                        </tr>
                                        <tr>
                                            <td><label id="lblEstado" for="descripcion">DESCRIPCION: </label></td>
                                            <td><input type="text" name="descripcion" id="descripcion" value="<?php echo $descripcion ?>" size="25" ></td>
                                        </tr>
                                        <tr>
                                            <td colspan=2><input class="btn_save" type="submit" name="accion" value="<?php echo $accion ?>"></td>
                                        </tr>
                                    </table> 
                            <?php }else { ?>
                                <tr>
                                    
                                </tr>
                                <input type="hidden" name="codFuncionalidad" value="<?php echo $codFuncionalidad ?>">
                                    
                                    <table border="0">
                                        <tr>
                                            
                                        </tr>
                                        <tr>
                                            <td><label id="lblModulo" for="nombre">Nombre: </label></td>
                                            <td><input type="text" name="nombre" id="nombre" value="<?php echo $nombre ?>" size="25" ></td>
                                        </tr>
                                        <tr>
                                            <td><label id="lblNombre" for="url">URL: </label></td>
                                            <td><input type="text" name="url" id="url" value="<?php echo $url ?>" maxlength="100" size="25" ></td>
                                        </tr>
                                        <tr>
                                            <td><label id="lblEstado" for="descripcion">DESCRIPCION: </label></td>
                                            <td><input type="text" name="descripcion" id="descripcion" value="<?php echo $descripcion ?>" size="25" ></td>
                                        </tr>
                                        <tr>
                                            <td colspan=2><input class="btn_save" type="submit" name="accion" value="<?php echo $accion ?>"></td>
                                        </tr>
                                    </table>
                            <?php }  ?>

                        </table>
                        
                    </form>
                </div>
            </div>
        </div>
    </div>

	<?php include "includes/footer.php"; ?>
</body>

</html> 