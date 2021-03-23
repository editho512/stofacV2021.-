<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Articles extends MY_Controller {

	public function __construct()
	{
		parent::__construct();		
		$this->load->model('Categorie_m');
		$this->load->model('Article_m');
		$this->load->model('Unite_mesure_m');	
		$this->_data['require_js'] = array("articles/articles");
        $this->_data['menu_active'] = "Articles"; 
        $this->_data['sous_menu'] = array("liste" => "Liste des articles","parametre" => "Paramètres"); 
		$this->_data['sous_menu_active'] = "Liste des articles";
		$this->_data['side_bar'] = array();	
		$this->_data["parcours"] = array("menu" => "Articles","sous_menu" => "Liste des articles" , "side_bar" => null);

		$this->_data['button_ajout'] = "article";	
    }
	public function Articles($page = 0){
		$this->_data['titre_page'] = "Liste des articles :";
		$data = array();
		if(isset($_POST)) extract($_POST);
		$offset = ( isset($off) && $off != '' ) ? $off : 0;
		$page = (isset($page))?$page:0;
		$data_local["select_categorie"] = $this->Categorie_m->liste();
		$data_local["select_unite_mesure"] = $this->Unite_mesure_m->liste();
		if(!isset($ajax)){
			$this->_data['content'] = $this->liste(__CLASS__,$this->Article_m, $offset, $page,$data, false, $data_local);			
			$this->chargerPage();		
		}else{
			$data["parcours"] = array("menu" => "Articles","sous_menu" => "Liste des articles" , "side_bar" => null);
			$this->liste(__CLASS__,$this->Article_m, $offset, $page,$data, true, $data_local);
		}
	}
	public function Trouver_article(){
		if(isset($_POST)){
			extract($_POST);
			$data = $this->Article_m->trouver($id);
			echo json_encode($data);
		}
	}
	public function Modifier_article(){
		if(isset($_POST)){
			extract($_POST);			
			$this->Article_m->modifier($id, ucwords($libcourt), ucwords($liblong), $id_categorie, $id_unite_mesure);
			echo 1;
		}else{
			echo 0;
		}
	}
	public function Supprimer_article(){
		$this->Supprimer($this->Article_m);
	}
	public function Parametres(){		
		$this->_data["side_bar"] = $this->chargeSideBar(array("categorie" => "Catégorie d'article","unite_mesure" => "Unité de mesure"),"Catégorie d'article","side_bar","article");
		$this->Categorie();
	}

	public function Unite_mesure($page = 0){
		$data["titre_page"] = "Liste des unités de mesure : ";
		$data["parcours"] = array("menu" => "Articles","sous_menu" => "Paramètres" , "side_bar" => "Unité de mesure");
		$data["side_bar"] = $this->chargeSideBar(array("categorie" => "Catégorie d'article","unite_mesure" => "Unité de mesure"),"Unité de mesure","side_bar","article");
			
		$offset = ( isset($off) && $off != '' ) ? $off : 0;
		$page = (isset($page))?$page:0;
		$this->liste(__FUNCTION__,$this->Unite_mesure_m, $offset, $page,$data);		
	}
	public function Categorie($page = 0){				
		$data["titre_page"] = "Liste des catégories d'article :"; // titre kafa alaigny am ajax.
		$data["parcours"] = array("menu" => "Articles","sous_menu" => "Paramètres" , "side_bar" => "catégories d'article");
		$data["side_bar"] = $this->_data["side_bar"];
		$offset = ( isset($off) && $off != '' ) ? $off : 0;
		$page = (isset($page))?$page:0;
		$this->liste(__FUNCTION__,$this->Categorie_m, $offset, $page,$data);
	}
		
	
	public function Ajouter_article(){
		$res = 0;
		if(isset($_POST)){
			extract($_POST);
			$this->load->model('Article_m');
			$this->Article_m->ajout(ucwords($libcourt), ucwords($liblong), $id_categorie, $id_unite_mesure);
			$res = 1;
		}
		echo $res;
	}
	public function Ajouter_unite_mesure(){
		$res = 0;
		if(isset($_POST)){
			extract($_POST);
			$this->load->model('Unite_mesure_m');
			$this->Unite_mesure_m->ajouter(ucwords($libelle), ($description == "")?null:ucwords($description));
			$res = 1;
		}
		echo $res;
	}
	public function Trouver_unite_mesure(){
		if(isset($_POST)){
			extract($_POST);
			
			$data = $this->Unite_mesure_m->trouver($id);
			echo json_encode($data);
		}
	}
	public function Modifier_unite_mesure(){
		if(isset($_POST)){
			extract($_POST);	
					
			$this->Unite_mesure_m->modifier($id, ucwords($libelle), ucwords($description));
			echo 1;
		}else{
			echo 0;
		}
	}
	public function Supprimer_unite_mesure(){
		$this->Supprimer($this->Unite_mesure_m);		
	}
	public function Ajouter_categorie(){
		$res = 0;
		if(isset($_POST)){
			extract($_POST);
			
			$this->Categorie_m->ajouter(ucwords($libelle), ($description == "")?null:ucwords($description));
			$res = 1;
		}
		echo $res;
	}
	public function Supprimer_categorie(){
		$this->Supprimer($this->Categorie_m);
	}
	public function Trouver_categorie(){
		if(isset($_POST)){
			extract($_POST);
			$data = $this->Categorie_m->trouver($id);
			echo json_encode($data);
		}
	}
	public function Modifier_categorie(){
		if(isset($_POST)){
			extract($_POST);			
			$this->Categorie_m->modifier($id, ucwords($libelle), ucwords($description));
			echo 1;
		}else{
			echo 0;
		}
	}

	
}