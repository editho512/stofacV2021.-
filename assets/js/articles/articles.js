
$(document).ready(function(){
   /* ---------- LIEN -----------*/
   var timer = null;
   var id_categorie = null;
   var id_unite_mesure = null;
   var id_article = null;
   var content = null;
   var off = null;
   var retour_meme_page = false;
   var url= {
     last : null ,   
    parametre :  $("#base_url").val()+"/Articles/Parametres/" ,
    listeArticles: $("#base_url").val() + "/Articles/Articles/" ,
    ajouterCategorie: $("#base_url").val() + "/Articles/Ajouter_categorie/" ,
    supprimerCategorie: $("#base_url").val() + "/Articles/Supprimer_categorie/" ,
    trouverCategorie: $("#base_url").val() + "/Articles/Trouver_categorie/" ,
    modifierCategorie: $("#base_url").val() + "/Articles/Modifier_categorie/" ,
    listeUniteMesure: $("#base_url").val() + "/Articles/Unite_mesure/" ,
    ajouterUniteMesure: $("#base_url").val() + "/Articles/Ajouter_unite_mesure/" ,
    trouverUniteMesure: $("#base_url").val() + "/Articles/Trouver_unite_mesure/" ,
    modifierUniteMesure: $("#base_url").val() + "/Articles/Modifier_unite_mesure/" ,
    supprimerUniteMesure: $("#base_url").val() + "/Articles/Supprimer_unite_mesure/",
    ajouterArticle: $("#base_url").val() + "/Articles/Ajouter_article/" ,
    trouverArticle: $("#base_url").val() + "/Articles/Trouver_article/" ,
    modifierArticle: $("#base_url").val() + "/Articles/Modifier_article/",
    supprimerArticle: $("#base_url").val() + "/Articles/Supprimer_article/",
};

    // ------------------------ FONCTION LOCAL 

    function retour_a_meme_page(selecteur_bouton_actuel, selecteur_retour_normal , is_side_bar){
        let content = (is_side_bar == undefined || is_side_bar == false)? $("#body-sans-sb .content #pagination button ") : $("#body-avec-sb .content #pagination button ");
        $(".close-modal").trigger("click");
        clearTimeout(timer);
            if($("#modal-article").css("display") != "block"){ 
                
                if(url.last != null && off != null){  
                    retour_meme_page = true;
                    content.trigger("click");
                } else{                    
                    selecteur_retour_normal.trigger("click");
                } 
            }else{
                timer = setTimeout(function(){
                    selecteur_bouton_actuel.trigger("click");
                },200);
            }
    }
    //----------------------- Articles ----------------
    $(document).on("click",".modal #btn-supprimer-article-valider",function(e){
        $.post(url.supprimerArticle,{ id : id_article}).done(function(data){
            if(data == 1){

                $(".close-modal").trigger("click");
                $("#sous_menu-liste").trigger("click");
                //$("#liste-categorie-"+id_categorie).hide();
            }
        });
    });
    $(document).on("click","#btn-supprimer-aritcle-annuler",function(){
       
        $(".close-modal").trigger("click");
    });
    $(document).on("click",".btn-supprimer-article",function(e){
        id_article= $(this).parent().attr("data-id");
       let libcourt = $(this).parent().parent().parent().prev().prev().prev().prev().html();
       $("#modal-supprimer-article").children().next().attr("data-id",id_article);
       my_modal("Suppression d'un article",$("#modal-supprimer-article").html());
       $(".modal #libelle-article").html(libcourt);
       
   });

    $(document).on("click",".btn-modifier-article",function(e){
        id_article = $(this).parent().attr("data-id");
        action = $(this).attr("data-action");       
        $.post(url.trouverArticle,{ id : id_article}).done(function(data){
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
                my_modal("Modification d'un article ",null,$("#modal-article"));
                $(".modal #ajout-article-libelle_court").val(donnees[0].libcourt_art);
                $(".modal #ajout-article-libelle_long").val(donnees[0].liblong_art);
                $(".modal #ajout-article-categorie").val(donnees[0].id_categorie);
                $(".modal #ajout-article-categorie").change();
                $(".modal #ajout-article-unite_mesure").val(donnees[0].id_unite_mesure);
                $(".modal #ajout-article-unite_mesure").change();               
                $(".modal #btn-ajout-article-valider").attr("data-action","modifier");
            }
        });
   });

    $(document).on("click","#btn-ajout-article-valider",function(){
        libcourt = $("#ajout-article-libelle_court").val();
        liblong = $("#ajout-article-libelle_long").val();
        let id_categorie = $("#ajout-article-categorie option:selected").val();
        let id_unite_mesure = $("#ajout-article-unite_mesure option:selected").val();
        action = $(this).attr("data-action");
        if(libcourt == null || libcourt == "") {
            $(".modal #ajout-article-accuse_de_reception").find(".alert-danger").html("Veuillez saisir un libellé de l'article s'il vous plait.").show().next().hide();
            $(".modal #ajout-article-accuse_de_reception").parent().show();
        }else if(libcourt.length < 2){
            $(".modal #ajout-article-accuse_de_reception").find(".alert-danger").html("Veuillez saisir un libellé valide s'il vous plait.").show().next().hide();
            $(".modal #ajout-article-accuse_de_reception").parent().show();
        }else if(id_categorie == 0 || id_unite_mesure == 0 || id_categorie == "0" || id_unite_mesure == "0"){
            $(".modal #ajout-article-accuse_de_reception").find(".alert-danger").html("Veuillez bien choisir le catégorie et l'unité de mesure de l'article s'il vous plait.").show().next().hide();
            $(".modal #ajout-article-accuse_de_reception").parent().show();
        }else{
            
            dataPost = {
                libcourt : libcourt,
                liblong : liblong,
                id_categorie : id_categorie,
                id_unite_mesure : id_unite_mesure
            };
            url_utiliser = url.ajouterArticle;
            message = "L'article a bien été ajouté.";
            if(action == "modifier"){
                dataPost = {
                    id : id_article,
                    libcourt : libcourt,
                    liblong : liblong,
                    id_categorie : id_categorie,
                    id_unite_mesure : id_unite_mesure
                };
                url_utiliser = url.modifierArticle;
                message = "L'article a bien été modifié.";
            }
            $.post(url_utiliser,dataPost).done(function(data){
               if(data == 1){
                  
                $(".modal #ajout-article-accuse_de_reception").find(".alert-success").html(message).prev().hide().next().show();
                $(".modal #ajout-article-libelle_court").parent().parent().hide();
                $(".modal #ajout-article-libelle_long").parent().parent().hide();
                $(".modal #ajout-article-categorie").parent().parent().hide();
                $(".modal #ajout-article-unite_mesure").parent().parent().hide();                
                $(".modal #ajout-article-accuse_de_reception").parent().show();
                $(".modal #btn-ajout-article-valider").hide();
                $(".modal #btn-ajout-article-annuler").hide().next().show();
               
               }
            });
        }

    });
    $(document).on("click","#btn-ajout-article-fermer",function(){
       
        retour_a_meme_page($(this),$("#sous_menu-liste"));
    });
    $(document).on("click","#btn-ajout-article", function(e){
       
        my_modal("Ajout d'un nouveau article",null ,$("#modal-article"));
                
    });
    $(document).on("click","#modal-article #btn-ajout-article-annuler",function(e){
        $(".close-modal").trigger("click");
        $(".modal #ajout-article-libelle_court").val("");
                $(".modal #ajout-article-libelle_long").val("");
                $(".modal #ajout-article-categorie").val(0);
                $(".modal #ajout-article-categorie").change();
                $(".modal #ajout-article-unite_mesure").val(0);
                $(".modal #ajout-article-unite_mesure").change();
                $(".modal #ajout-article-accuse_de_reception").parent().hide();
    });
    //------------------------ PARAMETRE catégorie darticle -------------------------
    $(document).on("click","#sous_menu-parametre",function(e){
        e.preventDefault();
        mampiasa_loader(1, 1);
        active_menu("sous_menu",$(this));
        $.post(url.parametre,null,dataType = "JSON" ).done(function(data){
            donnees = $.parseJSON(data);
            ajouter_bouton(1,"<span class='fa fa-plus' ></span>&nbsp;Ajouter", null,"btn-ajout-categorie",null,"btn-primary",null);
            ajout_content(donnees.titre_page,donnees.content,"side_bar",donnees.side_bar); 
            parcours(donnees.parcours.menu, donnees.parcours.sous_menu, donnees.parcours.side_bar);       
            mampiasa_loader(1, 2);            
        })
    });
    $(document).on("click","#article-categorie",function(e){
        e.preventDefault();
        active_menu("side_bar",$(this));
        $("#sous_menu-parametre").trigger("click");

    });
    $(document).on("click","#sous_menu-liste",function(e){
        e.preventDefault();
        ajouter_bouton(1,"<span class='fa fa-plus' ></span>&nbsp;Ajouter", null,"btn-ajouter-article",null,"btn-primary");
        active_menu("sous_menu",$(this));        
        mampiasa_loader(2,1)
        $.post(url.listeArticles,{ajax : true},dataType = "JSON" ).done(function(data){
            donnees = $.parseJSON(data);
            ajout_content("Liste des articles :",donnees.content,null,null); 
            parcours(donnees.parcours.menu, donnees.parcours.sous_menu);
            mampiasa_loader(2,2)
        });

    });
    $(document).on("click","#btn-ajout-categorie",function(e){
        
       my_modal("Ajout d'un nouveau catégorie",$("#modal-ajout-categorie").html());
    });
    $(document).on("click","#btn-ajout-categorie-annuler",function(){
        $(".close-modal").trigger("click");
    });
    $(document).on("click","#btn-supprimer-categorie-annuler",function(){
        $(".close-modal").trigger("click");
    });
    $(document).on("click","#btn-ajout-categorie-valider",function(){
        libelle = $(".modal #form-ajout-categorie-libelle").val();
        description = $(".modal #form-ajout-categorie-description").val();
        action = $(this).attr("data-action");
        if(libelle == null || libelle == "") {
            $(".modal #form-ajout-categorie-accuse_de_reception").find(".alert-danger").html("Veuillez saisir un libellé s'il vous plait.").show().next().hide();
            $(".modal #form-ajout-categorie-accuse_de_reception").parent().show();
        }else if(libelle.length < 3){
            $(".modal #form-ajout-categorie-accuse_de_reception").find(".alert-danger").html("Veuillez saisir un libellé valide s'il vous plait.").show().next().hide();
            $(".modal #form-ajout-categorie-accuse_de_reception").parent().show();
        }else{
            dataPost = {
                libelle : libelle,
                description : description
            };
            url_utiliser = url.ajouterCategorie;
            message = "Le catégorie a bien été ajouté.";
            if(action == "modifier"){
                dataPost = {
                    id : id_categorie,
                    libelle : libelle,
                    description : description
                };
                url_utiliser = url.modifierCategorie;
                message = "Le catégorie a bien été modifié.";
            }
            $.post(url_utiliser,dataPost).done(function(data){
               if(data == 1){
                  
                $(".modal #form-ajout-categorie-accuse_de_reception").find(".alert-success").html(message).prev().hide().next().show();
                $(".modal #form-ajout-categorie-libelle").parent().parent().hide();
                $(".modal #form-ajout-categorie-description").parent().parent().hide();
                $(".modal #form-ajout-categorie-accuse_de_reception").parent().show();
                $(".modal #btn-ajout-categorie-valider").hide();
                $(".modal #btn-ajout-categorie-annuler").hide().next().show();
               
               }
            });
        }
    });
    $(document).on("click",".modal #btn-ajout-categorie-fermer",function(e){
        $(".close-modal").trigger("click");
        $("#sous_menu-parametre").trigger("click");
    });
    $(document).on("click",".btn-supprimer-categorie",function(e){
         id_categorie = $(this).parent().attr("data-id");
        nom_categorie = $(this).parent().parent().parent().prev().html();
        $("#modal-supprimer-categorie").children().next().attr("data-id",id_categorie);
        my_modal("Suppression d'un catégorie",$("#modal-supprimer-categorie").html());
        $(".modal #libelle-categorie").html(nom_categorie);
        
    });
    $(document).on("click",".btn-modifier-categorie",function(e){
        id_categorie = $(this).parent().attr("data-id");
        action = $(this).attr("data-action");       
        $.post(url.trouverCategorie,{ id : id_categorie}).done(function(data){
            donnees = $.parseJSON(data);
            if(action == "consultation"){
                my_modal("Consultation d'un catégorie",$("#modal-ajout-categorie").html());
                $(".modal #form-ajout-categorie-libelle").val(donnees[0].nom_categorie).attr("disabled",true);
                $(".modal #form-ajout-categorie-description").val(donnees[0].description_categorie).attr("disabled",true);
                $(".modal #btn-ajout-categorie-valider").css("display","none");
                $(".modal #btn-ajout-categorie-annuler").css("display","none");
                $(".modal #btn-ajout-categorie-fermer").show();
                
            }else{
                my_modal("Modification d'un catégorie",$("#modal-ajout-categorie").html());
                $(".modal #form-ajout-categorie-libelle").val(donnees[0].nom_categorie);
                $(".modal #form-ajout-categorie-description").val(donnees[0].description_categorie);
                $(".modal #btn-ajout-categorie-valider").attr("data-action","modifier");
            }
        });
   });
    $(document).on("click",".modal #btn-supprimer-categorie-valider",function(e){
        $.post(url.supprimerCategorie,{ id : id_categorie}).done(function(data){
            if(data == 1){

                $(".close-modal").trigger("click");
                $("#sous_menu-parametre").trigger("click");
                //$("#liste-categorie-"+id_categorie).hide();
            }
        });
    });
    // -------- PARAMETRE unité de mesure ----------
    $(document).on("click","#article-unite_mesure",function(e){
        e.preventDefault();
        active_menu("side_bar",$(this));
        mampiasa_loader(1, 1);
        active_menu("sous_menu",$(this));
        $.post(url.listeUniteMesure,null,dataType = "JSON" ).done(function(data){
            donnees = $.parseJSON(data);
            ajouter_bouton(1,"<span class='fa fa-plus' ></span>&nbsp;Ajouter", null,"btn-ajout-unite_mesure",null,"btn-primary",null);
            ajout_content(donnees.titre_page,donnees.content,"side_bar",donnees.side_bar); 
            parcours(donnees.parcours.menu, donnees.parcours.sous_menu, donnees.parcours.side_bar);       
            mampiasa_loader(1, 2);            
        })
    });
    $(document).on("click", "#btn-ajout-unite_mesure",function(e){
        my_modal("Ajout d'une nouvelle unité de mesure ",$("#modal-ajout-unite_mesure").html());
    });
    $(document).on("click","#btn-ajout-unite_mesure-valider",function(e){
        libelle = $(".modal #form-ajout-unite_mesure-libelle").val();
        description = $(".modal #form-ajout-unite_mesure-description").val();
        action = $(this).attr("data-action");
        if(libelle == null || libelle == "" || description == null || description == "") {
            $(".modal #form-ajout-unite_mesure-accuse_de_reception").find(".alert-danger").html("Veuillez saisir un acronyme avec une description s'il vous plait.").show().next().hide();
            $(".modal #form-ajout-unite_mesure-accuse_de_reception").parent().show();
        }else{
            dataPost = {
                libelle : libelle,
                description : description
            };
            url_utiliser = url.ajouterUniteMesure;
            message = "L'unité de mesure a bien été ajouté.";
            if(action == "modifier"){
                dataPost = {
                    id : id_unite_mesure,
                    libelle : libelle,
                    description : description
                };
                url_utiliser = url.modifierUniteMesure;
                message = "L'unité de mesure a bien été modifié.";
            }
            $.post(url_utiliser,dataPost).done(function(data){
               if(data == 1){
                  
                $(".modal #form-ajout-unite_mesure-accuse_de_reception").find(".alert-success").html(message).prev().hide().next().show();
                $(".modal #form-ajout-unite_mesure-libelle").parent().parent().hide();
                $(".modal #form-ajout-unite_mesure-description").parent().parent().hide();
                $(".modal #form-ajout-unite_mesure-accuse_de_reception").parent().show();
                $(".modal #btn-ajout-unite_mesure-valider").hide();
                $(".modal #btn-ajout-unite_mesure-annuler").hide().next().show();

               }
            });
        }
        
    });
    $(document).on("click","#btn-ajout-unite_mesure-annuler", function(e){
        $(".close-modal").trigger("click");

    });
    $(document).on("click",".modal #btn-ajout-unite_mesure-fermer",function(e){   
        /*    
        $(".close-modal").trigger("click");
        $("#article-unite_mesure").trigger("click"); */
        retour_a_meme_page($(this),$("#article-unite_mesure"),true);
    });

    $(document).on("click",".btn-modifier-unite_mesure",function(e){
        id_unite_mesure = $(this).parent().attr("data-id");
        action = $(this).attr("data-action");       
        $.post(url.trouverUniteMesure,{ id : id_unite_mesure}).done(function(data){
            donnees = $.parseJSON(data);
            if(action == "consultation"){
                my_modal("Consultation d'un unite de mesure",$("#modal-ajout-unite_mesure").html());
                $(".modal #form-ajout-unite_mesure-libelle").val(donnees[0].nom_unite_mesure).attr("disabled",true);
                $(".modal #form-ajout-unite_mesure-description").val(donnees[0].description_unite_mesure).attr("disabled",true);
                $(".modal #btn-ajout-unite_mesure-valider").css("display","none");
                $(".modal #btn-ajout-unite_mesure-annuler").css("display","none");
                $(".modal #btn-ajout-unite_mesure-fermer").show();
                
            }else{
                my_modal("Modification d'un unite de mesure",$("#modal-ajout-unite_mesure").html());
                $(".modal #form-ajout-unite_mesure-libelle").val(donnees[0].nom_unite_mesure);
                $(".modal #form-ajout-unite_mesure-description").val(donnees[0].description_unite_mesure);
                $(".modal #btn-ajout-unite_mesure-valider").attr("data-action","modifier");
            }
        });
   });
   $(document).on("click",".btn-supprimer-unite_mesure",function(e){
        id_unite_mesure= $(this).parent().attr("data-id");
        nom_unite_mesure = $(this).parent().parent().parent().prev().html();
        $("#modal-supprimer-categorie").children().next().attr("data-id",id_unite_mesure);
        my_modal("Suppression d'une unité de mesure",$("#modal-supprimer-unite_mesure").html());
        $(".modal #libelle-unite_mesure").html(nom_unite_mesure);
   
    });
    $(document).on("click","#btn-supprimer-unite_mesure-annuler",function(){
        $(".close-modal").trigger("click");
    });
    $(document).on("click",".modal #btn-supprimer-unite_mesure-valider",function(e){
        $.post(url.supprimerUniteMesure,{ id : id_unite_mesure}).done(function(data){
            if(data == 1){
                $(".close-modal").trigger("click");
                $("#article-unite_mesure").trigger("click");
            }
        });
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
                retour_meme_page = false;
                donnees = $.parseJSON(data);
                mampiasa_loader(niveau_loader,2);               
                content.html(donnees.content); 
                  
            })
       }    
    });
})



