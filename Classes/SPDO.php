<?php

/**
 * Singleton pour l'acc�s � la base de donn�es
 * @author util1p04
 *
 */
class SPDO
{
  	/**
   	* Instance de la classe PDO
   	*
   	* @var PDO
   	* @access private
   	*/ 
  	private $PDOInstance = null;
 
   	/**
   	* Instance de la classe SPDO
   	*
   	* @var SPDO
   	* @access private
   	* @static
   	*/ 
  	private static $instance = null;
 
  	/**
   	* Constante: nom d'utilisateur de la bdd
   	*
   	* @var string
   	*/
  	const DEFAULT_SQL_USER = 'algobreizh';
 
  	/**
   	* Constante: h�te de la bdd
   	*
   	* @var string
   	*/
  	const DEFAULT_SQL_HOST = 'localhost';
 
  	/**
   	* Constante: h�te de la bdd
   	*
   	* @var string
   	*/
  	const DEFAULT_SQL_PASS = '';
 
  	/**
   	* Constante: nom de la bdd
   	*
   	* @var string
   	*/
 	const DEFAULT_SQL_DTB = 'algobreizh_gestion';
 
  	/**
   	* Constructeur
   	*
   	* @param void
   	* @return void
   	* @see PDO::__construct()
   	* @access private
   	*/
  	private function __construct()
  	{
    	$this->PDOInstance = new PDO('mysql:dbname='.self::DEFAULT_SQL_DTB.';host='.self::DEFAULT_SQL_HOST.';charset=utf8'	,self::DEFAULT_SQL_USER ,self::DEFAULT_SQL_PASS);    
  	}
 
   /**
    * Cr�e et retourne l'objet SPDO
    *
    * @access public
    * @static
    * @param void
    * @return SPDO $instance
    */
 	public static function getInstance()
  	{  
    	if(is_null(self::$instance))
    	{
      		self::$instance = new SPDO();
    	}
    	return self::$instance;
  	}
 
 	/**
   	* Ex�cute une requ�te SQL avec PDO
   	*
   	* @param string $query La requ�te SQL
   	* @return PDOStatement Retourne l'objet PDOStatement
   	*/
	public function query($query)
	{
		return $this->PDOInstance->query($query);
	}
	
	/**
	 * Récupère l'id du dernier objet inséré
	 * @return Retourne l'id du dernier objet inséré
	 */
	public function lastInsertId()
	{
		return $this->PDOInstance->lastInsertId();
	}
}
