<div style="border:solid 1px rgb(187, 8, 8) !important;border-radius:4px;padding:0.2% !important;" class="row">
    <table class=" table table-condensed table-bordered " style="margin-bottom:0px !important;">
            <thead style="border:solid 1px rgb(187, 8, 8);text-align:center;color:rgb(187, 8, 8);background-color:rgba(235, 148, 17,0.3);">      
                <th style="border:solid 1px rgb(187, 8, 8);text-align:center" class="col-sm-3" >Nom</th> 
                <th style="border:solid 1px rgb(187, 8, 8);text-align:center" class="col-sm-2" >district</th>  
                <th style="border:solid 1px rgb(187, 8, 8);text-align:center" class="col-sm-2" >Articles </th>
                <th style="border:solid 1px rgb(187, 8, 8);text-align:center;" class="col-sm-2">Adresse</th>   
                <th style="border:solid 1px rgb(187, 8, 8);text-align:center;" class="col-sm-3">Actions</th>             
            </thead>
            <tbody>
                <?php if(isset($liste_entrepot ) && !empty($liste_entrepot)){
                    foreach($liste_entrepot as $l_e):
                    ?>
                        <tr id="liste-categorie-<?php echo $l_e->id_entrepot;?>">
                            <td style="border:solid 1px rgb(187, 8, 8);text-align:center" class=" nom_entrepot"><?php echo $l_e->nom_entrepot;?></td>
                            <td style="border:solid 1px rgb(187, 8, 8);text-align:center" class=" " ><?php  echo $l_e->nom_district;?></td>
                            <td style="border:solid 1px rgb(187, 8, 8);text-align:center" class=" " >--</td>
                            <td style="border:solid 1px rgb(187, 8, 8);text-align:center" class=" " ><?php  echo $l_e->adresse_1;?></td>
                            <td style="border:solid 1px rgb(187, 8, 8);text-align:center;" class="" >
                                <div class="row">
                                    <div class="col-sm-2" style="text-align:right;">
                                    </div>
                                    <div data-id="<?php echo $l_e->id_entrepot;?>" class="col-sm-8" style="text-align:center;">
                                        <button data-action="consultation"  class='btn btn-info btn-modifier-entrepot '><span class="fa fa-tasks"  ></span></button>
                                        <button      class="btn btn-danger btn-supprimer-entrepot"><span class="fa fa-trash" ></span></button>
                                        <button   data-action ="modifier" class='btn btn-primary btn-modifier-entrepot ' ><span class="fa fa-edit" ></span></button>
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
             $compteur = count($liste_entrepot);
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

<!-- Modal ajout entrepôt avec select donc mila complet -->

<div id="modal-entrepot"   class="modal fade" role="dialog"  aria-labelledby="modal-entrepot"  data-backdrop="static">
            <div class="modal-dialog " style="max-width:90% !important;" role="document" id="entrepot-ajout-modal-size" >
                <div class="modal-content " id="modal-content-ajout-entrepot">
                    <div class="modal-header" id ="modal-header-entrepot" style="background-color:rgb(235, 148, 17); color:white;padding:1% !important;"> 
                        <div class="titre-modal" id="titre-modal-"></div>
                        <button type="button" class="close close-modal" data-dismiss="modal"><span aria-hidden="true">×</span><span class="sr-only">Close</span></button>
                    </div>
                    <div class="modal-body"  style="font-size:0.9em !important;" id = "corps-modal-" >
                        <div id="modal-ajout-entrepot"   class="col-sm-12" style="">
                            <div class="row" style="width:100% !important;">
                                <div class="col-md-6" style="border-bottom:solid 1px gray;margin-bottom:2px;">
                                    <div class="row">
                                        <b style="color:gray;border-bottom">Général :</b>                                       
                                    </div>
                                    <div class="row">
                                        <div class="col-sm-4">
                                            <label for="entrepot-nom">Nom (*) :</label>
                                        </div>
                                        <div class="col-sm-6">
                                            <input type="text" class="form-control " name="entrepot-nom" id="entrepot-nom">
                                            <div class="invalid-feedback"></div>
                                        </div>
                                    </div>
                                    <div class="row">
                                        <div class="col-sm-4">
                                            <label for="telephone-nom">Telephone (*) :</label>
                                        </div>
                                        <div class="col-sm-6">
                                            <input type="text" class="form-control "  name="entrepot-telephone" id="entrepot-telephone">
                                            <div class="invalid-feedback"></div>
                                        </div>
                                    </div>
                                    <div class="row">
                                        <div class="col-sm-4">
                                            <label for="entrepot-mail1-libelle">Mail 1 (*) :</label>
                                        </div>
                                        <div class="col-sm-6">
                                            <input type="text" class="form-control " name="entrepot-mail1-libelle" id="entrepot-mail1-libelle">
                                            <div class="invalid-feedback"></div>
                                        </div>
                                    </div>
                                    <div class="row">
                                        <div class="col-sm-4">
                                            <label for="entrepot-mail2-libelle">Mail 2 :</label>
                                        </div>
                                        <div class="col-sm-6">
                                            <input type="text" class="form-control " name="entrepot-mail2-libelle" id="entrepot-mail2-libelle">
                                            <div class="invalid-feedback"></div>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-md-6" style="border-bottom:solid 1px gray;margin-bottom:2px;">
                                    <div class="row">
                                        <b style="color:gray;border-bottom">Localisation :</b>                                       
                                    </div>
                                    <div class="row">
                                        <div class="col-sm-4">
                                            <label for="entrepot-district-libelle">District (*) :</label>
                                        </div>
                                        <div  class="col-sm-6">
                                            <select class=""  name="entrepot-district-libelle" id="entrepot-district-libelle">
                                                <option value=0>District - (Region - Province) </option>
                                                <?php if(isset($liste_district)){
                                                    foreach($liste_district as $l_d):
                                                ?>
                                                <option value=<?php echo $l_d->id_district?>><?php echo $l_d->nom_district?> - (<?php echo $l_d->nom_region;?> - <?php echo $l_d->nom_province;?>) </option>
                                                <?php endforeach; }?>
                                            </select>   
                                            <div id = "entrepot-district-libelle-feedback" class="invalid-feedback">Veillez sélectionner un district s'il vous plait.</div>                                     
                                        </div>
                                    </div>
                                    <div class="row">
                                        <div class="col-sm-4">
                                            <label for="entrepot-adresse1-libelle">Adresse 1 (*) :</label>
                                        </div>
                                        <div class="col-sm-6">
                                            <input type="text" class="form-control " name="entrepot-adresse1-libelle" id="entrepot-adresse1-libelle">
                                            <div class="invalid-feedback"></div>
                                        </div>
                                    </div>
                                    <div class="row">
                                        <div class="col-sm-4">
                                            <label for="entrepot-adresse2-libelle">Adresse 2 :</label>
                                        </div>
                                        <div class="col-sm-6">
                                            <input type="text" class="form-control " name="entrepot-adresse2-libelle" id="entrepot-adresse2-libelle">
                                            <div class="invalid-feedback"></div>
                                        </div>
                                    </div>
                                    
                                    
                                </div>
                                
                            </div>
                            <div class="row" style="width:100% !important;display:none;margin-top:1%;margin-bottom:1%;">
                                <div class="col-sm-2">                    
                                </div>
                                <div class="col-sm-8" id="ajout-entrepot-accuse_de_reception">
                                    <p class="alert alert-danger" style="text-align:center;display:none;"></p>
                                    <p class="alert alert-success" style="text-align:center;display:none;"></p>
                                </div>
                                <div class="col-sm-2">                    
                                </div>
                            </div>
                            <div class="row" data-id="" style="width:100% !important;">
                                <div class="col-sm-8"></div>
                                <div class="col-sm-4">
                                    <button id="btn-ajout-entrepot-valider" type="submit" class="btn btn-sm btn-primary"><span class='fa fa-save' ></span>&nbsp; Valider </button>
                                    <button id="btn-ajout-entrepot-annuler" class="btn btn-sm btn-danger"><span class='fa fa-remove' ></span>&nbsp;Annuler</button>
                                    <button id="btn-ajout-entrepot-fermer" style="display:none;" class="btn btn-sm btn-danger"><span class="fa fa-remove"></span>&nbsp;Fermer</button>

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
