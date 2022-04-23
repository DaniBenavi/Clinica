<?php
session_start();
include('config.php');
include_once 'class/pacientes.php';
if (!isset($_SESSION['user_id'])) {
    header('Location: index.php');
    exit;
}
$crud = new crud($conn);
//validacion del boton actualizar
if (isset($_POST['btn-delete'])) {
    $id = $_GET['delete_id'];
    /*$nombre = $_POST['nombre'];
    $apellido = $_POST['apellido'];
    $direccion = $_POST['direccion'];
    $telefono = $_POST['telefono'];
    $dui = $_POST['dui'];*/
    //hace referencia a la funcion update
    if ($crud->delete($id/*, $nombre, $apellido, $direccion, $telefono, $dui*/)) {
        $msg = "<b>WOW, Eliminacion exitosa!</b>";
        header('Location: admin_pacientes.php');
    } else {
        $msg = "<b>ERROR, algo anda mal</b>";
    }
}
if (isset($_GET['delete_id'])) {
    $id = $_GET['delete_id'];
    extract($crud->getID($id));
}
?>
<!doctype html>
<html lang="en">

<head>
    <!-- Required meta tags -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <!-- Bootstrap CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">
    <?php require_once "menu.php" ?>
    <title>Pacientes</title>
</head>

<body>

    <div class="container"><br>
        <div class="row justify-content-center">
            <div class="col-6 p-5 bg-white shadow-lg rounded">
                <?php
                if (isset($msg)) {
                    echo $msg;
                }
                ?>
                <h3>Eliminar USUARIO</h3>
                <hr>
                <form method="post">
                    <div class="form-group">
                        <label for="id">ID</label>
                        <input id="id" value="<?php echo $id; ?>" class="form-control" type="text" name="id">
                    </div>
                    <div class="form-group">
                        <label for="nombre">Nombre</label>
                        <input id="nombre" value="<?php echo $nombre; ?>" class="form-control" type="text" name="nombre">
                    </div>
                    <div class="form-group">
                        <label for="apellido">Apellido</label>
                        <input id="apellido" value="<?php echo $apellido; ?>" class="form-control" type="text" name="apellido">
                    </div>
                    <div class="form-group">
                        <label for="direccion">Direccion</label>
                        <input id="direccion" value="<?php echo $direccion; ?>" class="form-control" type="text" name="direccion">
                    </div>
                    <div class="form-group">
                        <label for="telefono">Telefono</label>
                        <input id="telefono" value="<?php echo $telefono; ?>" class="form-control" type="text" name="telefono">
                    </div>
                    <div class="form-group">
                        <label for="dui">Dui</label>
                        <input id="dui" value="<?php echo $dui; ?>" class="form-control" type="text" name="dui">
                    </div><br>
                    <button class="btn btn-primary" name="btn-delete" type="submit" onclick="preguntar(<?php echo $id ?>)">Eliminar</button>
                    <a href="admin_pacientes.php"><button type="button" class="btn btn-danger">Cancelar</button><br></a>
                </form>
            </div>


        </div>
    </div>


    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-MrcW6ZMFYlzcLA8Nl+NtUVF0sA7MsXsP1UyJoMp4YLEuNSfAP+JcXn/tWtIaxVXM" crossorigin="anonymous"></script>
    <script type="text/javascript">
        function preguntar(id) {
            if (confirm("Estas seguro que deseas eliminar?")) {
                window.location.href = "pacientes.php" + id
            }
        }
    </script>
</body>

</html>