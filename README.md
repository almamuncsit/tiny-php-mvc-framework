# A Tiny PHP MVC Framework

This is a very small php mvc framework. This will be helpfull if someone want to know how to implement mvc without framework or want to create own framework. It's bootstrap point is index.php page. It have three folder application, manager and public. Manager folder contain core component of this framework. Application folder cantain models, views, controller, configs and some others. And Public folder is to contain site's assets like css, js, image and others files. 

## Model have acces following functions to make database query

```
    public function setTable($table)
    public function setWhere($oparends, $oparetor)
    public function setLimit($ofset, $limit)
    public function join()
```
### Select From Table 

```
    public function selectAll()
    public function selectOne($ID)
    public function selectMulti($fields)
    public function numRow()
    public function numCol()
    public function selectMax()
    public function selectMin()
    public function selectSum()
    public function selectAvg()
```
### Insert into table

```
    public function insert(array $data, $table = NULL)
```

### Update data

```
    public function update(array $data, $ID)
```

### Delete data

```
    public function deleteAll()
    public function delete($ID)
```

### Resect Model

```
    public function reset()
```

## Creating model object on controller

```
$this->render->model('Welcome')
```

## Loading view
```
$this->loadView('index', ['hello' => hello]);
```

## And example
### Controller 

application/controllers/welcome.php

```
class Welcome extends CJ_Controller
{
    private $welcomeModel;

    public function __construct() {
        parent::__construct();
        $this->welcomeModel = $this->render->model('Welcome');
    }

    public function index() {
        $hello = $this->welcomeModel->hello();
        $this->loadView('index', ['hello' => hello]);
    }

}
```

### Model 

application/models/Welcome.php

```
class Welcome extends CJ_Model {

    function __construct() {
        parent::__construct();
        // $this->setTable('table_name');
    }
    
    public function hello() {
        return 'Welcome to Bangladesh';
    }
}
```

### View 

application/views/index.php

```
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Document</title>
</head>
<body>

<h1> <?php echo $hello ?> </h1>
    
</body>
</html>
```