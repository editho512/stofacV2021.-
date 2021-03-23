<doctype HTML>
<html>
    <head>
    <title><?php echo APP_TITLE;?></title>
    <link rel="stylesheet" type="text/css" href="<?php echo css_url("bootstrap/bootstrap.min");?>">
    <link rel="stylesheet" type="text/css" href="<?php echo css_url("style");?>">    
    <link rel="stylesheet"  href="<?php echo css_url("font-awesome/css/font-awesome.min");?>">
    <link rel="stylesheet"  href="<?php echo css_url("select2/select2.min");?>">
    <link rel="stylesheet" type="text/css" href="<?php // echo css_url("jquery.modal");?>">
    <link rel="stylesheet" type="text/css" href="<?php echo css_url("font-awesome.min");?>">
    <link rel="stylesheet" type="text/css" href="<?php echo css_url("bootstrap-datepicker3.min");?>">
    <script src="<?php // echo js_url("jquery.modal"); ?>"></script>
    <script src="<?php echo js_url("jquery/jquery.min"); ?>"></script>
    <script src="<?php echo js_url("bootstrap/bootstrap.min"); ?>"></script>
    <script src="<?php echo js_url("Chart.min"); ?>"></script>
    <script src="<?php echo js_url("bootstrap-datepicker"); ?>"></script>
    <script src="<?php echo js_url("style"); ?>"></script>
    <script src="<?php echo js_url("select2/select2"); ?>"></script>
  
   
   
    <?php if(isset($require_js)):?>
        <?php foreach($require_js as $r):?>
            <script src="<?php echo js_url($r);?>"></script>
        <?php endforeach;?>
        <?php endif;?>
</head>
    <body>
       
        <nav class="navbar navbar-expand-lg navbar-light bg-light" style="background-color:rgb(235, 148, 17) !important;z-index:1000;">
            <a class="navbar-brand"  style="color:white !important" href="<?php echo base_url().'index.php/Welcome/'; ?>"><?php echo APP_TITLE;?></a>
        
            <div class="collapse navbar-collapse" id="navbarSupportedContent" >
                <ul class="navbar-nav mr-auto grand" id="grand" style="background-color:rgb(187, 8, 8) !important;border-radius:4%;border:solid 2px white !important;">
                    <li class="nav-item ">
                        <a class="nav-link icon-menu <?php echo (isset($menu_active) && $menu_active == 'TBD')?'active':'';?>" style="color:white !important" id="tdb" href="<?php echo base_url().'index.php/Welcome/tdb'; ?>">TBD&nbsp;<span id ="tdb-icon "class="fa fa-tachometer " ></span></a>
                    </li>
                    <li class="nav-item "> 
                        <a class="nav-link icon-menu <?php echo (isset($menu_active) && $menu_active == 'Articles')?'active':'';?> " style="color:white !important" id="articles" href="<?php echo base_url().'index.php/Articles/Articles'; ?>">Articles&nbsp;<span id ="tdb-icon "class="fa fa-list " ></span></a>
                    </li>
                    <li class="nav-item ">
                        <a class="nav-link icon-menu <?php echo (isset($menu_active) && $menu_active == 'Stock')?'active':'';?> " style="color:white !important" id="tdb" href="<?php echo base_url().'index.php/Stock/Stock'; ?>">Stock&nbsp;<span id ="tdb-icon "class="fa fa-tachometer " ></span></a>
                    </li>
                    <li class="nav-item ">
                        <a class="nav-link icon-menu <?php echo (isset($menu_active) && $menu_active == 'Paramètre')?'active':'';?> " style="color:white !important" id="tdb" href="<?php echo base_url().'index.php/Welcome/tdb'; ?>">Paramètre&nbsp;<span id ="tdb-icon "class="fa fa-cog " ></span></a>
                    </li>
                

                </ul>
                
            </div>
            <a class="navbar-brand"  style="color:rgb(187, 8, 8) !important;font-size:100% !important;" href="<?php echo base_url().'index.php/Welcome/Deconnecter'; ?>">Se deconnecter&nbsp;<span class="fa fa-power-off icon"></span></a>

        </nav>
        <input type="hidden" name="" id="chargement" value="<?php echo img_url("spin.gif");?>" >
        <input type="hidden" name="" id="base_url" value="<?php echo base_url()."index.php"?>" >
        <input type="hidden" name="" id="menu-active" value="<?php echo (isset($menu_active))?$menu_active:null;?>" >
        <input type="hidden" name="" id="sous_menu-active" value="<?php echo (isset($sous_menu_active))?$sous_menu_active:null;?>" >
        <input type="hidden" name="" id="side_bar-active" value="<?php echo (isset($side_bar_active))?$side_bar_active:null;?>" >

        <div class="container-fluid">
                    <div class="row">
                    
                    <?php if(isset($sous_menu) && !empty($sous_menu)):?>
                        <div id="sous-menu" class="navbar navbar-expand-sm " style="width:100% !important;background-color:rgb(187, 8, 8) !important;border:solid 2px rgb(235, 148, 17) ;border-radius:3px !important;max-height:40px !important;">
                            <ul class="navbar-nav " >
                            <?php foreach($sous_menu as $tondro => $smenu):?>
                                <li class="nav-item ">
                                    <a href="#" style="color:white !important;" id="sous_menu-<?php echo $tondro;?>" class="nav-link icon-menu <?php echo (isset($sous_menu_active) && $sous_menu_active == $smenu)?"active":'';?> "><?php echo $smenu;?></a> 
                                </li>
                                <?php endforeach;?>
                                
                        </div>
                        <?php endif;?>
                    </div>
               
                
                    <div class="row" id="body-sans-sb" style="min-height:300px !important;width:100% !important;<?php echo (!empty($side_bar))?'display:none':''?>" >
                        <div style="background-color: rgba(82, 75, 75,0.06);border:solid 6px white !important;padding-top:0.1%;" class="col-sm-12 " > 
                            <div class="row" >
                                <div class="col-sm-12" style="margin-left:5px !important;color:rgba(82, 75, 75,0.7);">
                                    <p style="padding-bottom:0.2% !important;border-radius:5px;border-bottom:solid 2px rgba(82, 75, 75,0.5);"><span class="parcours-menu" style="border:solid 1px rgba(82, 75, 75,0.5);border-top-right-radius:3px;border-bottom-right-radius:3px;border-left:none;padding-right:6px;"><?php echo (isset($parcours["menu"]) && $parcours["menu"] != null)?$parcours["menu"]:"";?> </span><span class="parcours-sous_menu" style="border:solid 1px gray;border-top-right-radius:3px;border-bottom-right-radius:3px;border-left:none;padding-right:6px;"><?php echo (isset($parcours["sous_menu"]) && $parcours["sous_menu"] != null)?$parcours["sous_menu"]:"";?> </span><span class="parcours-side_bar" style="border:solid 1px gray;border-top-right-radius:3px;border-bottom-right-radius:3px;border-left:none;padding-right:6px;"><?php echo (isset($parcours["side_bar"]) && $parcours["side_bar"] != null)?$parcours["side_bar"]:"";?></span></p>

                                </div>
                            </div>
                            <div class="row" >
                                <div class="col-sm-8"></div>
                                <div class="col-sm-4 boutons" style="text-align:right;">
                                    <button style="<?php echo (isset($button_ajout))?"":'display:none;';?>" class="btn btn-sm btn-primary boutons1" id="btn-ajout-<?php echo (isset($button_ajout))?$button_ajout:'';?>"> <span class="fa fa-plus"></span>&nbsp;<span>Ajouter</span> </button>
                                    <button  style="<?php echo (isset($button_retour))?"":'display:none;';?>" class="btn btn-sm btn-secondary boutons2" id="btn-annuler-<?php echo (isset($button_retour))?$button_retour:'';?>"> &nbsp;<span>Retour</span> </button>
                                </div>
                            </div>
                            <div class="row" >
                                <div class="col-sm-12" style="padding:2px ;text-align:center;">
                                    <h4 class="titre_page"> <?php echo (isset($titre_page))?$titre_page:'Titre';?></h4>
                                </div>
                            </div>  
                            <div class="row" >
                                <div class="col-sm-12 content" >
                                    <?php echo (!isset($content) ||( isset($side_bar) && !empty($side_bar)))?'contenu sans side bar':$content;?>
                                  
                                </div>
                            </div>                    
            
                        </div>
                    </div>
                   
                    <div class="row" id="body-avec-sb" style="padding-left:0.1% !important;min-height:300px !important;<?php echo (empty($side_bar))?'display:none':''?>">
                        <div  class="col-sm-2" style="max-height:300px !important;padding:0px !important;background-color:rgba(235, 148, 17,0.25);border:solid 1px rgb(235, 148, 17);border-bottom-right-radius:6px;margin-top:0.25%;">
                            <ul id="side_bar" style="padding:0px !important;margin:0px !important;">
                                <?php  
                                if(isset($side_bar) && !empty($side_bar) && $side_bar != ""){
                                    echo $side_bar;
                                   } ?>
                            </ul>
                        </div>
                       
                        <div style="background-color: rgba(82, 75, 75,0.06);border:solid 6px white !important;padding-top:1%;" class="col-sm-10 ">
                            <div class="row" >
                                <div class="col-sm-12" style="margin-left:5px !important;color:rgba(82, 75, 75,0.7);">
                                    <p style="padding-bottom:0.2% !important;border-radius:5px;border-bottom:solid 2px rgba(82, 75, 75,0.5);"><span class="parcours-menu" style="border:solid 1px rgba(82, 75, 75,0.5);border-top-right-radius:3px;border-bottom-right-radius:3px;border-left:none;padding-right:6px;"><?php echo (isset($parcours["menu"]) && $parcours["menu"] != null)?$parcours["menu"]:"";?> </span><span class="parcours-sous_menu" style="border:solid 1px gray;border-top-right-radius:3px;border-bottom-right-radius:3px;border-left:none;padding-right:6px;"><?php echo (isset($parcours["sous_menu"]) && $parcours["sous_menu"] != null)?$parcours["sous_menu"]:"";?> </span><span class="parcours-side_bar" style="border:solid 1px gray;border-top-right-radius:3px;border-bottom-right-radius:3px;border-left:none;padding-right:6px;"><?php echo (isset($parcours["side_bar"]) && $parcours["side_bar"] != null)?$parcours["side_bar"]:"";?></span></p>
                                </div>
                            </div>
                            <div class="row" >
                                <div class="col-sm-8"></div>
                                <div class="col-sm-4 boutons" style="text-align:right;">
                                    <button style="<?php echo (isset($button_ajout))?"":'display:none;';?>" class="btn btn-sm btn-primary boutons1" id="btn-ajout-<?php echo (isset($button_ajout))?$button_ajout:'';?>"> <span class="fa fa-plus"></span>&nbsp;<span>Ajouter</span> </button>
                                    <button  style="<?php echo (isset($button_retour))?"":'display:none;';?>" class="btn btn-sm btn-secondary boutons2" id="btn-annuler-<?php echo (isset($button_retour))?$button_retour:'';?>"> &nbsp;<span>Retour</span> </button>

                                </div>
                            </div>
                            <div class="row" >
                                <div class="col-sm-12" style="padding:2px ;text-align:center;">
                                    <h4 class="titre_page" ><?php echo (isset($titre_page))?$titre_page:'Titre';?></h4>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-sm-12 content">
                                    <?php echo (!isset($content) ||( !isset($side_bar) && empty($side_bar)))?'Contenu avec side bar .':$content;?>
    
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="row" id='loader-1' style="min-height:300px !important;display:none;">
                        <div   class='col-sm-12' style='position:absolute;top:30% !important;left:41.5% !important;'> <img src='<?php echo img_url("spin.gif");?>' alt=''></div>
                    </div>

                    <div class="row">
                        <div class="col-sm-12" id="footer">
                                <p>&copy;<?php echo APP_TITLE;?> 2021</p>
                        </div>
                    </div>
                    
            
            </div>
        </div>
        <!-- Modal HTML embedded directly into document -->
        <div id="" class="modal" role="dialog"  aria-labelledby="modal-ajout-article"  data-backdrop="static" style="min-width:70% !important;">
            <div class="row" style="background-color:rgb(235, 148, 17);border:solid 2px rgb(187, 8, 8); color:white;border-radius:2%;padding:1% !important;">
                <div style="" id="titre-modal-"></div>
            </div>
            <div class="row" id="corps-modal-" style="padding:1% !important;">

            </div>
       
            <a style="display:none" href='#' style='text-decoration:none' rel='modal:close'>Close</a>
        </div>
        
        
        <!---------------------- Import des modals -------------->
        <?php
            if(isset($menu_active) && $menu_active == 'Articles'){
                require_once("modals/modal_articles.php");
            }
            if(isset($menu_active) && $menu_active == 'Stock'){
                require_once("modals/modal_stock.php");
            }
            ?>

            

            <!-- Modal parent -->
            <div id="stofac-modal" style="z-index:10000;" class="modal fade" role="dialog" aria-labelledby="modal-stofac"   data-backdrop="static">

            <div class="modal-dialog " style="max-width:85% !important;" role="document" id="articles-ajout-modal-size" >
                <div class="modal-content " id="">
                    <div class="modal-header" id ="modal-header-article" style="background-color:rgb(235, 148, 17); color:white;padding:1% !important;"> 
                        <div class="titre-modal" style="" id="titre-modal"></div>
                        <button type="button" class="close close-modal" data-dismiss="modal"><span aria-hidden="true">×</span><span class="sr-only">Close</span></button>
                    </div>
                    <div class="modal-body"  id = "corps-modal" >

                        <p>test modal</p>
                        
                    </div>    
                </div>
            </div>

            
            

             
    </body>
</html>
