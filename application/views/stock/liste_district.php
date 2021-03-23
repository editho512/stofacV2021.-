<div style="border:solid 1px rgb(187, 8, 8) !important;border-radius:4px;padding:0.2% !important;" class="row">
    <table class=" table table-condensed table-bordered " style="margin-bottom:0px !important;">
            <thead style="border:solid 1px rgb(187, 8, 8);text-align:center;color:rgb(187, 8, 8);background-color:rgba(235, 148, 17,0.3);">      
                <th style="border:solid 1px rgb(187, 8, 8);text-align:center" class="col-sm-4" >district</th> 
                <th style="border:solid 1px rgb(187, 8, 8);text-align:center" class="col-sm-4" >Region</th>          
                <th style="border:solid 1px rgb(187, 8, 8);text-align:center;" class="col-sm-4">Actions</th>               
            </thead>
            <tbody>
                <?php if(isset($liste_district ) && !empty($liste_district)){
                    foreach($liste_district as $l_d):
                    ?>
                        <tr id="liste-categorie-<?php echo $l_d->id_district;?>">
                            <td style="border:solid 1px rgb(187, 8, 8);text-align:center" class="col-sm-4 nom_district"><?php echo $l_d->nom_district;?></td>
                            <td style="border:solid 1px rgb(187, 8, 8);text-align:center" class="col-sm-4 " ><?php  echo $l_d->nom_region;?></td>
                            <td style="border:solid 1px rgb(187, 8, 8);text-align:center;" class="col-sm-4" >
                                <div class="row">
                                    <div class="col-sm-2" style="text-align:right;">
                                    </div>
                                    <div data-id="<?php echo $l_d->id_district;?>" class="col-sm-8" style="text-align:center;">
                                        <button data-action="consultation"  class='btn btn-info btn-modifier-district '><span class="fa fa-tasks"  ></span></button>
                                        <button      class="btn btn-danger btn-supprimer-district"><span class="fa fa-trash" ></span></button>
                                        <button   data-action ="modifier" class='btn btn-primary btn-modifier-district ' ><span class="fa fa-edit" ></span></button>
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
             $compteur = count($liste_district);
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

 <!-- Modal ajout district avec select donc mila complet -->

 <div id="modal-district"   class="modal fade" role="dialog"  aria-labelledby="modal-district"  data-backdrop="static">
            <div class="modal-dialog " style="max-width:55% !important;" role="document" id="district-ajout-modal-size" >
                <div class="modal-content " id="modal-content-ajout-district">
                    <div class="modal-header" id ="modal-header-district" style="background-color:rgb(235, 148, 17); color:white;padding:1% !important;"> 
                        <div class="titre-modal" id="titre-modal-"></div>
                        <button type="button" class="close close-modal" data-dismiss="modal"><span aria-hidden="true">×</span><span class="sr-only">Close</span></button>
                    </div>
                    <div class="modal-body"  style="font-size:0.9em !important;" id = "corps-modal-" >
                        <div id="modal-ajout-district"   class="col-sm-10" style="">
                            <div class="row" style="width:100% !important;">
                                <div class="col-sm-3" >
                                    <label for="nom_district" >Nom :</label>
                                </div>
                                <div class="col-sm-8">
                                <input style="width:100% !important;" type="text" name="nom_district" id="ajout-district-nom"> 
                                </div>
                            </div>
                            
                            <div class="row" style="width:100% !important;">
                                <div class="col-sm-3" >
                                    <label for="ajout-district-region">Region :</label>
                                </div>
                                <div class="col-sm-8" id="form-ajout-province">
                                    <select  class = "select-region " name="ajout-district-region" style="width:100% !important;" id="ajout-district-region">
                                            <option value=0>Region (Province - Pays) </option>
                                            <?php foreach($liste_region as $l_r): ?>
                                            <option value=<?php echo $l_r->id_region;?>><?php echo $l_r->nom_region ." (".$l_r->nom_province." - Madagascar) ";?></option>
                                            <?php endforeach?>
                                         
                                    </select> 
                                </div>
                            </div>
                            <div class="row" style="width:100% !important;display:none;margin-top:1%;margin-bottom:1%;">
                                <div class="col-sm-2">                    
                                </div>
                                <div class="col-sm-8" id="ajout-district-accuse_de_reception">
                                    <p class="alert alert-danger" style="text-align:center;display:none;"></p>
                                    <p class="alert alert-success" style="text-align:center;display:none;"></p>
                                </div>
                                <div class="col-sm-2">                    
                                </div>
                            </div>
                            <div class="row" data-id="" style="width:100% !important;">
                                <div class="col-sm-8"></div>
                                <div class="col-sm-4">
                                    <button id="btn-ajout-district-valider" class="btn btn-sm btn-primary"><span class='fa fa-save' ></span>&nbsp; Valider </button>
                                    <button id="btn-ajout-district-annuler" class="btn btn-sm btn-danger"><span class='fa fa-remove' ></span>&nbsp;Annuler</button>
                                    <button id="btn-ajout-district-fermer" style="display:none;" class="btn btn-sm btn-danger"><span class="fa fa-remove"></span>&nbsp;Fermer</button>

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