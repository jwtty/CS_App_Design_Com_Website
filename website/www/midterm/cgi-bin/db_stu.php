<?php
class StuDb {
    protected static $connection;

    public function connect()
    {
        if(!isset(self::$connection)) {
            $config = parse_ini_file("/var/www/db_stu_config.ini"); 
            self::$connection = new mysqli('localhost',$config['username'],$config['password'],$config['dbname']);
        }

        if(self::$connection === false) {
            return false;
        }
        return self::$connection;
    }

	public function close()
	{
		if((!isset(self::$connection)) || self::$connection === false) {
			return false;
		}
		else {
				self::$connection -> close();
				self::$connection = null;
		}
	}
	public function query($query)
    {
        $connection = $this -> connect();
        $result = $connection -> query($query);
        return $result;
    }

    public function select($query) {
        $rows = array();
        $result = $this -> query($query);
        if($result === false) {
            return false;
        }
        while ($row = $result -> fetch_assoc()) {
            $rows[] = $row;
        }
        return $rows;
    }

    //Fetch the last error from the database
    public function error()
    {
        $connection = $this -> connect();
        return $connection -> error;
    }


    public function quote($value)
    {
        $connection = $this -> connect();
        return "'" . $connection -> real_escape_string($value) . "'";
    }
}
?>
