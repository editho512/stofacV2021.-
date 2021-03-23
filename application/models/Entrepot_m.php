<?php 
class Entrepot_m extends MY_model{

    public function __construct(){
        parent::__construct();
        $this->_table = "Entrepot";
        $this->_pk = "id_entrepot";
    }
    public function liste($limit = null ){
        $sql ="SELECT *
        FROM entrepot
        JOIN telephone ON entrepot.id_telephone = telephone.id_telephone JOIN district ON entrepot.id_district = district.id_district JOIN mail ON entrepot.id_mail1 = mail.id_mail LEFT JOIN mail AS mail2 ON entrepot.id_mail2 = mail2.id_mail ";
        if ($limit != null) {
            $sql .= " LIMIT ". $limit['start'] ." , ".$limit['limit'];
            }
        $res = $this->_db->query($sql);         
        $res = $res->result();
        return $res;
    }
    public function trouver($id ){
        $sql ="SELECT entrepot.nom_entrepot, entrepot.adresse_1, entrepot.adresse_2, telephone.libelle_telephone, entrepot.id_district, mail.libelle_mail as mail1, mail2.libelle_mail as mail2
        FROM entrepot
        JOIN telephone ON entrepot.id_telephone = telephone.id_telephone JOIN district ON entrepot.id_district = district.id_district JOIN mail ON entrepot.id_mail1 = mail.id_mail LEFT  JOIN mail AS mail2 ON entrepot.id_mail2 = mail2.id_mail WHERE entrepot.id_entrepot = ? ";
        
        $res = $this->_db->query($sql, $id);         
        $res = $res->result();
        return $res;
    }
    /*public function ajout($nom, $adress1,$adresse1,$mail1,$mail2,$telephone,$id_district){

    }*/
}