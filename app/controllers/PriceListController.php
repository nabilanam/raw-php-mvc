<?php
class PriceListController extends Controller
{
    /** @var PriceList $model */
    private $model;

    public function __construct()
    {
        $this->model = $this->model('PriceList');
    }

    public function index()
    {
        $data['title'] = 'Price List';

        $this->view('price-list/index', $data);
    }

    public function create()
    {
        if ($_SERVER['REQUEST_METHOD'] == 'POST') {
            $data = $this->sanitize();
            $errors = $this->checkErrors($data);

            if (count($errors) == 0) {
                $this->model->insert($data);
                return redirect_to('/price-list');
            } else {
                $data = array_merge($data, $errors);
                $data['title'] = 'Create Price Record';
                return $this->view('price-list/create', $data);
            }
        }

        $data = $this->emptyData();
        $data['title'] = 'Create Price Record';
        $this->view('price-list/create', $data);
    }

    public function show($id)
    {
        $data = $this->model->find($id);
        $data['title'] = 'Price Record # ' . $id;

        $this->view('price-list/show', $data);
    }

    public function edit($id)
    {
        if ($_SERVER['REQUEST_METHOD'] == 'POST') {
            $data = $this->sanitize();
            $errors = $this->checkErrors($data);

            if (count($errors) == 0) {
                if ($this->model->update($id, $data)) {
                    $data['success'] = 1;
                }
            } else {
                $data = array_merge($data, $errors);
            }

            $data['title'] = 'Price Record Edit # ' . $id;
        } else {
            $data = $this->model->find($id);
            $data['title'] = 'Price Record Edit # ' . $id;
        }

        $this->view('price-list/edit', $data);
    }

    public function destroy($id)
    {
        $this->model->delete($id);

        redirect_back();
    }

    public function searchItems()
    {
        $in = filter_input_array(INPUT_GET, FILTER_SANITIZE_STRING);
        $term = array_key_exists('search', $in) ? $in['search'] : '';
        $page = array_key_exists('page', $in) ? $in['page'] : 1;

        /** @var Item $model */
        $model = $this->model('Item');
        $data = $model->list2($term, $page);

        header('Content-type: application/json');
        echo json_encode($data);
    }

    public function dataTable()
    {
        $columns = [
            [
                'db' => 'id',
                'dt' => 0,
                'formatter' => function ($d, $row) {
                    return $d;
                }
            ],
            ['db' => 'Branch Code',             'dt' => 1],
            ['db' => 'Supplier/Customer Name',  'dt' => 2],
            ['db' => 'Price Date',              'dt' => 3],
            ['db' => 'Item Name',               'dt' => 4],
            ['db' => 'Purchase/Sale Price',     'dt' => 5],
            ['db' => 'Price Type',              'dt' => 6],
            ['db' => 'Unit Price',              'dt' => 7],
            ['db' => 'Price Validity To',       'dt' => 8],
            ['db' => 'Price Validity From',     'dt' => 9],
            [
                'db' => 'id',
                'dt' => 10,
                'formatter' => function ($d, $row) {
                    return '<div class="btn-group btn-corner">
                    <a target="_blank" href="' . APP_URL . '/price-list/show/' . $d . '" class="btn btn-minier text-success"><i class="fa fa-eye"></i></a>
                    <a target="_blank" href="' . APP_URL . '/price-list/edit/' . $d . '" class="btn btn-minier text-info"><i class="fa fa-pencil"></i></a>
                    <a href="' . APP_URL . '/price-list/destroy/' . $d . '" class="btn btn-minier text-danger"><i class="fa fa-trash"></i></a>
                </div>';
                }
            ],
        ];

        require APP_ROOT . '/app/vendor/ssp.class.php';

        echo json_encode(
            SSP::simple($_GET, [
                'user' => DB_USERNAME,
                'pass' => DB_PASSWORD,
                'db'   => DB_NAME,
                'host' => DB_HOST
            ], 'price_list', 'id', $columns)
        );
    }

    private function sanitize()
    {
        $data = filter_input_array(INPUT_POST, FILTER_SANITIZE_STRING);
        $data['branch_code'] = trim($_POST['branch_code']);
        $data['supplier_customer_code'] = trim($_POST['supplier_customer_code']);
        $data['supplier_customer_name'] = trim($_POST['supplier_customer_name']);
        $data['price_date'] = trim($_POST['price_date']) == '' ? null : trim($_POST['price_date']);
        $data['purchase_sale_price'] = trim($_POST['purchase_sale_price']);
        $data['price_type'] = trim($_POST['price_type']);
        $data['unit'] = trim($_POST['unit']);
        $data['unit_price'] = trim($_POST['unit_price']);
        $data['price_validity_from'] = trim($_POST['price_validity_from']);
        $data['price_validity_to'] = trim($_POST['price_validity_to']);
        $data['up_to_qty'] = trim($_POST['up_to_qty']);
        $data['up_to_value'] = trim($_POST['up_to_value']);
        $data['item_code'] = trim($_POST['item_code']);
        $data['item_name'] = trim($_POST['item_name']);
        $data['item_category'] = trim($_POST['item_category']);
        $data['bar_code'] = trim($_POST['bar_code']);

        return $data;
    }

    private function checkErrors($data)
    {
        $errors = [];

        if (!is_numeric($data['branch_code'])) {
            $errors['err_branch_code'] = 1;
        }
        if (!is_numeric($data['supplier_customer_code'])) {
            $errors['err_supplier_customer_code'] = 1;
        }
        if (!is_numeric($data['unit_price'])) {
            $errors['err_unit_price'] = 1;
        }
        if (!is_numeric($data['up_to_qty'])) {
            $errors['err_up_to_qty'] = 1;
        }
        if (!is_numeric($data['up_to_value'])) {
            $errors['err_up_to_value'] = 1;
        }

        return $errors;
    }

    private function emptyData()
    {
        $data['branch_code'] = null;
        $data['supplier_customer_code'] = null;
        $data['supplier_customer_name'] = null;
        $data['price_date'] = null;
        $data['purchase_sale_price'] = null;
        $data['price_type'] = null;
        $data['unit_price'] = null;
        $data['price_validity_from'] = null;
        $data['price_validity_to'] = null;
        $data['up_to_qty'] = null;
        $data['up_to_value'] = null;

        return $data;
    }
}
