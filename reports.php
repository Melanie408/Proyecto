<?php
    $title ="Reporte | ";
    include "head.php";
    include "sidebar.php";

?>  


    <div class="right_col" role="main">
        <div class="">
            <div class="page-title">
                <div class="clearfix"></div>
                <div class="col-md-12 col-sm-12 col-xs-12">
                    <div class="x_panel">
                        <div class="x_title">
                            <h2>Reporte</h2>
                            <ul class="nav navbar-right panel_toolbox">
                                <li><a class="collapse-link"><i class="fa fa-chevron-up"></i></a>
                                </li>
                                <li><a class="close-link"><i class="fa fa-close"></i></a>
                                </li>
                            </ul>
                            <div class="clearfix"></div>
                        </div>


        <div class="x_content">
            <div class="table-responsive">
                <table class="table table-bordered table-hover">
                    <thead>
                        <th>Código</th>
                        <th>Descripción</th>
                        <th>Nombre Actividad</th>
                        <th>Técnico</th>
                        <th>Estado</th>
                        <th>Usuario</th>
                        <th>Fecha</th>
                    </thead>

                    <?php 
                        $ticket_query = mysqli_query($con, "select * from ticket");

                        while ($r=mysqli_fetch_array($ticket_query)) {
                            $id=$r['id'];
                            $dateT=date('d/m/Y', strtotime($r['dateT']));
                            $description=$r['description'];
                            $code=$r['code'];
                            $id_project=$r['id_project'];
                            $id_requirements=$r['id_requirements'];
                            $technical=$r['technical'];

                            $id_user = $r['id_user'];
                            $sql = mysqli_query($con, "select * from user where id=$id_user");
                            if($c=mysqli_fetch_array($sql)) {
                                $name_user=$c['name'];
                            }

                            $id_status=$r['id_status'];
                            $sql = mysqli_query($con, "select * from status where id=$id_status");
                            if($c=mysqli_fetch_array($sql)) {
                                $name_status=$c['name'];
                            }

                            $sql = mysqli_query($con, "select * from project where id=$id_project");
                            
                            if($sql != null){
                                if($c=mysqli_fetch_array($sql)) {
                                    $name_project=$c['name'];
                                }
                            }

                            $sql = mysqli_query($con, "select * from requirements where id=$id_requirements");
                            
                            if($sql != null) {
                                if($c=mysqli_fetch_array($sql)) {
                                    $name_requirements=$c['name'];
                                }
                            }


                            if($name_project != null){
                                $name_activity = $name_project;
                            }else if($name_requirements != null){
                                $name_activity = $name_requirements;
                            }

                ?>

                <tr class="even pointer">
                    <td><?php echo $code;?></td>
                    <td><?php echo $description; ?></td>
                    <td><?php echo $name_activity; ?></td>
                    <td><?php echo $technical;?></td>
                    <td><?php echo $name_status; ?></td>
                    <td><?php echo $name_user; ?></td>
                    <td><?php echo $dateT;?></td>
                </tr>

                <?php  
                    }
                ?>

     </table>
    
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

<?php include "footer.php" ?>
