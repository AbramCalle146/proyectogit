<script src="https://code.jquery.com/ui/1.12.1/jquery-ui.js"></script>



<script>
    $(document).ready( function () {

        $('#saleTable').DataTable();
        $('#credictTable').DataTable();
        $(".nav-sale").addClass("active");

        $("#subtotal").prop( "disabled", true );
        $("#voucherIgv").prop( "disabled", true );
        $("#igv").prop( "disabled", true );
        $("#total").prop( "disabled", true );
        $("#voucherId").prop( "disabled", true );
        $("#clientId").prop( "disabled", true );

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
        
        voucher("Factura")
        search();

        $(document).on("click",".btn-remove", function(){
            $(this).closest("tr").remove();
            update();
        });

        $(document).on("keyup",".list-product #cant", function(){
            cant = Number($(this).val());
            price = Number($(this).closest("tr").find("td:eq(2)").text());
            stock = Number($(this).closest("tr").find("td:eq(3)").text());
            if (!Number.isInteger(cant) || cant >= stock) {
                $(this).addClass("is-invalid");
                $(this).closest("tr").find("td:eq(5)").text(0);
                update();
            } else {
                $(this).removeClass("is-invalid");
                importe = cant*price;
                $(this).closest("tr").find("td:eq(5)").text(importe.toFixed(2));
                update();
            }

        });

        $(document).on("keyup","#discount", function(){
            update();
        });

        $(".btn-voucher").on("click", function(){
            voucher($(this).text());
        });

        $(".list-client tr").on("click", function(){   
            $(".btn-inner--text").html($(this).find("td:eq(0)").text());
            $("#clientId").val(this.id);
        });

        $("#btnSave").on("click", function(){ 

            subtotal=$("#subtotal").val();
            igv=$("#igv").val();
            discount=$("#discount").val();
            total=$("#total").val();
            clientId=$("#clientId").val();
            voucherId= $("#voucherId").val();
            estado=$("#tipo_venta").val();
                
            ids=new Array();
            $(".list-product").find('tr').each (function() {
                ids.push($(this).find("td:eq(0)").text());
            });     
            
            prices=new Array();
            $(".list-product").find('tr').each (function() {
                prices.push($(this).find("td:eq(2)").text());
            });     

            cants=new Array();
            $(".list-product").find('tr').each (function() {
                cants.push($(this).find("#cant").val());
            }); 

            sale(subtotal,igv,discount,total,clientId,voucherId,estado,ids,prices,cants);
        
        });
        
    });

    
    function search(){
        $("#search-product").autocomplete({
            source: function( request, response ) {
                $.ajax({
                    url: "<?php echo base_url(); ?>sale/Main/getData",
                    type: "POST",
                    dataType:"json",
                    data:{ name: request.term},
                    success: function($data){
                        response($data);
                    }
                });
            },
            select:function(event, ul){

                var html='<tr>'+
                    '<td>'+ul.item.id+'</td>'+
                    '<td>'+ul.item.label+'</td>'+
                    '<td>'+ul.item.price+'</td>'+
                    '<td>'+ul.item.stock+'</td>'+
                    '<td><input id="cant" type="text" class="form-control" value="1" ></td>'+
                    '<td>'+ul.item.price+'</td>'+
                    '<td><button class="btn btn-icon btn-danger btn-remove" type="button"><span class="btn-inner--icon"><i class="ni ni-fat-remove ni-lg"></i></span></button></td>'
                    '</tr>';

                $(".list-product").append(html);
                update();
            },
        });
    }

    function voucher(name){
        $.ajax({
            url: "<?php echo base_url(); ?>sale/Main/voucherData",
            type: "POST",
            dataType:"json",
            data:{name:name},
            success: function(resp){

                $("#dropdownMenuButton").html(resp.name);
                $("#voucherId").val(resp.id);
                $("#voucherIgv").val(resp.igv);
                update();
            }
        });       
    }


    function update(){
        subtotal = 0;

        $(".list-product tr").each(function(){
            subtotal = subtotal + Number($(this).find("td:eq(5)").text());
        });
        
        $("#subtotal").val(subtotal.toFixed(2));

        porcentajeIgv = $("#voucherIgv").val();
        igv = subtotal * (porcentajeIgv/100);
        $("#igv").val(igv);

        descuento = $("#discount").val();
        total = (subtotal - descuento)+igv;
        $("#total").val(total.toFixed(2));
    }

    function sale(subtotal,igv,discount,total,clientId,voucherId,estado,ids,prices,cants){
        $.ajax({
            url: "<?php echo base_url();?>nuevo-venta/save",
            type: "POST",
            dataType:"json",
            data:{subtotal:subtotal,igv:igv,discount:discount,total:total,clientId:clientId,voucherId:voucherId,estado:estado,ids:ids,prices:prices,cants:cants },
            success: function(resp){

                Swal.fire({
                    type: resp.type,
                    title: 'Oops...',
                    text: resp.message
                });
                
            },
            error: function(){ 
                window.location="<?php echo base_url(); ?>ventas";
            }
        });
    }

</script>