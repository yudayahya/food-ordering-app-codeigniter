<!-- Bootstrap 3.3.7 -->
<link rel="stylesheet" href="<?php echo base_url() ?>template/AdminLTE/bower_components/bootstrap/dist/css/bootstrap.min.css">
<!-- Font Awesome -->
<link rel="stylesheet" href="<?php echo base_url() ?>template/AdminLTE/bower_components/font-awesome/css/font-awesome.min.css">
<!-- Ionicons -->
<link rel="stylesheet" href="<?php echo base_url() ?>template/AdminLTE/bower_components/Ionicons/css/ionicons.min.css">
<!-- DataTables -->
<link rel="stylesheet" href="<?php echo base_url() ?>template/AdminLTE/bower_components/datatables.net-bs/css/dataTables.bootstrap.min.css">
<!-- Theme style -->
<link rel="stylesheet" href="<?php echo base_url() ?>template/AdminLTE/dist/css/AdminLTE.min.css">
<!-- AdminLTE Skins. Choose a skin from the css/skins
       folder instead of downloading all of them to reduce the load. -->
<link rel="stylesheet" href="<?php echo base_url() ?>template/AdminLTE/dist/css/skins/_all-skins.min.css">
<!-- daterange picker -->
<link rel="stylesheet" href="<?php echo base_url() ?>template/AdminLTE/bower_components/bootstrap-daterangepicker/daterangepicker.css">
<link rel="stylesheet" type="text/css" href="https://cdn.datatables.net/v/bs4/jszip-2.5.0/dt-1.10.20/b-1.6.1/b-html5-1.6.1/datatables.min.css" />


<span id="success_message">

</span>
<div class="box">
    <div class="box-header">
        <h3 class="box-title">Data Transaksi <strong>SELESAI</strong></h3>
    </div>

    <!-- /.box-header -->
    <div class="box-body">
        <label for="">Gunakan Filter Tanggal Berikut :</label>
        <div class="row">
            <div class="col-lg-2">
                <div class="input-group">
                    <div class="input-group-addon">
                        <i class="fa fa-calendar"></i>
                    </div>
                    <input type="text" class="form-control pull-right" id="reservation">
                </div>
            </div>
        </div>
        <br>
        <div class="box-body table-responsive no-padding">
            <table id="tabel1" class="table table-bordered table-striped">
                <thead>
                    <tr>
                        <th>Order ID</th>
                        <th>Tanggal</th>
                        <th>Nama Member</th>
                        <th>Nama Produk</th>
                        <th>Deskripsi Varian</th>
                        <th>Harga Satuan</th>
                        <th>Qty</th>
                        <th>Sub Total</th>
                    </tr>
                </thead>
                <tbody id="show-data1">

                </tbody>
            </table>
        </div>
    </div>
    <!-- /.box-body -->
</div>

<!-- jQuery 3 -->
<script src="<?php echo base_url() ?>template/AdminLTE/bower_components/jquery/dist/jquery.min.js"></script>
<!-- Bootstrap 3.3.7 -->
<script src="<?php echo base_url() ?>template/AdminLTE/bower_components/bootstrap/dist/js/bootstrap.min.js"></script>
<!-- DataTables -->
<script src="<?php echo base_url() ?>template/AdminLTE/bower_components/datatables.net/js/jquery.dataTables.min.js"></script>
<script src="<?php echo base_url() ?>template/AdminLTE/bower_components/datatables.net-bs/js/dataTables.bootstrap.min.js"></script>
<!-- SlimScroll -->
<script src="<?php echo base_url() ?>template/AdminLTE/bower_components/jquery-slimscroll/jquery.slimscroll.min.js"></script>
<!-- FastClick -->
<script src="<?php echo base_url() ?>template/AdminLTE/bower_components/fastclick/lib/fastclick.js"></script>
<!-- AdminLTE App -->
<script src="<?php echo base_url() ?>template/AdminLTE/dist/js/adminlte.min.js"></script>
<!-- AdminLTE for demo purposes -->
<script src="<?php echo base_url() ?>template/AdminLTE/dist/js/demo.js"></script>
<!-- date-range-picker -->
<script src="<?php echo base_url() ?>template/AdminLTE/bower_components/moment/min/moment.min.js"></script>
<script src="<?php echo base_url() ?>template/AdminLTE/bower_components/bootstrap-daterangepicker/daterangepicker.js"></script>

<script type="text/javascript" src="https://cdnjs.cloudflare.com/ajax/libs/pdfmake/0.1.36/pdfmake.min.js"></script>
<script type="text/javascript" src="https://cdnjs.cloudflare.com/ajax/libs/pdfmake/0.1.36/vfs_fonts.js"></script>
<script type="text/javascript" src="https://cdn.datatables.net/v/bs4/jszip-2.5.0/dt-1.10.20/b-1.6.1/b-html5-1.6.1/datatables.min.js"></script>

<!-- page script -->
<script type="text/javascript">
    var table1;
    $(document).ready(function() {
        table1 = $('#tabel1').DataTable({
            "paging": true,
            "lengthChange": false,
            "pageLength": 50,
            "searching": false,
            "ordering": false,
            "info": false,
            "autoWidth": true,
            dom: 'Bfrtip',
            buttons: [{
                    extend: 'copyHtml5',
                    className: 'btn-primary'
                },
                {
                    extend: 'pdfHtml5',
                    className: 'btn-primary'
                },
                {
                    extend: 'excelHtml5',
                    className: 'btn-primary'
                },
            ],

            // Load data for the table's content from an Ajax source
            ajax: "<?= base_url('admin/transaksi/list_laporan') ?>",
            createdRow: function(row, data, dataIndex) {
                // If name is "Ashton Cox"
                if (data[0] === '') {
                    // Add COLSPAN attribute
                    $('td:eq(0)', row).attr('colspan', 6);

                    // Hide required number of columns
                    // next to the cell with COLSPAN attribute
                    $('td:eq(1)', row).css('display', 'none');
                    $('td:eq(2)', row).css('display', 'none');
                    $('td:eq(3)', row).css('display', 'none');
                    $('td:eq(4)', row).css('display', 'none');
                    $('td:eq(5)', row).css('display', 'none');

                    // Update cell data
                    this.api().cell($('td:eq(0)', row)).data('');
                }
            }
        });
    });

    function refreshTable() {
        table1.ajax.reload();
    }

    $(function() {
        //Date range picker
        $('#reservation').daterangepicker({
            opens: 'left'
        }, function(start, end, label) {
            console.log("A new date selection was made: " + start.format('YYYY-MM-DD') + ' to ' + end.format('YYYY-MM-DD'));

            $.ajax({
                type: "POST",
                url: "<?= base_url('admin/transaksi/sortByDate') ?>",
                dataType: "JSON",
                data: {
                    awal: start.format('YYYY-MM-DD'),
                    akhir: end.format('YYYY-MM-DD')
                },
                success: function(html) {
                    Toast.fire({
                        icon: 'success',
                        title: 'Filter Tanggal Berhasil Diterapkan.'
                    });
                    table1.clear();
                    table1.rows.add(html.data);
                    table1.draw();
                }
            });
        });

    });
</script>