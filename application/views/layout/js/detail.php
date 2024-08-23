<script src="https://code.jquery.com/ui/1.12.1/jquery-ui.js"></script>

<script>

    $(document).ready( function () {
        $("#print").on("click",function(){
            window.print();
        });

        <?php $this->session->unset_userdata('success'); ?>
        <?php $this->session->unset_userdata('error'); ?>
                 
    });

</script>