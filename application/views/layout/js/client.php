<script>
    $(document).ready( function () {
        $('#clientTable').DataTable();
        $(".nav-client").addClass("active");

        clients();
        
        documents();

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

    function clients(){
        
        data =["Empresa","Otros"];
        var html=new Array();

        $.each(data,function(key, value){
            if(value == "<?php echo set_value('typeClient') ? set_value('typeClient'): (!empty($type_client) ? $type_client: 0) ?>"){
                html.push('<option  value="'+value+'" selected>'+value+'</option>');
            }else{
                html.push('<option  value="'+value+'">'+value+'</option>');
            }
        });

        $("#clients").html(html);
    }

    function documents(){

        data =["DNI","RUC"];

        var html=new Array();

        $.each(data,function(key, value){
            if(value == "<?php echo set_value('typeDocument') ? set_value('typeDocument'): (!empty($type_document) ? $type_document: 0) ?>"){
                html.push('<option  value="'+value+'" selected>'+value+'</option>');
            }else{
                html.push('<option  value="'+value+'">'+value+'</option>');
            }
        });

        $("#documents").html(html);
    }
    
</script>