

<?php $__env->startSection('content'); ?>

<style>
    .table-responsive-custom {
        overflow-x: auto;
        -webkit-overflow-scrolling: touch;
    }
    .form-control {
        border-radius: 10px;
        padding: 0.75rem 1rem;
        transition: all 0.2s;
        min-height: 46px;
        height: auto;
    }
    .form-control:focus {
        box-shadow: 0 0 0 4px rgba(16, 185, 129, 0.15);
        border-color: #10b981;
    }
    select.form-control {
        padding-right: 2.5rem;
        background-image: url("data:image/svg+xml,%3csvg xmlns='http://www.w3.org/2000/svg' viewBox='0 0 16 16'%3e%3cpath fill='none' stroke='%23343a40' stroke-linecap='round' stroke-linejoin='round' stroke-width='2' d='m2 5 6 6 6-6'/%3e%3c/svg%3e");
        background-repeat: no-repeat;
        background-position: right 0.75rem center;
        background-size: 16px 12px;
        -webkit-appearance: none;
        -moz-appearance: none;
        appearance: none;
    }
    .btn {
        border-radius: 10px;
    }
    .card {
        border: none;
        box-shadow: 0 4px 20px rgba(0, 0, 0, 0.08);
        border-radius: 16px;
    }
</style>
<?php
$total_transaksi = 0;

function tgl_indo($tanggal){
    $bulan=array(
        1=>'Januari',
        'Februari',
        'Maret',
        'April',
        'Mei',
        'Juni',
        'Juli',
        'Agustus',
        'September',
        'Oktober',
        'November',
        'Desember'
    );

$pecahkan=explode('-',$tanggal);

return $pecahkan[2].' '.$bulan[(int)$pecahkan[1]].' '.$pecahkan[0];
}
?>

<div class="content_wrapper py-4">
    <!--middle content wrapper-->
    <div class="middle_content_wrapper">
        <!-- counter_area -->
        <section class="counter_area">
            <div class="card">
                <div class="card-header">
                    <div class="row g-3 align-items-center justify-content-between">
                        <div class="col-12 col-lg-4">
                            <h2 class="mb-0 fw-bold">Laporan Bulanan Cafe</h2>
                        </div>
                        <div class="col-12 col-lg-8">
                            <form action="/laporan_cafe_bulanan/search" method="GET" class="d-flex flex-wrap gap-2 justify-content-lg-end align-items-center">
                                <?php echo csrf_field(); ?>
                                <div class="d-flex align-items-center gap-2">
                                    <label for="search" class="fw-semibold mb-0">Bulan</label>
                                    <select name="search" id="search" class="form-control" style="min-width: 120px;">
                                        <option value="01">Januari</option>
                                        <option value="02">Februari</option>
                                        <option value="03">Maret</option>
                                        <option value="04">April</option>
                                        <option value="05">Mei</option>
                                        <option value="06">Juni</option>
                                        <option value="07">Juli</option>
                                        <option value="08">Agustus</option>
                                        <option value="09">September</option>
                                        <option value="10">Oktober</option>
                                        <option value="11">November</option>
                                        <option value="12">Desember</option>
                                    </select>
                                </div>
                                <div class="d-flex align-items-center gap-2">
                                    <label for="ddlYears" class="fw-semibold mb-0">Tahun</label>
                                    <select name="search2" id="ddlYears" class="form-control" style="min-width: 120px;">
                                    </select>
                                </div>
                                <button type="submit" class="btn btn-success">
                                    <i class="fa fa-search" aria-hidden="true"></i> Cari
                                </button>
                            </form>
                        </div>
                    </div>
                </div>
                <div class="card-body">
                    <div class="row">
                        <div class="col-lg-12">
                            <div class="table-responsive-custom">
                            <table class="table table-hover" id="table">
                                <thead style="background: linear-gradient(135deg, #10b981 0%, #059669 100%); color: white;">
                                    <tr>
                                        <th scope="col" class="ps-3">No</th>
                                        <th scope="col">Tanggal</th>
                                        <th scope="col" class="text-end">Transaksi Jumlah</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <?php $no=1; ?>
                                    <?php $__currentLoopData = $cafe; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $key): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                    <tr>
                                        <?php
                                        $total_transaksi += $key->transaksi_jumlah;
                                        ?>
                                        <td class="ps-3 fw-semibold"><?php echo e($no++); ?></td>
                                        <td><?php echo e(tgl_indo($key->tanggal)); ?></td>
                                        <td class="text-end fw-semibold text-success">Rp <?php echo e(number_format($key->transaksi_jumlah)); ?></td>
                                    </tr>
                                    <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                                </tbody>
                                <tfoot class="bg-light fw-bold">
                                    <tr>
                                        <td colspan="2" class="ps-3">Total</td>
                                        <td class="text-end text-success">Rp <?php echo e(number_format($total_transaksi)); ?></td>
                                    </tr>
                                </tfoot>
                            </table>
                            </div>
                            <div class="text-center mt-4">
                                <button id="downloadexcel" class="btn btn-success btn-lg">
                                    <i class="fas fa-file-excel me-2"></i>Download Excel
                                </button>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </section>
    </div>
</div>

<script type="text/javascript">
    window.onload = function () {
        //Reference the DropDownList.
        var ddlYears = document.getElementById("ddlYears");

        //Determine the Current Year.
        var currentYear = (new Date()).getFullYear();

        //Loop and add the Year values to DropDownList.
        for (var i = 2022; i <= currentYear; i++) {
            var option = document.createElement("option");
            option.innerHTML = i;
            option.value = i;
            ddlYears.appendChild(option);
        }
    };
</script>

<script>
    class Table2Excel {
        constructor() {
            this.template = {
                worksheet: `<?xml version="1.0"?><ss:Workbook xmlns="urn:schemas-microsoft-com:office:spreadsheet"
                    xmlns:o="urn:schemas-microsoft-com:office:office"
                    xmlns:x="urn:schemas-microsoft-com:office:excel"
                    xmlns:ss="urn:schemas-microsoft-com:office:spreadsheet"
                    xmlns:html="http://www.w3.org/TR/REC-html40">
                    <ss:Styles><ss:Style ss:ID="textStyle"><ss:NumberFormat ss:Format="@"/></ss:Style></ss:Styles>
                    <ss:Worksheet ss:Name="Sheet1">
                        <ss:Table>{table}</ss:Table>
                    </ss:Worksheet>
                </ss:Workbook>`,
                tableRow: '<ss:Row>{cells}</ss:Row>',
                tableCell: '<ss:Cell ss:StyleID="textStyle"><ss:Data ss:Type="String">{value}</ss:Data></ss:Cell>',
            };
        }

        format(s, c) {
            return s.replace(/{(\w+)}/g, function (m, p) { return c[p]; });
        }

        export(table, name) {
            let ctx = { worksheet: this.template.worksheet, table: '' };
            let rows = table[0].querySelectorAll('tr');
            for (let i = 0; i < rows.length; i++) {
                let rowCtx = { tableRow: this.template.tableRow, cells: '' };
                let cells = rows[i].querySelectorAll('td, th');
                for (let j = 0; j < cells.length; j++) {
                    rowCtx.cells += this.format(this.template.tableCell, {
                        value: cells[j].innerText.trim()
                    });
                }
                ctx.table += this.format(this.template.tableRow, rowCtx);
            }
            let workbook = this.format(this.template.worksheet, ctx);
            let url = 'data:application/vnd.ms-excel;charset=utf-8,' + encodeURIComponent(workbook);
            let a = document.createElement('a');
            a.href = url;
            a.download = name || 'Laporan_Cafe_' + (new Date().toLocaleDateString('id-ID')) + '.xls';
            document.body.appendChild(a);
            a.click();
            document.body.removeChild(a);
        }
    }

    document.getElementById('downloadexcel').addEventListener('click', function() {
        var table2excel = new Table2Excel();
        table2excel.export(document.querySelectorAll("#table"));
    });
</script>
<?php $__env->stopSection(); ?>

<?php echo $__env->make('layout', array_diff_key(get_defined_vars(), ['__data' => 1, '__path' => 1]))->render(); ?><?php /**PATH C:\Users\Administrator\Downloads\PengeluaranBn-main\PengeluaranBn-main\resources\views/laporan_cafe_bulanan.blade.php ENDPATH**/ ?>