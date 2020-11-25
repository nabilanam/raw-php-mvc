<?php require_once APP_ROOT . '/app/views/includes/header.php'; ?>

<div class="container">
    <div class="row mb-4">
        <div class="col-md-11 text-center">
            <h2 class="display-6"><?php echo $data['title'] ?></h2>
        </div>
    </div>

    <form method="post">
        <div class="form-row">
            <div class="form-group col-md-5">
                <label for="branch_code">Branch Code <span class="text-danger">*</span></label>
                <input type="text" class="form-control" id="branch_code" name="branch_code" placeholder="Branch Code" value="<?php echo $data['branch_code'] ?>" required>
                <div class="invalid-feedback" style="display: <?php echo array_key_exists('err_branch_code', $data) ? 'block' : 'none' ?>">
                    Must be number.
                </div>
            </div>
            <div class="form-group col-md-5 offset-1">
                <label for="supplier_customer_code">Supplier / Customer Code <span class="text-danger">*</span></label>
                <input type="text" class="form-control" id="supplier_customer_code" name="supplier_customer_code" placeholder="Supplier / Customer Code" value="<?php echo $data['supplier_customer_code'] ?>" required>
                <div class="invalid-feedback" style="display: <?php echo array_key_exists('err_supplier_customer_code', $data) ? 'block' : 'none' ?>">
                    Must be number.
                </div>
            </div>
        </div>

        <div class="form-row">
            <div class="form-group col-md-5">
                <label for="supplier_customer_name">Supplier / Customer Name <span class="text-danger">*</span></label>
                <input type="text" class="form-control" id="supplier_customer_name" name="supplier_customer_name" placeholder="Supplier / Customer Name" value="<?php echo $data['supplier_customer_name'] ?>" required>
            </div>
            <div class="form-group col-md-5 offset-1">
                <label for="price_date">Price Date <span class="text-danger">*</span></label>
                <input type="text" class="form-control datepicker" id="price_date" name="price_date" placeholder="Price Date" value="<?php echo $data['price_date'] ?>" required>
            </div>
        </div>

        <div class="form-row">
            <div class="form-group col-md-5">
                <label for="item">Item <span class="text-danger">*</span></label>
                <select id="item" name="item_code" required>
                    <option value="">Select Item</option>
                </select>
            </div>
            <div class="form-group col-md-5 offset-1">
                <label for="purchase_sale_price">Purchase / Sale Price <span class="text-danger">*</span></label>
                <input type="text" class="form-control" id="purchase_sale_price" name="purchase_sale_price" placeholder="Purchase / Sale Price" value="<?php echo $data['purchase_sale_price'] ?>" required>
            </div>
        </div>

        <div class="form-row">
            <div class="form-group col-md-5">
                <label for="price_type">Price Type <span class="text-danger">*</span></label>
                <input type="text" class="form-control" id="price_type" name="price_type" placeholder="Price Type" value="<?php echo $data['price_type'] ?>" required>
            </div>
            <div class="form-group col-md-5 offset-1">
                <label for="unit_price">Unit Price <span class="text-danger">*</span></label>
                <input type="text" class="form-control" id="unit_price" name="unit_price" placeholder="Unit Price" value="<?php echo $data['unit_price'] ?>" required>
                <div class="invalid-feedback" style="display: <?php echo array_key_exists('err_unit_price', $data) ? 'block' : 'none' ?>">
                    Must be number.
                </div>
            </div>
        </div>

        <div class="form-row">
            <div class="form-group col-md-5">
                <label for="price_validity_from">Price Validity From <span class="text-danger">*</span></label>
                <input type="text" class="form-control datepicker" id="price_validity_from" name="price_validity_from" placeholder="Price Validity From" value="<?php echo $data['price_validity_from'] ?>" required>
            </div>
            <div class="form-group col-md-5 offset-1">
                <label for="price_validity_to">Price Validity To <span class="text-danger">*</span></label>
                <input type="text" class="form-control datepicker" id="price_validity_to" name="price_validity_to" placeholder="Price Validity To" value="<?php echo $data['price_validity_to'] ?>" required>
            </div>
        </div>

        <div class="form-row">
            <div class="form-group col-md-5">
                <label for="up_to_qty">Up To Qty <span class="text-danger">*</span></label>
                <input type="text" class="form-control" id="up_to_qty" name="up_to_qty" placeholder="Up To Qty" value="<?php echo $data['up_to_qty'] ?>" required>
                <div class="invalid-feedback" style="display: <?php echo array_key_exists('err_up_to_qty', $data) ? 'block' : 'none' ?>">
                    Must be number.
                </div>
            </div>
            <div class="form-group col-md-5 offset-1">
                <label for="up_to_value">Up To Value <span class="text-danger">*</span></label>
                <input type="text" class="form-control" id="up_to_value" name="up_to_value" placeholder="Up To Value" value="<?php echo $data['up_to_value'] ?>" required>
                <div class="invalid-feedback" style="display: <?php echo array_key_exists('err_up_to_value', $data) ? 'block' : 'none' ?>">
                    Must be number.
                </div>
            </div>
        </div>


        <div class="form-row">
            <div class="form-group col-md-11 mt-4 text-right">
                <button type="submit" class="btn btn-primary">Save</button>
            </div>
        </div>

        <input type="hidden" name="unit" id="unit">
        <input type="hidden" name="bar_code" id="bar_code">
        <input type="hidden" name="item_name" id="item_name">
        <input type="hidden" name="item_category" id="item_category">
    </form>
</div>

<?php require_once APP_ROOT . '/app/views/includes/footer.php'; ?>
<script>
    $(document).ready(function() {
        const item = $('#item');
        item.select2({
            width: '100%',
            ajax: {
                url: '<?php echo APP_URL ?>/price-list/search-items',
                data: function(params) {
                    return {
                        search: params.term,
                        page: params.page || 1
                    };
                },
                processResults: function(data, params) {
                    params.page = params.page || 1;

                    return {
                        results: $.map(data.list, function(item) {
                            return {
                                id: item.item_code,
                                text: item.item_name,
                                unit: item.unit,
                                barcode: item.barcode,
                                item_name: item.item_name,
                                item_category: item.item_category,
                            }
                        }),
                        pagination: {
                            more: (params.page * 10) < data.pageCount
                        }
                    };
                }
            },
        });

        item.on('change', function() {
            const data = $(this).select2('data')[0];
            $('#unit').val(data.unit);
            $('#bar_code').val(data.barcode);
            $('#item_name').val(data.item_name);
            $('#item_category').val(data.item_category);
        });
    });
</script>