<?php 
class Province_m extends MY_model{

    public function __construct(){
        parent::__construct();
        $this->_table = "Province";
        $this->_pk = "id_province";
    }
    public function ajout($nom, $pays = null){
        $sql = " INSERT INTO province VALUES(0,?,?)";
        $this->_db->query($sql,array($nom, $pays));
    }
    public function trouver ($id){
        $sql = "SELECT * FROM province WHERE id_province = ?  ";
        $res = $this->_db->query($sql, $id); 
        return $res->result();
    } 
    public function liste($limit = null ){
        $sql ="SELECT province.id_province, province.nom_province, region.id_region FROM province LEFT JOIN region ON province.id_province = region.id_province GROUP BY province.id_province";
        if ($limit != null) {
            $sql .= " LIMIT ". $limit['start'] ." , ".$limit['limit'];
            }
        $res = $this->_db->query($sql);   
        $res = $res->result();
        return $res;
    }
    public function modifier ($id, $nom, $pays = null){
        $sql = "UPDATE province SET nom_province = ? WHERE id_province = ? ";
        $res = $this->_db->query($sql, array($nom, $id)); 
        
    } 
}