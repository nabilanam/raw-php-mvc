<?php
class TransactionController extends Controller
{
    public function index()
    {
        if ($_SERVER['REQUEST_METHOD'] == 'POST') {
            $data = filter_input_array(INPUT_POST, FILTER_SANITIZE_STRING);
            $data['office_code'] = 1500000000;
            $data['year_code'] = date('Y');
            $data['back_value_date'] = null;
            $data['tran_mode'] = 'PVC';
            $data['vaucher_type'] = 'DR';
            $data['dr_amt_fc'] = 0;
            $data['cr_amt_fc'] = 0;
            $data['dr_amt_loc'] = $data['grand_total'];
            $data['cr_amt_loc'] = $data['grand_total'];

            # tran_details
            /** @var TranDetails $model */
            $model = $this->model('TranDetails');
            $data['batch_no'] = $model->lastRow()['tran_no'];

            $data['gl_acc_code'] = $data['by_account'];
            $model->insert($data, true);

            $data['gl_acc_code'] = $data['to_account'];
            $model->insert($data, false);

            # invoice detail
            if (array_key_exists('items', $data)) {
                /** @var InvoiceDetail $model */
                $model = $this->model('InvoiceDetail');
                foreach ($data['items'] as $key => $item_id) {
                    $row = [
                        'office_code' => $data['office_code'],
                        'order_type' => $data['tran_mode'],
                        'in_out_flag' => 1,
                        'order_no' => $data['order_no'],
                        'gl_acc_code' => $data['to_account'],
                        'order_date' => $data['tran_date'],
                        'item_no' => $item_id,
                        'item_qty' => $data['qty'][$key],
                        'item_unit' => $data['unit'][$key],
                        'unit_price_loc' => $data['price'][$key],
                        'total_price_loc' => $data['total'][$key],
                        'item_status' => 1,
                        'bill_status' => 1
                    ];

                    $model->insert($row);
                }
            }

            $data['title'] = 'Transactions';
            $data['success'] = 'Successfully saved!';
        } else {
            $data = $this->emptyData();
            $data['title'] = 'Transactions';
        }

        return $this->view('transactions/index', $data);
    }

    public function searchItems()
    {
        $in = filter_input_array(INPUT_GET, FILTER_SANITIZE_STRING);
        $term = array_key_exists('search', $in) ? $in['search'] : '';
        $page = array_key_exists('page', $in) ? $in['page'] : 1;

        /** @var Item $model */
        $model = $this->model('Item');
        $data = $model->list1($term, $page);

        header('Content-type: application/json');
        echo json_encode($data);
    }

    public function searchAccount()
    {
        $in = filter_input_array(INPUT_GET, FILTER_SANITIZE_STRING);
        $term = array_key_exists('search', $in) ? $in['search'] : '';
        $page = array_key_exists('page', $in) ? $in['page'] : 1;

        /** @var GLAccCode $model */
        $model = $this->model('GLAccCode');
        $data = $model->list($term, $page);

        header('Content-type: application/json');
        echo json_encode($data);
    }

    private function emptyData()
    {
        return [
            'by_account' => null,
            'to_account' => null,
            'tran_date' => null,
            'tran_time' => null,
        ];
    }
}
