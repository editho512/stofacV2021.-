</div>
<div style="border:solid 1px rgb(187, 8, 8) !important;border-radius:4px;padding:0.2% !important;" class="row">
    <table class=" table table-condensed table-bordered " style="margin-bottom:0px !important;">
            <thead style="border:solid 1px rgb(187, 8, 8);text-align:center;color:rgb(187, 8, 8);background-color:rgba(235, 148, 17,0.3);">      
                <th style="border:solid 1px rgb(187, 8, 8);text-align:center" class="col-sm-2" >Numero</th>     
                <th style="border:solid 1px rgb(187, 8, 8);text-align:center" class="col-sm-6" >Libellé</th>           
                <th style="border:solid 1px rgb(187, 8, 8);text-align:center;" class="col-sm-4">Actions</th>
            </thead>
            <tbody>
                <?php if(isset($liste_unite_mesure ) && !empty($liste_unite_mesure)){
                    foreach($liste_unite_mesure as $l_um):
                    ?>
                        <tr id="liste-categorie-<?php echo $l_um->id_unite_mesure;?>">
                            <td style="border:solid 1px rgb(187, 8, 8);text-align:center" class="col-sm-2"><?php echo $l_um->id_unite_mesure;?></td>
                            <td style="border:solid 1px rgb(187, 8, 8);text-align:center" class="col-sm-6 nom-categorie" ><?php echo $l_um->nom_unite_mesure."(".$l_um->description_unite_mesure.")";?></td>
                            <td style="border:solid 1px rgb(187, 8, 8);text-align:center;" class="col-sm-4" >
                                <div class="row">
                                    <div class="col-sm-2" style="text-align:right;">
                                    </div>
                                    <div data-id="<?php echo $l_um->id_unite_mesure;?>" class="col-sm-8" style="text-align:center;">
                                        <button data-action="consultation"  class='btn btn-info btn-modifier-unite_mesure '><span class="fa fa-tasks"  ></span></button>
                                        <button <?php echo ($l_um->id_art != null) ? "disabled":"";?> class="btn btn-danger btn-supprimer-unite_mesure"><span class="fa fa-trash" ></span></button>
                                        <button   data-action ="modifier" class='btn btn-primary btn-modifier-unite_mesure ' ><span class="fa fa-edit" ></span></button>
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
             $compteur = count($liste_unite_mesure);
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