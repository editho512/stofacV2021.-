<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Stock extends MY_Controller {
	/**
	 * Author : RANDRIAMAHAZOSOA Alex Editho
	 */

	public function __construct()
	{
		parent::__construct();	
        $this->load->model('Province_m');
		$this->load->model('Region_m');
		$this->load->model('District_m');
		$this->load->model('Entrepot_m');
		$this->_data['require_js'] = array("stock/stock");
        $this->_data['menu_active'] = "Stock"; 
        $this->_data['sous_menu'] = array("entrepot" => "Entrepôts","point_de_vente" => "Point de vente" , "paremetre" => "Paramètre de localisation" ); 
		$this->_data['sous_menu_active'] = "Entrepôts";
		$this->_data['button_ajout'] = "entrepot";	
    }
    public function Stock(){
		$this->_data['titre_page'] = "Liste des entrepôts :";
		$this->_data["parcours"] = array("menu" => "Stock","sous_menu" => "Entrepôts" , "side_bar" => "Liste des entrepôts");
		$this->_data["side_bar"] = $this->chargeSideBar(array("liste_entrepot" => "Liste des entrepôts","fournisseur" => "Fournisseur", ),"Liste des entrepôts","side_bar","stock");
		$this->Entrepot();		
        $this->chargerPage();
    }
    public function Parametre(){
        $this->_data["side_bar"] = $this->chargeSideBar(array("province" => "Province","region" => "Region", "district" => "District"),"Province","side_bar","stock");
        $this->province();
    }
	private function verifier_entrepot($data){
		extract($data);
			$res = array();
			$id_mail = 0 ;
			$id_telephone = 0;
			$id_mail2 = null;
			$clause = null;
			if( !isset($mail1) || $mail1 == "" || $mail1 != null) {
				// 1 si mail n'est pas valide.
				$id_mail = 0 ;
				if(isset($old_mail1) && $old_mail1 != "" && $old_mail1 != null){
					$id_mail = $this->Verifier_mail($old_mail1);
					$this->load->model("Mail_m");
                	$this->Mail_m->save(array("libelle_mail" => $mail1), array("id_mail" => $id_mail));
				}else {
					$id_mail = $this->Verifier_mail($mail1);
				}
				if($id_mail == 0  ){
					$res["mail1"] = 1;
				}				
			}
			if( !isset($telephone) || $telephone == "" || $telephone != null){
				// 2 si telephone est invalide.
				$id_telephone = $this->Verifier_telephone($telephone);
				if($id_telephone == 0){
					$res["telephone"] = 1 ;
				}
			}
			if(!isset($nom) || $nom == "" || strlen($nom) < 3){
				// 3 si nom entrepot invalide
				$res["nom"] = 1 ;				
			}
			if(!isset($id_district) || $id_district ==  0 ){
				// 4 si district invalid;
				$res["district"] = 1 ;
			}
			if(isset($mail2) && $mail2 != null && $mail2 !="") {
				// 12 si mail 2 n'est pas valide.
				$id_mail2 = 0 ;
				if(isset($old_mail2) && $old_mail2 != "" && $old_mail2 != null){
					$id_mail2 = $this->Verifier_mail($old_mail2);
					$this->load->model("Mail_m");
                	$this->Mail_m->save(array("libelle_mail" => $mail2), array("id_mail" => $id_mail2));
				}else {
					$id_mail2 = $this->Verifier_mail($mail2);
				}
				if($id_mail2 == 0 ){
					$res["mail2"] = 1;
				}
				
			}
			if(!isset($adresse1) || $adresse1 == "" || strlen($adresse1) < 5){
				// 5 adresse 1 invalid
				$res["adresse1"] = 1;
			}
			if(isset($adresse2) && $adresse2 != "" && $adresse2 != null &&  strlen($adresse2) < 5){
				// 6 adresse 2 invalid
				$res["adresse2"] = 1;
			}
			if( count($res) == 0 && isset($id_mail) && $id_mail != 0 && isset($adresse1) && $adresse1 !="" ){
				$adresse2 = (isset($adresse2) && $adresse2 !="") ? $adresse2 : null;
				$id_mail2 = (isset($id_mail2) && $id_mail2 != 0) ? $id_mail2 : null;
				$entrepot = array(
				"nom_entrepot" => ucwords($nom) , "adresse_1" => ucwords($adresse1),
				"adresse_2" => ucwords($adresse2) , "id_mail1" => $id_mail ,
				"id_mail2" => $id_mail2 , "id_telephone" => $id_telephone ,
				"id_district" => $id_district);
				if(isset($id_entrepot) && $id_entrepot != null){
					$clause = array("id_entrepot" => $id_entrepot);
				}else{
					$entrepot["id_entrepot"] = 0;
				}
				$this->Entrepot_m->save($entrepot, $clause);
			}
		return $res;
	}
	public function Ajouter_entrepot(){
		$res = array();
		if(isset($_POST)){
			$res = $this->verifier_entrepot($_POST);
		}
		echo json_encode($res);
	}
	
	public function ajout_tel($tel){
		$this->load->model("Telephone_m");
		$this->Telephone_m->ajout($tel);
		//echo $this->Telephone_m->trouver($tel."000");
	}
	public function Entrepot($page = 0){
		$data = array();
		$liste_district = $this->District_m->liste();
		if(isset($_POST)) extract($_POST);
        $offset = ( isset($off) && $off != '' ) ? $off : 0;
		$page = (isset($page))?$page:0;
		if(isset($ajax) && $ajax == true) {
			$data["titre_page"] = "Liste des entrepôts :"; // titre kafa alaigny am ajax.
			$data["parcours"] = array("menu" => "Stock","sous_menu" => "Entrepôts" , "side_bar" => "Liste des entrepôts");
			$data["side_bar"] = $this->chargeSideBar(array("liste_entrepot" => "Liste des entrepôts","fournisseur" => "Fournisseur", ),"Liste des entrepôts","side_bar","stock");
			$this->liste(__FUNCTION__,$this->Entrepot_m, $offset, $page,$data, true,array("liste_district" => $liste_district ) );
		} else{
			
			$this->_data["content"] = $this->liste(__FUNCTION__,$this->Entrepot_m, $offset, $page,$data, false,array("liste_district" => $liste_district ) );

		}

    }
	public function Trouver_entrepot(){
		if(isset($_POST)){
			extract($_POST);
			$data = $this->Entrepot_m->trouver($id);
			echo json_encode($data);
		}
	}
	//----------------- DISTRICT -----------------
	public function district($page = 0){
        $data["titre_page"] = "Liste des districts :"; // titre kafa alaigny am ajax.
		$data["parcours"] = array("menu" => "Stock","sous_menu" => "Paramètre de localisation" , "side_bar" => "District");
		$this->_data["side_bar"] = $this->chargeSideBar(array("province" => "Province","region" => "Region", "district" => "District"),"District","side_bar","stock");
		$liste_region = $this->Region_m->liste_select();
        $offset = ( isset($off) && $off != '' ) ? $off : 0;
		$page = (isset($page))?$page:0;
        $this->liste(__FUNCTION__,$this->District_m, $offset, $page,$data, true,array("liste_region" => $liste_region ) );

    }
	public function Ajouter_district(){
		$res = 0;
		if(isset($_POST)){
			extract($_POST);			
			$this->District_m->ajout(ucwords($nom), $id_region);
			$res = 1;
		}
		echo $res;
	}
	
	public function Trouver_district(){
		if(isset($_POST)){
			extract($_POST);
			$data = $this->District_m->trouver($id);
			echo json_encode($data);
		}
	}
	public function Modifier_district(){
		if(isset($_POST)){
			extract($_POST);	
			$this->District_m->modifier($id, ucwords($nom), $id_region);
			echo 1;
		}else{
			echo 0;
		}
	}
	public function Supprimer_district(){
		$this->Supprimer($this->District_m);
	}

	//--------- REGION ----------------
	public function region($page = 0){
        $data["titre_page"] = "Liste des regions :"; // titre kafa alaigny am ajax.
		$data["parcours"] = array("menu" => "Stock","sous_menu" => "Paramètre de localisation" , "side_bar" => "Region");
		$this->_data["side_bar"] = $this->chargeSideBar(array("province" => "Province","region" => "Region", "district" => "District"),"Region","side_bar","stock");
		$liste_province = $this->Province_m->liste();
        $offset = ( isset($off) && $off != '' ) ? $off : 0;
		$page = (isset($page))?$page:0;
        $this->liste(__FUNCTION__,$this->Region_m, $offset, $page,$data, true,array("liste_province" => $liste_province ) );

    }
	public function Ajouter_region(){
		$res = 0;
		if(isset($_POST)){
			extract($_POST);			
			$this->Region_m->ajout(ucwords($nom), $id_province);
			$res = 1;
		}
		echo $res;
	}
	public function Trouver_region(){
		if(isset($_POST)){
			extract($_POST);
			$data = $this->Region_m->trouver($id);
			echo json_encode($data);
		}
	}
	public function Modifier_region(){
		if(isset($_POST)){
			extract($_POST);	
			$this->Region_m->modifier($id, ucwords($nom), $id_province);
			echo 1;
		}else{
			echo 0;
		}
	}
	public function Supprimer_region(){
		$this->Supprimer($this->Region_m);
	}

	//---------- Province -----------
    public function province($page = 0){
        $data["titre_page"] = "Liste des provinces :"; // titre kafa alaigny am ajax.
		$data["parcours"] = array("menu" => "Stock","sous_menu" => "Paramètre de localisation" , "side_bar" => "Province");
		$data["side_bar"] = $this->_data["side_bar"];
        $offset = ( isset($off) && $off != '' ) ? $off : 0;
		$page = (isset($page))?$page:0;
        $this->liste(__FUNCTION__,$this->Province_m, $offset, $page,$data);

    }
    public function Ajouter_province(){
		$res = 0;
		if(isset($_POST)){
			extract($_POST);			
			$this->Province_m->ajout(ucwords($nom), $pays);
			$res = 1;
		}
		echo $res;
	}
    public function Trouver_province(){
		if(isset($_POST)){
			extract($_POST);
			$data = $this->Province_m->trouver($id);			
			echo json_encode($data);
		}
	}
    public function Modifier_province(){
		if(isset($_POST)){
			extract($_POST);	
			$this->Province_m->modifier($id, ucwords($nom), $pays);
			echo 1;
		}else{
			echo 0;
		}
	}
	public function Supprimer_province(){
		$this->Supprimer($this->Province_m);
	}
}