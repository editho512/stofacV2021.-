<?php 
class Article_m extends MY_model{

    public function __construct(){
        parent::__construct();
        $this->_table = "Article";
        $this->_pk = "id_art";
    }
    public function liste($limit = null ){
        $sql ="SELECT * FROM Article JOIN categorie ON Article.id_categorie = categorie.id_categorie JOIN unite_mesure ON unite_mesure.id_unite_mesure = Article.id_unite_mesure ";
        if ($limit != null) {
            $sql .= " LIMIT ". $limit['start'] ." , ".$limit['limit'];
            }
        $res = $this->_db->query($sql);      
        $res = $res->result();
        return $res;
    }
    public function ajout($libcourt, $liblong, $categorie, $unite_mesure){
        $sql = "INSERT INTO article VALUES(0,null,?,?,?,?) ";
        $this->_db->query($sql,array($libcourt, $liblong, $categorie, $unite_mesure));
        $sql = " SELECT id_art FROM article WHERE libcourt_art = ? AND liblong_art = ? AND id_categorie = ? AND id_unite_mesure = ?";  
        $res = $this->_db->query($sql,array($libcourt, $liblong, $categorie, $unite_mesure));
        $this->mettre_code($res->result()[0]->id_art, $unite_mesure);
    }

    public function modifier($id_art, $libcourt, $liblong, $id_categorie, $id_unite_mesure){
        $sql = " UPDATE article SET libcourt_art = ? , liblong_art = ? , id_categorie = ? , id_unite_mesure = ? WHERE id_art = ? ";
        $this->_db->query($sql,array($libcourt, $liblong, $id_categorie, $id_unite_mesure, $id_art));
        $this->mettre_code($id_art,$id_unite_mesure);
    }
    private function mettre_code($id_art, $id_unite_mesure){
        $sql = "SELECT nom_unite_mesure AS um FROM unite_mesure WHERE id_unite_mesure = ? ";
        $res = $this->_db->query($sql,$id_unite_mesure);
        $um = $res->result()[0]->um;
        $um = strtoupper(substr($um, 0,2));        
        $code = $um.$id_art."";
        $sql = " UPDATE article SET code_art = ? WHERE id_art = ? ";
        $this->_db->query($sql,array($code, $id_art));
    }
}