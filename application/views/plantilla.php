<!doctype html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport"
          content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <link rel="stylesheet" href="<?php echo base_url('public/utils/bower_components/bootstrap/dist/css/bootstrap.min.css') ?>">
    <link rel="stylesheet" href="<?php echo base_url('public/utils/bower_components/bootstrap/dist/css/bootstrap-theme.min.css') ?>">
    <link rel="stylesheet" href="<?php echo base_url('public/css/bootstrap.min.css') ?>">
    <link rel="stylesheet" href="<?php echo base_url('public/utils/css/style.css') ?>">
    <link rel="stylesheet" href="<?php echo base_url('public/css/style.css') ?>">
    <link rel="stylesheet"
          href="<?php echo base_url('public/utils/bower_components/font-awesome/css/font-awesome.css') ?>">

    <title>Document</title>
</head>
<body>
<header>
    <div id="container">
        <div class="col-md-6 offset-md-3">
            <div class="card">
                <div class="card-header">
                    <div class="row">
                        <div class="col-md-4">
                            <?php print_r($title); ?>
                        </div>
                        <div class="col-md-6 offset-md-8">
                            <?php if ($action === 'create' || $action === 'edit' ) { ?>
                                <form method="POST" action="<?php echo base_url('reservation/listReservation') ?>">
                                    <button class="btn btn-dark">Reservation List</button>
                                </form>
                            <?php } else { ?>
                                <form method="POST" action="<?php echo base_url('reservation/index') ?>">
                                    <button class="btn btn-dark">Create Reservation</button>
                                </form>
                            <?php } ?>
                        </div>
                    </div>

                </div>
                <div class="card-body">
                    <?php if ($action === 'list') { ?>
                        <div id="grid"></div>

                    <?php } ?>
                    <?php

                    $this->load->view($content);
                    ?>
                </div>
            </div>
        </div>
    </div>
</header>
<footer>

</footer>
<script src="<?php echo base_url('public/utils/bower_components/jquery/dist/jquery.js') ?>"></script>
<script src="<?php echo base_url('public/utils/bower_components/jquery.form.min/index.js') ?>"></script>
<script src="<?php echo base_url('public/utils/ckeditor_4.16.0_standard/ckeditor/ckeditor.js') ?>"></script>
<script src="<?php echo base_url('public/js/knockout.js') ?>"></script>

<script src="<?php echo base_url('public/utils/bower_components/bootstrap/dist/js/bootstrap.min.js') ?>"></script>
<script src="<?php echo base_url('public/js/bootstrap.js') ?>"></script>
<script src="<?php echo base_url('public/utils/js/anexgrid/jquery.anexgrid.min.js') ?>"></script>
<script src="<?php echo base_url('public/utils/bower_components/moment/min/moment.min.js') ?>"></script>
<script src="<?php echo base_url('public/utils/js/ini.js') ?>"></script>
<script src="<?php echo base_url('public/js/action.js') ?>"></script>
<?php if ($action === 'create') { ?>
    <script>
        $('#contact_type').val("selected");
    </script>
<?php } ?>
<script>
    CKEDITOR.replace( 'description' );
</script>
<?php if ($action === 'list') { ?>
    <script>
        $(document).ready(function () {
            var data = {
                class: 'table-striped table-bordered table-condensed table-hover',
                columnas: [
                    {leyenda: 'Contact Name', class: '', ordenable: true, columna: 'nombre'},
                    {leyenda: 'Phone number', class: '', ordenable: true, columna: 'phone'},
                    {leyenda: 'Birth date', class: '', ordenable: true, columna: 'dob'},
                    {leyenda: 'Contact Type', class: '', ordenable: true, columna: 'contact_type'},
                    {style: 'width:40px;', leyenda:'Action'}
                ],
                modelo: [
                    { propiedad: 'nombre', formato: function (tr, obj, valor) {
                            return anexGrid_link({
                                href: "<?php echo base_url('reservation/edit') ?>"+'/' + obj.id,
                                contenido: valor
                            });
                        }},
                    {propiedad: 'phone'},
                    {propiedad: 'dob'},
                    {propiedad: 'contact_type'},
                    { propiedad: 'id', formato: function (tr, obj, valor) {
                            return anexGrid_boton({
                                type: 'button',
                                class: 'btn btn-xs btn-danger btn-block btn-eliminar',
                                value: valor,
                                contenido: '<i class="fa fa-trash"></i>'
                            });
                        }},
                ],
                url: "<?php echo base_url('reservation/grid') ?>",
                paginable: true,
                limite: [5, 10, 15, 20, 50, 100],
                columna: 'id',
                columna_orden: 'desc'
            };

            var grid = $("#grid").anexGrid(data);

            grid.tabla().on('click', '.btn-eliminar', function () {
                var obj = $(this);
                obj.attr('disabled', true);

                $.post("<?php echo base_url('reservation/delete')?>", {
                    id: obj.val()
                }, function (r) {
                    console.log(r)
                    if (r.response) {
                        grid.refrescar();
                    } else {
                        alert(r.message);
                    }
                }, 'json')
                grid.refrescar();
            })
        })
    </script>
<?php } ?>
</body>
</html>
