<?php 
class Telephone_m extends MY_model{

    public function __construct(){
        parent::__construct();
        $this->_table = "Telephone";
        $this->_pk = "id_telephone";
    }
    public function ajout($telephone, $type = "Professionnel"){
        $misy = $this->trouver($telephone, $type);
        if( $misy == null){

            $sql = "INSERT INTO telephone VALUES(0,?,?)";
            $res = $this->_db->query($sql,array($telephone,$type));  
        }
    }
    public function trouver($telephone, $type = "Professionnel"){
        $sql = "SELECT (id_telephone) FROM telephone WHERE libelle_telephone = ? AND type_telephone = ? ";
        $res = $this->_db->query($sql,array($telephone,$type)); 
        $res = $res->result();
        return (isset( $res[0]->id_telephone)) ? $res[0]->id_telephone : NULL;
    }
}