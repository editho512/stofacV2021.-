<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Welcome extends MY_Controller {

	/**
	 * Index Page for this controller.
	 *
	 * Maps to the following URL
	 * 		http://example.com/index.php/welcome
	 *	- or -
	 * 		http://example.com/index.php/welcome/index
	 *	- or -
	 * Since this controller is set as the default controller in
	 * config/routes.php, it's displayed at http://example.com/
	 *
	 * So any other public methods not prefixed with an underscore will
	 * map to /index.php/welcome/<method_name>
	 * @see https://codeigniter.com/user_guide/general/urls.html
	 * 
	 */

	public function __construct()
	{
		parent::__construct();
        $this->_data['menu_active'] = "TBD"; 
	}
	public function index()
	{
		if(isset($_SESSION['user']))
		{
			
			$this->chargerPage();			
		}else{
			$this->_data['require_js'] = array("welcome/welcome");
			$this->load->view('log',$this->_data,false);
		}
	}

	public function Connecter(){
		if(isset($_POST)) 
		{
			extract($_POST);
			$user = (isset($user) || $user != "")?$user:null;
			$mdp = (isset($mdp) || $mdp != "")?$mdp:null;
			$this->load->model('Welcome_m');
			$this->load->library('encryption');
			$key='Ydf5EfP79mPz';
			$this->encryption->initialize(array('key' => $key));
			//$mdp_crypte =$this->encryption->encrypt($mdp);			
			$compte = $this->Welcome_m->connecter($user);
			$state = 0;
			$result = 0;
			foreach($compte as $cmpt){
				$result++;
				if($this->encryption->decrypt($cmpt->mdp_utilisateur) == $mdp){
					$this->session->set_userdata("user",$cmpt->nom_utilisateur);
					$this->session->set_userdata("photo",$cmpt->photo_utilisateur);
					$state = 1;
				}
			}		
			$response['statuts'] = (($state == 0 && $result > 0)?2:$state); 
			
			$response['message'] = $this->Tdb();
			echo json_encode($response);
		}
		
	}
	public function Tdb(){
		return $this->chargerPageChaine();
	}
	public function Deconnecter(){
		$this->session->sess_destroy();
		redirect("Welcome/index");
	}
}
