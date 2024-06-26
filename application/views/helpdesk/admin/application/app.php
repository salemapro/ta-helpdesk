<div class="content-wrapper">
    <section class="content-header">
        <div class="container-fluid">
            <div class="row mb-3 mt-3">
                <div class="col-sm-6">
                    <h3 class="m-0 font-weight-bolder">Application</h3>
                </div>
                <div class="col-sm-6">
                    <div class="row">
                        <div class="col-11">
                            <button class="btn btn-primary text-sm float-right mr-2" id="tambahApp">Create Application</button>
                        </div>
                        <div class="col-1">
                            <button class="btn btn-outline-primary text-sm float-right" onclick="reload()">
                                <i class="fas fa-sync"></i>
                            </button>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
    <section class="content">
        <div class="container-fluid">
            <div class="row mt-2">
                <div class="col-12">
                    <div class="card">
                        <!-- <div class="card-header">
                        <h3 class="card-title">Application</h3>
                    </div> -->
                        <div class="card-body table-responsive text-sm">
                            <!-- <div class="form-group">
                            <button class="btn btn-sm btn-primary" id="tambahApp"> <i class="fa fa-plus"></i> New Entry</button>
                        </div> -->
                            <table id="example1" class="table table-head-fixed text-nowrap">
                                <thead>
                                    <tr>
                                        <th class="col-md-1 font-weight-normal text-sm">No</th>
                                        <th class="font-weight-normal text-sm">Application</th>
                                        <th class="font-weight-normal text-sm">Company</th>
                                        <th class="col-md-2 font-weight-normal text-sm">Action</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <?php
                                    $no = 1;
                                    foreach ($app as $row) { ?>
                                        <tr>
                                            <td class="font-weight-normal text-sm"><?= $no++ ?></td>
                                            <td class="font-weight-normal text-sm"><?= $row->application ?></td>
                                            <td class="font-weight-normal text-sm"><?= $row->company ?></td>
                                            <td>
                                                <button title="Update" class="btn btn-sm btn-success" onclick="get_app(<?= $row->id_application ?>);">
                                                    <i class="fa fa-edit"></i>
                                                </button>
                                                <!-- &nbsp; -->
                                                <button title="Delete" onclick="deleteConfirm(<?= $row->id_application ?>);" class="btn btn-sm btn-danger">
                                                    <i class="fa fa-trash"></i>
                                                </button>
                                            </td>
                                        </tr>
                                    <?php } ?>
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
                <div class="col-12">
                    <div class="viewmodal" style="display: none;">

                    </div>
                </div>
            </div>
        </div>
    </section>
</div>

<script type="text/javascript">
    $(document).ready(function() {
        $("#example1").DataTable({
            "responsive": true,
            "lengthChange": false,
            "autoWidth": false,
            "buttons": ["copy", "excel", "pdf", "print", "colvis"]
        }).buttons().container().appendTo('#example1_wrapper .col-md-6:eq(0)');

        $('#tambahApp').click(function(e) {
            $.ajax({
                url: "<?php echo base_url('helpdesk/client/formTambahApp') ?>",
                dataType: "json",
                success: function(response) {
                    if (response.success) {
                        $('.viewmodal').html(response.success).show();
                        $('#modalTambahApp').on('shown.bs.modal', function(e) {
                            $('#application').focus();
                        })
                        $('#modalTambahApp').modal('show');
                    }
                }
            });
        });
    });

    function get_app(id) {
        $.ajax({
            type: "post",
            url: "<?php echo base_url('helpdesk/client/formEditApp') ?>",
            data: {
                id_app: id
            },
            dataType: "json",
            success: function(response) {
                if (response.success) {
                    $('.viewmodal').html(response.success).show();
                    $('#modalEditApp').on('shown.bs.modal', function(e) {
                        $('#application').focus();
                    })
                    $('#modalEditApp').modal('show');
                }
            }
        });
    }

    function deleteConfirm(id) {
        Swal.fire({
            title: 'Are you sure?',
            text: `You won't be able to revert this`,
            icon: 'warning',
            showCancelButton: true,
            confirmButtonColor: '#3085d6',
            cancelButtonColor: '#d33',
            confirmButtonText: 'Yes, delete it!',
            cancelButtonText: 'Cancel'
        }).then((result) => {
            if (result.value) {
                $.ajax({
                    type: "post",
                    url: "<?php echo base_url('helpdesk/client/deleteApp') ?>",
                    data: {
                        id_app: id,
                    },
                    dataType: "json",
                    success: function(response) {
                        if (response.success) {
                            Swal.fire({
                                icon: 'success',
                                title: 'konfirmasi',
                                text: response.success,
                                showCancelButton: false,
                                showConfirmButton: false
                            });
                            setTimeout(function() {
                                location.reload();
                            }, 1000);
                        }
                    }
                });
            }
        })
    }

    function reload() {
        location.reload();
    }
</script>