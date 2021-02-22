<?php


namespace app\core;


class Database
{
    // some local properties
    // we store out connecion
    // dbh - database handler
    private $dbh;
    private $stmt;
    private $error;

    public function __construct($config)
    {
        $dsn = $config['dsn'];
        $user = $config['user'];
        $password = $config['password'];

        // set some connection options
        $options = [
            //sleshiukas t.b.
            \PDO::ATTR_PERSISTENT => true,
            \PDO::ATTR_ERRMODE => \PDO::ERRMODE_EXCEPTION,
        ];

        // create \PDO instance
        try {
            // if we have erro here
            // echo 'tyring in db';
            // connect to db
            $this->dbh = new \PDO($dsn, $user, $password, $options);
        } catch (\PDOException $e) {
            // we catch error here
            $this->error = $e->getMessage();
            echo $this->error;
            // echo 'catching in db';
        }
    }

    // Prepare statments with query
    // dbh->query('SELECT * FROM posts WHERE email = :email');
    public function query($sql)
    {
        // prepare sql statment and save it in local private var
        $this->stmt = $this->dbh->prepare($sql);
    }

    // use stm->bind(':email', 'john@jame.com');
    public function bind($param, $value, $type = null)
    {
        if (is_null($type)) {
            // check what type is $value
            switch (true) {
                case is_int($value):
                    $type = \PDO::PARAM_INT;
                    break;
                case is_bool($value):
                    $type = \PDO::PARAM_BOOL;
                    break;
                case is_null($value):
                    $type = \PDO::PARAM_NULL;
                    break;
                default:
                    $type = \PDO::PARAM_STR;
            }
        }

        // Bind Value
        $this->stmt->bindValue($param, $value, $type);
    }


    // execute prepared and binded stament
    // return result
    public function execute()
    {
        return $this->stmt->execute();
    }

    // Get results as an array
    // return db result array
    public function resultSet()
    {
        $this->execute();
        // \PDO::FETCH_OBJ $result[1]->id
        return $this->stmt->fetchAll(\PDO::FETCH_OBJ);
    }

    // method to return single row of data
    public function singleRow()
    {
        $this->execute();
        // \PDO::FETCH_OBJ $result->id
        return $this->stmt->fetch(\PDO::FETCH_OBJ);
    }

    // method to get back number of rows
    public function rowCount()
    {
        return $this->stmt->rowCount();
    }

}