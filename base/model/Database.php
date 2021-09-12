<?php

namespace base\model;

class Database extends DatabaseMethods
{
    private $link;

    private function __construct()
    {
        $this->connect();
    }

    /**
     * @return $this
     */
    protected function connect()
    {
        $dsn = 'mysql:host=' . HOST . ';dbname=' . DB_NAME . ';charset=' . DB_CHARSET;

        $this->link = new \PDO($dsn, DB_USERNAME, DB_PASSWORD);

        return $this;
    }

    public function execute($sql)
    {
        $sth = $this->link->prepare($sql);

        return $sth->execute();
    }

    public function query($sql)
    {
        $sth = $this->link->prepare($sql);

        $sth->execute();

        $result = $sth->fetchAll(\PDO::FETCH_ASSOC);

        if($result === false) {
            return [];
        }

        return $result;
    }

    public function get($table, $set)
    {
        $fields = $set['fields'] = (is_array($set['fields']) && !empty($set['fields'])) ? $set['fields'] : ['*'];

        $fields = $this->createFields($set);
        $fields = rtrim($fields, ',');
        $where = $this->createWhere($set);

        $query = "SELECT $fields FROM $table $where";
        return $this->query($query);
    }

    public function add($table, $arr = [])
    {
        foreach ($arr as $key => $value) {
            $fields .= $key . ',';

            if(is_array($value)) {
                $values .= "'" . addslashes(json_encode($value)) . "'" . ',';
            }else{
                $values .= "'" . addslashes($value) . "'" . ',';
            }
        }

        $fields = '(' . trim($fields, ',') . ') ';
        $values = '(' . trim($values, ',') . ')';

        $query = "INSERT INTO $table $fields VALUES $values";

        return $this->execute($query);
    }

    public function edit($table, $set = [])
    {
        $fields = (is_array($set['fields']) && !empty($set['fields'])) ? $set['fields'] : $_POST;
        $files = (is_array($set['files']) && !empty($set['files'])) ? $set['files'] : false;

        if(!$set['fields'] && !$set['files']) return false;

        if(!$set['all_rows']) {

            if($set['where']) {
                $where = $this->createWhere($set);
            }else{
                $columns = $this->showColumns($table);

                if(!$columns) return false;

                if($columns['id_row'] && $set['fields'][$columns['id_row']]) {
                    $where = 'WHERE ' . $columns['id_row'] . '=' . $set['fields'][$columns['id_row']];
                    unset($set['fields'][$columns['id_row']]);
                }
            }
        }

        $update = $this->createUpdate($fields, $files);

        $query = "UPDATE $table SET $update $where";

        return $this->execute($query);
    }

    public function delete($table, $set)
    {
        $where = $this->createWhere($set, $table);
        $query = "DELETE FROM $table $where";
        return $this->execute($query);
    }

    final public function showColumns($table) {
        $query = "SHOW COLUMNS FROM $table";
        $res = $this->query($query);

        $columns = [];
        if($res) {

            foreach ($res as $row) {
                $columns[$row['Field']] = $row;
                if($row['Key'] === 'PRI') $columns['id_row'] = $row['Field'];
            }

        }

        return $columns;
    }
}