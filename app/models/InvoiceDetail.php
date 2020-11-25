<?php
class InvoiceDetail extends Model
{
    public function insert($data)
    {
        $this->db->query('INSERT INTO invoice_detail(
            office_code,
            order_type,
            in_out_flag,
            order_no,
            gl_acc_code,
            order_date,
            item_no,
            item_qty,
            item_unit,
            unit_price_loc,
            total_price_loc,
            item_status,
            bill_status
        ) VALUES (
            :office_code, 
            :order_type, 
            :in_out_flag, 
            :order_no, 
            :gl_acc_code, 
            :order_date, 
            :item_no, 
            :item_qty,
            :item_unit, 
            :unit_price_loc, 
            :total_price_loc, 
            :item_status, 
            :bill_status 
        )')
            ->bind('office_code', $data['office_code'], PDO::PARAM_STR)
            ->bind('order_type', $data['order_type'], PDO::PARAM_STR)
            ->bind('in_out_flag', $data['in_out_flag'], PDO::PARAM_STR)
            ->bind('order_no', $data['order_no'], PDO::PARAM_STR)
            ->bind('gl_acc_code', $data['gl_acc_code'], PDO::PARAM_STR)
            ->bind('order_date', $data['order_date'], PDO::PARAM_STR)
            ->bind('item_no', $data['item_no'], PDO::PARAM_STR)
            ->bind('item_qty', $data['item_qty'], PDO::PARAM_STR)
            ->bind('item_unit', $data['item_unit'], PDO::PARAM_STR)
            ->bind('unit_price_loc', $data['unit_price_loc'], PDO::PARAM_STR)
            ->bind('total_price_loc', $data['total_price_loc'], PDO::PARAM_STR)
            ->bind('item_status', $data['item_status'], PDO::PARAM_INT)
            ->bind('bill_status', $data['bill_status'], PDO::PARAM_INT)
            ->execute();
    }
}
