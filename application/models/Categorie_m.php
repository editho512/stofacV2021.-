<?php 
class Categorie_m extends MY_model{

    public function __construct(){
        parent::__construct();
        $this->_table = "Categorie";
        $this->_pk = "id_categorie";
    }

    public function liste($limit = null ){
        $sql ="SELECT categorie.id_categorie, categorie.nom_categorie, categorie.description_categorie, article.id_art FROM categorie LEFT JOIN  article ON article.id_categorie = categorie.id_categorie GROUP BY categorie.id_categorie ";
        if ($limit != null) {
            $sql .= " LIMIT ". $limit['start'] ." , ".$limit['limit'];
            }
        $res = $this->_db->query($sql);      
        $res = $res->result();
        //echo $this->_db->last_query();
        return $res;
    }
    
    
    public function trouver ($id){
        $sql = "SELECT * FROM categorie WHERE id_categorie = ?  ";
        $res = $this->_db->query($sql, $id); 
        return $res->result();
    } 
    public function modifier($id , $libelle, $description){
        $sql = "UPDATE categorie  SET nom_categorie = ? , description_categorie = ? WHERE id_categorie = ?";
        $this->_db->query($sql,array($libelle, $description, $id));      
    }
}