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

if (isset($_POST["accion"]) && ($_POST["accion"] == "Agregar")) {
    $moduloService->insertFun($_POST['modulo'], $_POST["url"], $_POST["nombre"], $_POST["descripcion"]);
} 

else if (isset($_POST["accion"]) && ($_POST["accion"] == "Modificar")) {
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
else if (isset($_POST["eliminarMod"])) {
    $moduloService->deleteFun($_POST["eliminarMod"]);
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
    <div>
        <div id="content-wrapper" class="d-flex flex-column">
            <div class="card-body">
                
                <div class="table-responsive">
                    <form name="forma" id="forma" method="post" action="registrar_Funcionalidad.php">
                    <br>
                    <br>
                    <br>
                        <table>
                        <br>
                        <h1>Modulo</h1>
                            
                            <tr>
                                <td>
                                    <select class="custom-select" id="modulo" name="modulo">
                                        <?php
                                    if($result->num_rows>0){
                                        while($row = $result->fetch_assoc()) {
                                    ?>
                                        <option value="<?php echo $row["COD_MODULO"]?>">
                                            <?php echo $row["NOMBRE"]?></option>
                                        <?php if(isset($_POST["aceptar"])){?>
                                        <option hidden selected>
                                            <?php echo $_POST['modulo']?></option>
                                        <?php }} }?>
                                    </select>
                                </td>
                            </tr>
                            <tr>
                                <td><input class="btn_save" name="aceptar" type="submit" value="Aceptar"></td>
                            </tr>
                        </table><br>

                        <table>
                            <?php
                            if(isset($_POST["aceptar"])){
                                $res = $moduloService->findAllFun($_POST['modulo']);                           
                                if($res->num_rows>0){
                                    while($row1 = $res->fetch_assoc()) {
                            ?>
                            <?php
                                } ?>
                            <input type="hidden" name="codFuncionalidad" value="<?php echo $codFuncionalidad ?>">

                            <table border="0">
                                <tr>
                                    <td colspan=2 class="text-primary">
                                        <h1>Nueva Funcionalidad</h1>
                                    </td>
                                </tr>
                                <tr>
                                    <td><label id="lblModulo" for="nombre">Nombre: </label></td>
                                    <td><input type="text" name="nombre" id="nombre" value="<?php echo $nombre ?>"
                                            size="25"></td>
                                </tr>
                                <tr>
                                    <td><label id="lblNombre" for="url">URL: </label></td>
                                    <td><input type="text" name="url" id="url" value="<?php echo $url ?>"
                                            maxlength="100" size="25"></td>
                                </tr>
                                <tr>
                                    <td><label id="lblEstado" for="descripcion">DESCRIPCION: </label></td>
                                    <td><input type="text" name="descripcion" id="descripcion"
                                            value="<?php echo $descripcion ?>" size="25"></td>
                                </tr>
                                <tr>
                                    <td colspan=2><input class="btn_save" type="submit" name="accion"
                                            value="<?php echo $accion ?>"></td>
                                </tr>
                            </table>
                            <?php }else { ?>
                            <tr>
                                <td class="text-center" colspan="5"></td>
                            </tr>
                            <input type="hidden" name="codFuncionalidad" value="<?php echo $codFuncionalidad ?>">
                            <table border="0">
                                <tr>
                                    <td colspan=2><strong>Nueva Funcionalidad</strong></td>
                                </tr>
                                <tr>
                                    <td><label id="lblModulo" for="nombre">Nombre: </label></td>
                                    <td><input type="text" name="nombre" id="nombre" value="<?php echo $nombre ?>"
                                            size="25"></td>
                                </tr>
                                <tr>
                                    <td><label id="lblNombre" for="url">URL: </label></td>
                                    <td><input type="text" name="url" id="url" value="<?php echo $url ?>"
                                            maxlength="100" size="25"></td>
                                </tr>
                                <tr>
                                    <td><label id="lblEstado" for="descripcion">DESCRIPCION: </label></td>
                                    <td><input type="text" name="descripcion" id="descripcion"
                                            value="<?php echo $descripcion ?>" size="25"></td>
                                </tr>
                                <tr>
                                    <td colspan=2><input class="btn_save" type="submit" name="accion"
                                            value="<?php echo $accion ?>"></td>
                                </tr>
                            </table>
                            <?php }  
            
                        }else { ?>
                            <tr>
                                <td class="text-center" colspan="5"></td>
                            </tr>
                            <?php } ?>
                        </table>

                    </form>
                </div>
            </div>
        </div>
    </div>

    <?php include "includes/footer.php"; ?>
</body>
<script>
function eliminacionModulo() {
    document.getElementById("forma").submit();
}

function agregarModulo() {
    document.getSelection("forma").submit();
}
</script>

</html>