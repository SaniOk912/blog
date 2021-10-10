<?php

namespace core\base\model;

class DatabaseMethods
{
    protected function createWhere($set = [], $table = false)
    {
        if($set['where']) {

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
                        $where .= $key . ' ' . $operand . ' (' . trim($in_str, ',') . ') ' .$condition;
                    }else{
                        $where .= $key . $operand . "'" . addslashes($item) . "' $condition";
                    }
                }
            }
            return substr($where, 0, strlen($where) - 4) . ';';
        }else return ';';
    }

    protected function createFields($set = [], $table = false)
    {
        $set['fields'] = (is_array($set['fields']) && !empty($set['fields'])) ? $set['fields'] : ['*'];

        if($set['concat']) {
            foreach ($set['fields'] as $key => $item) {
                foreach ($item as $index => $field) {
                    $fields .= $key . '.' . $field . ',';
                }
            }
            return $fields;
        }

        $fields = '';

        foreach ($set['fields'] as $field) {
            $fields .= $field . ',';
        }

        return $fields;
    }

    protected function createInsert($fields, $files)
    {
        $insert_arr = [];

        foreach ($fields as $key => $value) {
            $insert_arr['fields'] .= $key . ',';
            $insert_arr['values'] .= "'" . strip_tags(addslashes($value)) . "'" . ',';
        }

        foreach ($files as $key => $value) {
            $insert_arr['fields'] .= $key . ',';

            if(is_array($value)){

                foreach ($value as $i => $item){
                    $imgArr .= $item . ',';
                }

                $insert_arr['values'] .= "'" . strip_tags(addslashes($imgArr)) . "'" . ',';
            }else $insert_arr['values'] .= "'" . strip_tags(addslashes($value)) . "'" . ',';
        }

        return $insert_arr;
    }

    protected function createUpdate($fields, $files)
    {
        if($fields) {
            foreach ($fields as $row => $value) {

                $update .= $row . '=';

                if($value === NULL) {
                    $update .= "NULL" . ',';
                }else{
                    $update .= "'" . strip_tags(addslashes($value)) . "',";
                }
            }
        }

        if($files) {
            foreach ($files as $row => $file) {

                $update .= $row . '=';

                if(is_array($file)) {
                    print_arr($file);
                    $update .= "'" . strip_tags(addslashes(json_encode($file))) . "',";
                }else{
                    $update .= "'" . strip_tags(addslashes($file)) . "',";
                }

            }
        }

        return rtrim($update, ',');
    }
}