<!doctype html>
<html lang="en">

<head>
  <title>Pagina PHP</title>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
  <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
  <link rel="stylesheet" href="css/bootstrap.min.css">
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.1/dist/css/bootstrap.min.css" rel="stylesheet"
    integrity="sha384-iYQeCzEYFbKjA/T2uDLTpkwGzCiq6soy8tYaI1GyVh/UjpbCx/TYkiZhlZB6+fzT" crossorigin="anonymous">
</head>
<!-------------------------------------Estilos de encabezado----------------------------------------------->
<body>
    <nav class="navbar bg-dark border-bottom border-body" data-bs-theme="dark">
        <div class="container">
            <h1><span style="color: aliceblue;">Erickso Barillas</span></h1>
            <a class="navbar-brand" href="#">
                <img src="Logo.png" alt="Bootstrap" width="60" height="45">
            </a>
        </div>
    </nav>
    <ul class="nav justify-content-center custom-navbar">
        <li class="nav-item">
            <button type="button" class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#myModal"><span style="font-style: italic;"><strong>Soy tu Menú ¡Ábreme!</strong></span></button>
        </li>
    </ul>
    <style>
        .custom-navbar {background-color: #007bff;} 
        .custom-navbar .nav-link {color: #ffffff;}
        .custom-navbar .nav-link:hover,
        .custom-navbar .nav-link.active {color: black;}
    </style>
    <br>
    <!-------------------------------------Estilos de encabezado----------------------------------------------->
  <form class="d-flex" action="crud_empleados.php" method="post" >
      <div class="modal" tabindex="-1" id="myModal">
            <div class="modal-dialog">
                <div class="modal-content">
                    <div class="modal-header">
                     <h5 class="modal-title">Detalles del Estudiante</h5>
                     <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                    </div>
                    <div class="modal-body">
                      <div class="mb-3">
                        <label for="lbl_id" class="form-label"><b>ID</b></label>
                        <input type="text" name="txt_id" id="txt_id" class="form-control" value="0" readonly>  
                      </div>
                      <div class="mb-3">
                        <label for="lbl_codigo" class="form-label"><b>Codigo</b></label>
                        <input type="text" name="txt_codigo" id="txt_codigo" class="form-control" placeholder="Codigo: E001" pattern="^E\d{3}$" required>
                      </div>
                      <div class="mb-3">
                        <label for="lbl_nombres" class="form-label"><b>Nombres</b></label>
                        <input type="text" name="txt_nombres" id="txt_nombres" class="form-control" placeholder="Nombres: nombre1 nombre2" required>  
                      </div>
                      <div class="mb-3">
                        <label for="lbl_apellidos" class="form-label"><b>Apellidos</b></label>
                        <input type="text" name="txt_apellidos" id="txt_apellidos" class="form-control" placeholder="Apellidos: apellido1 apellido2" required>  
                      </div>
                      <div class="mb-3">
                        <label for="lbl_dirección" class="form-label"><b>Dirección</b></label>
                        <input type="text" name="txt_dirección" id="txt_dirección" class="form-control" placeholder="Dirección: #casa calle avenida lugar" required>  
                      </div>
                      <div class="mb-3">
                        <label for="lbl_telefono" class="form-label"><b>Telefono</b></label>
                        <input type="number" name="txt_telefono" id="txt_telefono" class="form-control" placeholder="Telefono 555" required>  
                      </div>
                      <div class="mb-3">
                        <label for="lbl_Puesto" class="form-label"><b>Puesto</b></label>
                        <select class="form-select" name="drop_Puesto" id="drop_Puesto">
                        <option value="0">---Puesto---</option>
                        <?php
                        include("datos_conexion.php");
                        $bd_conexion = mysqli_connect($bd_host,$bd_usr,$bd_pass,$bd_nombre);
                        $bd_conexion ->real_query("select id_Puesto as id_Puesto,Puesto from Puestos;");
                        $resultado = $bd_conexion->use_result();
                        while($fila = $resultado->fetch_assoc()){
                            echo"<option value=". $fila['id_Puesto'] .">". $fila['Puesto'] ."</option>";
                        }
                        $bd_conexion ->close();
                        ?>
                        </select>
                      </div>
                      <div class="mb-3">
                        <label for="lbl_fn" class="form-label"><b>fecha_nacimiento</b></label>
                        <input type="date" name="txt_fn" id="txt_fn" class="form-control" placeholder="aaaa-mm-dd" required>  
                      </div>
                          <hr>
                      
                      <div class="modal-footer">
                      <button type="submit" class="btn btn-primary" style="background-color: blue;" id="btn_crear" name="btn_crear" value="crear">Crear</button>
<button type="submit" class="btn btn-primary" style="background-color: blue;" id="btn_leer" name="btn_leer" value="leer">Leer</button>
<button type="submit" class="btn btn-primary" style="background-color: blue;" id="btn_actualizar" name="btn_actualizar" value="actualizar">Actualizar</button>
<button type="submit" class="btn btn-primary" style="background-color: black;" id="btn_borrar" name="btn_borrar" value="borrar" onclick="confirmDelete()">Borrar</button>

                        <button type="button" class="btn btn-secondary" style="background-color: rgb(185, 12, 12);" data-bs-dismiss="modal"><span style="font-style: italic;"><strong>Salir</strong></span></button>
                      
                      </div>
                    </div>
                  </div>
            </div>
      </div>  
  </form>

  <table class="table table-striped table-inverse table-responsive">
                <thead class="table-inverse">
                    <tr>
                        <th>Codigo</th>
                        <th>Nombres</th>
                        <th>Apellidos</th>
                        <th>Dirección</th>
                        <th>Telefono</th>
                        <th>Puesto</th>
                        <th>Nacimiento</th>
                    </tr>
                </thead>
                <tbody id="tbl_empleados">
                <?php
                        include("datos_conexion.php");
                        $bd_conexion = mysqli_connect($bd_host,$bd_usr,$bd_pass,$bd_nombre);
                        $bd_conexion ->real_query("SELECT e.id_Empleados as id,e.Codigo,e.Nombres,e.Apellidos,e.Dirección,e.Telefono,p.Puesto,e.fecha_nacimiento,e.id_puesto FROM empleados as e inner join puestos as p on e.id_Puesto = p.id_Puesto;
                        ");
                        $resultado = $bd_conexion->use_result();
                        while($fila = $resultado->fetch_assoc()){
                            echo"<tr data-id=" . $fila['id'] . " data-idp=". $fila['id_puesto'] . ">";
                            echo"<td>". $fila['Codigo'] ."</td>";
                            echo"<td>". $fila['Nombres'] ."</td>";
                            echo"<td>". $fila['Apellidos'] ."</td>";
                            echo"<td>". $fila['Dirección'] ."</td>";
                            echo"<td>". $fila['Telefono'] ."</td>";
                            echo"<td>". $fila['Puesto'] ."</td>";
                            echo"<td>". $fila['fecha_nacimiento'] ."</td>";
                            echo"<tr>";
                        }
                        $bd_conexion ->close();
                        ?>
                </tbody>
            </table>
        </div>
    </div>
<!---->

  <script src="https://code.jquery.com/jquery-3.7.1.slim.js" integrity="sha256-UgvvN8vBkgO0luPSUl2s8TIlOSYRoGFAX4jlCIm9Adc=" crossorigin="anonymous"></script>
  <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.11.6/dist/umd/popper.min.js"integrity="sha384-oBqDVmMz9ATKxIep9tiCxS/Z9fNfEXiDAYTujMAeBAsjFuCZSmKbSSUnQlmh/jp3" crossorigin="anonymous"></script>
  <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.1/dist/js/bootstrap.min.js"integrity="sha384-7VPbUDkoPSGFnVtYi0QogXtr74QeVeeIs99Qfg5YCF+TidwNdjvaKZX19NZ/e6oz" crossorigin="anonymous"></script>

<script>
    $("#tbl_empleados").on('click','tr td',function (e){
        var target,id,idp,codigo,nombres,apellidos,dirección,telefono,fn;
        target =$(event.target);
        id = target.parent().data('id');
        idp = target.parent().data('idp');
        codigo = target.parent('tr').find("td").eq(0).html();
        nombres = target.parent('tr').find("td").eq(1).html();
        apellidos = target.parent('tr').find("td").eq(2).html();
        dirección = target.parent('tr').find("td").eq(3).html();
        telefono = target.parent('tr').find("td").eq(4).html();
        fn = target.parent('tr').find("td").eq(6).html();
        $("#txt_id").val(id);
        $("#txt_codigo").val(codigo);
        $("#txt_nombres").val(nombres);
        $("#txt_apellidos").val(apellidos);
        $("#txt_dirección").val(dirección);
        $("#txt_telefono").val(telefono);
        $("#txt_fn").val(fn);
        $("#drop_Puesto").val(idp);
    })
</script>
<script src="js/bootstrap.min.js"></script> 
<script>
            document.addEventListener("DOMContentLoaded", function () {
                const dataRows = document.querySelectorAll(".data-row");
                dataRows.forEach(row => {
                    row.addEventListener("click", function () {
                        const rowData = this.getAttribute("data-row");
                        const data = JSON.parse(rowData);
                        document.getElementById("txt_id_estudiantes").value = data.id_estudiantes;
                        document.getElementById("txt_carnet").value = data.carnet;
                        document.getElementById("txt_nombres").value = data.nombres;
                        document.getElementById("txt_apellidos").value = data.apellidos;
                        document.getElementById("txt_dirección").value = data.dirección;
                        document.getElementById("txt_telefono").value = data.telefono;
                        document.getElementById("txt_correo_electronico").value = data.correo_electronico;
                        document.getElementById("txt_tipo_de_sangre").value = data.tipo_de_sangre;
                        document.getElementById("txt_fecha_nacimiento").value = data.fecha_nacimiento;
                        const modal = new bootstrap.Modal(document.getElementById("myModal"));
                        modal.show();
                    });
                });
            });
</script>
<script>
function confirmDelete(event) {
    if (confirm("¿Estás seguro de que deseas eliminar este estudiante?")) {
        const row = event.target.closest(".data-row");
        const idEstudiante = row.dataset.row.id_estudiantes;

        fetch(`/eliminar/${idEstudiante}`, {
            method: "DELETE",
        })
        .then(response => {
            if (response.ok) {
                location.reload();
            } else {
                console.error("Error al eliminar estudiante");
            }
        })
        .catch(error => {
            console.error("Error al eliminar estudiante:", error);
        });
    }
}
</script> 
<br><br><br><br><br><br><br><br><br><br><br><br>
<!-------------------------------------Estilos de pie de pagina----------------------------------------------->
<style>
  .footer-bar {
    background-color: black;
    padding: 10px; 
    text-align: center; 
  }
  .footer-text {
    color: white; 
    font-weight: bold;
    font-style: italic;
  }
</style>
<div class="footer-bar">
  <footer class="footer-text">
    <p><i>La Belleza de las Cosas Reside en el Espíritu de Quien las Contempla...</i></p>
  </footer>
</div>
</body>
</html>
