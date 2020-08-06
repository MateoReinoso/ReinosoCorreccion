<?php
    include './service/moduloService.php';
    session_start();

    //INICIALIZACIÓN
    $nombre = "";
    $estado = "";
    $codModulo = "";
    $accion = "Agregar";
    $eliminarMod = "Eliminar";
    $moduloService = new ModuloService();

    //CRUD
    //AGREGAR
    if (isset($_POST["accion"]) && ($_POST["accion"] == "Agregar")) {
        $moduloService->insert($_POST["codModulo"], $_POST["nombre"], $_POST["estado"]);
    } 
    //MODIFICAR
    else if (isset($_POST["accion"]) && ($_POST["accion"] == "Modificar")) {
        $moduloService->update($_POST["nombre"],$_POST["estado"],$_POST["codModulo"]);
    } 
    //SELECCIONAR ID A MODIFICAR
    else if (isset($_GET["update"])) {
        $modulo = $moduloService->findByPK($_GET["update"]);
        if ($modulo!=null){
            $codModulo = $modulo["COD_MODULO"];
            $nombre = $modulo["NOMBRE"];
            $estado = $modulo["ESTADO"];
            $accion = "Modificar";
        }
    } 
    //ELIMINAR
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
                        <!-- BOTÓN ELIMINAR -->
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
                        <!-- TABLA CLIENTE -->
                        <table border="1" id="t01" class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
                            <!-- TÍTULOS -->
                            <tr>
                                <th class="text-center">COD_MODULO</th>
                                <th class="text-center">NOMBRE</th>
                                <th class="text-center">ESTADO</th>
                                <th class="text-center">ELIM</th>
                            </tr>
                            <?php
                            /* GUARDAR EN RESULT LOS DATOS DE LA TABLA */
                            if ($result->num_rows > 0) {
                                while ($row = $result->fetch_assoc()) {
                            ?>
                            
                            <!-- IMPRESIÓN DE LA TABLA CON LOS DATOS DESDE LA BASE -->
                                    <tr>
                                        <td class="text-center"><a href="index.php?update=<?php echo $row["COD_MODULO"]; ?>"><?php echo $row["COD_MODULO"]; ?></a>
                                        </td>
                                        <td class="text-center"><?php echo $row["NOMBRE"]; ?></td>
                                        <td class="text-center"><?php echo $row["ESTADO"]; ?></td>
                                        <td class="text-center"><input type="radio" name="eliminarMod" value="<?php echo $row["COD_MODULO"]; ?>">
                                        </td>
                                    </tr>
                                <?php
                                }
                            } 
                            /* EN CASO DE NO EXISTIR DATOS EN LA TABLA */
                            else { ?>
                                <tr>
                                    <td colspan="4" class="text-center">NO HAY DATOS</td>
                                </tr>
                            <?php } ?>
                        </table>
                        <!-- hidden ES PARA QUE LOS USUARIOS NO PUEDAN VER NI MODIFICAR DATOS CUANDO SE ENVÍA EN UN FORMULARIO, ESPECIALMENTE ID -->
                        <input type="hidden" name="codModulo" value="<?php echo $codModulo ?>">
                        <!-- CAMPOS PARA NUEVO MODULO -->
                        <?php if($accion=="Agregar") {?>
                        <table border="0">
                            <tr>
                                <td colspan=2 class="text-primary"><h1>Nuevo Modulo</h1></td>
                            </tr>
                            <tr>
                                <td><label id="lblModulo" for="codModulo">Código del Módulo: </label></td>
                                <td><input type="text" class="form-control" name="codModulo" id="codModulo" value="<?php echo $codModulo ?>" required></td>
                            </tr>
                            <tr>
                                <td><label id="lblNombre" for="nombre">Nombre: </label></td>
                                <td><input type="text" class="form-control" name="nombre" id="nombre" value="<?php echo $nombre ?>" maxlength="100" size="25" required></td>
                            </tr>
                            <tr>
                                <td><label id="lblEstado" for="estado">Estado: </label></td>
                                <td>
                                <select class="custom-select" id="estado" name="estado">
                                    <option hidden selected><?php echo $estado ?></option>
                                    <option value="ACT">Activo</option>
                                    <option value="INA">Inactivo</option>
                                </select>
                                </td>
                            </tr>
                            <tr>
                                <td colspan=2><input type="submit" name="accion" value="<?php echo $accion ?>"></td>
                            </tr>
                        </table>
                        <?php } else{?>
                        <table border="0">
                            <tr>
                                <td colspan=2><strong>Modificar Modulo</strong></td>
                            </tr>
                            <tr>
                                <td><label id="lblModulo" for="codModulo">Código del Módulo: </label></td>
                                <td><input type="text" class="form-control" name="codModulo" id="codModulo" disabled value="<?php echo $codModulo ?>" required></td>
                            </tr>
                            <tr>
                                <td><label id="lblNombre" for="nombre">Nombre: </label></td>
                                <td><input type="text" class="form-control" name="nombre" id="nombre" value="<?php echo $nombre ?>" maxlength="100" size="25" required></td>
                            </tr>
                            <tr>
                                <td><label id="lblNombre" for="estado">Estado: </label></td>
                                <td>
                                <select class="custom-select" id="estado" name="estado">
                                    <option hidden selected><?php echo $estado ?></option>
                                    <option disabled ><?php echo $estado ?></option>
                                </select>
                                </td>
                            </tr>
                            <tr>
                                <td colspan=2><input type="submit" name="accion" value="<?php echo $accion ?>"></td>
                            </tr>
                        </table>
                        <?php }?>
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