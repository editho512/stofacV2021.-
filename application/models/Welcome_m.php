<?php 
class Welcome_m extends MY_model{

    public function connecter($user){
        $sql ="SELECT * FROM utilisateur WHERE nom_utilisateur = ? ";
        $res = $this->_db->query($sql,array($user));      
        $res = $res->result();
        return $res;
    }
}