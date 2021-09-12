<?php

namespace base\model;

class DatabaseMethods
{
    protected function createWhere($set = [], $table = false)
    {
        if(is_string($set['where'])) {
            return 'WHERE' . ' ' . trim($set['where']);
        }

        $where = 'WHERE';

        if(is_array($set['where']) && !empty($set['where'])) {
            $set['operand'] = (is_array($set['operand']) && !empty($set['operand'])) ? $set['operand'] : ['='];
            $set['condition'] = (is_array($set['condition']) && !empty($set['condition'])) ? $set['condition'] : ['AND'];

            $o_count = 0;
            $c_count = 0;

            foreach ($set['where'] as $key => $item) {
                $where .= ' ';

                if($set['operand'][$o_count]) {
                    $operand = $set['operand'][$o_count];
                    $o_count++;
                }else{
                    $operand = $set['operand'][$o_count - 1];
                }

                if($set['condition'][$c_count]) {
                    $condition = $set['condition'][$c_count];
                    $c_count++;
                }else{
                    $condition = $set['condition'][$c_count - 1];
                }

                if($operand === 'IN' || $operand === 'NOT IN') {
                    if(is_array($item)) $temp_item = $item;
                    else $temp_item = explode(',', $item);

                    $in_str = '';

                    foreach ($temp_item as $v) {
                        $in_str .= "'" . addslashes(trim($v)) . "',";
                    }
//                    $where .= $table . $key . ' ' . $operand . ' (' . trim($in_str, ',') . ') ' .$condition;
                    $where .= $key . ' ' . $operand . ' (' . trim($in_str, ',') . ') ' .$condition;
                }else{
//                    $where .= $table . $key . $operand . "'" . addslashes($item) . "' $condition";
                    $where .= $key . $operand . "'" . addslashes($item) . "' $condition";
                }
            }
        }
        return substr($where, 0, strlen($where) - 4) . ';';
    }

    protected function createFields($set = [], $table = false)
    {
        $set['fields'] = (is_array($set['fields']) && !empty($set['fields'])) ? $set['fields'] : ['*'];

        $table = ($table && !$set['no_concat']) ? $table . '.' : '';

        $fields = '';

        foreach ($set['fields'] as $field) {
            $fields .= $table . $field . ',';
        }

        return $fields;
    }

    protected function createUpdate($fields, $files) {
        if($fields) {
            foreach ($fields as $row => $value) {

                $update .= $row . '=';

                if($value === NULL) {
                    $update .= "NULL" . ',';
                }else{
                    $update .= "'" . addslashes($value) . "',";
                }
            }
        }

        if($files) {
            foreach ($files as $row => $file) {

                $update .= $row . '=';

                if(is_array($file)) {
                    $update .= "'" . addslashes(json_encode($file)) . "',";
                }else{
                    $update .= "'" . addslashes($file) . "',";
                }

            }
        }

        return rtrim($update, ',');
    }
}