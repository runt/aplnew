<?php



class Model extends /*Nette\*/Object
{
	/** @var DibiConnection */
	public $db;



	public function __construct()
	{
            require_once LIBS_DIR . '/dibi/dibi.php';
            $this->db = new DibiConnection(array(
                'driver'=>'mysql',
                'database'=>'apl',
//                'host'=>'172.16.1.100',
                'host'=>'172.16.1.111',
                'user'=>'root',
                'password'=>'nuredv'));
                $this->db->query('set names utf8');
        }



	/**
	 * @return array
	 */
	public function getTableNames()
	{
		return $this->db->getDatabaseInfo()->getTableNames();
	}



	/**
	 * @return DibiDataSource
	 */
	public function getDataSource($table)
	{
                // TODO: zde vznika velke zpozdeni pri nacitani vsech zaznamu
                
		return $this->db->dataSource('SELECT * FROM %n', $table);
	}

}