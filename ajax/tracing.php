<?php
    include "../config/config.php";//Funcion que conecta a la base de datos
    
    $action = (isset($_REQUEST['action']) && $_REQUEST['action'] !=NULL)?$_REQUEST['action']:'';
    if (isset($_GET['id'])){
        $id_del=intval($_GET['id']);
        $query=mysqli_query($con, "SELECT * from ticket where id='".$id_del."'");
        $count=mysqli_num_rows($query);

            if ($delete1=mysqli_query($con,"DELETE FROM ticket WHERE id='".$id_del."'")){
?>
            <div class="alert alert-success alert-dismissible" role="alert">
              <button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button>
              <strong>¡Aviso!</strong> Datos eliminados exitosamente.
            </div>
        <?php 
            }else {
        ?>
                <div class="alert alert-danger alert-dismissible" role="alert">
                  <button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                  <strong>¡Error!</strong> Lo siento algo ha salido mal intenta nuevamente.
                </div>
    <?php
            } 
        } 
    ?>

<?php
    if($action == 'ajax'){
        
         $q = mysqli_real_escape_string($con,(strip_tags($_REQUEST['q'], ENT_QUOTES)));
         $aColumns = array('code');//Columnas de busqueda
         $sTable = "ticket";
         $sWhere = "";
        if ( $_GET['q'] != "" )
        {
            $sWhere = "WHERE (";
            for ( $i=0 ; $i<count($aColumns) ; $i++ )
            {
                $sWhere .= $aColumns[$i]." LIKE '%".$q."%' OR ";
            }
            $sWhere = substr_replace( $sWhere, "", -3 );
            $sWhere .= ')';
        }
        $sWhere.=" order by code desc";
        include 'pagination.php';
        
        $page = (isset($_REQUEST['page']) && !empty($_REQUEST['page']))?$_REQUEST['page']:1;
        $per_page = 10; 
        $adjacents  = 4; 
        $offset = ($page - 1) * $per_page;
        
        $count_query   = mysqli_query($con, "SELECT count(*) AS numrows FROM $sTable  $sWhere");
        $row= mysqli_fetch_array($count_query);
        $numrows = $row['numrows'];
        $total_pages = ceil($numrows/$per_page);
        $reload = './expences.php';
        
        $sql="SELECT * FROM  $sTable $sWhere LIMIT $offset,$per_page";
        $query = mysqli_query($con, $sql);
        
        $name_project="";
        $name_requirements="";

        $M_query="SELECT count(*) AS mRows FROM ticket WHERE id_status = '2'";
        $M_num = mysqli_query($con, $M_query);
        $M_row = mysqli_fetch_array($M_num);
        $M = $M_row['mRows'];

        if($M>0){
            ?>
            <div class="alert alert-warning alert-dismissible" role="alert">
              <button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button>
              <strong>Aviso!</strong> ¡Requerimiento o Proyecto Finalizado!
            </div>
            <?php

        } 

        if ($numrows>0){
            
            ?>
            <table class="table table-striped jambo_table bulk_action">
                <thead>
                    <tr class="headings">
                        <th class="column-title">Código </th>
                        <th class="column-title">Nombre </th>
                        <th class="column-title">Tecnico </th>
                        <th class="column-title">Estado</th>
                        <th class="column-title">Fecha</th>
                        <th class="column-title no-link last"><span class="nobr"></span></th>
                    </tr>
                </thead>
                <tbody>
                <?php 
                        while ($r=mysqli_fetch_array($query)) {
                            $id=$r['id'];
                            $dateT=date('d/m/Y', strtotime($r['dateT']));
                            $code=$r['code'];
                            $id_project=$r['id_project'];
                            $id_requirements=$r['id_requirements'];
                            $technical=$r['technical'];
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
                    <input type="hidden" value="<?php echo $id;?>" id="id<?php echo $id;?>">
                    <input type="hidden" value="<?php echo $code;?>" id="code<?php echo $id;?>">


                    <input type="hidden" value="<?php echo $name_activity;?>" id="name<?php echo $id;?>">
                    <input type="hidden" value="<?php echo $id_project;?>" id="id_project<?php echo $id;?>">
                    <input type="hidden" value="<?php echo $id_requirements;?>" id="id_requirements<?php echo $id;?>">
                    <input type="hidden" value="<?php echo $name_status;?>" id="name_status<?php echo $id;?>">
                    <input type="hidden" value="<?php echo $technical;?>" id="technical<?php echo $id;?>">


                    <tr class="even pointer">
                        <td><?php echo $code;?></td>
                        <td><?php echo $name_activity; ?></td>
                        <td><?php echo $technical;?></td>
                        <td><?php echo $name_status; ?></td>
                        <td><?php echo $dateT;?></td>
                        <td ><span class="pull-right">
                    </tr>
                <?php
                    }
                ?>
                <tr>
                    <td colspan=6><span class="pull-right">
                        <?php echo paginate($reload, $page, $total_pages, $adjacents);?>
                    </span></td>
                </tr>
              </table>
            </div>
            <?php
        }else{
           ?> 
            <div class="alert alert-warning alert-dismissible" role="alert">
              <button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button>
              <strong>Aviso!</strong> ¡No hay datos para mostrar!
            </div>
        <?php    
        }
    }
?>