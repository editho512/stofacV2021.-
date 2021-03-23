<?php 
class Mail_m extends MY_model{

    public function __construct(){
        parent::__construct();
        $this->_table = "Mail";
        $this->_pk = "id_mail";
    }
    public function ajout($mail, $type = "Professionnel"){
        $misy = $this->trouver($mail, $type);
        if( $misy == null){
            $sql = "INSERT INTO mail VALUES(0,?,?)";
            $res = $this->_db->query($sql,array($mail,$type));  
            return 0;
        }else{
            return $misy;
        }
    }
    public function trouver($mail, $type = "Professionnel"){
        $sql = "SELECT (id_mail) FROM mail WHERE libelle_mail = ? AND type_mail = ? ";
        $res = $this->_db->query($sql,array($mail,$type)); 
        $res = $res->result();
        return (isset( $res[0]->id_mail)) ? $res[0]->id_mail : NULL;
    }
}