<?php
class PriceList extends Model
{
    private $perPage = 10;

    public function list($page = 1)
    {
        $count = round($this->db->query('SELECT COUNT(*) AS count FROM price_list')->first()['count'] / $this->perPage);
        $list = $this->db->query('SELECT * FROM price_list ORDER BY id DESC LIMIT ' . $this->perPage . ' OFFSET ' . (($page - 1) * $this->perPage))->get();

        return [
            'pageCount' => max($count, 1),
            'list' => $list
        ];
    }

    public function insert($data)
    {
        return $this->db->query('INSERT INTO price_list(
            `Branch Code`, 
            `Supplier/Customer Code`, 
            `Supplier/Customer Name`, 
            `Price Date`, 
            `Item Category`, 
            `Item Code`, 
            `Item Name`, 
            `Purchase/Sale Price`, 
            `Price Type`, 
            `Unit Price`, 
            `Price Validity From`, 
            `Price Validity To`, 
            `Up to Qty`, 
            `Unit`, 
            `Up to Value`, 
            `Bar Code`
        ) VALUES (
            :branch_code, 
            :supplier_customer_code, 
            :supplier_customer_name, 
            :price_date, 
            :item_category, 
            :item_code, 
            :item_name, 
            :purchase_sale_price, 
            :price_type, 
            :unit_price, 
            :price_validity_from, 
            :price_validity_to, 
            :up_to_qty, 
            :unit, 
            :up_to_value, 
            :bar_code
        )')
            ->bind('branch_code', $data['branch_code'], PDO::PARAM_STR)
            ->bind('supplier_customer_code', $data['supplier_customer_code'], PDO::PARAM_STR)
            ->bind('supplier_customer_name', $data['supplier_customer_name'], PDO::PARAM_STR)
            ->bind('price_date', $data['price_date'], PDO::PARAM_STR)
            ->bind('item_category', $data['item_category'], PDO::PARAM_STR)
            ->bind('item_code', $data['item_code'], PDO::PARAM_STR)
            ->bind('item_name', $data['item_name'], PDO::PARAM_STR)
            ->bind('purchase_sale_price', $data['purchase_sale_price'], PDO::PARAM_STR)
            ->bind('price_type', $data['price_type'], PDO::PARAM_STR)
            ->bind('unit_price', $data['unit_price'], PDO::PARAM_STR)
            ->bind('price_validity_from', $data['price_validity_from'], PDO::PARAM_STR)
            ->bind('price_validity_to', $data['price_validity_to'], PDO::PARAM_STR)
            ->bind('up_to_qty', $data['up_to_qty'], PDO::PARAM_STR)
            ->bind('unit', $data['unit'], PDO::PARAM_STR)
            ->bind('up_to_value', $data['up_to_value'], PDO::PARAM_STR)
            ->bind('bar_code', $data['bar_code'], PDO::PARAM_STR)
            ->execute();
    }

    public function find($id)
    {
        return $this->db->query('SELECT 
        `Branch Code` as branch_code,
        `Supplier/Customer Code` as supplier_customer_code, 
        `Supplier/Customer Name` as supplier_customer_name, 
        `Price Date` as price_date, 
        `Item Category` as item_category, 
        `Item Code` as item_code, 
        `Item Name` as item_name, 
        `Purchase/Sale Price` as purchase_sale_price, 
        `Price Type` as price_type, 
        `Unit Price` as unit_price, 
        `Price Validity From` as price_validity_from, 
        `Price Validity To` as price_validity_to, 
        `Up to Qty` as up_to_qty, 
        `Unit` as unit, 
        `Up to Value` as up_to_value, 
        `Bar Code` as bar_code 
        FROM price_list WHERE id=:id')
            ->bind('id', $id, PDO::PARAM_INT)
            ->first();
    }

    public function update($id, $data)
    {
        return $this->db->query('UPDATE price_list SET 
        `Branch Code`=:branch_code, 
        `Supplier/Customer Code`=:supplier_customer_code, 
        `Supplier/Customer Name`=:supplier_customer_name, 
        `Price Date`=:price_date, 
        `Item Category`=:item_category, 
        `Item Code`=:item_code, 
        `Item Name`=:item_name, 
        `Purchase/Sale Price`=:purchase_sale_price, 
        `Price Type`=:price_type, 
        `Unit Price`=:unit_price, 
        `Price Validity From`=:price_validity_from, 
        `Price Validity To`=:price_validity_to, 
        `Up to Qty`=:up_to_qty, 
        `Unit`=:unit, 
        `Up to Value`=:up_to_value, 
        `Bar Code`=:bar_code 
        WHERE id=:id')
            ->bind('branch_code', $data['branch_code'], PDO::PARAM_STR)
            ->bind('supplier_customer_code', $data['supplier_customer_code'], PDO::PARAM_STR)
            ->bind('supplier_customer_name', $data['supplier_customer_name'], PDO::PARAM_STR)
            ->bind('price_date', $data['price_date'], PDO::PARAM_STR)
            ->bind('item_category', $data['item_category'], PDO::PARAM_STR)
            ->bind('item_code', $data['item_code'], PDO::PARAM_STR)
            ->bind('item_name', $data['item_name'], PDO::PARAM_STR)
            ->bind('purchase_sale_price', $data['purchase_sale_price'], PDO::PARAM_STR)
            ->bind('price_type', $data['price_type'], PDO::PARAM_STR)
            ->bind('unit_price', $data['unit_price'], PDO::PARAM_STR)
            ->bind('price_validity_from', $data['price_validity_from'], PDO::PARAM_STR)
            ->bind('price_validity_to', $data['price_validity_to'], PDO::PARAM_STR)
            ->bind('up_to_qty', $data['up_to_qty'], PDO::PARAM_STR)
            ->bind('unit', $data['unit'], PDO::PARAM_STR)
            ->bind('up_to_value', $data['up_to_value'], PDO::PARAM_STR)
            ->bind('bar_code', $data['bar_code'], PDO::PARAM_STR)
            ->bind('id', $id, PDO::PARAM_INT)
            ->execute();
    }

    public function delete($id)
    {
        return $this->db->query('DELETE FROM price_list WHERE id=:id')->bind('id', $id, PDO::PARAM_INT)->execute();
    }
}
