<div class="content-wrapper">
    <div class="content-header">
        <div class="container-fluid">
            <div class="row mb-3 mt-3">
                <div class="col-sm-6">
                    <h3 class="m-0 font-weight-bolder">Report</h3>
                </div>
                <div class="col-sm-6">
                    <!-- <ol class="breadcrumb float-sm-right">
                        <li class="breadcrumb-item"><a href="#">Home</a></li>
                        <li class="breadcrumb-item active">Dashboard v1</li>
                    </ol> -->
                    <div class="row">
                        <div class="col-11">
                            <!-- <button class="btn btn-primary text-sm float-right mr-2" onclick="crtTicket()">Create Ticket</button> -->
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
    </div>
    <section class="content">
        <div class="container-fluid">
            <div class="row mt-2">
                <div class="col-6">
                    <div class="card">
                        <div class="card-header">
                            <h3 class="card-title font-weight-bold">Start Date :</h3>
                        </div>
                        <div class="card-body">
                            <!-- <div class="form-group"> -->
                            <div class="input-group date p-0 shadow-sm" id="start-date" data-target-input="nearest">
                                <input type="text" id="start-date-data" placeholder="contoh: 2024-06-16" class="form-control datetimepicker-input py-4 px-4" data-toggle="datetimepicker" data-target="#start-date" />
                                <div class="input-group-append" data-target="#start-date" data-toggle="datetimepicker">
                                    <div class="input-group-text px-4"><i class="fa fa-calendar"></i></div>
                                </div>
                            </div>
                            <!-- </div> -->
                            <!-- <div class="datepicker date input-group p-0 shadow-sm">
                                <input id="reservationDate" type="text" placeholder="Choose a date" class="form-control py-4 px-4" />
                                <div class="input-group-append">
                                    <span class="input-group-text px-4">
                                        <i class="fa fa-calendae"></i>
                                    </span>
                                </div>
                            </div> -->
                            <!-- <div id="target" style="position:relative" data-target-input="nearest">
                                <input type="text" class="form-control datetimepicker-input" id="Datetimepicker" data-toggle="datetimepicker" data-target="#target" autocomplete="off" style="width: 200px;" />
                            </div> -->
                        </div>
                    </div>
                </div>
                <div class="col-6">
                    <div class="card">
                        <div class="card-header">
                            <h3 class="card-title font-weight-bold">End Date :</h3>
                        </div>
                        <div class="card-body">
                            <div class="input-group date p-0 shadow-sm" id="end-date" data-target-input="nearest">
                                <input type="text" id="end-date-data" placeholder="contoh: 2024-06-16" class="form-control datetimepicker-input py-4 px-4" data-toggle="datetimepicker" data-target="#end-date" autocomplete="off" />
                                <div class="input-group-append" data-target="#end-date" data-toggle="datetimepicker">
                                    <div class="input-group-text px-4"><i class="fa fa-calendar"></i></div>
                                </div>
                            </div>
                            <!-- <div class="form-group"> -->
                            <!-- <div class="input-group date p-0 shadow-sm" id="reservationdate2" data-target-input="nearest">
                                <input type="text" id="end-date" placeholder="contoh: 2024-06-16" class="form-control datetimepicker-input py-4 px-4" data-target="#reservationdate2" />
                                <div class="input-group-append" data-target="#reservationdate2" data-toggle="datetimepicker">
                                    <div class="input-group-text px-4"><i class="fa fa-calendar"></i></div>
                                </div>
                            </div> -->
                            <!-- </div> -->
                        </div>
                    </div>
                </div>
            </div>
            <div class="row mt-2">
                <div class="col-12">
                    <div class="card">
                        <div class="card-body table-responsive text-sm">
                            <table id="example1" class="table table-head-fixed text-nowrap">
                                <thead>
                                    <tr>
                                        <th class="col-ms-1 font-weight-normal text-sm">No</th>
                                        <th class="font-weight-normal text-sm">Customer</th>
                                        <th class="font-weight-normal text-sm">Ticket Number</th>
                                        <th class="font-weight-normal text-sm">Ticket Summary</th>
                                        <th class="font-weight-normal text-sm">Status</th>
                                        <th class="font-weight-normal text-sm">Action</th>
                                    </tr>
                                </thead>
                                <tbody id="tbody">
                                    <?php
                                    $no = 1;
                                    foreach ($ticket as $row) { ?>
                                        <tr>
                                            <td><?= $no++ ?></td>
                                            <td class="text-sm">
                                                <div class="media align-items-center">
                                                    <div class="avatar-wrapper2">
                                                        <img src="<?php echo base_url('assets/back') ?><?= $row->avatar; ?>" class="img-size-32 img-circle">
                                                    </div>
                                                    <div class="media-body ml-2 ">
                                                        <h4 class="dropdown-item-title text-sm mb-0 ">
                                                            <?= $row->fullname; ?>
                                                        </h4>
                                                        <p class="text-sm text-muted mb-0"><?= $row->email; ?></p>
                                                    </div>
                                                </div>
                                            </td>
                                            <td class="text-sm"><?= $row->no_ticket ?></td>
                                            <td class="text-sm"><?= $row->subject ?></td>
                                            <td class="text-sm">
                                                <?php if ($row->status_ticket == '0') {
                                                    echo '<span class="badge badge-danger">Waiting</span>';
                                                } else if ($row->status_ticket == '1') {
                                                    echo '<span class="badge badge-warning">Process</span>';
                                                } else {
                                                    echo '<span class="badge badge-success">Solved</span>';
                                                }
                                                ?>
                                            </td>
                                            <td class="text-sm">
                                                <a href="<?= base_url('helpdesk/report/print_report/' . $row->id_ticket) ?>" class="btn btn-default btn-sm">
                                                    <i class="fa fa-print"></i>
                                                </a>
                                            </td>
                                        </tr>
                                    <?php } ?>
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
</div>

<script>
    $(document).ready(function() {
        console.log('Document ready');
        if ($.fn.datetimepicker) {
            console.log('Datetime picker plugin loaded');
        } else {
            console.error('Datetime picker plugin not loaded');
        }
        $("#start-date").datetimepicker({
            format: 'YYYY-MM-DD',
            defaultDate: new Date()
        });

        $("#start-date").on("change.datetimepicker", ({
            date
            // oldDate
        }) => {
            console.log("New date", date);
            // console.log("Old date", oldDate);
            // alert("Changed date")
            filterTickets();
        })

        $("#end-date").datetimepicker({
            format: 'YYYY-MM-DD',
            defaultDate: new Date()
        });

        $("#end-date").on("change.datetimepicker", ({
            date
        }) => {
            console.log("New date", date);
            filterTickets();
        })


        // $('#reservationdate1').datetimepicker({
        //     format: 'YYYY-MM-DD'
        // }).on('dp.change', function(e) {
        //     console.log('Datetime picker 1 initialized');
        // });

        // $('#reservationdate2').datetimepicker({
        //     format: 'YYYY-MM-DD'
        // }).on('dp.change', function(e) {
        //     console.log('Datetime picker 2 initialized');
        // });

        // $('#start-date').on('change', function() {
        //     console.log('Start date changed');
        // });

        // $('#end-date').on('change', function() {
        //     console.log('End date changed');
        // });
        // $('#reservationdate1').datetimepicker({
        //     format: 'MM/DD/YYYY'
        // }).on('dp.change', function(e) {
        //     console.log('Datetime picker 1 initialized');
        // });

        // $('#reservationdate1').datetimepicker({
        //     format: 'YYYY-MM-DD'
        // }).on('dp.change', function(event) {
        //     console.log('Start date changed:', $('#start-date').val());
        // });

        // $('#reservationdate2').datetimepicker({
        //     format: 'YYYY-MM-DD'
        // }).on('dp.change', function(event) {
        //     console.log('End date changed:', $('#end-date').val());
        // });

        // $('#reservationdate1').datetimepicker({
        //     format: 'YYYY-MM-DD'
        // });
        // $('#reservationdate2').datetimepicker({
        //     format: 'YYYY-MM-DD'
        // });

        // $('#reservationdate1').datetimepicker({
        //     format: 'YYYY-MM-DD'
        // }).on('change.datetimepicker', function() {
        //     console.log('Datetime picker 1 initialized');
        // });

        // $('#reservationdate2').datetimepicker({
        //     format: 'YYYY-MM-DD'
        // }).on('change.datetimepicker', function() {
        //     console.log('Datetime picker 2 initialized');
        // });

        // $('#start-date').on('dp.change', function() {
        //     console.log('Start date changed');
        //     // filterTickets();
        // });

        // $('#end-date').on('change.datetimepicker', function() {
        //     console.log('End date changed');
        //     // filterTickets();
        // });

        $("#example1").DataTable({
            "responsive": true,
            "lengthChange": false,
            "autoWidth": false,
            "buttons": ["copy", "excel", "pdf", "print", "colvis"]
        }).buttons().container().appendTo('#example1_wrapper .col-md-6:eq(0)');
    });

    $(function() {
        //     $("#example1").DataTable({
        //         "responsive": true,
        //         "lengthChange": false,
        //         "autoWidth": false,
        //         "buttons": ["copy", "excel", "pdf", "print", "colvis"]
        //     }).buttons().container().appendTo('#example1_wrapper .col-md-6:eq(0)');

        //     $('#reservationdate1').datetimepicker({
        //         format: 'YYYY-MM-DD'
        //     });
        //     $('#reservationdate2').datetimepicker({
        //         format: 'YYYY-MM-DD'
        //     });

        //     // $('#start-date').on('change.datetimepicker', function() {
        //     //     console.log('Start date changed');
        //     //     filterTickets();
        //     // });

        //     // $('#end-date').on('change.datetimepicker', function() {
        //     //     console.log('End date changed');
        //     //     filterTickets();
        //     // });
        // $('#start-date').on('change', function() {
        //     console.log('Start date changed:', $(this).val());
        //     // filterTickets();
        // });

        // $('#end-date').on('change', function() {
        //     console.log('End date changed:', $(this).val());
        //     // filterTickets();
        // });
    });

    function filterTickets() {
        var startDate = $('#start-date-data').val();
        var endDate = $('#end-date-data').val();

        console.log('Start Date:', startDate);
        console.log('End Date:', endDate);
        console.log('Filtering tickets with dates:', startDate, endDate);

        $.ajax({
            url: '<?= base_url("helpdesk/report/filter_tickets") ?>',
            method: 'POST',
            data: {
                start_date: startDate,
                end_date: endDate
            },
            success: function(response) {
                $('#tbody').html(response);
            }
        });
    }

    function reload() {
        location.reload();
    }
</script>