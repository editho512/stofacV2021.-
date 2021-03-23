<?php 
class Region_m extends MY_model{

    public function __construct(){
        parent::__construct();
        $this->_table = "Region";
        $this->_pk = "id_region";
    }
    public function liste($limit = null ){
        $sql ="SELECT region.id_region, region.nom_region, province.nom_province , district.id_district FROM region LEFT JOIN district ON region.id_region = district.id_region JOIN province ON region.id_province = province.id_province GROUP BY region.id_region";
        if ($limit != null) {
            $sql .= " LIMIT ". $limit['start'] ." , ".$limit['limit'];
            }
        $res = $this->_db->query($sql);      
        $res = $res->result();
        return $res;
    }
    public function liste_select( ){
        $sql ="SELECT * FROM region JOIN province ON region.id_province = province.id_province";
       
        $res = $this->_db->query($sql);      
        $res = $res->result();
        return $res;
    }
    public function trouver ($id){
        $sql = "SELECT province.id_province, region.nom_region FROM  region JOIN province ON region.id_province = province.id_province  WHERE region.id_region = ? ";
        $res = $this->_db->query($sql, $id);         
        return $res->result();
    } 
    public function ajout($nom, $id_province){
        $sql ="INSERT INTO region VALUES(0,?,?) ";
        $this->_db->query($sql,array($nom, $id_province));
    }
    public function modifier($id, $nom, $id_province){
        $sql = "UPDATE region SET nom_region = ? , id_province = ? WHERE id_region = ?";
        $this->_db->query($sql,array( $nom, $id_province, $id));
    }
}