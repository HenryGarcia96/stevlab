<?php $__env->startPush('plugin-styles'); ?> 
<link href="<?php echo e(asset('public/assets/plugins/datatables-net-bs5/dataTables.bootstrap5.css')); ?>" rel="stylesheet" />
<link href="<?php echo e(asset('public/assets/plugins/select2/select2.min.css')); ?>" rel="stylesheet" />
<link href="<?php echo e(asset('public/assets/plugins/sweetalert2/sweetalert2.min.css')); ?>" rel="stylesheet" />
<link href="<?php echo e(asset('public/assets/plugins/bootstrap-datepicker/bootstrap-datepicker.min.css')); ?>" rel="stylesheet" />
<link href="<?php echo e(asset('public/assets/plugins/jquery-tags-input/jquery.tagsinput.min.css')); ?>" rel="stylesheet" />
<link href="<?php echo e(asset('public/assets/plugins/@mdi/css/materialdesignicons.min.css')); ?>" rel="stylesheet" />
<link href="<?php echo e(asset('public/assets/plugins/prismjs/prism.css')); ?>" rel="stylesheet" />
<link href="<?php echo e(asset('public/assets/plugins/tempusdominus-bootstrap-4/tempusdominus-bootstrap-4.min.css')); ?>" rel="stylesheet" />

<?php $__env->stopPush(); ?>


<?php $__env->startSection('content'); ?>

    <nav class="page-breadcrumb">
        <ol class="breadcrumb">
            <li class="breadcrumb-item"><a href="<?php echo e(route('stevlab.dashboard')); ?>">StevLab</a></li>
            <li class="breadcrumb-item active" aria-current="page"> <a href="<?php echo e(route('stevlab.recepcion.index')); ?>">Recepcion</a> </li>
            <li class="breadcrumb-item active" aria-current="page"> <a href="<?php echo e(route('stevlab.recepcion.editar')); ?>">Solicitudes</a> </li>
            <li class="breadcrumb-item active" aria-current="page"> <a href="#">Editar solicitud</a> </li>
        </ol>
    </nav>



<!----------------------------------------------------------------------------------------------------->

<!---------------------------------------------------------------------------------------------------->
<div class="row">
    <div class="col-lg-12 grid-margin stretch-card">
        <div class="card">
            <div class="card-body">
                <input  class="form-control" id='identificador' name="identificador" type="hidden" readonly="readonly" value="<?php echo e($folio->id); ?>">
                <form id='edit_folio' class="form-sample">
                    <?php echo csrf_field(); ?>
                    <div class="row">
                        <div class="col-sm-3">
                            <div class="mb-3">
                                <label class="form-label">Folio:</label>
                                <input  class="form-control" id='folio' name="folio" type="text" readonly="readonly" value="<?php echo e($folio->folio); ?>">
                            </div>
                        </div>
                        <div class="col-sm-3">
                            <div class="mb-3">
                                <label class="form-label">F.Flebotomia:</label>
                                <div class="input-group date datepicker" id="datePickerExample" style='padding:0;'>
                                    <input type="text" class="form-control" id="f_flebotomia" name="f_flebotomia" value="<?php echo e($folio->f_flebotomia); ?>">
                                    <span class="input-group-text input-group-addon"><i data-feather="calendar"></i></span>
                                </div>
                            </div>
                        </div>
                        <div class="col-sm-3">
                            <div class="mb-3">
                                <label class="form-label">H.Flebotomia:</label>
                                <div class="input-group date" id="flebo_time" data-target-input="nearest">
                                    <input type="text" id='h_flebotomia' name="h_flebotomia" class="form-control datetimepicker-input" data-target="#flebo_time" value="<?php echo e($folio->h_flebotomia); ?>"/>
                                    <div class="input-group-append" data-target="#flebo_time" data-toggle="datetimepicker">
                                        <span class="input-group-text input-group-addon"><i data-feather="calendar"></i></span>
                                    </div>
                                </div>
                                
                            </div>
                        </div>
                        <div class="col-sm-3">
                            <div class="mb-3">
                                <label class="form-label">Fecha de entrega</label>
                                <div class="input-group date datepicker" >
                                    <input type="text" class="form-control " id="fecha_entrega" name="fecha_entrega" value="<?php echo e($folio->fecha_entrega); ?>">
                                    <span class="input-group-text input-group-addon"><i data-feather="calendar"></i></span>
                                </div>
                                
                            </div>
                        </div>
                    </div>
                    
                    <div class="row">
                        <div class="col-sm-6">
                            <div class="mb-3">
                                <label class="form-label">Nombre de paciente:</label>
                                <select class="js-example-basic-multiple form-control" multiple='multiple' id='id_paciente' name="id_paciente" data-width="100%">
                                    <?php
                                        if($folio->paciente()->first() != null){
                                            echo "<option selected value=" . $folio->paciente()->first()->id . ">". $folio->paciente()->first()->fecha_nacimiento ."-". $folio->paciente()->first()->nombre . "</option>";
                                        }else{

                                        }
                                    ?>
                                    
                                </select>
                            </div>
                        </div>
                        <div class="col-sm-6">
                            <div class="mb-3">
                                <label class="form-label">Empresa:</label>
                                <select class="js-example-basic-multiple form-control" multiple='multiple' id='id_empresa' name="id_empresa">
                                    <option selected value="<?php echo e($folio->empresas()->first()->id); ?>"><?php echo e($folio->empresas()->first()->descripcion); ?></option>
                                </select>
                            </div>
                        </div>
                    </div>
                    
                    <div class="row">
                        <div class="col-sm-4">
                            <div class="mb-3">
                                <label class="form-label">Tipo de paciente:</label>
                                <select class="form-select" id='tipPasiente' name="tipPasiente" data-width="100%">
                                    <option disabled>Seleccione</option>
                                    <option value="Lab.Clinico" <?php echo e(($folio->tipPasiente == 'Lab.Clinico') ? 'selected' : ''); ?>>Lab. Clinico</option>
                                </select>
                            </div>
                        </div>
                        <div class="col-sm-4">
                            <div class="mb-3">
                                <label class="form-label">Turno:</label>
                                <select class="form-select" name="turno" data-width="100%">
                                    <option disabled >Seleccione</option>
                                    <option value="Matutino" <?php echo e(($folio->turno == 'Matutino') ? 'selected' : ''); ?>>Matutino</option>
                                    <option value="Vespertino" <?php echo e(($folio->turno == 'Vespertino') ? 'selected' : ''); ?>>Vespertino</option>
                                    <option value="Nocturno" <?php echo e(($folio->turno == 'Nocturno') ? 'selected' : ''); ?>>Nocturno</option>
                                    <option value="Fines de semana" <?php echo e(($folio->turno == 'Fines de semana') ? 'selected' : ''); ?>>Fines de semana</option>
                                </select>
                            </div>
                        </div>
                        <div class="col-sm-4">
                            <div class="mb-3">
                                <label class="form-label">Servicio:</label>
                                <select class="form-select" name="servicio" data-width="100%">
                                    <option selected disabled>Seleccione</option>
                                    <option value="Lab.Clinico">Lab. Clinico</option>
                                    <option value="Urgencias">Urgencias</option>
                                    <option value="Urgencias">Clinicas y hosp</option>
                                    <option value="Urgencias">Pacientes ext</option>
                                </select>
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-sm-6">
                            <div class="mb-3">
                                <label class="form-label">Medico:</label>
                                <select class="js-example-basic-multiple form-control" multiple='multiple' id='id_doctor' name="id_doctor">
                                    <option selected value="<?php echo e($folio->doctores()->first()->id); ?>"><?php echo e($folio->doctores()->first()->clave); ?> - <?php echo e($folio->doctores()->first()->nombre); ?></option>
                                </select>
                            </div>
                        </div>
                    </div>
                    
                    <div class="row">
                        <div class="col-md-12">
                            <div class="mb-3">
                                <a data-bs-toggle="collapse" href="#colapse_registro" role="button" aria-expanded="" aria-controls="advanced-ui">
                                    <span>Datos de seguimiento</span>
                                    <i class="mdi mdi-plus"></i>
                                </a>
                            </div>
                        </div>
                    </div>
                    <div class="collapse " id="colapse_registro">
                        <div class="row">
                            <div class="col-sm-2">
                                <div class="mb-3">
                                    <label class="form-label">No. Cama:</label>
                                    <input class="form-control" id='numCama' name="numCama" value="<?php echo e($folio->numCama); ?>" type="number">
                                </div>
                            </div>
                            <div class="col-sm-2">
                                <div class="mb-3">
                                    <label class="form-label">Peso:</label>
                                    <input class="form-control" id='peso' name="peso"value="<?php echo e($folio->peso); ?>" type="text">
                                </div>
                            </div>
                            <div class="col-sm-2">
                                <div class="mb-3">
                                    <label class="form-label">Talla:</label>
                                    <input class="form-control" id="talla" name="talla"value="<?php echo e($folio->talla); ?>" type="text">
                                </div>
                            </div>
                            <div class="col-sm-2">
                                <div class="mb-3">
                                    <label class="form-label">FUR:</label>
                                    <input class="form-control" id='fur' name="fur" type="text" value="<?php echo e($folio->fur); ?>">
                                </div>
                            </div>
                            <div class="col-sm-4">
                                <div class="mb-3">
                                    <label class="form-label">Pais destino:</label>
                                    <input type="text" class="form-control" id="pais_destino" name="pais_destino" value="<?php echo e($folio->pais_destino); ?>">
                                </div>
                            </div>
                            
                            
                        </div>
                        
                        <div class="row">
                            <div class="col-sm-4">
                                <div class="mb-3">
                                    <label class="form-label">Aerolinea:</label>
                                    <input type="text" class="form-control" id="aerolinea" name="aerolinea" value="<?php echo e($folio->aerolinea); ?>">
                                </div>
                            </div>
                            <div class="col-sm-2">
                                <div class="mb-3">
                                    <label class="form-label">No. vuelo:</label>
                                    <input type="text" class="form-control" id="num_vuelo" name="num_vuelo" value="<?php echo e($folio->num_vuelo); ?>">
                                </div>
                            </div>
                        </div>
                        
                        <div class="row">
                            <div class="col-sm-6">
                                <div class="mb-3">
                                    <label class="form-label">Medicamento:</label>
                                    <input class="form-control mb-1 mb-md-0" id="medicamento" name="medicamento" type="text" value="<?php echo e($folio->medicamento); ?>">
                                </div>
                            </div>
                            <div class="col-sm-6">
                                <div class="mb-3">
                                    <label class="form-label">Diagnostico:</label>
                                    <input class="form-control mb-1 mb-md-0" id="diagnostico" name="diagnostico" value="<?php echo e($folio->diagnostico); ?>" type="text">
                                </div>
                                
                            </div>
                        </div>
                        
                    </div>
                    <div class="row">
                        <div class="col-sm-12">
                            <div class="mb-3">
                                <label for="defaultconfig-4" class="form-label">Observaciones:</label>
                                <textarea id="maxlength-textarea" class="form-control" maxlength="500" rows="3" id="observaciones" name="observaciones"><?php echo e($folio->observaciones); ?></textarea>
                            </div>
                        </div>
                        
                    </div>
                    
                    
                    <div class="row">
                        <div class="col-sm-12">
                            <div class="mb-3">
                                <label class="form-label">Estudios:</label>
                                <select name="listEstudio" id="listEstudio" class="js-example-basic-multiple form-select" multiple='multiple' data-width="100%">
                                </select>
                            </div>
                        </div>
                    </div>
                    
                    
                    <div class="row">
                        <div class="col-sm-12">
                            <div class="mb-3">
                                <div class="card">
                                    <div class="card-body">
                                        <div class="table-responsive-md">
                                            <table class="table">
                                                <thead>
                                                    <tr>
                                                        <th>Clv</th>
                                                        <th>Descrip</th>
                                                        <th>Tip</th>
                                                        <th>Cost</th>
                                                        <th>Conforme</th>
                                                        <th><i class="mdi mdi-wrench"></i></th>
                                                    </tr>
                                                </thead>
                                                <tbody id='listEstudios'>
                                                    
                                                    <?php $__currentLoopData = $lista; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $key => $item): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                                        <tr>
                                                            <th><?php echo e($item->clave); ?></th>
                                                            <td ><?php echo e($item->descripcion); ?></td>
                                                            <td><?php echo e($item->tipo); ?></td>
                                                            <td>
                                                                <span>
                                                                    <?php echo e($item->precio); ?>.00
                                                                </span>
                                                            </td>
                                                            <td class='text-center'>
                                                                <div class="form-check mb-3">
                                                                    <input type="checkbox" class="form-check-input" id="exampleCheck1">
                                                                    <label class="form-check-label" for="exampleCheck1"></label>
                                                                </div>
                                                            </td>
                                                            <td>
                                                                <a onclick="removeThisOfficialEstudio(this)"><i class="mdi mdi-backspace"></i></a>
                                                            </td>
                                                        </tr>
                                                    <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                                                </tbody>
                                            </table>
                                        </div>
                                        
                                        
                                    </div>
                                    
                                </div>
                            </div>
                            
                        </div>
                        
                    </div>
                    
                    <div class="row">

                        <div class="col-sm-12">
                            <div class="mb-3">
                                <label class="form-label">Total:</label>
                                <input disabled class="form-control fs-1"  name="num_total" type="text" placeholder="$00.00" id="num_total" value="$ <?php echo e($lista->sum('precio')); ?>.00">
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="mb-3">
                            <button id='guardar_folio' type="submit" class="btn btn-success">
                                <span id='search' class="spinner-border spinner-border-sm search" role="status" aria-hidden="true" style="display:none;"></span>
                                Guardar
                            </button>
                            <button onclick="borra_form()" type="button" class="btn btn-danger">Borrar</button>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-sm-12">
                            <div class="mb-3">
                                <label for="defaultconfig-4" class="form-label">Comentarios:</label>
                                <textarea id="maxlength-textarea" class="form-control" maxlength="500" rows="3" id="comentarios" name="comentarios"></textarea>
                            </div>
                        </div>
                        
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>
<!----------------------------------------------------------------------------------------------------->
<!------------------------------------------- RECIBO DE PAGO ------------------------------------------->
<div class="modal fade" id="modal_cobro" tabindex="-1" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1" aria-labelledby="modalCobroRecepcion" aria-hidden="true">
    <div class="modal-dialog modal-lg">
        <div class="modal-content static">
            <div class="modal-header">
                <h5 class="modal-title" id="modalCobroRecepcion">Actualizar cobro</h5>
                
            </div>
            <div class="modal-body">
                <div>
                    <div>
                        <div>
                            <input type="hidden" id="identificador_folio" name="identificador_folio" class="form-control" value="">
                        </div>
                    </div>
                </div>
                
                <div class="row">
                    <div class="col-sm-6">
                        <div class="mb-3">
                            <label class="form-label" for="pago_anterior">Pago anterior</label>
                            <span class="input-symbol-dollar">
                                <input disabled type="text" id="pago_anterior" name='pago_anterior' class="form-control fs-3">
                            </span>
                        </div>
                    </div>
                    <div class="col-sm-6">
                        <div class="mb-3">
                            <label class="form-label" for="monto_nuevo">Nuevo monto (actualizado sin descuentos anteriores)</label>
                            <span class="input-symbol-dollar">
                                <input disabled type="text" placeholder="$00.00" id="monto_nuevo" name='monto_nuevo' class="form-control fs-3">
                            </span>
                        </div>
                    </div>
                </div>
                <div class="row">
                    <div class="col-sm-6">
                        <div class="mb-3">
                            <label class="form-label" for="total_restante">Pago restante (actualizado + descuentos anteriores)</label>
                            <span class="input-symbol-dollar">
                                <input type="text" placeholder="$00.00" id="total_restante" name='total_restante' class="form-control fs-2">
                            </span>
                        </div>
                    </div>
                    <div class="col-sm-6">
                        <div class="mb-3">
                            <label class="form-label" for="">Descuento</label>
                            <span class="input-symbol-dollar">
                                <input onkeyup="calcula_cobro()"  type="number" id="solicitud_descuento" name="solicitud_descuento" class="form-control fs-2" placeholder="$00.00">
                            </span>
                        </div>
                    </div>
                </div>
                <div class="row">
                    <div class="col-sm-6">
                        <div class="mb-3">
                            <label class="form-label" for="">Subtotal</label>
                            <span class="input-symbol-dollar">
                                <input disabled type="text" placeholder="$00.00" id="solicitud_subtotal" name="solicitud_subtotal" class="form-control fs-2">
                            </span>
                        </div>
                    </div>
                    <div class="col-sm-6">
                        <div class="mb-3">
                            <label class="form-label" for="">Metodo de pago</label>
                            <select class="js-example-basic-single form-control fs-2" name="solicitud_metodo" id="solicitud_metodo">
                                <option disabled>Seleccione metodo de pago</option>
                                <option value="efectivo">Efectivo</option>
                                <option value="tarjeta">Tarjeta</option>
                                <option value="transferencia">Transferencia</option>
                            </select>
                        </div>
                    </div>
                </div>
                <div class="row">
                    <div class="col-sm-6">
                        <div class="mb-3">
                            <label class="form-label" for="">Cobro</label>
                            <input onkeyup="calcula_cambio()" type="number" id="solicitud_pago" name="solicitud_pago" class="form-control fs-2" placeholder="$00.00" value="0">
                        </div>
                    </div>
                    <div class="col-sm-6">
                        <div class="mb-3">
                            <label class="form-label" for="">Cambio</label>
                            <input disabled type="text" placeholder="$00.00" id="solicitud_cambio" name="solicitud_cambio" class="form-control fs-2">
                        </div>
                    </div>
                </div>
                <div class="row">
                    <div class="col-sm-12">
                        <div class="mb-3">
                            <label for="" class="form-label">Observaciones</label>
                            <textarea name="solicitud_observaciones" id="solicitud_observaciones" cols="30" rows="3" class="form-control"></textarea>
                        </div>
                    </div>
                </div>
                <div class="row">
                    <div class="col-sm-12">
                        <div class="mb-3">
                            <label class="form-label">Formato de ticket de venta</label>
                            <div>
                                <div class="form-check form-check-inline">
                                    <input value="ticket" type="radio" class="form-check-input" name="factura_radio" id="factura1">
                                    <label class="form-check-label" for="factura1">
                                        Ticket
                                    </label>
                                </div>
                                <div class="form-check form-check-inline">
                                    <input value="hoja" type="radio" class="form-check-input" name="factura_radio" id="factura2" checked>
                                    <label class="form-check-label" for="factura2" >
                                        Hoja
                                    </label>
                                </div>
                            </div>
                        </div>
                        
                    </div>
                    
                </div>
                
                
                <button id='boton-pagar' type="submit" onclick="genera_venta()" class="btn btn-primary"> <i class="mdi mdi-cash"></i> Generar venta</button>
                
            </div>
            <div class="modal-footer">
            </div>
        </div>
    </div>
</div>
<?php $__env->stopSection(); ?>

<?php $__env->startPush('plugin-scripts'); ?>
<script src="<?php echo e(asset('public/assets/plugins/jquery-validation/jquery.validate.min.js')); ?>"></script>
<script src="<?php echo e(asset('public/assets/plugins/datatables-net/jquery.dataTables.js')); ?>"></script>
<script src="<?php echo e(asset('public/assets/plugins/datatables-net-bs5/dataTables.bootstrap5.js')); ?>"></script>
<script src="<?php echo e(asset('public/assets/plugins/bootstrap-datepicker/bootstrap-datepicker.min.js')); ?>"></script>
<script src="<?php echo e(asset('public/assets/plugins/inputmask/jquery.inputmask.bundle.min.js')); ?>"></script>
<script src="<?php echo e(asset('public/assets/plugins/select2/select2.min.js')); ?>"></script>
<script src="<?php echo e(asset('public/assets/js/axios.min.js')); ?>"></script>
<script src="<?php echo e(asset('public/assets/plugins/sweetalert2/sweetalert2.min.js')); ?>"></script>
<script src="<?php echo e(asset('public/assets/plugins/moment/moment.min.js')); ?>"></script>
<script src="<?php echo e(asset('public/assets/plugins/tempusdominus-bootstrap-4/tempusdominus-bootstrap-4.js')); ?>"></script>
<?php $__env->stopPush(); ?>

<?php $__env->startPush('custom-scripts'); ?>
<script src="<?php echo e(asset('public/stevlab/recepcion/edicion/datepicker.js')); ?>?v=<?php echo rand();?>"></script>
<script src="<?php echo e(asset('public/stevlab/recepcion/edicion/inputmask.js')); ?>?v=<?php echo rand();?>"></script>
<script src="<?php echo e(asset('public/stevlab/recepcion/edicion/select2.js')); ?>?v=<?php echo rand();?>"></script>
<script src="<?php echo e(asset('public/stevlab/recepcion/edicion/functions.js')); ?>?v=<?php echo rand();?>"></script>
<script src="<?php echo e(asset('public/stevlab/recepcion/edicion/form-validation.js')); ?>?v=<?php echo rand();?>"></script>
<script src="<?php echo e(asset('public/stevlab/recepcion/edicion/caja.js')); ?>?v=<?php echo rand();?>"></script>

<?php $__env->stopPush(); ?>


<?php echo $__env->make('layout.master', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH /home2/pixelar6/micromed.book-medical.com/resources/views/recepcion/editar/editar.blade.php ENDPATH**/ ?>