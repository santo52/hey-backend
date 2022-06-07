<?php  

    require($_SERVER['DOCUMENT_ROOT'] . '/hey-backend/db.php');

    define("DB_HOST", $DB_HOST);
    define("DB_USER", $DB_USER);
    define("DB_PASS", $DB_PASSWORD);
    define("DB_NAME", $DB_NAME);
    define("DB_PORT", $DB_PORT);

    class Database {
        private $host   = DB_HOST;
        private $user   = DB_USER;
        private $pass   = DB_PASS;
        private $dbname = DB_NAME;

        private $dbh;
        private $inc;
        public $conx=array();
        private $error;
        private $stmt;
        private $dbGetQuery;
        private static $instance = null;

        public function __construct(){

            // Set DSN
            $dsn = 'mysql:host=' . $this->host . ';dbname=' . $this->dbname;
            // Set options  PDO::ATTR_PERSISTENT
            $options = array(
                PDO::ATTR_PERSISTENT    => false,
                PDO::ATTR_ERRMODE       => PDO::ERRMODE_EXCEPTION,
                PDO::MYSQL_ATTR_INIT_COMMAND => "SET CHARACTER SET utf8"
            );
    
            //Create a new PDO instance
            try {
                $this->dbh = new PDO($dsn, $this->user, $this->pass, $options);
            }catch(PDOException $e) {
                $this->error = $e->getMessage();
                print_r($this->error); exit();
            }
        }
    
        public static function getInstance(){
            if(!self::$instance){
                self::$instance = new Database();
            }
            return self::$instance;
        }
    
        public function getConnection(){
            return $this;
        }

        public function query($query){
            $this->dbGetQuery[]=$query;
            $this->stmt = $this->dbh->prepare($query);
            return $this;
        }

        public function bind($param, $value, $type = null)
        {
            if (is_null($type)) {
                switch (true) {
                    case is_int($value):
                        $type = PDO::PARAM_INT;
                        break;
                    case is_bool($value):
                        $type = PDO::PARAM_BOOL;
                        break;
                    case is_null($value):
                        $type = PDO::PARAM_NULL;
                        break;
                    default:
                        $type = PDO::PARAM_STR;
                }
            }
            $this->stmt->bindValue($param, $value, $type);
        }


        public function bindArray($array){
            foreach($array as $key => $value){
                bind($key, $value);
            }
        }

        public function execute() {
            return $this->stmt->execute();
        }

        public function resultset(){
            $this->execute();
            return $this->stmt->fetchAll(PDO::FETCH_ASSOC);
        }


        public function single()  {
            $this->execute();
            return $this->stmt->fetch(PDO::FETCH_ASSOC);
        }


        public function execRowCount(){
            $this->execute();
            return $this->stmt->rowCount();
        }

        public function rowCount() {
            return $this->stmt->rowCount();
        }


        public function lastInsertId()   {
            return $this->dbh->lastInsertId();
        }
    }

?>