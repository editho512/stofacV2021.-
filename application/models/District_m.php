<?php 
class District_m extends MY_model{

    public function __construct(){
        parent::__construct();
        $this->_table = "district";
        $this->_pk = "id_district";
    }
    public function liste($limit = null ){
        $sql ="SELECT district.id_district, district.nom_district, region.nom_region , province.nom_province FROM district JOIN region ON district.id_region = region.id_region JOIN province ON region.id_province = province.id_province";
        if ($limit != null) {
            $sql .= " LIMIT ". $limit['start'] ." , ".$limit['limit'];
            }
        $res = $this->_db->query($sql);      
        $res = $res->result();
        return $res;
    }
    
    public function ajout($nom, $region = null){
        $sql = " INSERT INTO district VALUES(0,?,?)";
        $this->_db->query($sql,array($nom, $region));
    }
    public function modifier($id , $nom, $id_region){
        $sql = "UPDATE district  SET nom_district = ? , id_region = ? WHERE id_district = ?";
        $this->_db->query($sql,array($nom, $id_region, $id));      
    }
}