<?php
class GLAccCode extends Model
{
    private $perPage = 10;

    public function list($term, $page = 1)
    {
        $pageCount = $this->db->query('SELECT COUNT(*) AS count 
        FROM gl_acc_code 
        WHERE acc_head 
        LIKE CONCAT(\'%\', :term, \'%\')')
            ->bind('term', $term, PDO::PARAM_STR)
            ->first()['count'];

        $list = $this->db->query('SELECT id, acc_code, acc_head 
        FROM gl_acc_code 
        WHERE acc_head 
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
