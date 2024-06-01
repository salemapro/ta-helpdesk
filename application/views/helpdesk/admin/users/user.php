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
                        <h3 class="card-title">User</h3>
                        <!-- <a href="<?= base_url('') ?>" class="btn btn-primary btn-sm float-right ">Create User</a> -->
                        <button class="btn btn-primary text-sm float-right" onclick="crtUser()">Create User</button>

                    </div>

                    <div class="card-body">
                        <table class="table table-bordered">
                            <thead>
                                <tr>
                                    <th>No</th>
                                    <th>Name</th>
                                    <th>Role</th>
                                    <th>Status</th>
                                    <th>Action</th>
                                </tr>
                            </thead>
                            <tbody>
                                <?php
                                $no = 1;
                                foreach ($user as $key => $row) { ?>
                                    <tr>
                                        <td><?= $no++ ?></td>
                                        <td>
                                            <?= $row->fullname ?><br>
                                            <p class="text-black-50 font-weight-light text-sm"><i class="fas fa-envelope"></i> <?= $row->email ?></p>
                                        </td>
                                        <td>
                                            <?php if ($row->divisi_id == 0) {
                                                echo $row->role . ' - Client';
                                            } else {
                                                echo $row->role . ' - ' . $row->divisi;
                                            }
                                            ?>
                                        </td>
                                        <td>
                                            <?php if ($row->status == '1') {
                                                echo 'Active';
                                            } else {
                                                echo 'Non Active';
                                            }
                                            ?>
                                        </td>
                                        <td nowrap align="center">
                                            <button title="Update" class="btn btn-sm btn-success" onclick="get_user(<?= $row->id_user ?>);">
                                                <i class="fa fa-edit"></i>
                                            </button>
                                            &nbsp;
                                            <button title="Delete" onclick="deleteConfirm(<?= $row->id_user ?>);" class="btn btn-sm btn-danger">
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
        </div>
    </section>
</div>

<script type="text/javascript">
    function crtUser() {
        window.location.href = "<?= base_url('helpdesk/user/new_user') ?>"
    }

    function get_user(id) {
        var id_user = id
        if (id_user != "") {
            window.location.href = "<?= base_url('helpdesk/user/edit_user/') ?>" + id_user;
        } else {
            alert('Oops.!!');
        }
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
                    url: "<?php echo base_url('helpdesk/user/deleteUser') ?>",
                    data: {
                        id_user: id,
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