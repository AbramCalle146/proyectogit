<script>
    $(document).ready( function () {

        $(".navbar-top").addClass("bg-default");


        <?php if(file_exists("./assets/img/user/".$this->session->userdata("picture"))): ?>
            $(".header").css({
              "background-image":
              "url(<?php echo base_url(); ?>assets/img/user/<?php echo $this->session->userdata("picture"); ?>)"
            });
        <?php else: ?>
            $(".header").css({
              "background-image":
              "url(<?php echo base_url(); ?>assets/img/user/img.png)"
            });
        <?php endif ?>

        <?php if($this->session->flashdata("success")):?>
        Swal.fire({
            position: 'top-end',
            type: 'success',
            title: '<?php echo $this->session->flashdata("success"); ?>',
            showConfirmButton: false,
            timer: 2000
        })
        <?php endif; ?>

        <?php $this->session->unset_userdata('success'); ?>
        <?php $this->session->unset_userdata('error'); ?>

        upload();
    });
    
    function upload(){
        $('.custom-file-input').change(function() {
			var input = event.target;
			var name=this.id;
			var reader = new FileReader();
			reader.onload = function(){

				var dataURL = reader.result;
				var file = input.files[0];
				var form = new FormData();

                $(".label-profile img").attr('src', dataURL);
                
                $('.custom-file-input').val('');
                
				form.append('picture', file);

                $.ajax({
                    url: '<?php echo base_url(); ?>perfil/upload',
                    type: "POST",
                    cache: false,
                    contentType: false,
                    processData: false,
                    dataType:"json",
                    data : form,
                    success: function(resp){
                        Swal.fire({
                            type: resp.type,
                            title: resp.type,
                            text: resp.message
                        });
                    }
                });

			};

			reader.readAsDataURL(input.files[0]);
		});
    }
</script>