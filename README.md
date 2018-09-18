# A Tiny PHP MVC Framework

This is a very small php mvc framework. This will be helpfull if someone want to know how to implement mvc without framework or want to create own framework. It's bootstrap point is index.php page. It have three folder application, manager and public. Manager folder contain core component of this framework. Application folder cantain models, views, controller, configs and some others. And Public folder is to contain site's assets like css, js, image and others files. 

# Installation

> Create a directory on html/htdocs folder and clone or download this repository.

```bash
    mkdir test
    cd test
    git clone https://github.com/almamuncsit/tiny-php-mvc-framework.git .
```

### Configure Database on 

> application/config/database.php

```php
    define('HOST_NAME',     'localhost');
    define('USER_NAME',     'root');
    define('PASSWORD',      'root');
    define('DATABASE_NAME', 'test');
    define('DATABASE',      'mysql');
```

### Configure site's information on

> application/config/config.php

```php
define('DEVELOPMENT_ENVIRONMENT',   TRUE) // Define your work environment true or flase
define('BASE_URL',                  'http://localhost/test/admin/');
define('SITE_URL',                  'http://localhost/test/');
define('SITE_NAME',                 'CenaJana');
define("DEFAULT_CONTROLLER",        'Welcome');
define("DEFAULT_METHOD",            'index');
define('URL_EXTENTION',             '');
```

Now run http://localhost/test

## Model have acces following functions to make database query

```php
    public function setTable($table)
    public function setWhere($oparends, $oparetor)
    public function setLimit($ofset, $limit)
    public function join()
```

### Select From Table

```php
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

```php
    public function insert(array $data, $table = NULL)
```

### Update data

```php
    public function update(array $data, $ID)
```

### Delete data

```php
    public function deleteAll()
    public function delete($ID)
```

### Reset Model

```php
    public function reset()
```

## Creating model object on controller

```php
    $this->render->model('Welcome')
```

## Loading view

```php
    $this->loadView('index', ['hello' => hello]);
```

## Global funcions

```php
    redirect($url, $statusCode = 303)
    site_name()
    base_url()
```

## Receiving data from form on controller

```php
    $this->input->post($key , $html = FALSE)
    $this->input->arrayFromPost($fields)
    $this->input->get($key, $html = FALSE)
    $this->input->arrayFromGet($fields)
```

# Libraries

### Filters

```php
    int($int)
    string($string)
    float($var)
    email($email)
    magicQuotes($var)
    specialChars($var)
    url($url)
    farray($array)
```

### Validatations

```php
    bool($var)
    email($email)
    float($var)
    int($int, $range = NULL)
    ip($ip)
    url($email)
```

### Session

```php
    start()
    set($key, $value)
    get($key)
    destroy ()
```

### File uploading

```php
    name() // Return name
    type() // Return file type
    size() // Return size of file
    rename() // Rename file
    image($directory, $resize = NULL, $max_size = NULL) // Upload image
    document($directory, $resize = NULL, $max_size = NULL) // Upload document

```

# Helpers

> To use helper you have to use Bootstrap

### Alerts

```php
    success($message) // Alert if Success and its status is 1
    info($message) // Alert Information and its status is 2
    warning($message) // Alert Warnging and its status is 3
    danger($message) // Alert Danger and its status is 4
    show($msg, $status) // Show Alert Depend on Status (1/2/3/4)
```

### Creating buttons

> Class is an option parameter. If you need different color you can you others classes.

```php
    view($url, $class = "btn btn-info btn-xs")
    btn_print($url, $class="")
    edit($url, $class = "btn btn-success btn-xs")
    delete($url, $class="btn btn-danger btn-sm")
    link($url, $label, $classes)
```

### Display data and image

```php
    view($var, $label)
    image($location, $label = NULL)
```

### Creating forms

```php
    start($action = NULL, $data = NULL, $method = 'POST', $class = 'form-horizontal')
    end()
    text($name, $required = NULL, $type = 'text', $value = NULL, $label = NULL)
    date($name, $required = NULL, $type = 'date', $value = NULL, $label = NULL) // need datepicker
    select($name, $values, $selected = NULL, $required = NULL, $label = NULL)
    selectVal($name, $values, $selected = NULL, $required = NULL, $label = NULL) //  Add dropdown list where label and vlue is defferent
    textarea($name, $required = NULL, $value = NULL, $label = NULL)
    file($name, $required = NULL, $label = NULL)
    submit($label = 'Save', $class = 'btn btn-success')

```


# An example

### Controller 

application/controllers/welcome.php

```php
    class Welcome extends CJ_Controller
    {
        private $welcomeModel;

        public function __construct() {
            parent::__construct();
            $this->welcomeModel = $this->render->model('WelcomeModel');
        }

        public function index() {
            $hello = $this->welcomeModel->hello();
            $this->loadView('index', ['hello' => hello]);
        }

    }
```

### Model

application/models/WelcomeModel.php

```php
    class WelcomeModel extends CJ_Model {

        function __construct() {
            parent::__construct();
            $this->setTable('table_name');
        }
        
        public function hello() {
            return 'Welcome to Bangladesh';
        }
    }
```

### View

application/views/index.php

```html
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