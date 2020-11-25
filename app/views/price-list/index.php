<?php require_once APP_ROOT . '/app/views/includes/header.php'; ?>
<link rel="stylesheet" href="<?php echo APP_URL . '/' . 'public/css/jquery.dataTables.min.css' ?>">
<link rel="stylesheet" href="<?php echo APP_URL . '/' . 'public/css/dataTables.bootstrap4.min.css' ?>">
<style>
    table.dataTable>thead .sorting::before,
    table.dataTable>thead .sorting::after {
        opacity: 0.6 !important;
    }
</style>

<div class="col-md-12 text-right mb-2">
    <a href="/price-list/create" class="btn btn-primary">Create Record</a>
</div>

<div class="col-md-12">
    <div class="table-responsive">
        <table id="data-table" class="table table-bordered" style="width: 99%">
            <thead>
                <tr>
                    <th scope="col">#</th>
                    <th scope="col">Branch <br>Code</th>
                    <th scope="col">Sup. / <br> Cus. Name</th>
                    <th scope="col">Price <br>Date</th>
                    <th scope="col">Item</th>
                    <th scope="col">Purchase / <br> Sale Price</th>
                    <th scope="col">Price Type</th>
                    <th scope="col">Unit Price</th>
                    <th scope="col">Validity <br>To</th>
                    <th scope="col">Validity <br>From</th>
                    <th scope="col">Actions</th>
                </tr>
            </thead>
        </table>
    </div>
</div>

<?php require_once APP_ROOT . '/app/views/includes/footer.php'; ?>
<script src="<?php echo APP_URL . '/public/js/jquery.dataTables.min.js' ?>"></script>
<script>
    const table = $('#data-table').DataTable({
        'processing': true,
        'serverSide': true,
        'ajax': '<?php echo APP_URL ?>/price-list/data-table',
        'pageLength': 10,
    });
    table.on('draw.dt', function() {
        let info = table.page.info();
        table.column(0, {
            search: 'applied',
            order: 'applied',
            page: 'applied'
        }).nodes().each(function(cell, i) {
            cell.innerHTML = i + 1 + info.start;
        });
    });
</script>