<?php $__env->startPush('plugin-styles'); ?>
    <link href="<?php echo e(asset('public/assets/plugins/@mdi/css/materialdesignicons.min.css')); ?>" rel="stylesheet" />
    <link href="<?php echo e(asset('public/assets/plugins/sweetalert2/sweetalert2.min.css')); ?>" rel="stylesheet" />
    <link href="<?php echo e(asset('public/assets/plugins/datatables-net-bs5/dataTables.bootstrap5.css')); ?>" rel="stylesheet" />
    <link href="<?php echo e(asset('public/assets/plugins/bootstrap-datepicker/bootstrap-datepicker.min.css')); ?>" rel="stylesheet" />
    <link href="<?php echo e(asset('public/assets/plugins/select2/select2.min.css')); ?>" rel="stylesheet" />
<?php $__env->stopPush(); ?>

<?php $__env->startSection('content'); ?>

    <nav class="page-breadcrumb">
        <ol class="breadcrumb">
            <li class="breadcrumb-item"><a href="<?php echo e(route('stevlab.dashboard')); ?>">StevLab</a></li>
            <li class="breadcrumb-item active" aria-current="page"> <a href="<?php echo e(route('stevlab.recepcion.prefolio')); ?>">Prefolios</a> </li>
        </ol>
    </nav>
    
    <div class="row">
        
        
        <div class="col-md-12 col-lg-12 grid-margin stretch-card">
            <div class="card">
                <div class="card-body">
                    <h4 class="card-title">Prefolios</h4>
                    <div class="table-responsive">
                        <table id="dataTablePrefolios" class="table table-hover nowrap" style="width:100%">
                            <thead>
                                <tr>
                                    <th>#</th>
                                    <th>Prefolio</th>
                                    <th>Nombre</th>
                                    <th>Doctor</th>
                                    <th>Fecha</th>
                                    
                                </tr>
                            </thead>
                            <tbody id="listPrefolios">
                                
                            </tbody>
                        </table>
                        
                    </div>
                </div>
                
            </div>
        </div>
    </div>


    <!------------------------------------------------- PREFOLIO --------------------------------------------------------->

    <div class="modal fade" id="modal_prefolio" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="1" aria-labelledby="modal_pago" aria-hidden='true'> 
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="modalPago">Preparación del prefolio</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="btn-close"></button>
                </div>
                <div class="modal-body">
                    <form id="formPrefolio" class="form-sample">
                        <?php echo csrf_field(); ?>
                        <input type="hidden" id="identificador_folio" name="identificador_folio" class="form-control" value="">
                        <div class="row">
                            <div class="col-sm-12 col-md-12">
                                <div class="mb-3">
                                    <label class="form-label">Doctor:</label>
                                    <div class="row">
                                        <div class="col-sm-10 col-10">
                                            <select class="js-example-basic-multiple form-control" multiple='multiple' id='id_doctor' name="id_doctor" data-width="100%">
                                            </select>
                                        </div>
                                        <div class="col-sm-2 col-2">
                                            <button type="button" class="btn btn-xs btn-success" onclick="abre_modal_doctor()">
                                                <i class="mdi mdi-stethoscope"></i>
                                            </button>
                                        </div>
                                    </div>
                                    <p class="text-muted">Si no se agrego doctor al campo o no es la persona correcta, por favor puede agregarlo a través del campo o simplemente añadirlo (en caso de no existir) desde el botón.</p>
                                </div>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-sm-12 col-md-12">
                                <div class="mb-3">
                                    <label class="form-label" for="">Paciente</label>
                                    <div class="row">
                                        <div class="col-sm-10 col-10">
                                            <select class="js-example-basic-multiple form-control" multiple='multiple' id='id_paciente' name="id_paciente" data-width="100%">
                                            </select>
                                        </div>
                                        <div class="col-sm-2 col-2">
                                            <button type="button" class="btn btn-xs btn-success" onclick="abre_modal_pacientes()">
                                                <i class="mdi mdi-account-plus"></i>
                                            </button>
                                        </div>
                                        <p class="text-muted">Si no se agrego paciente al campo o no es la persona correcta, por favor puede agregarlo a través del campo o simplemente añadirlo (en caso de no existir) desde el botón.</p>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="row">
                            <div class="mb-3">
                                <label class="form-label" for="">Observaciones</label>
                                <textarea class="form-control" maxlength="500" rows="3" id="observaciones" name="observaciones"></textarea>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-sm-12">
                                <div class="mb-3">
                                    <label class='form-label' for="">Lista de estudios</label>
                                    <div class="card">
                                        <div class="card-body">
                                            <div class="table-responsive-md">
                                                <table class="table">
                                                    <thead>
                                                        <tr>
                                                            <th>Clv</th>
                                                            <th>Descrip</th>
                                                            <th>Tip</th>
                                                            
                                                            
                                                            
                                                        </tr>
                                                    </thead>
                                                    <tbody id='tablelistEstudios'>
                                                    </tbody>
                                                    <tbody id="tablelistPerfiles">
                                                    </tbody>
                                                </table>
                                            </div>
                                        </div>
                                        
                                    </div>
                                </div>
                                
                            </div>
                            
                        </div>
                        
                        <button type="submit" id='enviar_informacion' class="btn btn-primary"> <i class="mdi mdi-user"></i>Enviar información</button>                    
                    </form>
                </div>
                <div class="modal-footer">
                </div>
            </div>
        </div>
    </div>


        <!---------------------------------------------- NUEVO PACIENTE------------------------------------------------------>
    <div class="modal fade" tabindex="-1" aria-labelledby="myExtraLargeModalLabel" aria-hidden="true" id="modal_paciente">
        <div class="modal-dialog modal-xl">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="modalPaciente">Nuevo paciente</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="btn-close"></button>
                </div>
                <div class="modal-body">
                    <div class="row">
                        <div class="col-md-12">
                            <form id="storePatientForm" >
                                <?php echo csrf_field(); ?>
                                <div class="row">
                                    <div class="col-sm-12 col-md-6 col-lg-4">
                                        <div class="mb-3">
                                            <label class="form-label">Nombre</label>
                                            <input class="form-control " id='nombre_paciente' name="nombre" type="text" placeholder="Nombre completo">
                                        </div>
                                    </div>
                                    <div class="col-sm-12 col-md-6 col-lg-2">
                                        <div class="mb-3">
                                            <label class="form-label">Sexo</label>
                                            <select class="js-example-basic-single form-select " name="sexo" data-width="100%">
                                                <option value="masculino">Masculino</option>
                                                <option value="femenino">Femenino</option>
                                            </select>
                                        </div>
                                    </div>
                                    <div class="col-sm-12 col-md-6 col-lg-3">
                                        <div class="mb-3">
                                            <label class="form-label">Fecha Nacimiento</label>
                                            <div class="input-group date datepicker" style="padding: 0">
                                                <input type="text" class="form-control " id="fecha_nacimiento" name="fecha_nacimiento" data-date-end-date="0d" >
                                                <span class="input-group-text input-group-addon"><i data-feather="calendar"></i></span>
                                            </div>
                                            
                                        </div>
                                    </div>
                                    <div class="col-sm-12 col-md-2 col-lg-2 col-xl-3">
                                        <div class="mb-3">
                                            <label class="form-label">Edad</label>
                                            <input type="number" class="form-control" id="edad_or" name="edad" placeholder="Edad">
                                        </div>
                                    </div>
                                    <div class="col-sm-12 col-md-6 col-lg-3">
                                        <div class="mb-3">
                                            <label class="form-label">Celular</label>
                                            
                                            <input type="number" class="form-control" name="celular" placeholder="Número de telefono con código de área">
                                            <p class="text-muted ">"5219931077629"</p>
                                        </div>
                                    </div>
                                </div>
                                
                                <div class="row">
                                    <div class="col-sm-12 col-md-6 col-lg-5">
                                        <div class="mb-3">
                                            <label class="form-label">Domicilio</label>
                                            <input class="form-control" name="domicilio" type="text" placeholder="Domicilio">
                                        </div>
                                    </div>
                                    <div class="col-sm-12 col-md-6 col-lg-4">
                                        <div class="mb-3">
                                            <label class="form-label">Colonia</label>
                                            <input type="text" class="form-control" name="colonia" placeholder="Colonia">
                                        </div>
                                    </div>
                                    <div class="col-sm-12 col-md-6 col-lg-3">
                                        <div class="mb-3">
                                            <label class="form-label">No. Seguro</label>
                                            <input type="text" class="form-control" name="seguro_popular" placeholder="NSS">
                                        </div>
                                    </div>
                                </div>
                                
                                
                                <div class="row">
                                    <div class="col-sm-12 col-md-6 col-lg-3">
                                        <div class="mb-3">
                                            <label class="form-label">Vigencia inicio</label>
                                            <div class="input-group date datepicker"  style="padding: 0">
                                                <input type="text" class="form-control" id="vigencia_inicio" name="vigencia_inicio">
                                                <span class="input-group-text input-group-addon"><i data-feather="calendar"></i></span>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-sm-12 col-md-6 col-lg-3">
                                        <div class="mb-3">
                                            <label class="form-label">Vigencia fin</label>
                                            <div class="input-group date datepicker" style="padding: 0" >
                                                <input type="text" class="form-control" id="vigencia_fin" name="vigencia_fin" >
                                                <span class="input-group-text input-group-addon"><i data-feather="calendar"></i></span>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-sm-12 col-md-6 col-lg-4">
                                        <div class="mb-3">
                                            <label class="form-label">Email</label>
                                            <input type="email" class="form-control" name="email" placeholder="Correo electrónico">
                                        </div>
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="col-sm-12 col-md-6 col-lg-6">
                                        <div class="mb-3">
                                            <label class="form-label">Empresa</label>   
                                            <select class="js-example-basic-multiple form-control" multiple='multiple' id='id_empresa_paciente' name="id_empresa" data-width="100%">
                                            </select>
                                        </div>
                                    </div>
                                </div>
                                
                                
                                
                                <button type="submit" class="btn btn-primary">Guardar</button>
                                
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>


    <!---------------------------------------------- NUEVO MEDICO------------------------------------------------------>
    <div class="modal fade " tabindex="-1" aria-labelledby="myExtraLargeModalLabel" aria-hidden="true" id='modal_doctor'>
        <div class="modal-dialog modal-xl">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title">Nuevo medico</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="btn-close"></button>
                </div>
                <div class="modal-body">
                    <div class="row">
                        <div class="col-md-12">
                            <form id='storeDoctorForm'>
                                <div class="row">
                                    <div class="col-sm-2">
                                        <div class="mb-3">
                                            <label class="form-label">Clave</label>
                                            <input class="form-control" name="clave" value="<?php echo e(old('clave')); ?>"type="text" placeholder="Clave doctor">
                                        </div>
                                    </div>
                                    <div class="col-sm-4">
                                        <div class="mb-3">
                                            <label class="form-label">Nombre</label>
                                            <input class="form-control" id='nombre_doctor' name="nombre" value="<?php echo e(old('nombre')); ?>" type="text" placeholder="Nombre completo">
                                        </div>
                                    </div>
                                    <div class="col-sm-3">
                                        <div class="mb-3">
                                            <label class="form-label">Telefono</label>
                                            <input type="number" class="form-control" name="telefono" value="<?php echo e(old('telefono')); ?>" placeholder="Número de télefono">
                                        </div>
                                    </div>
                                    <div class="col-sm-3">
                                        <div class="mb-3">
                                            <label class="form-label">Celular</label>
                                            <input type="number" class="form-control" name="celular" value="<?php echo e(old('celular')); ?>" placeholder="Número de celular">
                                        </div>
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="col-sm-4">
                                        <div class="mb-3">
                                            <label class="form-label">Email</label>
                                            <input type="email" class="form-control" name="email" value="<?php echo e(old('email')); ?>" placeholder="Correo electrónico">
                                        </div>
                                    </div>
                                </div>
                                
                                <button type="submit" class="btn btn-primary">Guardar</button>
                            </form>
                        </div>
                    </div>
                    
                </div>
                
            </div>
        </div>
    </div>
<?php $__env->stopSection(); ?>

<?php $__env->startPush('plugin-scripts'); ?>
    <script src="<?php echo e(asset('public/assets/js/axios.min.js')); ?>"></script>
    <script src="<?php echo e(asset('public/assets/plugins/bootstrap-datepicker/bootstrap-datepicker.min.js')); ?>"></script>
    <script src="<?php echo e(asset('public/assets/plugins/sweetalert2/sweetalert2.min.js')); ?>"></script>
    <script src="<?php echo e(asset('public/assets/plugins/datatables-net/jquery.dataTables.js')); ?>"></script>
    <script src="<?php echo e(asset('public/assets/plugins/datatables-net-bs5/dataTables.bootstrap5.js')); ?>"></script>
    <script src="<?php echo e(asset('public/assets/plugins/datatables-net-bs5/dataTables.responsive.min.js')); ?>"></script>
    <script src="<?php echo e(asset('public/assets/plugins/moment/moment.min.js')); ?>"></script>
    <script src="<?php echo e(asset('public/assets/plugins/select2/select2.min.js')); ?>"></script>
    <script src="<?php echo e(asset('public/assets/plugins/jquery-validation/jquery.validate.min.js')); ?>"></script>
    <script src="<?php echo e(asset('public/assets/plugins/tempusdominus-bootstrap-4/tempusdominus-bootstrap-4.js')); ?>"></script>
    <script src="<?php echo e(asset('public/assets/plugins/bootstrap-datepicker/bootstrap-datepicker.min.js')); ?>"></script>
    <script src="<?php echo e(asset('public/assets/plugins/ckeditor5-build-classic/ckeditor.js')); ?>" ></script>

<?php $__env->stopPush(); ?>

<?php $__env->startPush('custom-scripts'); ?>
    <script src="<?php echo e(asset('public/stevlab/recepcion/prefolios/data-table.js')); ?>?v=<?php echo rand();?>"></script>
    <script src="<?php echo e(asset('public/stevlab/recepcion/prefolios/functions.js')); ?>?v=<?php echo rand();?>"></script>
    <script src="<?php echo e(asset('public/stevlab/recepcion/prefolios/select2.js')); ?>?v=<?php echo rand();?>"></script>
    <script src="<?php echo e(asset('public/stevlab/recepcion/prefolios/form-validation.js')); ?>?v=<?php echo rand();?>"></script>
    <script src="<?php echo e(asset('public/stevlab/recepcion/prefolios/datepicker.js')); ?>?v=<?php echo rand();?>"></script>
    <script src="<?php echo e(asset('public/stevlab/recepcion/prefolios/ckeditor.js')); ?>?v=<?php echo rand();?>"></script>
<?php $__env->stopPush(); ?>
<?php echo $__env->make('layout.master', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH /home2/pixelar6/micromed.book-medical.com/resources/views/recepcion/prefolios/index.blade.php ENDPATH**/ ?>