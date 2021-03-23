


<div style="border:solid 1px rgb(187, 8, 8) !important;border-radius:4px;padding:0.2% !important;" class="row">
    <table class=" table table-condensed table-bordered " style="margin-bottom:0px !important;">
            <thead style="border:solid 1px rgb(187, 8, 8);color:rgb(187, 8, 8);background-color:rgba(235, 148, 17,0.3);">      
                <th style="border:solid 1px rgb(187, 8, 8);text-align:center" class="col-sm-1" >Code</th>     
                <th style="border:solid 1px rgb(187, 8, 8);text-align:center" class="col-sm-2" >Libellé court</th> 
                <th style="border:solid 1px rgb(187, 8, 8);text-align:center;" class="col-sm-3" >Libellé long</th>  
                <th style="border:solid 1px rgb(187, 8, 8);text-align:center;" class="col-sm-3" >Catégorie</th> 
                <th style="border:solid 1px rgb(187, 8, 8);text-align:center;" class="col-sm-1" >Unité de mesure</th>            
                <th style="border:solid 1px rgb(187, 8, 8);text-align:center;text-align:center;" class="col-sm-2">Actions</th>
            </thead>
            <tbody>
                <?php if(isset($liste_articles ) && !empty($liste_articles)){
                    foreach($liste_articles as $l_art):
                    ?>
                        <tr id="liste-categorie-<?php echo $l_art->id_art;?>">
                            <td style="border:solid 1px rgb(187, 8, 8);text-align:center" class="col-sm-1"><?php echo $l_art->code_art;?></td>
                            <td style="border:solid 1px rgb(187, 8, 8);text-align:center" class="col-sm-2 libelle-article" ><?php echo $l_art->libcourt_art;?></td>
                            <td style="border:solid 1px rgb(187, 8, 8);text-align:center" class="col-sm-3 " ><?php echo $l_art->liblong_art;?></td>
                            <td style="border:solid 1px rgb(187, 8, 8);text-align:center" class="col-sm-3" ><?php echo $l_art->nom_categorie;?></td>
                            <td style="border:solid 1px rgb(187, 8, 8);text-align:center;" class="col-sm-1" ><?php echo $l_art->nom_unite_mesure;?></td>
                            <td style="border:solid 1px rgb(187, 8, 8);text-align:center;" class="col-sm-2" >
                                <div class="row">
                                    <div class="col-sm-2" style="text-align:right;">
                                    </div>
                                    <div data-id="<?php echo $l_art->id_art;?>" class="col-sm-8" style="text-align:center;">
                                        <button data-action="consultation"  class="btn btn-info btn-modifier-unite_mesure"><span class="fa fa-tasks"  ></span></button>
                                        <button class="btn btn-danger btn-supprimer-article"><span class="fa fa-trash" ></span></button>
                                        <button data-action ="modifier" class="btn btn-primary btn-modifier-article"><span class="fa fa-edit" ></span></button>
                                    </div>
                                    <div class="col-sm-2" style="text-align:left;">
                                    </div>
                                </div>
                            </td>
                        </tr>
                    <?php endforeach;
                    }
                    ?>
            </tbody>
    </table>
</div>
<div class="row" style="width:100%" >
        <div class="col-sm-9" id="reg-pagination-info">
               <?php
             $compteur = count($liste_articles);
             $debut = isset($page) ? $page+1 : 0;
             $debut= ($total_rows == 0)? 0 : $debut;
             $fin = $page + $compteur;
             $nbr = isset($total_rows) ? $total_rows : null;
                   echo  "Affichage de " .$debut ."  à " .$fin." sur ".$nbr." éléments";
                        ?>
        </div>
            
        <div class="col-sm-3" id="pagination">
            <?= $page_links?>
        </div>
</div>
<!-- Modal ajout article avec select donc mila complet -->

<div id="modal-article"   class="modal fade" role="dialog"  aria-labelledby="modal-article"  data-backdrop="static">
            <div class="modal-dialog " style="max-width:55% !important;" role="document" id="articles-ajout-modal-size" >
                <div class="modal-content " id="modal-content-ajout-article">
                    <div class="modal-header" id ="modal-header-article" style="background-color:rgb(235, 148, 17); color:white;padding:1% !important;"> 
                        <div class="titre-modal" id="titre-modal-"></div>
                        <button type="button" class="close close-modal" data-dismiss="modal"><span aria-hidden="true">×</span><span class="sr-only">Close</span></button>
                    </div>
                    <div class="modal-body"  style="font-size:0.9em !important;" id = "corps-modal-" >
                        <div id="modal-ajout-article"   class="col-sm-10" style="">
                            <div class="row" style="width:100% !important;">
                                <div class="col-sm-3" >
                                    <label for="libelle_court" >Libellé court :</label>
                                </div>
                                <div class="col-sm-8">
                                <input style="width:100% !important;" type="text" name="libelle_court" id="ajout-article-libelle_court"> 
                                </div>
                            </div>
                            <div class="row" style="width:100% !important;">
                                <div class="col-sm-3" >
                                    <label for="libelle_long">Libellé long :</label>
                                </div>
                                <div class="col-sm-8">
                                <textarea name="libelle_long" id="ajout-article-libelle_long" cols="20" rows="3"></textarea>
                                </div>
                            </div>
                            <div class="row" style="width:100% !important;">
                                <div class="col-sm-3"  >
                                    <label for="libelle_court">Catégorie :</label>
                                </div>
                                <div class="col-sm-8">
                                    <select style="width:100% !important;" class = "select-article" name="ajout-article-categorie" id="ajout-article-categorie">
                                            <option value=0>Catégorie</option>
                                        <?php foreach($select_categorie as $cat):?> 
                                            <option value="<?php echo $cat->id_categorie;?>"><?php echo $cat->nom_categorie;?></option>
                                        <?php endforeach;?>                     
                                    </select> 
                                </div>
                            </div>
                            <div class="row" style="width:100% !important;">
                                <div class="col-sm-3" >
                                    <label for="libelle_court">Unité de mesure :</label>
                                </div>
                                <div class="col-sm-8" id="form-ajout-article">
                                    <select class = "select-article " name="ajout-article-unite_mesure" style="width:100% !important;" id="ajout-article-unite_mesure">
                                            <option value=0>Unité de mesure</option>
                                        <?php foreach($select_unite_mesure as $um):?> 
                                                <option  value="<?php echo $um->id_unite_mesure;?>"><?php echo $um->nom_unite_mesure."(".$um->description_unite_mesure.")";?></option>
                                            <?php endforeach;?>   
                                    </select> 
                                </div>
                            </div>
                            <div class="row" style="width:100% !important;display:none;margin-top:1%;margin-bottom:1%;">
                                <div class="col-sm-2">                    
                                </div>
                                <div class="col-sm-8" id="ajout-article-accuse_de_reception">
                                    <p class="alert alert-danger" style="text-align:center;display:none;"></p>
                                    <p class="alert alert-success" style="text-align:center;display:none;"></p>
                                </div>
                                <div class="col-sm-2">                    
                                </div>
                            </div>
                            <div class="row" data-id="" style="width:100% !important;">
                                <div class="col-sm-8"></div>
                                <div class="col-sm-4">
                                    <button id="btn-ajout-article-valider" class="btn btn-sm btn-primary"><span class='fa fa-save' ></span>&nbsp; Valider </button>
                                    <button id="btn-ajout-article-annuler" class="btn btn-sm btn-danger"><span class='fa fa-remove' ></span>&nbsp;Annuler</button>
                                    <button id="btn-ajout-article-fermer" style="display:none;" class="btn btn-sm btn-danger"><span class="fa fa-remove"></span>&nbsp;Fermer</button>

                                </div>
                            </div>
                            
                        </div>

                    </div>    
                </div>
            </div>
        </div>
        <script>
                    
            $(document).ready(function(){
                $("select").select2();
            });
        </script>