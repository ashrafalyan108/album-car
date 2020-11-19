<html lang="es">
<head>
    <meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
    <title> Ingresar Marca</title>
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css" integrity="sha384-ggOyR0iXCbMQv3Xipma34MD+dH/1fQ784/j6cY/iJTQUOhcWr7x9JvoRxT2MZw1T" crossorigin="anonymous">
</head>
<body>
<div class="container">
    <div class="signup-form-container" style="max-width: 600px;">
        <form role="form" class="form-horizontal" id="register-form" action='administrar_marcas.php' method='POST'>
            <div class="form-header">
                <h1>Ingresa los datos de la Marca</h1>
            </div>
            <div class="form-body">
                <div class="form-group">
                    <div class="input-group">
                        <div class="input-group-addon"><span class="glyphicon glyphicon-user"></span></div>
                        <label>Nombre:<input id="nombre" name="nombre" type="text" class="form-control" placeholder="Nombre Marca" maxlength="20" required></label>
                    </div>
                    <span class="help-block" id="error"></span>
                </div>
                <div class="form-group">
                    <div class="input-group">
                        <div class="input-group-addon"><span class="glyphicon glyphicon-user"></span></div>
                        <label>Orden:<input id="orden" name="orden" type="number" class="form-control" placeholder="Orden" maxlength="20" required></label>
                    </div>
                    <span class="help-block" id="error"></span>
                </div>
                <div class="form-group">
                    <label>Activo:<input type='checkbox' name='activo' value="1"> </label>
                </div>
                <input type='hidden' name='insertar' value='insertar'>
            </div>
            <input type="submit" id="guardar" name="submit" onclick="return validar()" value='Guardar'>
            <a href="index-marcas.php">Volver</a>
            <script>
                function validar() {
                    let nombre, orden, expresionLet;
                    nombre = document.getElementById("nombre").value;
                    orden = document.getElementById("orden").value;

                    expresionLet = new RegExp("^[a-zA-ZñçáéíóúÁÉÍÓÚäëïöüÄËÏÖÜàèìòùÀÈÌÒÙ ]*$");

                    if (nombre === "" || orden==="") {
                        alert("ERROR: Todos los campos son obligatorios");
                        return false;
                    } else if (nombre.length > 20) {
                        alert("ERROR: El nombre es muy largo");
                        return false;
                    } else if (!expresionLet.test(nombre)) {
                        alert("ERROR: El nombre solo puede contener letras");
                        return false;
                    } else if (orden.length > 11) {
                        alert("ERROR: El orden es muy largo");
                        return false;
                    }else if (isNaN(orden)){
                        alert("ERROR: El orden tiene que ser un numero");
                        return false;
                    }
                }
            </script>
        </form>
    </div>
</div>
</body>
</html>