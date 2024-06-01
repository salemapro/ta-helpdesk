<div class="content-wrapper">
    <section class="content-header">
        <div class="container-fluid">
            <div class="row mb-2">

            </div>
        </div>
    </section>
    <section class="content">
        <div class="row mt-2">
            <div class="col-12">
                <div class="card">
                    <div class="card-header">
                        <h3 class="card-title">Application</h3>
                    </div>
                    <div class="card-body">
                        <div class="form-group">
                            <button class="btn btn-sm btn-primary" id="tambahApp"> <i class="fa fa-plus"></i> New Entry</button>
                        </div>
                        <table class="table table-bordered table-hover">
                            <thead align="center">
                                <tr>
                                    <th>No</th>
                                    <th>Application</th>
                                    <th>Company</th>
                                    <th class="notexport">Action</th>
                                </tr>
                            </thead>
                            <tbody>
                                <?php
                                $no = 1;
                                foreach ($app as $row) { ?>
                                    <tr>
                                        <td><?= $no++ ?></td>
                                        <td><?= $row->application ?></td>
                                        <td><?= $row->company ?></td>
                                        <td nowrap align="center">
                                            <button title="Update" class="btn btn-sm btn-success" onclick="get_app(<?= $row->id_application ?>);">
                                                <i class="fa fa-edit"></i>
                                            </button>
                                            &nbsp;
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
    </section>
</div>

<script type="text/javascript">
    $(document).ready(function() {

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
</script>