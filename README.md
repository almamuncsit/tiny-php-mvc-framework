# A Tiny PHP MVC Framework

This is a very small php mvc framework. This will be helpfull if someone want to know how to implement mvc without framework or want to create own framework. It's bootstrap point is index.php page. It have three folder application, manager and public. Manager folder contain core component of this framework. Application folder cantain models, views, controller, configs and some others. And Public folder is to contain site's assets like css, js, image and others files. 

## Model have acces following functions to make database query

```
    public function setTable($table); //
    public function setWhere($oparends, $oparetor); //
    public function setLimit($ofset, $limit);
    public function join();

     Select From Table 

    public function selectAll(); //
    public function selectOne($ID); //
    public function selectMulti($fields);
    public function numRow(); //
    public function numCol();
    public function selectMax();
    public function selectMin();
    public function selectSum();
    public function selectAvg();

    Insert into table

    public function insert(array $data, $table = NULL); //

    Update data

    public function update(array $data, $ID);

    Delete data
    
    public function deleteAll(); 
    public function delete($ID); 

    Resect Model

    public function reset(); 
    
    ```
