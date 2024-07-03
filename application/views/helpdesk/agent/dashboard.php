        <div class="content-wrapper">
            <div class="content-header">
                <div class="container-fluid">
                    <div class="row mb-3 mt-3">
                        <div class="col-sm-6">
                            <h1 class="m-0 font-weight-bolder">Dashboard </h1>
                        </div>
                        <div class="col-sm-6">

                        </div>
                    </div>
                    <div class="alert alert-success"> Selamat Datang <b><?= $this->session->fullname; ?></b></div>
                </div>
            </div>
            <section class="content">
                <div class="container-fluid">
                    <div class="row">
                        <div class="col-lg-3 col-6">
                            <div class="small-box bg-info">
                                <div class="inner">
                                    <h3><?= $ticket_wait ?></h3>

                                    <p>Menunggu Respon</p>
                                </div>
                                <div class="icon">
                                    <i class="ion ion-bag"></i>
                                </div>
                                <a href="#" class="small-box-footer">More info <i class="fas fa-arrow-circle-right"></i></a>
                            </div>
                        </div>
                        <div class="col-lg-3 col-6">
                            <div class="small-box bg-success">
                                <div class="inner">
                                    <h3><?= $ticket_proses ?></h3>

                                    <p>Proses Pengerjaan</p>
                                </div>
                                <div class="icon">
                                    <i class="ion ion-stats-bars"></i>
                                </div>
                                <a href="#" class="small-box-footer">More info <i class="fas fa-arrow-circle-right"></i></a>
                            </div>
                        </div>
                        <div class="col-lg-3 col-6">
                            <div class="small-box bg-warning">
                                <div class="inner">
                                    <h3><?= $ticket_close ?></h3>

                                    <p>Ticket Success</p>
                                </div>
                                <div class="icon">
                                    <i class="ion ion-person-add"></i>
                                </div>
                                <a href="#" class="small-box-footer">More info <i class="fas fa-arrow-circle-right"></i></a>
                            </div>
                        </div>
                        <div class="col-lg-3 col-6">
                            <div class="small-box bg-danger">
                                <div class="inner">
                                    <h3><?= $user ?></h3>

                                    <p>Karyawan</p>
                                </div>
                                <div class="icon">
                                    <i class="ion ion-pie-graph"></i>
                                </div>
                                <a href="#" class="small-box-footer">More info <i class="fas fa-arrow-circle-right"></i></a>
                            </div>
                        </div>
                    </div>
                </div>
            </section>
        </div>
        <script>
            // $(document).ready(function() {
            //     var list = <?php echo json_encode($ticket_wait); ?>;
            //     if (list.length == 0) {
            //         Swal.fire('Information', 'You have new ticket', 'info');
            //     }
            // });
        </script>