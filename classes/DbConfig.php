<?php
class DbConfig 
{	
	private $_host = '203.170.84.9';
	private $_username = 'stemedu1_bertram';
	private $_password = "fh9H^g76{.?+";
	private $_database = 'stemedu1_weightbuddy';


	/*My original db info - Open the database & define tables for this website

$dbserver = "localhost"; my remote IP: 1.136.109.170
$dbusername = "stemedu1_bertram";
$dbpassword = "fh9H^g76{.?+";
$dbname = "stemedu1_weightbuddy";*/
	
	protected $connection;
	
	public function __construct()
	{
		if (!isset($this->connection)) {
			
			$this->connection = new mysqli($this->_host, $this->_username, $this->_password, $this->_database);
			
			if (!$this->connection) {
				echo 'Cannot connect to database server';
				exit;
			}			
		}	
		
		return $this->connection;
	}
}
?>
