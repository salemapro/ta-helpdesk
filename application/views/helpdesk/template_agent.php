<?php $this->load->view('helpdesk/agent/template/meta'); ?>
<div class="wrapper">
    <?php $this->load->view('helpdesk/agent/template/header'); ?>
    <?php $this->load->view('helpdesk/agent/template/sidebar'); ?>
    <script src="<?= base_url() ?>assets/back/plugins/jquery/jquery.min.js"></script>

    <?php echo $contents; ?>
    <!-- <?php $this->load->view('helpdesk/agent/template/footer'); ?> -->
</div>
<?php $this->load->view('helpdesk/agent/template/script'); ?>