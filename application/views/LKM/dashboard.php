<?php $this->load->view('kaprodi/head'); ?>
<?php $this->load->view('kaprodi/header'); ?>
<div class="jumbotron">
    <form action="#" id="form" class="form-horizontal">
        <div align="center">
            <select name="tahun" id="tahun" class="form-control" required style="width: 20%;" onchange="get_value()">
                <option value="">--Pilih Tahun--</option>
                <?php
                foreach ($tahun_record as $th) {
                    echo "<option value='" . $th['Tahun_ID'] . "'>" . $th['Tahun_ID'] . "</option>";
                }
                ?>
            </select>
        </div>
        <span class="help-block"></span>
    </form>
    <div id="container">
    </div>
    <hr>
</div>
</div>
<p id="demo"></p>
<?php
$jurusan = array();
$rata = array();
foreach ($query as $row) {
    $jurusan[] = array($row->nm_jur);
    $rata[] = array($row->kategori, floatval($row->rata_rata));
}
?>
<!-- jQuery 3 -->
<script src="<?php echo base_url() . "assets/backend/bower_components/jquery/dist/jquery.min.js" ?>"></script>
<!-- Bootstrap 3.3.7 -->
<script src="<?php echo base_url() . "assets/backend/bower_components/bootstrap/dist/js/bootstrap.min.js" ?>"></script>
<!-- SlimScroll -->
<script src="<?php echo base_url() . "assets/backend/bower_components/jquery-slimscroll/jquery.slimscroll.min.js" ?>"></script>
<!-- FastClick -->
<script src="<?php echo base_url() . "assets/backend/bower_components/fastclick/lib/fastclick.js" ?>"></script>
<!-- AdminLTE App -->
<script src="<?php echo base_url() . "assets/backend/dist/js/adminlte.min.js" ?>"></script>
<!-- AdminLTE for demo purposes -->
<script src="<?php echo base_url() . "assets/backend/dist/js/demo.js" ?>"></script>
<script src="<?php echo base_url() . "assets/backend/Highchart/highcharts.js" ?>"></script>
<script src="<?php echo base_url() . "assets/backend/Highchart/exporting.js" ?>"></script>
<script src="<?php echo base_url() . "assets/backend/Highchart/data.js" ?>"></script>
<script src="<?php echo base_url() . "assets/backend/Highchart/drilldown.js" ?>"></script>
<script type="text/javascript">
    function get_value() {
        var selector = document.getElementById('tahun');
        var value = selector[selector.selectedIndex].value;
        window.location = "<?php echo base_url() . "Dashboard_user/get_one/" ?>" + value;
    }


    Highcharts.chart('container', {
        chart: {
            type: 'column'
        },
        title: {
            text: 'Rata-rata hasil penilaian kinerja dosen'
        },
        subtitle: {
            text: 'Tahun akademik: <?= json_encode(intval($tahun)); ?>'
        },
        xAxis: {
            categories: <?= json_encode($jurusan); ?>,
            crosshair: true
        },
        yAxis: {
            min: 0,
            title: {
                text: 'Rata-rata'
            }
        },
        tooltip: {
            headerFormat: '<span style="font-size:10px">{point.key}</span>',
            pointFormat: '<table><tr><td style="color:{series.color};padding:0">Rata-rata keseluruhan: </td>' +
                '<td style="padding:0"><b>{point.y:.2f}</b></td></tr>',
            footerFormat: '</table>',
            shared: true,
            useHTML: true
        },
        plotOptions: {
            column: {
                colorByPoint: true,
                pointPadding: 0.2,
                borderWidth: 0
            }
        },
        series: [{

            showInLegend: false,
            data: <?= json_encode($rata); ?>,

        }]
    });
</script>
</body>

</html>