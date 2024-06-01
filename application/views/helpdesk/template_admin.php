<?php $this->load->view('helpdesk/admin/template/meta'); ?>
<div class="wrapper">
    <?php $this->load->view('helpdesk/admin/template/header'); ?>
    <?php $this->load->view('helpdesk/admin/template/sidebar'); ?>
    <script src="<?= base_url() ?>assets/back/plugins/jquery/jquery.min.js"></script>

    <?php echo $contents; ?>
    <!-- <?php $this->load->view('helpdesk/admin/template/footer'); ?> -->
</div>
<?php $this->load->view('helpdesk/admin/template/script'); ?>