    
        <!-- Ny modal ajout article dia any am views liste_articles.php satria misy select2 ka mila chargena ra tsy zay tsy mis à jour ny select ra asynchrone -->
        <!-- Modal formulaire de suppression  d'article --->

        <div id="modal-supprimer-article"  class="col-sm-12" style="display:none">
            <div class="row" style="width:100% !important;">
                <div class="col-sm-12">
                    <p class="alert alert-info">
                        Voulez-vous vraiment supprimer l'article " <span id="libelle-article"></span> " ?
                    </p>
                </div>
            </div>
            <div class="row" data-id="" style="width:100% !important;">
                <div class="col-sm-8"></div>
                <div class="col-sm-4">
                    <button id="btn-supprimer-article-valider" class="btn btn-sm btn-primary"><span class='fa fa-save' ></span>&nbsp; Valider </button>
                    <button id="btn-supprimer-aritcle-annuler" class="btn btn-sm btn-danger"><span class='fa fa-remove' ></span>&nbsp;Annuler</button>
                    
                </div>
            </div>
        </div>
        <!-- Link to open the modal -->
        <p style="display:none"><a id="modal-btn" href="#stofac-modal" rel="modal:open">Open Modal</a></p>

        <!-- Modal formulaire de suppression categorie d'article --->
        <div id="modal-supprimer-categorie"  class="col-sm-12" style="display:none">
            <div class="row" style="width:100% !important;">
                <div class="col-sm-12">
                    <p class="alert alert-info">
                        Voulez-vous vraiment supprimer le categorie " <span id="libelle-categorie"></span> " ?
                    </p>
                </div>
            </div>
            <div class="row" data-id="" style="width:100% !important;">
                <div class="col-sm-8"></div>
                <div class="col-sm-4">
                    <button id="btn-supprimer-categorie-valider" class="btn btn-sm btn-primary"><span class='fa fa-save' ></span>&nbsp; Valider </button>
                    <button id="btn-supprimer-categorie-annuler" class="btn btn-sm btn-danger"><span class='fa fa-remove' ></span>&nbsp;Annuler</button>
                    
                </div>
            </div>
        </div>

        <!-- Modal formulaire ajout, consultation et modification de categorie d'article --->
        <div id="modal-ajout-categorie" class="col-sm-12" style="display:none">
            <div class="row" style="width:100% !important;">
                <div class="col-sm-4">
                    <label for="libellé">Libellé (*):</label>
                </div>
                <div class="col-sm-8">
                    <input style="width:100% !important;" value="" type="text" placeholder="Libellé" name="libelle" class="form-ajout-categorie-libelle" id="form-ajout-categorie-libelle">
                </div>
            </div>
            <div class="row" style="width:100% !important;">
                <div class="col-sm-4">
                    <label for="libellé">Description :</label>
                </div>
                <div class="col-sm-8">
                    <textarea name="description" id="form-ajout-categorie-description" cols="30" rows="4"></textarea>
                </div>
            </div>
            <div class="row" style="width:100% !important;display:none;margin-top:1%;margin-bottom:1%;">
                <div class="col-sm-2">                    
                </div>
                <div class="col-sm-8" id="form-ajout-categorie-accuse_de_reception">
                    <p class="alert alert-danger" style="text-align:center;display:none;"></p>
                    <p class="alert alert-success" style="text-align:center;display:none;"></p>
                </div>
                <div class="col-sm-2">                    
                </div>
            </div>
            <div class="row" style="width:100% !important;text-align:right;"> 
                <div class="col-sm-7">
                   
                </div>
                <div class="col-sm-5" style="text-align:right;">
                   <button data-action="ajouter" id="btn-ajout-categorie-valider" class="btn btn-sm btn-primary"><span class="fa fa-save "></span>&nbsp;Valider</button>
                   <button id="btn-ajout-categorie-annuler" class="btn btn-sm btn-danger"><span class="fa fa-remove"></span>&nbsp;Annuler</button>
                   <button id="btn-ajout-categorie-fermer" style="display:none;" class="btn btn-sm btn-danger"><span class="fa fa-remove"></span>&nbsp;Fermer</button>

                </div>
            </div>
            
        </div>
        <!-- Modal formulaire ajout, consultation et modification d'unité de mesure  --->
        <div id="modal-ajout-unite_mesure" class="col-sm-12" style="display:none">
            <div class="row" style="width:100% !important;">
                <div class="col-sm-4">
                    <label for="libellé">Acronyme (*):</label>
                </div>
                <div class="col-sm-8">
                    <input style="width:100% !important;" value="" type="text" placeholder="Acronyme" name="libelle" class="form-ajout-unite_mesure-libelle" id="form-ajout-unite_mesure-libelle">
                </div>
            </div>
            <div class="row" style="width:100% !important;">
                <div class="col-sm-4">
                    <label for="libellé">Signification :</label>
                </div>
                <div class="col-sm-8">
                    <textarea name="description" id="form-ajout-unite_mesure-description" cols="30" rows="4"></textarea>
                </div>
            </div>
            <div class="row" style="width:100% !important;display:none;margin-top:1%;margin-bottom:1%;">
                <div class="col-sm-2">                    
                </div>
                <div class="col-sm-8" id="form-ajout-unite_mesure-accuse_de_reception">
                    <p class="alert alert-danger" style="text-align:center;display:none;"></p>
                    <p class="alert alert-success" style="text-align:center;display:none;"></p>
                </div>
                <div class="col-sm-2">                    
                </div>
            </div>
            <div class="row" style="width:100% !important;text-align:right;"> 
                <div class="col-sm-7">
                   
                </div>
                <div class="col-sm-5" style="text-align:right;">
                   <button data-action="ajouter" id="btn-ajout-unite_mesure-valider" class="btn btn-sm btn-primary"><span class="fa fa-save "></span>&nbsp;Valider</button>
                   <button id="btn-ajout-unite_mesure-annuler" class="btn btn-sm btn-danger"><span class="fa fa-remove"></span>&nbsp;Annuler</button>
                   <button id="btn-ajout-unite_mesure-fermer" style="display:none;" class="btn btn-sm btn-danger"><span class="fa fa-remove"></span>&nbsp;Fermer</button>

                </div>
            </div>
            
        </div>
        <!-- Modal suppression Unité de mesure --->
        <div id="modal-supprimer-unite_mesure"  class="col-sm-12" style="display:none">
            <div class="row" style="width:100% !important;">
                <div class="col-sm-12">
                    <p class="alert alert-info">
                        Voulez-vous vraiment supprimer l'unité de mesure " <span id="libelle-unite_mesure"></span> " ?
                    </p>
                </div>
            </div>
            <div class="row" data-id="" style="width:100% !important;">
                <div class="col-sm-8"></div>
                <div class="col-sm-4">
                    <button id="btn-supprimer-unite_mesure-valider" class="btn btn-sm btn-primary"><span class='fa fa-save' ></span>&nbsp; Valider </button>
                    <button id="btn-supprimer-unite_mesure-annuler" class="btn btn-sm btn-danger"><span class='fa fa-remove' ></span>&nbsp;Annuler</button>
                </div>
            </div>
        </div>

        <!-- Modal Ajout Articles --->
        
       
   