<?php
    $project =mysqli_query($con, "select * from project");
    $requirements =mysqli_query($con, "select * from requirements");
?>

    <div>
        <button type="button" class="btn btn-primary" data-toggle="modal" data-target=".bs-example-modal-lg-add"><i class="fa fa-plus-circle"></i> Agregar Ticket</button>
    </div>
    <div class="modal fade bs-example-modal-lg-add" tabindex="-1" role="dialog" aria-hidden="true">
        <div class="modal-dialog modal-md">
            <div class="modal-content">
                <div class="modal-header">
                    <button type="button" class="close" data-dismiss="modal"><span aria-hidden="true">×</span>
                    </button>
                    <h4 class="modal-title" id="myModalLabel">Agregar Ticket</h4>
                </div>
                <div class="modal-body">
                    <form class="form-horizontal form-label-left input_mask" method="post" id="add" name="add">
                        <div id="result"></div>
                        <div class="form-group">
                            <label class="control-label col-md-3 col-sm-3 col-xs-12">Código<span class="required">*</span></label>
                            <div class="col-md-9 col-sm-9 col-xs-12">
                              <input type="text" name="code" class="form-control" placeholder="Código">
                            </div>
                        </div>
                        <div class="form-group">
                            <label class="control-label col-md-3 col-sm-3 col-xs-12">Descripción <span class="required">*</span>
                            </label>
                            <div class="col-md-9 col-sm-9 col-xs-12">
                              <textarea name="description" class="form-control col-md-7 col-xs-12"  placeholder="Descripción"></textarea>
                            </div>
                        </div>
                        <br>
                        <div class="form-group">
                            <label class="control-label col-md-3 col-sm-3 col-xs-12"></label>
                            <div class="col-md-9 col-sm-9 col-xs-12">
                              <label class="control-label col-md-12  col-xs-12">Seleccione Unicamente El Proyecto o El Requerimiento</label>
                            </div>
                        </div>
                        <div class="form-group">
                            <label class="control-label col-md-3 col-sm-3 col-xs-12" for="first-name">Proyecto
                            </label>
                            <div class="col-md-9 col-sm-9 col-xs-12">
                                <select class="form-control" name="id_project">
                                    <option selected="" value="">-- Selecciona --</option>
                                      <?php foreach($project as $p):?>
                                        <option value="<?php echo $p['id']; ?>"><?php echo $p['name']; ?></option>
                                      <?php endforeach; ?>
                                </select>
                            </div>
                        </div>
                        <div class="form-group">
                            <label class="control-label col-md-3 col-sm-3 col-xs-12" for="first-name">Requerimiento
                            </label>
                            <div class="col-md-9 col-sm-9 col-xs-12">
                                <select class="form-control" name="id_requirements">
                                    <option selected="" value="">-- Selecciona --</option>
                                      <?php foreach($requirements as $p):?>
                                        <option value="<?php echo $p['id']; ?>"><?php echo $p['name']; ?></option>
                                      <?php endforeach; ?>
                                </select>
                            </div>
                        </div>
                        <br>
                        <div class="form-group">
                            <label class="control-label col-md-3 col-sm-3 col-xs-12" for="first-name">Tecnico
                            </label>
                            <div class="col-md-9 col-sm-9 col-xs-12">
                                <select class="form-control" required name="technical">
                                    <option value="" selected>-- Seleccionar --</option>
                                    <option value="1" >Técnico 1</option>
                                    <option value="2" >Técnico 2</option>
                                    <option value="3" >Técnico 3</option> 
                                    <option value="4" >Técnico 4</option> 
                                    <option value="5" >Técnico 5</option>    
                            </select>
                            </div>
                        </div>
                        <div class="ln_solid"></div>
                        <div class="form-group">
                            <div class="col-md-9 col-sm-9 col-xs-12 col-md-offset-3">
                              <button id="save_data" type="submit" class="btn btn-success">Guardar</button>
                            </div>
                        </div>    
                    </form>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-default" data-dismiss="modal">Cerrar</button>
                </div>
            </div>
        </div>
    </div>