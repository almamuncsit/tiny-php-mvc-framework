<?php

interface DatabaseInterface
{

    public function setTable($table); //

    public function setWhere($oparends, $oparetor); //

    public function setLimit($ofset, $limit);

    public function join();
    /*
     * Select From Table 
     */

    public function selectAll(); //

    public function selectOne($ID); //

    public function selectMulti($fields);

    public function numRow(); //

    public function numCol();

    public function selectMax();

    public function selectMin();

    public function selectSum();

    public function selectAvg();

    /*
     * Insert into table
     */

    public function insert(array $data, $table = NULL); //

    /*
     * update data
     */

    public function update(array $data, $ID);
    /*
     * Delete data
     */

    public function deleteAll(); //

    public function delete($ID); //
    /*
     * resect Model
     */

    public function reset(); //
}
