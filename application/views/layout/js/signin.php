<script>
    $(document).ready( function () {
        <?php if($this->session->flashdata("error")):?>
            Swal.fire({
                type: 'error',
                title: 'Oops...',
                text: '<?php echo $this->session->flashdata("error") ?>',
            })
        <?php endif; ?>

        <?php $this->session->unset_userdata('success'); ?>
        <?php $this->session->unset_userdata('error'); ?>
    });
</script>