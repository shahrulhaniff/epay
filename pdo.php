<?
//untuk php data object (pdo)
	class Database {
		/*
		function test2() {
                
		$dbName =  $GLOBALS['db'];; // try dah takleh baca outer variable dari class. siapa power java tolong...
		}
		//private static $dbName = 'cashless'; 
		private static $dbHost = 'localhost' ;
		private static $dbUsername = 'root';
		private static $dbUserPassword = ''; */
		 
		private static $cont  = null;
		 
		 
		public function __construct() {
			die('Init function is not allowed');
		}
		 
		public static function connect()
		{
		   // One connection through whole application
		   if ( null == self::$cont )
		   {     
			try
			{
			  self::$cont =  new PDO( "mysql:host=".self::$dbHost.";"."dbname=".self::$dbName, self::$dbUsername, self::$dbUserPassword); 
			}
			catch(PDOException $e)
			{
			  die($e->getMessage()); 
			}
		   }
		   return self::$cont;
		}
		 
		public static function disconnect()
		{
			self::$cont = null;
		}
}

?>