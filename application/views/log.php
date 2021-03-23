<doctype HTML>
<html>
    <head>
        <title><?php echo (isset($_SESSION['title']))?$this->session->title:APP_TITLE;?></title>
        <link rel="stylesheet" type="text/css" href="<?php echo css_url("bootstrap/bootstrap.min");?>">
        <link rel="stylesheet"  href="<?php echo css_url("font-awesome/css/font-awesome.min");?>">
        <link rel="stylesheet"  href="<?php echo css_url("select2/select2.min");?>">
        <link rel="stylesheet" type="text/css" href="<?php echo css_url("style");?>">
        <link rel="stylesheet" type="text/css" href="<?php echo css_url("jquery.modal");?>">
        <link rel="stylesheet" type="text/css" href="<?php echo css_url("font-awesome.min");?>">
        <link rel="stylesheet" type="text/css" href="<?php echo css_url("bootstrap-datepicker3.min");?>">
    <!-- <link href="https://stackpath.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min.css" rel="stylesheet" integrity="sha384-wvfXpqpZZVQGK6TAh5PVlGOfQNHSoD2xbE+QkPxCAFlNEevoEH3Sl0sibVcOQVnN" crossorigin="anonymous">-->
        <script src="<?php echo js_url("bootstrap/bootstrap.min"); ?>"></script>
        <script src="<?php echo js_url("jquery/jquery.min"); ?>"></script>
        <script src="<?php echo js_url("select2/select2.min"); ?>"></script>
        <script src="<?php echo js_url("jquery.modal"); ?>"></script>
        <script src="<?php echo js_url("Chart.min"); ?>"></script>
        <script src="<?php echo js_url("bootstrap-datepicker"); ?>"></script>
   
        <?php if(isset($require_js)):?>
            <?php foreach($require_js as $rjs):?>
                <script src="<?php echo js_url($rjs);?>"></script>
            <?php endforeach;?>
        <?php endif;?>
    </head>
    <body>                        
    <div id='loader1'  class='col-sm-12' style='position:absolute;top:20% !important;left:41.5% !important;display:none'> <img src='<?php echo img_url("spin.gif");?>' alt=''></div>
        <input type="hidden" name="" id="chargement" value="<?php echo img_url("giphy.gif");?>" >
        <input type="hidden" name="" id="base_url" value="<?php echo base_url()."index.php"?>" >
        <div class="row">
            <div class="col-sm-2"></div>
            <div class="col-sm-8" style="text-align:center;" >                              
                <h1 style="color:rgb(187, 8, 8);"><?php echo APP_TITLE;?></h1>  
                <h4 style="color: rgb(235, 148, 17);font-size:90%;">Logiciel de gestion de stock et facturation</h4>
            </div>
            <div class="col-sm-2"></div>
        </div>
        <div class="row" style="margin-top:1% !important;">
                <div class="col-sm-2">                   
                </div>   
                <div class="col-sm-8 " style="color:rgb(187, 8, 8) !important;background-color: rgba(235, 148, 17,0.5);border:solid 3px rgb(187, 8, 8);border-radius:5px !important;text-align:center !important;padding-top:1% !important;padding-bottom:1% !important;">
                    <div class="row">
                        <div class="col-sm-12" style="text-align:left !important;">
                            <div class="row">
                                <div class="col-sm-4">
                                    <label for="user">Utilisateur :</label>
                                </div>
                                <div class="col-sm-8">
                                    <input class="" style="min-width:90% !important;" type="text" name="user" id="user">
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-sm-4">
                                    <label for="password">Mots de passe :</label>
                                </div>
                                <div class="col-sm-8">
                                    <input class="" style="min-width:90% !important;" type="password" name="password" id="mdp">
                                </div>
                            </div>
                            
                        </div>
                    </div>  
                    <div class="row" style="margin-top:2% !important;">
                        <div class="col-sm-8"></div>
                        <div class="col-sm-4 " style="">
                            <input  id='log_id' type="button" value="Log in" class="btn btn-xs btn-primary">
                        </div>
                        
                    </div>              
                                
                    
                </div>  
                <div class="col-sm-2">
                    
                </div> 

        </div>
        <div class="row">
            <div class="col-sm-2"></div> 
            <div class="col-sm-8">
                <div class="row" style="padding-top:1% !important;">
                    <div class="col-sm-4"></div> 
                    <div class="col-sm-4">
                        <div id="connecter_notif" class="alert alert-danger" style="display:none;"><p style="text-align:CENTER;"></p></div>
                    </div> 
                    <div class="col-sm-4"></div> 
                </div>
                        
            </div> 
            <div class="col-sm-2"></div> 
        
        </div>
    </body>
</html>