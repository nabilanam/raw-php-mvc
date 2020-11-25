<?php
class Item extends Model
{
    private $perPage = 10;

    public function list1($term, $page = 1)
    {
        $pageCount = $this->db->query('SELECT COUNT(*) AS count 
        FROM item 
        INNER JOIN price_list ON price_list.`Item Code` = item.item_code
        WHERE item.item_name 
        LIKE CONCAT(\'%\', :term, \'%\')')
            ->bind('term', $term, PDO::PARAM_STR)
            ->first()['count'];

        $list = $this->db->query('SELECT item.id, item.item_name, item.unit, price_list.`Unit Price` as unit_price 
        FROM item 
        INNER JOIN price_list ON price_list.`Item Code` = item.item_code
        WHERE item.item_name 
        LIKE CONCAT(\'%\', :term, \'%\') 
        LIMIT :limit 
        OFFSET :offset')
            ->bind('term', $term, PDO::PARAM_STR)
            ->bind('limit', $this->perPage, PDO::PARAM_INT)
            ->bind('offset', ($page - 1) * $this->perPage, PDO::PARAM_INT)
            ->get();

        return [
            'list' => $list,
            'pageCount' => max($pageCount, 1)
        ];
    }

    public function list2($term, $page = 1)
    {
        $pageCount = $this->db->query('SELECT COUNT(*) AS count 
        FROM item 
        WHERE item_name 
        LIKE CONCAT(\'%\', :term, \'%\')')
            ->bind('term', $term, PDO::PARAM_STR)
            ->first()['count'];

        $list = $this->db->query('SELECT id, item_name, item_code, item_category, unit, barcode
        FROM item 
        WHERE item_name 
        LIKE CONCAT(\'%\', :term, \'%\') 
        LIMIT :limit 
        OFFSET :offset')
            ->bind('term', $term, PDO::PARAM_STR)
            ->bind('limit', $this->perPage, PDO::PARAM_INT)
            ->bind('offset', ($page - 1) * $this->perPage, PDO::PARAM_INT)
            ->get();

        return [
            'list' => $list,
            'pageCount' => max($pageCount, 1)
        ];
    }
}
