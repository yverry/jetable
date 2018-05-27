<?php

/* This class handle ths output
 */

class Output {

	private static $out = '';

	function add($in) {
		self::$out .= $in;
	}

	function display() {
		echo self::$out;
	}


}

class cRedis {

	protected $redis;

	function __construct() {
		$this->redis = new Redis();
		$this->redis->connect('127.0.0.1', 6379);
	}
	function renamekey($key) {
		return PREFIX . ':' . $key;
	}
	function get($key) {
		return $this->redis->get($this->renamekey($key));
	}
	function incr($key) {
		return $this->redis->incr($this->renamekey($key));
	}
	function expire($key,$ttl) {
		return $this->redis->expire($this->renamekey($key),$ttl);
	}
}

class Stats extends cRedis {

	function active_alias() {
		return $this->get(NAME_ACTIVE_ALIAS);
	}
	function daily_alias() {
		return $this->get(NAME_DAILY_ALIAS);
	}
	function add_active_alias() {
		$this->incr(NAME_ACTIVE_ALIAS);
		$this->incr(NAME_DAILY_ALIAS);
	}
}

class Sql {
	private $dbh;
	private $sth;

	function __construct() {
		try {
			$dsn = 'mysql:host='.SQL_HOST.';dbname='.SQL_DB;
			$options = array(
					PDO::MYSQL_ATTR_INIT_COMMAND => 'SET NAMES utf8',
					);
			$this->dbh = new PDO($dsn, SQL_USER, SQL_PASS, $options);
			$this->dbh->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION); 
		} catch(PDOException $e) {
			echo $e->getMessage();
		}
	}
	private function nullparam($mark) {
                foreach ($mark as $key => $value) {

                        if ($value == "") {
                                if ($value !="0") {
                                        $mark[$key] = null;
                                }
                        }
                }
		return $mark;
	}
	function fetch($query,$mark=array()) {

		$this->execute($query,$mark);
		$result = $this->sth->fetch(PDO::FETCH_ASSOC);

		return $result;
	}
	function execute($query,$mark=array()) {

		$mark = $this->nullparam($mark);

		$this->sth = $this->dbh->prepare($query);
		$ret = $this->sth->execute($mark);

		return $ret; 

	}
	function columnCount() {
		return $this->sth->columnCount();
	}
	function quote($unescaped) {
		return $this->dbh->quote($unescaped);
	}

}
?>
