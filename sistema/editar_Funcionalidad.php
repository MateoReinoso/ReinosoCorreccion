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
        <!-- Sidebar -->
        <div id="content-wrapper" class="d-flex flex-column">
            <div class="card-body">
                <div class="table-responsive">
                    <form name="forma" id="forma" method="post" action="editar_Funcionalidad.php">
                        <br>
                        <br>
                        <br>
                        <br>
                        <table>
                            <h1>Modulp</h1>
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
                                <td><input class="btn_save" name="aceptar" type="submit"
                                        value="Aceptar"></td>
                            </tr>
                        </table><br>

                        <table border="1" id="t01" class="table table-bordered" id="dataTable" width="100%"
                            cellspacing="0">

                            <tr>
                                <th class="text-center">CÓDIGO MODULO</th>
                                <th class="text-center">NOMBRE</th>
                                <th class="text-center">URL</th>
                                <th class="text-center">DESCRIPCION</th>
                            </tr>
                            <?php
                            if(isset($_POST["aceptar"])){
                                $res = $moduloService->findAllFun($_POST['modulo']);                           
                                if($res->num_rows>0){
                                    while($row1 = $res->fetch_assoc()) {
                            ?>
                    
                            <tr>
                                <td class="text-center"><a
                                        href="editar_Function.php?update=<?php echo $row1["COD_FUNCIONALIDAD"]; ?>"
                                        class="btn btn-info btn-icon-split">
                                        <span class="icon text-white-50">
                                            <i class="fas fa-info-circle"></i>
                                        </span>
                                        <span class="text">Modificar</span>
                                    </a>
                                </td>
                                <td class="text-center"><?php echo $row1["NOMBRE"]; ?></td>
                                <td class="text-center"><?php echo $row1["URL_PRINCIPAL"]; ?></td>
                                <td class="text-center"><?php echo $row1["DESCRIPCION"]; ?></td>
                                
                            </tr>
                            <?php
                                } ?>
                            <input type="hidden" name="codFuncionalidad" value="<?php echo $codFuncionalidad ?>">
                                                       
                            <?php }else { ?>
                            <tr>
                                <td class="text-center" colspan="5"></td>
                            </tr>
                            <input type="hidden" name="codFuncionalidad" value="<?php echo $codFuncionalidad ?>">
                
                           
                            <?php }  
                            
                        }else { ?>
                            <tr>
                                <td class="text-center" colspan="5">SELECCIONE UN MÓDULO</td>
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

</html>