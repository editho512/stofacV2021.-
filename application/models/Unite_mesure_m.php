<?php 
class Unite_mesure_m extends MY_model{

    public function __construct(){
        parent::__construct();
        $this->_table = "Unite_mesure";
        $this->_pk = "id_unite_mesure";
    }

    public function liste($limit = null){
        $sql ="SELECT unite_mesure.id_unite_mesure, unite_mesure.nom_unite_mesure, unite_mesure.description_unite_mesure, article.id_art FROM unite_mesure LEFT JOIN article ON article.id_unite_mesure = unite_mesure.id_unite_mesure GROUP BY unite_mesure.id_unite_mesure ";     
        if($limit != null){
            $sql .= " LIMIT ". $limit['start'] ." , ".$limit['limit'];
        }
        $res = $this->_db->query($sql);      
        $res = $res->result();
        return $res;
    }
    public function modifier($id , $libelle, $description){
        $sql = "UPDATE unite_mesure SET nom_unite_mesure = ? , description_unite_mesure = ? WHERE id_unite_mesure = ?";
        $this->_db->query($sql,array($libelle, $description, $id));      
    }
        
}