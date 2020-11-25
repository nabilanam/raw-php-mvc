<?php require_once APP_ROOT . '/app/views/includes/header.php'; ?>

<div class="col-md-11 text-center">
    <h2 class="display-6"><?php echo $data['title'] ?></h2>
    <div class="alert alert-success text-center" role="alert" style="display: <?php echo array_key_exists('success', $data) ? 'block' : 'none' ?>">
        Data insertion successful!
    </div>
</div>

<div class="col-md-12">
    <form method="post">
        <div class="row">
            <div class="col-md-4">
                <div class="form-group row">
                    <label for="tran_no" class="col-sm-3 col-form-label text-right">Transaction No.</label>
                    <div class="col-sm-9">
                        <input type="text" class="form-control" id="order_no" name="order_no" placeholder="Transaction No" required>
                    </div>
                </div>
            </div>
            <div class="col-md-4">
                <div class="form-group row">
                    <label for="tran_date" class="col-sm-3 col-form-label text-right">Transaction Date</label>
                    <div class="col-sm-9">
                        <input type="text" class="form-control datepicker" id="tran_date" name="tran_date" value="<?php echo $data['tran_date'] ?>" placeholder="Transaction Date" required>
                    </div>
                </div>
            </div>
            <div class="col-md-4">
                <div class="form-group row">
                    <label for="tran_time" class="col-sm-3 col-form-label text-right">Time</label>
                    <div class="col-sm-9">
                        <input type="text" class="form-control timepicker" id="tran_time" name="tran_time" value="<?php echo $data['tran_time'] ?>" placeholder="Time" required>
                    </div>
                </div>
            </div>
        </div>

        <div class="table-responsive">
            <table class="table table-bordered">
                <thead>
                    <tr>
                        <th scope="col" style="min-width: 5%; max-width: 5%">Sl. No.</th>
                        <th scope="col" style="min-width: 15%; max-width: 15%">Item</th>
                        <th scope="col" style="min-width: 10%; max-width: 10%">Unit</th>
                        <th scope="col" style="min-width: 10%; max-width: 10%">Qty</th>
                        <th scope="col" style="min-width: 10%; max-width: 10%">Unit Price</th>
                        <th scope="col" style="min-width: 10%; max-width: 10%">Value</th>
                        <th scope="col" style="min-width: 5%; max-width: 5%">Actions</th>
                    </tr>
                </thead>
                <tbody>
                </tbody>
            </table>

            <div class="col-md-4">
                <div class="form-group row">
                    <label for="tran_no" class="col-sm-3 col-form-label">Value</label>
                    <div class="col-sm-9">
                        <div style="border-bottom: 1px dashed #000; min-height: 32px">
                            <span class="grand-total-span"></span>
                            <input type="hidden" name="grand_total" class="grand-total-input">
                        </div>
                    </div>
                </div>
            </div>

            <div class="col-md-4">
                <div class="form-group row">
                    <label for="by_account" class="col-sm-3 col-form-label">By Account</label>
                    <div class="col-sm-9">
                        <select id="by_account" name="by_account" class="account-select" required>
                            <option value="">Select Account</option>
                        </select>
                    </div>
                </div>
            </div>
            <div class="col-md-4">
                <div class="form-group row">
                    <label for="to_account" class="col-sm-3 col-form-label">To Account</label>
                    <div class="col-sm-9">
                        <select id="to_account" name="to_account" class="account-select" required>
                            <option value="">Select Account</option>
                        </select>
                    </div>
                </div>
            </div>
            <div class="col-md-4 text-right">
                <button type="submit" class="btn btn-info">Save</button>
            </div>
    </form>
</div>

<?php require_once APP_ROOT . '/app/views/includes/footer.php'; ?>
<script>
    $(document).ready(function() {
        const item = $('.item-select');
        const account = $('.account-select');
        const qty = $('.qty');
        const price = $('.price');
        const trash = $('a.trash');
        const itemSelectConfig = {
            width: '100%',
            ajax: {
                url: '<?php echo APP_URL ?>/transaction/search-items',
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
                                text: item.item_name,
                                id: item.id,
                                unit: item.unit,
                                unit_price: item.unit_price,
                            }
                        }),
                        pagination: {
                            more: (params.page * 10) < data.pageCount
                        }
                    };
                }
            },
        };
        const accountSelectConfig = {
            width: '100%',
            ajax: {
                url: '<?php echo APP_URL ?>/transaction/search-account',
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
                                text: item.acc_head,
                                id: item.acc_code,
                            }
                        }),
                        pagination: {
                            more: (params.page * 10) < data.pageCount
                        }
                    };
                }
            },
        };

        item.select2(itemSelectConfig);
        account.select2(accountSelectConfig);


        function calculateGrandTotal() {
            let sum = 0;
            $('tbody tr.irow').each(function() {
                sum += Number($(this).find('.value').text());
            })
            sum = round(sum);

            $('.grand-total-span').text(sum);
            $('.grand-total-input').val(sum);
        }

        function itemChanged() {
            const tr = $(this).closest('tr');
            const data = $(this).select2('data')[0];
            const price = tr.find('.price');
            tr.find('.unit-span').text(data.unit);
            tr.find('.unit-input').val(data.unit);
            price.val(data.unit_price);
            price.trigger('input');
        }

        function qtyChanged() {
            const tr = $(this).closest('tr');
            const price = round(Number($(this).val()) * Number(tr.find('.price').val()));
            tr.find('.value').text(price);
            tr.find('.total').val(price);

            calculateGrandTotal();
        }

        function priceChanged() {
            const tr = $(this).closest('tr');
            const price = round(Number($(this).val()) * Number(tr.find('.qty').val()));
            tr.find('.value').text(round(qty * price));
            tr.find('.total').val(price);

            calculateGrandTotal();
        }

        function trashClicked(e) {
            e.preventDefault();
            const tr = $(this).closest('tr');
            const data = tr.find('select').select2('data')[0];

            if ($('tbody tr.irow').length > 1) {
                tr.remove();
                $('table').append(`<input type="hidden" name="del_items[]" value="${data.id}" >`);
            }
        }

        item.on('change', itemChanged);
        qty.on('input', qtyChanged);
        price.on('input', priceChanged);
        trash.on('click', trashClicked);

        let rowId = 1;

        function addNew() {
            $('tbody tr:last').remove();

            const tbody = $('tbody');
            const dataTr = $('<tr class="irow"></tr>');

            const td01 = $(`<td>${rowId++}</td>`);
            dataTr.append(td01);

            const td02 = $(`
                    <td>
                        <select name="items[]" class="item-select" required>
                            <option value="">Select Item</option>
                        </select>
                        <input type="hidden" name="total[]" class="total"></input>
                    </td>`);
            td02.find('.item-select').select2(itemSelectConfig);
            td02.find('.item-select').on('change', itemChanged);
            dataTr.append(td02);

            const td03 = $(`<td>
                <span class="unit-span"></span>
                <input type="hidden" name="unit[]" class="unit-input"></input>
            </td>`);
            dataTr.append(td03);

            const td04 = $(`<td><input type="text" name="qty[]" class="qty" style="width: 100%" required></td>`);
            td04.find('.qty').on('input', qtyChanged);
            dataTr.append(td04);

            const td05 = $(`<td><input type="text" name="price[]" class="price" style="width: 100%" required></td>`);
            td05.find('.price').on('input', priceChanged);
            dataTr.append(td05);

            const td06 = $(`<td class="value"></td>`);
            dataTr.append(td06);

            const td07 = $(`<td>
                        <div class="btn-group btn-corner">
                            <a href="#" class="btn btn-minier text-danger trash"><i class="fa fa-trash"></i></a>
                        </div>
                    </td>`);
            td07.find('a.trash').on('click', trashClicked);
            dataTr.append(td07);

            const btnTr = $('<tr></tr>');
            const btnTd = $(`<td colspan="7" class="text-right">
                        <button type="button" class="btn btn-warning text-gray add">Add New</button>
                    </td>`);
            btnTd.find('.add').on('click', addNew);
            btnTr.append(btnTd);

            tbody.append(dataTr);
            tbody.append(btnTr);
        }

        $('.add').on('click', addNew);
        addNew();

        function round(num, dec = 2) {
            const num_sign = num >= 0 ? 1 : -1;
            return parseFloat((Math.round((num * Math.pow(10, dec)) + (num_sign * 0.0001)) / Math.pow(10, dec)).toFixed(dec));
        }
    });
</script>