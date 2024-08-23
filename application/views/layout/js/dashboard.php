<script>
    $(document).ready( function () {
        $(".nav-dashboard").addClass("active");
       
        <?php if($this->session->flashdata("success")):?>
            Swal.fire({
                position: 'top-end',
                type: 'success',
                title: '<?php echo $this->session->flashdata("success"); ?>',
                showConfirmButton: false,
                timer: 2000
            });
        <?php endif; ?>
        
        <?php $this->session->unset_userdata('success'); ?>
        <?php $this->session->unset_userdata('error'); ?>

        graphicCharYear();
        graphicCharWeek();

    });
    
    function graphicCharYear(){
        
      var chartyear= new Chart($('#chart-year'), {
            type: 'line',
            options: {
            scales: {
                yAxes: [{
                gridLines: {
                    lineWidth: 1,
                    color: Charts.colors.gray[900],
                    zeroLineColor: Charts.colors.gray[900]
                },
                ticks: {
                    callback: function(value) {
                    if (!(value % 10)) {
                        return  value;
                    }
                    }
                }
                }]
            },
            tooltips: {
                callbacks: {
                label: function(item, data) {
                    var label = data.datasets[item.datasetIndex].label || '';
                    var yLabel = item.yLabel;
                    var content = '';

                    if (data.datasets.length > 1) {
                    content += label;
                    }

                    content += '$ ' + yLabel;
                    return content;
                }
                }
            }
            },
            data: {
            labels: ['Ene', 'Feb','Mar', 'Abr', 'May', 'Jun', 'Jul', 'Ago', 'Sep','Oct',"Nov","Dec"],
            datasets: [{
                label: 'Performance',
                data: [0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0]
            }]
            }
        });

        dataChartYear("<?php echo date("Y"); ?>",chartyear);
        
        $(".dropdown-item").on("click", function(){
            var year = $(this).text();
            $("#dropdownMenuButton").html(year);
            dataChartYear(year,chartyear);
        });
    }

    function dataChartYear(year,chartyear){
        $.ajax({
            url: "<?php echo base_url(); ?>Dashboard/getSalesYear",
            type: "POST",
            dataType:"json",
            data:{ year: year},
            success: function(resp){
                amounts = [0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0];
                $.each(resp,function(key, value){
                    amounts[Number(value.month)-1] = Number(value.data);
                });
                chartyear.data.datasets[0].data = amounts;
                chartyear.update();
            }
        });
    }

    function graphicCharWeek(){
        var chartweek = new Chart($('#chart-week'), {
            type: 'bar',
            data: {
                labels: ['Do', 'Lu', 'Ma', 'Mi', 'Ju', 'Vi','Sa'],
                datasets: [{
                    label: '$',
                    data: [0, 0, 0, 0, 0, 0,0]
                }]
            }
        });

        dataChartWeek(chartweek);
    }


    function dataChartWeek(chartweek){
        $.ajax({
            url: "<?php echo base_url(); ?>Dashboard/getSalesWeek",
            type: "POST",
            dataType:"json",
            success: function(resp){
                amounts = [0, 0, 0, 0, 0, 0,0];
                $.each(resp,function(key, value){
                    amounts[Number(value.day)-1] = Number(value.data);
                });
                chartweek.data.datasets[0].data = amounts;
                chartweek.update();
            }
        });
    }

</script>