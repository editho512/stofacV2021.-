$(document).ready(function(){
    // ------LIEN----
    var id_region = null ;
    var id_province = null;
    var id_region = null;
    var id_entrepot = null ;
    var content = null;
    var off = null;
    var timer = null;
    var retour_meme_page = false;
    var old_mail1 = "";
    var old_mail2 = "";

    var url = {
        last : null ,
        parametre : $("#base_url").val() + "/Stock/Parametre/" ,
        ajouterProvince : $("#base_url").val() + "/Stock/Ajouter_province/" ,
        trouverProvince : $("#base_url").val() + "/Stock/Trouver_province/" ,
        modifierProvince : $("#base_url").val() + "/Stock/Modifier_province/" ,
        supprimerProvince : $("#base_url").val() + "/Stock/Supprimer_province/" ,
        listeRegion : $("#base_url").val() + "/Stock/Region/" ,
        ajouterRegion : $("#base_url").val() + "/Stock/Ajouter_region/" ,
        trouverRegion : $("#base_url").val() + "/Stock/Trouver_region/" ,
        modifierRegion : $("#base_url").val() + "/Stock/Modifier_region/" ,
        supprimerRegion : $("#base_url").val() + "/Stock/Supprimer_region/" ,
        listeDistrict : $("#base_url").val() + "/Stock/District/" ,
        ajouterDistrict : $("#base_url").val() + "/Stock/Ajouter_district/" ,
        trouverDistrict : $("#base_url").val() + "/Stock/Trouver_district/" ,
        modifierDistrict : $("#base_url").val() + "/Stock/Modifier_district/" ,
        supprimerDistrict : $("#base_url").val() + "/Stock/Supprimer_district/" ,
        listeEntrepot : $("#base_url").val() + "/Stock/Entrepot/" ,
        ajouterEntrepot : $("#base_url").val() + "/Stock/Ajouter_entrepot/" ,
        trouverEntrepot : $("#base_url").val() + "/Stock/Trouver_entrepot/" ,


    };

    // ------------------------ FONCTION LOCAL 

    function retour_a_meme_page(selecteur_bouton_actuel, selecteur_retour_normal , is_side_bar){
        let content = (is_side_bar == undefined || is_side_bar == false)? $("#body-sans-sb .content #pagination button ") : $("#body-avec-sb .content #pagination button ");
        $(".close-modal").trigger("click");
        if($("#modal-article").css("display") != "block"){             
           
            setTimeout(function(){
                if(url.last != null && off != null){  
                     retour_meme_page = true;
                        content.trigger("click");
                    } else{   
                        retour_meme_page = false;                 
                        selecteur_retour_normal.trigger("click");
                    } 
            },200);
        }else{
            selecteur_bouton_actuel.trigger("click");
        }
        
    }
    $(document).on("click", "#side_bar li",function(){
        off = null;
        url.last = null;
    })
    $(document).on("click", ".nav-link",function(){
        off = null;
        url.last = null;
    })
    function ajout_localisation ( content,select,action, _url, data , loha_message){        
        if(data.nom == null || data.nom == "") {
            $(".modal #ajout-"+content+"-accuse_de_reception").find(".alert-danger").html("Veuillez saisir un libellé du district s'il vous plait.").show().next().hide();
            $(".modal #ajout-"+content+"-accuse_de_reception").parent().show();
        }else{
            
            dataPost = data;          
            url_utiliser = _url.ajouter;
            message = loha_message+" a bien été ajoutée.";
            if(action == "modifier"){                
                url_utiliser = _url.modifier;
                message = loha_message+" a bien été modifiée.";
            }
            $.post(url_utiliser,dataPost).done(function(data){
               if(data == 1){      
                   $(".modal #ajout-"+content+"-accuse_de_reception").find(".alert-success").html(message).prev().hide().next().show();
                   $(".modal #ajout-"+content+"-nom").parent().parent().hide();
                    $(".modal #ajout-"+content+"-"+select).parent().parent().hide();      
                    $(".modal #ajout-"+content+"-accuse_de_reception").parent().show();          
                    $(".modal #btn-ajout-"+content+"-valider").hide();
                    $(".modal #btn-ajout-"+content+"-annuler").hide().next().show();          
               }
            });
        }

    }
    function remise_zero_entrepot_form(){
                    $("#entrepot-mail1-libelle").removeClass("is-valid").removeClass("is-invalid").val("");
                    $("#entrepot-telephone").removeClass("is-valid").removeClass("is-invalid").val("");
                    $("#entrepot-nom").removeClass("is-valid").removeClass("is-invalid").val("");
                    $("#entrepot-adresse1-libelle").removeClass("is-valid").removeClass("is-invalid").val("");
                    $("#entrepot-adresse2-libelle").removeClass("is-valid").removeClass("is-invalid").val("");
                    $("#entrepot-mail2-libelle").removeClass("is-valid").removeClass("is-invalid").val("");
                    $("#entrepot-district-libelle option:selected").val(0);
                    $("#entrepot-district-libelle ").change();
                    $("#entrepot-district-libelle-feedback").hide();
                   
    }


    $(document).on("click",".btn-modifier-entrepot",function(e){
        id_entrepot = $(this).parent().attr("data-id");
        action = $(this).attr("data-action");       
        $.post(url.trouverEntrepot,{ id : id_entrepot}).done(function(data){
            donnees = $.parseJSON(data);
            if(action == "consultation"){
                
                
            }else{
                old_mail1 = donnees[0].mail1;
                old_mail2 = donnees[0].mail2;
                my_modal("Modification d'un entrepot ",null,$("#modal-entrepot"));
                    $("#entrepot-mail1-libelle").val(donnees[0].mail1);
                    $("#entrepot-telephone").val(donnees[0].libelle_telephone);
                    $("#entrepot-nom").val(donnees[0].nom_entrepot);
                    $("#entrepot-adresse1-libelle").val(donnees[0].adresse_1);
                    $("#entrepot-adresse2-libelle").val(donnees[0].adresse_2);
                    $("#entrepot-mail2-libelle").val(donnees[0].mail2);
                    $("#entrepot-district-libelle").val(donnees[0].id_district);
                    $("#entrepot-district-libelle ").change();         
                $(".modal #btn-ajout-entrepot-valider").attr("data-action","modifier");
            }
        });
   });
    $(document).on("click","#btn-ajout-entrepot-fermer", function(e){
        retour_a_meme_page($(this),$("#sous_menu-entrepot"), true);
    });
    $(document).on("click","#btn-ajout-entrepot-annuler", function(e){
        remise_zero_entrepot_form();
        $(".close-modal").trigger("click");
    });

    $(document).on("click","#btn-ajout-entrepot-valider",function(e){        
        _nom_entrepot = $("#entrepot-nom").val();
        _telephone_entrepot = $("#entrepot-telephone").val();
        _mail1_entrepot = $("#entrepot-mail1-libelle").val();
        mail2_entrepot = $("#entrepot-mail2-libelle").val();
        _district_entrepot = $("#entrepot-district-libelle option:selected").val();
        _adresse1_entrepot = $("#entrepot-adresse1-libelle").val();
        adresse2_entrepot = $("#entrepot-adresse2-libelle").val();

        adresse_entrepot = $("#entrepot-adresse2-libelle").val();
        message = null;
        action = $(".modal #btn-ajout-entrepot-valider").attr("data-action");

        if(message == null){
            dataPost = { 
                nom : _nom_entrepot,
                telephone: _telephone_entrepot,                
                mail1 : _mail1_entrepot,
                adresse1 : _adresse1_entrepot,
                mail2 : mail2_entrepot,
                adresse2: adresse2_entrepot,
                id_district : _district_entrepot
            };
            message = "L'entrepôt a bien été ajouté.";
            if(action == "modifier"){
                dataPost.id_entrepot = id_entrepot;
                if(old_mail1 !="" && old_mail1 != _mail1_entrepot){
                    dataPost.old_mail1 = old_mail1;
                }
                if(old_mail2 !="" && old_mail2 != mail2_entrepot){
                    dataPost.old_mail2 = old_mail2;
                }
                message = "L'entrepôt a bien été modifié.";
            }
            
            $.post(url.ajouterEntrepot,dataPost).done(function(d){
                data = $.parseJSON(d);      
               
                if( data.mail1 == 1 ){
                   let message = "Le Mail 1 est invalide .";
                    $("#entrepot-mail1-libelle").addClass("is-invalid").next().html(message).show(); 
                } else {
                    $("#entrepot-mail1-libelle").removeClass("is-invalid").addClass("is-valid").next().hide();
                }
                if(data.telephone == 1){
                    let message = "Le telephone est invalide .";
                    $("#entrepot-telephone").addClass("is-invalid").next().html(message).show(); 
                }else {
                    $("#entrepot-telephone").removeClass("is-invalid").addClass("is-valid").next().hide();

                }
                if(data.nom == 1){
                    let message = "Le nom de l'entrepôt est invalide .";
                    $("#entrepot-nom").addClass("is-invalid").next().html(message).show();
                }else {
                    $("#entrepot-nom").removeClass("is-invalid").addClass("is-valid").next().hide();

                }
                if(data.district == 1){
                    let  message = "Le district selectionné est invalide.";
                    $("#entrepot-district-libelle-feedback").html(message).show();
                }else {
                    $("#entrepot-district-libelle-feedback").hide();
                }
                if(data.adresse1 == 1){
                    let message = "L'Adresse 1 est obligatoire de doit comporter au moins 4 caractères.";
                    $("#entrepot-adresse1-libelle").addClass("is-invalid").next().html(message).show();
                }else {
                    $("#entrepot-adresse1-libelle").removeClass("is-invalid").addClass("is-valid").next().hide();
                }
                if(data.adresse2 == 1){
                    let message = "L'Adresse 2 est obligatoire et doit comporter au moins 4 caractères.";
                    $("#entrepot-adresse2-libelle").addClass("is-invalid").next().html(message).show();
                }else if(data.adresse2 != undefined || adresse2_entrepot != ""){
                    $("#entrepot-adresse2-libelle").removeClass("is-invalid").addClass("is-valid").next().hide();
                }else {
                    $("#entrepot-adresse2-libelle").removeClass("is-invalid").removeClass("is-valid").next().hide();

                }
                if(data.mail2 == 1){
                    let message = "Le mail 2 est invalide.";
                    $("#entrepot-mail2-libelle").addClass("is-invalid").next().html(message).show(); 
                }else if(data.mail2 != undefined || mail2_entrepot != ""){
                    $("#entrepot-mail2-libelle").removeClass("is-invalid").addClass("is-valid").next().hide();

                }else{
                    $("#entrepot-mail2-libelle").removeClass("is-invalid").removeClass("is-valid").next().hide();

                }
                if(data.length ==  0){                   
                    
                    remise_zero_entrepot_form();
                    $("#entrepot-nom").parent().parent().parent().parent().hide().next().show();
                    $(".modal #ajout-entrepot-accuse_de_reception").find(".alert-success").html(message).prev().hide().next().show();
                    $(".modal #btn-ajout-entrepot-valider").hide();
                    $(".modal #btn-ajout-entrepot-annuler").hide().next().show();   
                    }
             
            });
        }
    });
    $(document).on("click","#sous_menu-entrepot",function(e){
        e.preventDefault();
        mampiasa_loader(1, 1);
        active_menu("sous_menu",$(this));
        $.post(url.listeEntrepot,{ ajax : true},dataType = "JSON" ).done(function(data){
            donnees = $.parseJSON(data);
            ajouter_bouton(1,"<span class='fa fa-plus' ></span>&nbsp;Ajouter", null,"btn-ajout-entrepot",null,"btn-primary",null);
            ajout_content(donnees.titre_page,donnees.content,"side_bar",donnees.side_bar); 
            parcours(donnees.parcours.menu, donnees.parcours.sous_menu, donnees.parcours.side_bar);       
            active_menu("side_bar",$("#stock-liste_entrepot"));
            mampiasa_loader(1, 2);            
        })
    })
    $(document).on("click","#stock-liste_entrepot",function(e){
        e.preventDefault();
        $("#sous_menu-entrepot").trigger("click");
    });

    $(document).on("click","#btn-ajout-entrepot",function(e){
        my_modal("Ajout d'un nouvel entrepôt ",null ,$("#modal-entrepot"));
    });

    // ----------------- DISTRICT----------------------
    
  
    $(document).on("click",".modal #btn-supprimer-district-valider",function(e){
        $.post(url.supprimerDistrict,{ id : id_district}).done(function(data){
            if(data == 1){
                $(".close-modal").trigger("click");
                $("#stock-district").trigger("click");
                //$("#liste-categorie-"+id_categorie).hide();
            }
        });
    });

    $(document).on("click",".btn-supprimer-district",function(e){
        id_district = $(this).parent().attr("data-id");
       let nom_district = $(this).parent().parent().parent().prev().prev().html();
       $("#modal-supprimer-district").children().next().attr("data-id",id_district);
       my_modal("Suppression d'un district ",$("#modal-supprimer-district").html());
       $(".modal #libelle-district").html(nom_district);
       
   });

    $(document).on("click",".btn-modifier-district",function(e){
        id_district = $(this).parent().attr("data-id");
        action = $(this).attr("data-action");       
        $.post(url.trouverDistrict,{ id : id_district}).done(function(data){
            donnees = $.parseJSON(data);
            if(action == "consultation"){
                /*
                my_modal("Consultation d'un catégorie",$("#modal-ajout-categorie").html());
                $(".modal #form-ajout-categorie-libelle").val(donnees[0].nom_categorie).attr("disabled",true);
                $(".modal #form-ajout-categorie-description").val(donnees[0].description_categorie).attr("disabled",true);
                $(".modal #btn-ajout-categorie-valider").css("display","none");
                $(".modal #btn-ajout-categorie-annuler").css("display","none");
                $(".modal #btn-ajout-categorie-fermer").show(); */
                
            }else{
                my_modal("Modification d'un district ",null,$("#modal-district"));
                $(".modal #ajout-district-nom").val(donnees[0].nom_district); 
                $(".modal #ajout-district-region").val(donnees[0].id_region);
                $(".modal #ajout-district-region").change();                  
                $(".modal #btn-ajout-district-valider").attr("data-action","modifier");
            }
        });
   });


    $(document).on("click","#modal-district #btn-ajout-district-annuler",function(e){
        $(".close-modal").trigger("click");
        $(".modal #ajout-district-nom").val("");  
        $(".modal #ajout-district-accuse_de_reception").parent().hide();               
        $(".modal #ajout-district-region").val(0);
        $(".modal #ajout-district-region").change();               
    });
    
    $(document).on("click","#btn-ajout-district-fermer", function(e){
        retour_a_meme_page($(this),$("#stock-district"), true);
    });
    
    $(document).on("click","#btn-ajout-district-valider",function(){
        nom = $("#ajout-district-nom").val();        
        let id_region = $("#ajout-district-region option:selected").val();
        action = $(this).attr("data-action");
        districtData = {            
            nom : nom,
            id_region : id_region
        } 
        if( action == "modifier"){
            districtData.id = id_district;
        }
        districtUrl = {
            ajouter : url.ajouterDistrict ,
            modifier : url.modifierDistrict
        }
          
        ajout_localisation("district", "region", action, districtUrl, districtData,"Le district");
        /*if(nom == null || nom == "") {
            $(".modal #ajout-district-accuse_de_reception").find(".alert-danger").html("Veuillez saisir un libellé du district s'il vous plait.").show().next().hide();
            $(".modal #ajout-district-accuse_de_reception").parent().show();
        }else{
            
            dataPost = {
                nom : nom ,
                id_region : id_region
            };
          
            url_utiliser = url.ajouterDistrict;
            message = "Le district a bien été ajoutée.";
            if(action == "modifier"){
                dataPost = {
                    id : id_district,
                    nom : nom ,
                    id_region : id_region
                };
                url_utiliser = url.modifierDistrict;
                message = "Le district a bien été modifiée.";
            }
            $.post(url_utiliser,dataPost).done(function(data){
               if(data == 1){      
                   $(".modal #ajout-district-accuse_de_reception").find(".alert-success").html(message).prev().hide().next().show();
                   $(".modal #ajout-district-nom").parent().parent().hide();
                    $(".modal #ajout-district-region").parent().parent().hide();      
                    $(".modal #ajout-district-accuse_de_reception").parent().show();          
                    $(".modal #btn-ajout-district-valider").hide();
                    $(".modal #btn-ajout-district-annuler").hide().next().show();          
               }
            });
        }*/

    });
    $(document).on("click","#btn-ajout-district",function(e){
        my_modal("Ajout d'un nouveau district ",null ,$("#modal-district"));
    });
    $(document).on("click", "#stock-district", function(e){
        e.preventDefault();
        mampiasa_loader(1, 1);
        active_menu("sous_menu",$(this));
        $.post(url.listeDistrict,null,dataType = "JSON" ).done(function(data){
            donnees = $.parseJSON(data);
            ajouter_bouton(1,"<span class='fa fa-plus' ></span>&nbsp;Ajouter", null,"btn-ajout-district",null,"btn-primary",null);
            ajout_content(donnees.titre_page,donnees.content,"side_bar",donnees.side_bar); 
            parcours(donnees.parcours.menu, donnees.parcours.sous_menu, donnees.parcours.side_bar);       
            mampiasa_loader(1, 2);            
        })
    }); 

     //-------------- Region --------------
    $(document).on("click",".modal #btn-supprimer-region-valider",function(e){
        $.post(url.supprimerRegion,{ id : id_region}).done(function(data){
            if(data == 1){
                $(".close-modal").trigger("click");
                $("#stock-region").trigger("click");
                //$("#liste-categorie-"+id_categorie).hide();
            }
        });
    });
    $(document).on("click",".btn-supprimer-region",function(e){
        id_region = $(this).parent().attr("data-id");
       let nom_region = $(this).parent().parent().parent().prev().prev().html();
       $("#modal-supprimer-region").children().next().attr("data-id",id_region);
       my_modal("Suppression d'une region",$("#modal-supprimer-region").html());
       $(".modal #libelle-region").html(nom_region);
       
   });
    $(document).on("click",".btn-modifier-region",function(e){
        id_region = $(this).parent().attr("data-id");
        action = $(this).attr("data-action");       
        $.post(url.trouverRegion,{ id : id_region}).done(function(data){
            donnees = $.parseJSON(data);
            if(action == "consultation"){
                /*
                my_modal("Consultation d'un catégorie",$("#modal-ajout-categorie").html());
                $(".modal #form-ajout-categorie-libelle").val(donnees[0].nom_categorie).attr("disabled",true);
                $(".modal #form-ajout-categorie-description").val(donnees[0].description_categorie).attr("disabled",true);
                $(".modal #btn-ajout-categorie-valider").css("display","none");
                $(".modal #btn-ajout-categorie-annuler").css("display","none");
                $(".modal #btn-ajout-categorie-fermer").show(); */
                
            }else{
                my_modal("Modification d'une region ",null,$("#modal-region"));
                $(".modal #ajout-region-nom").val(donnees[0].nom_region); 
                $(".modal #ajout-region-province").val(donnees[0].id_province);
                $(".modal #ajout-region-province").change();                  
                $(".modal #btn-ajout-region-valider").attr("data-action","modifier");
            }
        });
   });

   $(document).on("click","#btn-supprimer-region-annuler",function(){
        $(".close-modal").trigger("click");
   });
    $(document).on("click","#btn-ajout-region-fermer", function(e){
        retour_a_meme_page($(this),$("#stock-region"), true);
    });

    $(document).on("click","#btn-ajout-region-valider",function(){
        nom = $("#ajout-region-nom").val();        
        let id_province = $("#ajout-region-province option:selected").val();
        action = $(this).attr("data-action");
        regionData = {            
            nom : nom,
            id_province : id_province
        } 
        if( action == "modifier"){
            regionData.id = id_region;
        }
        regionUrl = {
            ajouter : url.ajouterRegion ,
            modifier : url.modifierRegion
        }
          
        ajout_localisation("region", "province", action, regionUrl, regionData,"La region");

       /* if(nom == null || nom == "") {
            $(".modal #ajout-region-accuse_de_reception").find(".alert-danger").html("Veuillez saisir un libellé de l'article s'il vous plait.").show().next().hide();
            $(".modal #ajout-region-accuse_de_reception").parent().show();
        }else{
            
            dataPost = {
                nom : nom ,
                id_province : id_province
            };
            url_utiliser = url.ajouterRegion;
            message = "La region a bien été ajoutée.";
            if(action == "modifier"){
                dataPost = {
                    id : id_region,
                    nom : nom ,
                    id_province : id_province
                };
                url_utiliser = url.modifierRegion;
                message = "La region bien été modifiée.";
            }
            $.post(url_utiliser,dataPost).done(function(data){
               if(data == 1){      
                   $(".modal #ajout-region-accuse_de_reception").find(".alert-success").html(message).prev().hide().next().show();
                   $(".modal #ajout-region-nom").parent().parent().hide();
                    $(".modal #ajout-region-province").parent().parent().hide();      
                    $(".modal #ajout-region-accuse_de_reception").parent().show();          
                    $(".modal #btn-ajout-region-valider").hide();
                    $(".modal #btn-ajout-region-annuler").hide().next().show();          
               }
            });
        }*/

    });
    $(document).on("click","#modal-region #btn-ajout-region-annuler",function(e){
        $(".close-modal").trigger("click");
        $(".modal #ajout-region-nom").val("");  
        $(".modal #ajout-region-accuse_de_reception").parent().hide();               
        $(".modal #ajout-region-province").val(0);
        $(".modal #ajout-region-province").change();               
    });
    $(document).on("click","#btn-ajout-region",function(e){
        my_modal("Ajout d'une nouvelle region ",null ,$("#modal-region"));
    });
    $(document).on("click", "#stock-region", function(e){
        e.preventDefault();
        mampiasa_loader(1, 1);
        active_menu("sous_menu",$(this));
        $.post(url.listeRegion,null,dataType = "JSON" ).done(function(data){
            donnees = $.parseJSON(data);
            ajouter_bouton(1,"<span class='fa fa-plus' ></span>&nbsp;Ajouter", null,"btn-ajout-region",null,"btn-primary",null);
            ajout_content(donnees.titre_page,donnees.content,"side_bar",donnees.side_bar); 
            parcours(donnees.parcours.menu, donnees.parcours.sous_menu, donnees.parcours.side_bar);       
            mampiasa_loader(1, 2);            
        })
    }); 

    //-------------- Province --------------

    $(document).on("click","#btn-supprimer-province-annuler",function(){
        $(".close-modal").trigger("click");
   });
    $(document).on("click", "#stock-province",function(e){
        e.preventDefault();
        $("#sous_menu-paremetre").trigger("click");
    });
    $(document).on("click",".modal #btn-supprimer-province-valider",function(e){
        $.post(url.supprimerProvince,{ id : id_province}).done(function(data){
            if(data == 1){
                $(".close-modal").trigger("click");
                $("#sous_menu-paremetre").trigger("click");
                //$("#liste-categorie-"+id_categorie).hide();
            }
        });
    });
    $(document).on("click",".btn-supprimer-province",function(e){
        id_province= $(this).parent().attr("data-id");
       let nom_province = $(this).parent().parent().parent().prev().prev().html();
       $("#modal-supprimer-province").children().next().attr("data-id",id_province);
       my_modal("Suppression d'un province",$("#modal-supprimer-province").html());
       $(".modal #libelle-province").html(nom_province);
       
   });
    $(document).on("click",".btn-modifier-province",function(e){
        id_province = $(this).parent().attr("data-id");
        action = $(this).attr("data-action");       
        $.post(url.trouverProvince,{ id : id_province}).done(function(data){
            donnees = $.parseJSON(data);
            if(action == "consultation"){
                /*
                my_modal("Consultation d'un catégorie",$("#modal-ajout-categorie").html());
                $(".modal #form-ajout-categorie-libelle").val(donnees[0].nom_categorie).attr("disabled",true);
                $(".modal #form-ajout-categorie-description").val(donnees[0].description_categorie).attr("disabled",true);
                $(".modal #btn-ajout-categorie-valider").css("display","none");
                $(".modal #btn-ajout-categorie-annuler").css("display","none");
                $(".modal #btn-ajout-categorie-fermer").show(); */
                
            }else{
                my_modal("Modification d'un province ",null,$("#modal-province"));
                $(".modal #ajout-province-nom").val(donnees[0].nom_province);                
                $(".modal #btn-ajout-province-valider").attr("data-action","modifier");
            }
        });
   });
    $(document).on("click","#btn-ajout-province-valider",function(){
        nom = $("#ajout-province-nom").val();        
        id_pays = $("#ajout-province-pays option:selected").val();
        action = $(this).attr("data-action");
        if(nom == null || nom == "") {
            $(".modal #ajout-province-accuse_de_reception").find(".alert-danger").html("Veuillez saisir un libellé de l'article s'il vous plait.").show().next().hide();
            $(".modal #ajout-province-accuse_de_reception").parent().show();
        }else{
            
            dataPost = {
                nom : nom ,
                pays : null
            };
            url_utiliser = url.ajouterProvince;
            message = "Le province a bien été ajouté.";
            if(action == "modifier"){
                dataPost = {
                    id : id_province,
                    nom : nom ,
                    pays : null
                };
                url_utiliser = url.modifierProvince;
                message = "Le province a bien été modifié.";
            }
            $.post(url_utiliser,dataPost).done(function(data){
               if(data == 1){      
                   $(".modal #ajout-province-accuse_de_reception").find(".alert-success").html(message).prev().hide().next().show();
                   $(".modal #ajout-province-nom").parent().parent().hide();
                    $(".modal #ajout-province-pays").parent().parent().hide();      
                    $(".modal #ajout-province-accuse_de_reception").parent().show();          
                    $(".modal #btn-ajout-province-valider").hide();
                    $(".modal #btn-ajout-province-annuler").hide().next().show();          
               }
            });
        }

    });

    $(document).on("click","#btn-ajout-province-fermer", function(e){
        retour_a_meme_page($(this),$("#sous_menu-paremetre"), true);
    });

    $(document).on("click", "#sous_menu-paremetre", function(e){
        e.preventDefault();
        mampiasa_loader(1, 1);
        active_menu("sous_menu",$(this));
        $.post(url.parametre,null,dataType = "JSON" ).done(function(data){
            donnees = $.parseJSON(data);
            ajouter_bouton(1,"<span class='fa fa-plus' ></span>&nbsp;Ajouter", null,"btn-ajout-province",null,"btn-primary",null);
            ajout_content(donnees.titre_page,donnees.content,"side_bar",donnees.side_bar); 
            parcours(donnees.parcours.menu, donnees.parcours.sous_menu, donnees.parcours.side_bar);       
            mampiasa_loader(1, 2);            
        })
    }); 

    $(document).on("click","#btn-ajout-province",function(e){
        my_modal("Ajout d'un nouveau Province ",null ,$("#modal-province"));
    });
    $(document).on("click","#modal-province #btn-ajout-province-annuler",function(e){
        $(".close-modal").trigger("click");
        $(".modal #ajout-province-nom").val("");                
        $(".modal #ajout-province-accuse_de_reception").parent().hide();            
        $(".modal #ajout-article-province").val(0);
        $(".modal #ajout-article-province").change(); 
    });

    $(document).on("click","#pagination button ",function(e){
        e.preventDefault();
        content = $(this).parent().parent().parent();
        is_there_side_bar = content.parent().parent().parent().attr("id");
        niveau_loader = (is_there_side_bar == "body-avec-sb")? 1 : 2 ;
        off = ( retour_meme_page == true)? off : $(this).find("a").data("ci-pagination-page") ;        
        _url = ( retour_meme_page == true)? url.last : $(this).find("a").attr('href');        
        if(url != undefined){
            url.last = _url;
            // url.last = url;
            console.log(_url);
            Data = {
                off : (off == null)? 0 : off,
                ajax : true
            };  
            
            mampiasa_loader(niveau_loader,1);     
            $.post(_url,Data,dataType = "JSON" ).done(function(data){
                donnees = $.parseJSON(data);
                mampiasa_loader(niveau_loader,2);               
                content.html(donnees.content); 
                retour_meme_page = false;
                  
            })
       }    
    });
});