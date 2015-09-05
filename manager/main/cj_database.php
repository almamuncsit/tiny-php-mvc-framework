<?php

class CJ_Database
{

    private $_dbh,
            $_sth = NULL,
            $_tableName,
            $_select = '*',
            $_join = '',
            $_bind = array(),
            $_where = NULL,
            $_order,
            $_limit = "",
            $_sql,
            $_insertId;

    public function __construct()
    {
        $this->connect();
    }

    /*
     * *******************************************************
     * Create Database Connection Object
     * *******************************************************
     */

    public function connect()
    {
        try {
            $this->_dbh = new PDO(DATABASE . ':host=' . HOST_NAME . ';dbname=' . DATABASE_NAME, USER_NAME, PASSWORD);
        } catch (PDOException $e) {
            print "Error!: " . $e->getMessage() . "<br/>";
        }
    }

    /*
     * ******************************************************
     * Set Database Table Name
     * ******************************************************
     */

    public function setSql($sql)
    {
        $this->_sql = $sql;
    }

    /*
     * ******************************************************
     * Set Database Table Name
     * ******************************************************
     */

    public function setTable($table)
    {
        $this->_tableName = Filter::string($table);
    }

    /*
     * ******************************************************
     * Set Select
     * ******************************************************
     */

    public function setSelects($fields, $table = NULL)
    {
        if (!empty($table)) {
            $this->setTable($table);
        }
        $select = '';
        if (is_array($fields)) {
            foreach ($fields as $field) {
                $select .= ('`' . $this->_tableName . '`.`' . $field . '`, ');
            }
            $select = rtrim($select, ', ');
        } else {
            $select = $fields;
        }
        $this->_select = $select;
    }

    /*
     * *******************************************************
     * Get Sql where
     * *******************************************************
     */

    public function where($where)
    {
        $this->_where = $where;
    }

    /*
     * *****************************************************
     * Set Where 
     * *****************************************************
     */

    public function setWhere($field, $value, $oparetor = '=')
    {
        $field = Filter::string($field);
        $value = Filter::string($value);
        $this->_bind = array($value);
        $this->_where = '`' . $field . '` ' . $oparetor . ' ? ';
    }

    /*
     * *****************************************************
     * Set AND Where 
     * *****************************************************
     */

    public function andWhere($field, $value, $oparetor = '=')
    {
        $field = Filter::string($field);
        $value = Filter::string($value);
        $this->_bind[] = $value;
        $this->_where .= 'AND `' . $field . '` ' . $oparetor . ' ? ';
    }

    /*
     * *****************************************************
     * Set AND Where 
     * *****************************************************
     */

    public function orWhere($field, $value, $oparetor = '=')
    {
        $field = Filter::string($field);
        $value = Filter::string($value);
        $this->_bind[] = $value;
        $this->_where .= 'OR `' . $field . '` ' . $oparetor . ' ? ';
    }

    /*
     * *****************************************************
     * Bind value of where
     * *****************************************************
     */

    public function bind()
    {
        if (!empty($this->_bind)) {
            foreach ($this->_bind as $key => $value) {
                $this->_sth->bindValue($key + 1, $value);
            }
        }
    }

    /*
     * *****************************************************
     * Set Order by of sql
     * *****************************************************
     */

    public function setOrderBy($fields = 'id', $value = 'ASC')
    {
        $this->_order = 'ORDER BY `' . $fields . '` ' . $value . ' ';
    }

    /*
     * ******************************************************
     * Set Limit of a query
     * ******************************************************
     */

    public function setLimit($limit, $ofset = 0)
    {
        $limit = Filter::int($limit);
        $ofset = Filter::int($ofset);

        $this->_limit = "LIMIT $limit OFFSET $ofset";
    }

    /*
     * *****************************************************
     * SQL Creator : Create Sql from defferent file 
     * *****************************************************
     */

    public function selectSqlCreator()
    {
        unset($this->_sql);
        if (!empty($this->_select)) {
            $sql = "SELECT " . $this->_select . " FROM ";
        }

        if (!empty($this->_tableName)) {
            $sql .= "`" . $this->_tableName . '` ';
        }

        if (!empty($this->_join)) {
            $sql .= $this->_join;
        }

        if (!empty($this->_where)) {
            $sql .= 'WHERE ' . $this->_where;
        }

        if (!empty($this->_order)) {
            $sql .= $this->_order;
        }

        if (!empty($this->_limit)) {
            $sql .= $this->_limit;
        }

        $this->_sql = $sql;
        return $sql;
    }

    /*
     * *****************************************************
     * Select all from a table 
     * *****************************************************
     */

    public function selectAll($table = NULL, $fetch_type = PDO::FETCH_OBJ)
    {
        if (!empty($table)) {
            $this->_tableName = $table;
        }
        //echo $this->_tableName;
        $sql = $this->selectSqlCreator();
        try {
            $this->_sth = $this->_dbh->prepare($sql);
            $this->bind();
            $this->_sth->execute();
            return $this->_sth->fetchAll($fetch_type);
        } catch (Exception $e) {
            print "Error!: " . $e->getMessage() . "</br>";
        }
    }

    /*
     * *****************************************************
     * Select all from a table 
     * *****************************************************
     */

    public function selectOne($id, $table = NULL, $fetch_type = PDO::FETCH_OBJ)
    {
        $id = Filter::int($id);
        if (!empty($table)) {
            $this->_tableName = $table;
        }
        $this->_where = "`id` = :id ";
        $this->selectSqlCreator();
        try {
            $this->_sth = $this->_dbh->prepare($this->_sql);
            $this->_sth->bindParam(':id', $id);
            $this->_sth->execute();
            return $this->_sth->fetch($fetch_type);
        } catch (Exception $e) {
            print "Error!: " . $e->getMessage() . "</br>";
        }
    }

    /*
     * ************************************************
     * Join query
     * ************************************************
     */

    public function setJoin($table, $joinCondition, $type = " INNER ")
    {
        $this->_join .= $type . " JOIN `" . $table . '` ON ' . $joinCondition;
    }


    /*
     * *************************************************
     * Get the number of selected row
     * *************************************************
     */

    public function numRow()
    {
        if (isset($this->_sth)) {
            return $this->_sth->rowCount();
        }
        return 0;
    }

    /*
     * ****************************************************
     * Start Coding for Insert 
     * ****************************************************
     */

    private function insertSqlCreator($data)
    {
        $sql = 'INSERT INTO `' . $this->_tableName . '` ';
        $fields = '(';
        $values = 'VALUES (';

        foreach ($data as $key => $val) {
            $fields .= "`$key`, ";
            $values .= ":$key, ";
        }

        $sql .= rtrim($fields, ', ') . ') ';
        $sql .= rtrim($values, ', ') . ')';
        $this->_sql = $sql;
    }

    /*
     * *****************************************************
     * Insert into database Table 
     * *****************************************************
     */

    public function insert($data)
    {
        $this->insertSqlCreator($data);
        try {
            $this->_sth = $this->_dbh->prepare($this->_sql);
            $this->_sth->execute((array) $data);
            return $this->_insertId = $this->_dbh->lastInsertId();
        } catch (PDOExecption $e) {
            print "Error!: " . $e->getMessage() . "</br>";
        }
    }

    /*
     * **************************************************
     * Show Last Inserted ID
     * **************************************************
     */

    public function insertedId()
    {
        return $this->_insertId;
    }

    //--------------------------------------------------------------------------------------

    /*
     * **************************************************
     * Create update sql from array
     * **************************************************
     */

    public function updateSqlCreator($data)
    {
        $sql = 'UPDATE `' . $this->_tableName . '` SET ';
        $this->_bind = array();
        foreach ($data as $key => $val) {
            $sql .='`' . $key . '` = ?, ';
            $this->_bind[] = $val;
        }

        $sql = rtrim($sql, ', ');
        return $sql;
    }

    /*
     * **************************************************
     * Update date from array 
     * **************************************************
     */

    public function update($data, $id = NULL)
    {
        $sql = $this->updateSqlCreator($data); //Create First SQL

        if (!empty($id)) {
            $id = Filter::int($id);
            $sql .= ' WHERE `id` = ?';
            $this->_bind[] = $id;
        } else {
            $sql .= ' WHERE ' . $this->_where;
        }

        
        try {
            $this->_sth = $this->_dbh->prepare($sql);
            $this->bind();
            $this->_sth->execute();
        } catch (PDOExecption $e) {
            print "Error!: " . $e->getMessage() . "</br>";
        }
    }

    /*
     * *************************************************
     * Delete a column from table
     * *************************************************
     */

    public function delete($id, $table = NULL)
    {
        if (!empty($table)) {
            $this->_tableName = Filter::string($table);
        }

        $id = Filter::int($id);
        try {
            $sql = "DELETE FROM `$this->_tableName` WHERE `id`= ? ";
            $sth = $this->_dbh->prepare($sql);
            $sth->bindParam(1, $id);
            $sth->execute();
        } catch (PDOExecption $e) {
            print "Delete Error!: " . $e->getMessage() . "</br>";
        }
    }

    /*
     * **************************************************
     * Delete by condition
     * ***************************************************
     */

    public function deleteBy($field, $value)
    {
        $field = filter_var($field, FILTER_SANITIZE_STRING);
        $value = filter_var($value, FILTER_SANITIZE_STRING);
        try {
            $sql = "DELETE FROM `$this->_tableName` WHERE `$field`= ? ";
            $sth = $this->_dbh->prepare($sql);
            $sth->bindParam(1, $value);
            $sth->execute();
        } catch (PDOExecption $e) {
            print "Delete Error!: " . $e->getMessage() . "</br>";
        }
    }

    /*
     * ******************************************************
     * Set Default of all updated Variables
     * ******************************************************
     */

    public function reset()
    {
        $this->_tableName = NULL;
        $this->_select = '*';
        $this->_where = NULL;
        $this->_order = NULL;
        $this->_limit = "LIMIT 0, 999999 ";
        $this->_sql = NULL;
        $this->_insertId = NULL;
        $this->_dbh;
        $this->_sth = NULL;
        $this->_bind = array();
    }

    /*
     * ***************************************************
     * Close Database Connection 
     * ***************************************************
     */

    function close()
    {
        $this->dbh = NULL;
    }

    /*
     * *****************************************
     * Call Distractor
     * *****************************************
     */

    function __destruct()
    {
        $this->close();
    }

}
