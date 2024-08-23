<script>
    $(document).ready(function () {
        $('#productTable').DataTable();
        $(".nav-product").addClass("active");

        category();
        upload();

        // Manejo de mensajes flash
        <?php if ($this->session->flashdata("success")): ?>
            Swal.fire({
                position: 'top-end',
                icon: 'success',
                title: '<?php echo $this->session->flashdata("success"); ?>',
                showConfirmButton: false,
                timer: 2000
            });
        <?php endif; ?>

        <?php if ($this->session->flashdata("error")): ?>
            Swal.fire({
                icon: 'error',
                title: 'Oops...',
                text: '<?php echo $this->session->flashdata("error") ?>',
            });
        <?php endif; ?>

        <?php $this->session->unset_userdata('success'); ?>
        <?php $this->session->unset_userdata('error'); ?>
    });

    function upload() {
        $('.custom-file-input').change(function(event) {
            var input = event.target;
            var file = input.files[0];
            var reader = new FileReader();

            reader.onload = function() {
                var dataURL = reader.result;
                $("#img-product").attr('src', dataURL);

                $('.custom-file-input').val('');

                var form = new FormData();
                form.append('picture', file);

                $.ajax({
                    url: '<?php echo base_url(); ?>nuevo-producto/upload',
                    type: "POST",
                    cache: false,
                    contentType: false,
                    processData: false,
                    dataType: "json",
                    data: form,
                    success: function(resp) {
                        Swal.fire({
                            icon: resp.type,
                            title: resp.type,
                            text: resp.message
                        });
                    }
                });
            };

            reader.readAsDataURL(file);
        });
    }

    function category() {
        $.ajax({
            url: "<?php echo base_url(); ?>product/Main/getData",
            type: "POST",
            dataType: "json",
            success: function(resp) {
                var html = [];
                var selectedCategoryId = <?php echo set_value('categoryId') ? set_value('categoryId') : (!empty($category_id) ? $category_id : 0) ?>;

                $.each(resp, function(key, value) {
                    var selected = value.id == selectedCategoryId ? 'selected' : '';
                    html.push('<option value="' + value.id + '" ' + selected + '>' + value.name + '</option>');
                });

                $("#category").html(html);
            }
        });
    }
</script>
