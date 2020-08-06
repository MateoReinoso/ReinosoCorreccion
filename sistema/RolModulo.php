<?php
include './service/moduloService.php';
session_start();

//INICIALIZACIÓN

$codModulo="";
$codRol = "";
$accion = "Agregar";
$eliminarMod = "Eliminar";
$moduloService = new ModuloService();

//CRUD
//AGREGAR
if (isset($_POST["accion"]) && ($_POST["accion"] == "Agregar")) {
    $moduloService->insertModRol($_POST["rol"],$_POST["modulo"]);
} 

//ELIMINAR
else if (isset($_POST["eliminarMod"])) {
    $moduloService->deleteModRol($_POST["eliminarMod"], $_POST['rol']);
}
$result = $moduloService->findAllRol();
$result2 = $moduloService->findAll();

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
                <br>
                <br>
                <br>
                <br>
                <div class="table-responsive">
                    <form name="forma" id="forma" method="post" action="RolModulo.php">

                        <table>
                            <h1>Rol</h1>
                            <tr>
                                <td>
                                    <select class="custom-select" id="rol" name="rol">
                                        <?php
                                    if($result->num_rows>0){
                                        while($row = $result->fetch_assoc()) {
                                    ?>
                                        <option value="<?php echo $row["COD_ROL"]?>">
                                            <?php echo $row["NOMBRE"]?></option>
                                        <?php if(isset($_POST["aceptar"])){?>
                                        <option hidden selected>
                                            <?php echo $_POST['rol']?></option>
                                        <?php }} }?>
                                    </select>
                                </td>
                            </tr>
                            <tr>
                                <td><input class="btn_save" name="aceptar" type="submit"
                                        value="Aceptar"></td>
                            </tr>
                        </table>
                        <table border=0>
                            <tr>
                                <td colspan="3" style="width: 1080px;">&nbsp;</td>
                                <td>
                                    <button type="button" class="btn_save" onclick="eliminacionModulo()">
                                        <span>
                                        <img src="img/delete.png" style="width:25px; height:25px" alt="">
                                        </span><span><?php echo $eliminarMod?></span></button>
                                </td>
                            </tr>
                        </table>
                      

                        <table border="1" id="t01" class="table table-bordered" id="dataTable" width="100%"
                            cellspacing="0">
                          
                            <tr>
                                <th class="text-center">MODULO</th>
                                <th class="text-center">ELIMINAR</th>
                            </tr>
                            <?php
                            if(isset($_POST["aceptar"])){
                                $respuesta = $moduloService->findAllModRol($_POST['rol']);                           
                                if($respuesta->num_rows>0){
                                    while($row1 = $respuesta->fetch_assoc()) {
                            ?>
                            <tr>
                                <td class="text-center"><?php echo $row1["NOMBRE"]; ?></td>
                                <td class="text-center"><input type="radio" name="eliminarMod"
                                        value="<?php echo $row1["COD_MODULO"]; ?>">
                                </td>
                            </tr>
                            <?php
                                } ?>
                            <h1 class="text-primary">Nuevo Módulo</h1>
                            <input type="hidden" name="codRol" value="<?php echo $codRol ?>">
                            <table>
                                <tr>
                                    <td><label id="lblCategoria" for="categoria">Modulo: </label></td>
                                </tr>
                                <tr>
                                    <td>
                                        <select class="custom-select" id="modulo" name="modulo">
                                            <?php
                                            if($result2->num_rows>0){
                                                while($row = $result2->fetch_assoc()) {
                                            ?>
                                            <option value="<?php echo $row["COD_MODULO"]?>">
                                                <?php echo $row["NOMBRE"]?></option>
                                            <?php if(isset($_POST["agregar"])){?>
                                            <option hidden selected>
                                                <?php echo $_POST['modulo']?></option>
                                            <?php }} }?>
                                        </select>
                                    </td>
                                </tr>
                                <tr>
                                    <td><input class="btn_save" name="accion" type="submit"
                                            value="Agregar"></td>
                                </tr>
                            </table>
                            <?php }else { ?>
                            <tr>
                                <td class="text-center" colspan="5">NO HAY MÓDULO REGISTRADO</td>
                            </tr>
                            <h1 class="text-primary">Nuevo Módulo</h1>
                            <input type="hidden" name="codRol" value="<?php echo $codRol ?>">
                            <table>
                                <tr>
                                    <td><label id="lblCategoria" for="categoria">Modulo: </label></td>
                                </tr>
                                <tr>
                                    <td>
                                        <select class="custom-select" id="modulo" name="modulo">
                                            <?php
                                            if($result2->num_rows>0){
                                                while($row = $result2->fetch_assoc()) {
                                            ?>
                                            <option value="<?php echo $row["COD_MODULO"]?>">
                                                <?php echo $row["NOMBRE"]?></option>
                                            <?php if(isset($_POST["agregar"])){?>
                                            <option hidden selected>
                                                <?php echo $_POST['modulo']?></option>
                                            <?php }} }?>
                                        </select>
                                    </td>
                                </tr>
                                <tr>
                                    <td><input class="btn_save" name="accion" type="submit"
                                            value="Agregar"></td>
                                </tr>
                            </table>
                            <?php }  
                        }else { ?>
                            <tr>
                                <td class="text-center" colspan="5">SELECCIONE UN ROL</td>
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

function seleccionarRol() {
    document.getElementById("forma").submit();
}
</script>

</html>