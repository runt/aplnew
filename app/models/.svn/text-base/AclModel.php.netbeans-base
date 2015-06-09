<?php
/* 
 * To change this template, choose Tools | Templates
 * and open the template in the editor.
 */

/**
 * Description of AclModel
 *
 * @author runt
 */
class AclModel extends Object{
    const ACL_TABLE = 'acl';
    const PRIVILEGES_TABLE = 'privileges';
    const RESOURCES_TABLE = 'resources';
    const ROLES_TABLE = 'roles';

    public $db;

        public function __construct()
	{
//            parent::__construct();
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
    public function getRoles() {
        $result = $this->db->query('SELECT r1.name, r2.name as parent_name
                               FROM ['. self::ROLES_TABLE . '] r1
                               LEFT JOIN ['. self::ROLES_TABLE . '] r2 ON (r1.parent_id = r2.id)
                              ');
        $rows = $result->fetchAll();
        return $rows;
    }

    public function getResources() {
        $result = $this->db->query('SELECT CONCAT_WS("_",form_id,element_id) as name FROM ['. self::RESOURCES_TABLE . '] ');
        return $result->fetchAll();
        //dibi::fetchAll('SELECT name FROM ['. self::RESOURCES_TABLE . '] ');
    }

    public function getRules() {
        $result = $this->db->query('
            SELECT
                a.allowed as allowed,
                ro.name as role,
                CONCAT_WS("_",re.form_id,re.element_id) as resource,
                p.name as privilege
                FROM [' . self::ACL_TABLE . '] a
                JOIN [' . self::ROLES_TABLE . '] ro ON (a.role_id = ro.id)
                LEFT JOIN [' . self::RESOURCES_TABLE . '] re ON (a.resource_id = re.id)
                LEFT JOIN [' . self::PRIVILEGES_TABLE . '] p ON (a.privilege_id = p.id)
                ORDER BY a.id ASC
        ');
        return $result->fetchAll();

    }
}
?>
