<?php

    class MY_Controller extends CI_Controller{
        
        protected   $_data            = array();
        protected   $_tousutilisateur = array();
        protected   $_session         = array();
      
        public function __construct( ){
            parent::__construct();
            $this->load->helper('assets'); 
                 
            
        }
        protected function chargerPageChaine(){
            
            return $this->load->view("layout",$this->_data,true);
        }
        protected function chargerPage(){

             $this->load->view("layout",$this->_data);
        }
        protected function chargeSideBar($liste, $active, $view,$menu){
            $this->_data['side_bar'] = $liste; 
		    $this->_data['side_bar_active'] = $active;
            $this->_data['menu'] = $menu;
		    return $this->load->view($view,$this->_data,true);

        }
        protected  function liste($nom, $table, $offset, $page,$__data , $ajax = true, $_data = null){ 
            //$_data porte les données vers la liste
            $limit = array( "limit" => 4, "start" => $page);
            $_data['liste_'.strtolower($nom)] = $table->liste($limit);		
            $total_rows = $table->liste_total();
            $this->_paginationConfig($total_rows, $limit['limit'], site_url( strtolower(get_class($this)). '/'.ucwords($nom).'/' ));
            $_data['offset'] = $offset;
            $_data['page'] = $page;
            $_data['page_links'] = $this->pagination->create_links();			
            $_data['total_rows'] = $total_rows;
            $__data["content"] = $this->load->view("/".strtolower(get_class($this))."/liste_".strtolower($nom),$_data,true);
            if($ajax == true){
                echo json_encode($__data);
            }else{
                return $__data["content"];
            }
    
        }
        protected function Supprimer($table){
            if( isset( $_POST))
            { extract($_POST);		
            $table->supprimer($id);
            echo 1;
            } else{
                echo 0;
            }
        }


        protected function Verifier_mail($mail, $type = "Professionnel"){
            if(filter_var($mail, FILTER_VALIDATE_EMAIL)){
                $this->load->model("Mail_m");
                $this->Mail_m->ajout($mail);
                return $this->Mail_m->trouver($mail);
            }else {                
                return 0;
            }
        }
        protected function Verifier_telephone($telephone, $type = "Professionnel"){
            if(strlen($telephone) > 2 ){
                $this->load->model("Telephone_m");
                $this->Telephone_m->ajout($telephone);
                return $this->Telephone_m->trouver($telephone);
            }else {	                
                return 0;
            }
        }
        protected function _paginationConfig( $totalrows, $limit, $baseurl ){

            $this->load->library( 'pagination' );
    
            $config['first_link']      = '<<';
            $config['last_link']       = '>>';
            $config['next_tag_open']   = '<button class="btn btn-default btn-sm">';
            $config['next_tag_close']  = '</button>';
            $config['last_tag_open']   = '<button class="btn btn-default btn-sm" >';
            $config['last_tag_close']  = '</button>';
            $config['first_tag_open']  = '<button class="btn btn-default btn-sm">';
            $config['first_tag_close'] = '</button>';
            $config['prev_tag_open']   = '<button class="btn btn-default btn-sm">';
            $config['prev_tag_close']  = '</button>';
            $config['cur_tag_open']    = '<button class="btn btn-info btn-sm">';
            $config['cur_tag_close']   = '</button>';
            $config['num_tag_open']    = '<button class="btn btn-default btn-sm ">';
            $config['num_tag_close']   = '</button>';
            $config["total_rows"]      = $totalrows;
            $config["per_page"]        = $limit;
            $config["uri_segment"]     = 3;
            $config["base_url"]        = $baseurl;
    
            $this->pagination->initialize( $config );
    
        }
    }
