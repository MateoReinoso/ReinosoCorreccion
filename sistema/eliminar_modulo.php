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
    <title>Sisteme Ventas</title>
</head>

<body>
    <?php include "includes/header.php"; ?>
    <div id="content-wrapper" class="d-flex flex-column">
            <div class="card-body">
                <h1>Examen</h1>
                <div class="card-header py-3">
                    <h1 class="m-0 font-weight-bold text-primary">Gestión Módulos</h1>
                </div>
                <div class="table-responsive">
                    <form name="forma" id="forma" method="post" action="eliminar_modulo.php">
                
                        <table border=0>
                        <td colspan="3" style="width: 1080px;">&nbsp;</td>
                                <td>
                                <button type="button" class="btn btn-danger btn-icon-split shadow" 
                                name="eliminar" onclick="eliminacionModulo()" >
                                <span class="icon text-white-50">
                                <i class="fas fa-trash"></i>
                                </span><span class="text"><?php echo $eliminarMod?></span></button>
                                </td>
                            </tr>
                        </table>
                      
                        <table border="1" id="t01" class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
                        
                            <tr>
                                <th class="text-center">CODIGO MODULO</th>
                                <th class="text-center">NOMBRE</th>
                                <th class="text-center">ESTADO</th>
                                <th class="text-center">ELIMINAR</th>
                            </tr>
                            <?php
                           
                            if ($result->num_rows > 0) {
                                while ($row = $result->fetch_assoc()) {
                            ?>
                            
                           
                                    <tr>
                                        <td class="text-center"><a href="registro_modulo.php?update=<?php echo $row["COD_MODULO"]; ?>"><?php echo $row["COD_MODULO"]; ?></a>
                                        </td>
                                        <td class="text-center"><?php echo $row["NOMBRE"]; ?></td>
                                        <td class="text-center"><?php echo $row["ESTADO"]; ?></td>
                                        <td class="text-center"><input type="radio" name="eliminarMod" value="<?php echo $row["COD_MODULO"]; ?>">
                                        </td>
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
</body>
<script>
    function eliminacionModulo() {
        document.getElementById("forma").submit();
    }
</script>

</html>