<script>
    $(document).ready( function () {
        $('#categoryTable').DataTable();
        $(".nav-category").addClass("active");

        <?php if($this->session->flashdata("success")):?>
        Swal.fire({
            position: 'top-end',
            type: 'success',
            title: '<?php echo $this->session->flashdata("success"); ?>',
            showConfirmButton: false,
            timer: 2000
        })
        <?php endif; ?>

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