<?php
class TranDetails extends Model
{
    public function insert($data, $is_dr)
    {
        $this->db->query('INSERT INTO tran_details(
            office_code,
            year_code,
            batch_no,
            tran_date,
            back_value_date,
            gl_acc_code,
            tran_mode,
            vaucher_type,
            dr_amt_loc,
            cr_amt_loc,
            dr_amt_fc,
            cr_amt_fc
        ) VALUES (
            :office_code, 
            :year_code, 
            :batch_no, 
            :tran_date, 
            :back_value_date, 
            :gl_acc_code, 
            :tran_mode,
            :vaucher_type, 
            :dr_amt_loc, 
            :cr_amt_loc, 
            :dr_amt_fc, 
            :cr_amt_fc 
        )')
            ->bind('office_code', $data['office_code'], PDO::PARAM_STR)
            ->bind('year_code', $data['year_code'], PDO::PARAM_STR)
            ->bind('batch_no', $data['batch_no'], PDO::PARAM_STR)
            ->bind('tran_date', $data['tran_date'], PDO::PARAM_STR)
            ->bind('back_value_date', $data['back_value_date'], PDO::PARAM_STR)
            ->bind('gl_acc_code', $data['gl_acc_code'], PDO::PARAM_STR)
            ->bind('tran_mode', $data['tran_mode'], PDO::PARAM_STR)
            ->bind('vaucher_type', $data['vaucher_type'], PDO::PARAM_STR)
            ->bind('dr_amt_loc', ($is_dr ? $data['dr_amt_loc'] : 0), PDO::PARAM_STR)
            ->bind('cr_amt_loc', (!$is_dr ? $data['cr_amt_loc'] : 0), PDO::PARAM_STR)
            ->bind('dr_amt_fc', $data['dr_amt_fc'], PDO::PARAM_STR)
            ->bind('cr_amt_fc', $data['cr_amt_fc'], PDO::PARAM_STR)
            ->execute();
    }

    public function lastRow()
    {
        return $this->db->query('SELECT * FROM tran_details ORDER BY tran_no DESC LIMIT 1')->first();
    }
}
