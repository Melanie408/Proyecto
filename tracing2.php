<?php
    $title ="Seguimiento | ";
    include "head.php";
    include "sidebar2.php";
?>

    <div class="right_col" role="main">
        <div class="">
            <div class="page-title">
                <div class="clearfix"></div>
                <div class="col-md-12 col-sm-12 col-xs-12">
                    <?php
                        include("modal/upd_tracing.php");
                    ?>
                    <div class="x_panel">
                        <div class="x_title">
                            <h2>Seguimiento de Proyectos y Requerimientos</h2>
                            <ul class="nav navbar-right panel_toolbox">
                                <li><a class="collapse-link"><i class="fa fa-chevron-up"></i></a>
                                </li>
                                <li><a class="close-link"><i class="fa fa-close"></i></a>
                                </li>
                            </ul>
                            <div class="clearfix"></div>
                        </div>
                        
                        <!-- Formulario de Busqueda -->
                        <form class="form-horizontal" role="form" id="gastos">
                            <div class="form-group row">
                                <label for="q" class="col-md-2 control-label">Código</label>
                                <div class="col-md-4">
                                    <input type="text" class="form-control" id="q" placeholder="Código del ticket" onkeyup='load(1);'>
                                </div>
                                <div class="col-md-3">
                                    <button type="button" class="btn btn-default" onclick='load(1);'>
                                        <span class="glyphicon glyphicon-search" ></span> Buscar</button>
                                    <span id="loader"></span>
                                </div>
                            </div>
                        </form>     


                        <div class="x_content">
                            <div class="table-responsive">
                                <!-- Datos ajax -->
                                    <div id="resultados"></div>
                                    <div class='outer_div'></div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

<?php include "footer.php" ?>

<script type="text/javascript" src="js/tracing2.js"></script>
<script type="text/javascript" src="js/VentanaCentrada.js"></script>

<script>

$( "#upd" ).submit(function( event ) {
  $('#upd_data').attr("disabled", true);
  
 var parametros = $(this).serialize();
     $.ajax({
            type: "POST",
            url: "action/updtracing2.php",
            data: parametros,
             beforeSend: function(objeto){
                $("#result2").html("Mensaje: Cargando...");
              },
            success: function(datos){
            $("#result2").html(datos);
            $('#upd_data').attr("disabled", false);
            load(1);
          }
    });
  event.preventDefault();
})

    function obtener_datos(id){
            var id_status = $("#id_status"+id).val();
            $("#mod_id").val(id);
            $("#mod_id_status").val(id);
        }


</script>