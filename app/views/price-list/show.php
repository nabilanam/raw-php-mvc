<?php require_once APP_ROOT . '/app/views/includes/header.php'; ?>
<style>
    th {
        max-width: 100px;
    }
</style>

<div class="col-md-12 text-center mb-4">
    <h2 class="display-6"><?php echo $data['title'] ?></h2>
</div>

<div class="col-md-8 offset-2">
    <table class="table table-striped">
        <tbody>
            <tr>
                <th scope="row">Branch Code</th>
                <td><?php echo $data['branch_code'] ?></td>
            </tr>
            <tr>
                <th scope="row">Supplier / Customer Code</th>
                <td><?php echo $data['supplier_customer_code'] ?></td>
            </tr>
            <tr>
                <th scope="row">Supplier / Customer Name</th>
                <td><?php echo $data['supplier_customer_name'] ?></td>
            </tr>
            <tr>
                <th scope="row">Item Code</th>
                <td><?php echo $data['item_code'] ?></td>
            </tr>
            <tr>
                <th scope="row">Item Name</th>
                <td><?php echo $data['item_name'] ?></td>
            </tr>
            <tr>
                <th scope="row">Item Category</th>
                <td><?php echo $data['item_category'] ?></td>
            </tr>
            <tr>
                <th scope="row">Price Date</th>
                <td><?php echo $data['price_date'] ?></td>
            </tr>
            <tr>
                <th scope="row">Purchase / Sale Price</th>
                <td><?php echo $data['purchase_sale_price'] ?></td>
            </tr>
            <tr>
                <th scope="row">Price Type</th>
                <td><?php echo $data['price_type'] ?></td>
            </tr>
            <tr>
                <th scope="row">Unit Price</th>
                <td><?php echo $data['unit_price'] ?></td>
            </tr>
            <tr>
                <th scope="row">Validity From</th>
                <td><?php echo $data['price_validity_from'] ?></td>
            </tr>
            <tr>
                <th scope="row">Validity To</th>
                <td><?php echo $data['price_validity_to'] ?></td>
            </tr>
            <tr>
                <th scope="row">Up To Qty</th>
                <td><?php echo $data['up_to_qty'] ?></td>
            </tr>
            <tr>
                <th scope="row">Up To Value</th>
                <td><?php echo $data['up_to_value'] ?></td>
            </tr>
            <tr>
                <th scope="row">Unit</th>
                <td><?php echo $data['unit'] ?></td>
            </tr>
            <tr>
                <th scope="row">Bar Code</th>
                <td><?php echo $data['bar_code'] ?></td>
            </tr>
        </tbody>
    </table>
</div>

<?php require_once APP_ROOT . '/app/views/includes/footer.php'; ?>