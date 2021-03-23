<?php defined('BASEPATH') OR exit('No direct script access allowed');

class MY_Model extends CI_Model {

	protected $_dbConfig;  
    protected $_db = '';    
    protected $_table = "";
    protected $_pk = "";
    protected $_filter = "intval";
    protected $_order = "";
    protected $_useDefaultDB = FALSE;
    public function __construct(){
        parent::__construct();
        $dbconfig = array(
            'dsn'   => '',
            'hostname' => 'localhost',
            'username' => 'root',
            'password' => '',
            'database' => "stofac",
            'dbdriver' => 'mysqli',
            'dbprefix' => '',
            'pconnect' => FALSE,
            'db_debug' => (ENVIRONMENT !== 'production'),
            'cache_on' => FALSE,
            'cachedir' => '',
            'char_set' => 'utf8',
            'dbcollat' => 'utf8_general_ci',
            'swap_pre' => '',
            'encrypt' => FALSE,
            'compress' => FALSE,
            'stricton' => FALSE,
            'failover' => array(),
            'save_queries' => TRUE);
        $this->db = $this->load->database($dbconfig,TRUE,TRUE);
        $this->_db = $this->db;
    }
    public function liste_total($limit = null ){
        $sql ="SELECT count(*) as total FROM  ".$this->_table;
        if ($limit != null) {
            $sql .= " LIMIT ". $limit['start'] ." , ".$limit['limit'];
            }
        $res = $this->_db->query($sql);      
        $res = $res->result()[0]->total;
        return $res;
    }
    public function ajouter($libelle , $description){
        $sql ="INSERT INTO ".$this->_table." VALUES(0,?,?)  ";
        
        $this->_db->query($sql,array($libelle, $description));      
       
    }
    public function trouver ($id){
        $sql = "SELECT * FROM ".$this->_table." WHERE ".$this->_pk." = ?  ";
        $res = $this->_db->query($sql, $id); 
        return $res->result();
    } 
    public function supprimer ($id){
        $sql =" DELETE FROM ".$this->_table." WHERE ".$this->_pk." = ?  ";
        $this->_db->query($sql,$id);     

    }
    public function liste($limit = null ){
        $sql ="SELECT * FROM ".$this->_table;
        if ($limit != null) {
            $sql .= " LIMIT ". $limit['start'] ." , ".$limit['limit'];
            }
        $res = $this->_db->query($sql);      
        $res = $res->result();
        return $res;
    }
    function save( $data, $clause = NULL){

        $res = NULL;

        if( $clause && is_array($clause) ) {
            $this->db->where ($clause);
            $this->db->update($this->_table, $data);
            $res = $clause;
           
        } else { 
            $this->db->insert($this->_table, $data);
            $res = $this->db->insert_id();
        }
        
       return $res;

    }
}
	