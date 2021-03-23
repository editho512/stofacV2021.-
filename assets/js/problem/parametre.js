
$(document).ready(function(){
    var url = {
        setDep : $("#base_url").val()+ "/Parametre/setDepartement",
        updateNom : $("#base_url").val()+ "/Parametre/updateNomDepartement",
        setCat : $("#base_url").val()+ "/Parametre/setCategorie",
        updateNomCat : $("#base_url").val()+ "/Parametre/updateNomCategorie",
        updateNomUtil : $("#base_url").val()+ "/Parametre/updateNomUtilisateur",
        updateMdpUtil : $("#base_url").val()+ "/Parametre/updateMdpUtilisateur"
       
    };
    var fois_cat = 0;
    var fois_util = 0;
    var fois_util2 = 0;
    var charger = $("loader").attr("data-img");
    $(document).on("click","#valider-dep",function(){
        var nomDep = $("#nom-dep").val();
        var mdpDep = $("#mdp-dep").val();
        animationAjax("corps","loader",url.setDep,{nom:nomDep,mdp:mdpDep});
    });
    $(document).on("click",".parametre-nom",function(e){
        e.preventDefault();
        var id = $(this).parent().parent().find(".id-dep").html();
        var nom = $(this).parent().parent().find(".nom-dep-"+id).html();
        var body ="<div class='form-group' style='margin:1%'><label class= label-control'>Nom :</label><input type='text' placeholder='Nom' name='nom' value='"+nom+"' id='nom-dep-input' class=' form-control'></div>"
        var button = "<div class='col-sm-8 form-group width='50%' style='margin-left:50%'><button class='btn btn-sm btn-danger col-sm-4' style='margin:2%' ><a href='#' style='text-decoration:none;color:white' id='close-modal' rel='modal:close'>Annuler&nbsp;<i class='fa fa-times'></i></a></button><button  class='btn btn-sm btn-primary envoyer-modal col-sm-4' style='margin:2%' id='btn-modifier' data-id='"+id+"' >Envoyer&nbsp;<i class='fa fa-check'></i></button></div>";
        my_modal("Modification du nom du departement "+nom,body+button);
        $("#smmc-modal").modal({
            escapeClose: false,
            clickClose: false,
            showClose: false
            });
      
    });
    
    $(document).on("click","#nouveau-dep",function(){
        var loc = $("#new-dep").attr("href");
       
        window.location.href = loc;
        
    });
    $(document).on("click","#btn-modifier",function(){
        var id = $(this).attr("data-id");
        var nom = $("#nom-dep-input").val();
        datapost ={
            id_dep : id,
            nom : nom
        };
        $.post(url.updateNom,datapost).done(function(data){
            $("#close-modal").trigger("click");
            $(".nom-dep-"+id).html(data);
        });
        
    });
    $(document).on("click","#valide-cat",function(){
        
        var nom = $("#nom-cat").val();
        if(nom == "" || nom.length < 6){
            $("#erreurForm").html("Le nom du type de problème doit contenir au moins 6 lettres");
            $("#erreurForm").css("display","block");
        }else{

            datapost ={           
                nom : nom
            };
            $.post(url.setCat,datapost).done(function(data){
                var d = parseInt(data);
                if(d == 1){

                    window.location.href = $("#base_url").val()+ "/Parametre/listeCategorie";
                }else{
                    if(fois_cat == 0){

                        $("#body-cat").after("<div class='row' ><p class='alert alert-danger'>Le type de problème '"+nom+"' existe dèja!</p></div>");
                        fois_cat++;
                    }
                }
            });
        }
        
    });
    $(document).on("click",".parametre-nom-cat",function(e){
        e.preventDefault();
        var id = $(this).parent().parent().find(".id-cat").html();
        var nom = $(this).parent().parent().find(".nom-cat-"+id).html();
        var body ="<div class='form-group' style='margin:1%'><label class= label-control'>Nom :</label><input type='text' placeholder='Nom' name='nom' value='"+nom+"' id='nom-cat-input' class=' form-control'></div>"
        var button = "<div class='col-sm-8 form-group width='50%' style='margin-left:50%'><button class='btn btn-sm btn-danger col-sm-4' style='margin:2%' ><a href='#' style='text-decoration:none;color:white' id='close-modal' rel='modal:close'>Annuler&nbsp;<i class='fa fa-times'></i></a></button><button  class='btn btn-sm btn-primary valide-modal col-sm-4' style='margin:2%' id='btn-modifier-cat' data-id='"+id+"' >Valider&nbsp;<i class='fa fa-check'></i></button></div>";
        my_modal("Modification du nom du type de problème "+nom,body+button);
        $("#smmc-modal").modal({
            escapeClose: false,
            clickClose: false,
            showClose: false
            });
      
    });
    $(document).on("click","#btn-modifier-cat",function(){
        var id = $(this).attr("data-id");
        var nom = $("#nom-cat-input").val();
        datapost ={
            id_cat : id,
            nom : nom
        };
        $.post(url.updateNomCat,datapost).done(function(data){
            $("#close-modal").trigger("click");
            $(".nom-cat-"+id).html(data);
        });
        
    });

    $(document).on("click",".user-nom",function(e){
        e.preventDefault();
        var id = $(this).parent().parent().parent().parent().find(".id-util").html();
        var nom = $(this).parent().parent().parent().parent().find(".nom-util-"+id).html();
        var body ="<div class='form-group' style='margin:1%'><label class= label-control'>Nom :</label><input type='text' placeholder='Nom' name='nom' value='"+nom+"' id='nom-util-input' class=' form-control'></div>"
        var button = "<div class='col-sm-8 form-group width='50%' style='margin-left:50%'><button class='btn btn-sm btn-danger col-sm-4' style='margin:2%' ><a href='#' style='text-decoration:none;color:white' id='close-modal' rel='modal:close'>Annuler&nbsp;<i class='fa fa-times'></i></a></button><button  class='btn btn-sm btn-primary envoyer-modal col-sm-4' style='margin:2%' id='btn-modifier-util-nom' data-id='"+id+"' >Envoyer&nbsp;<i class='fa fa-check'></i></button></div>";
        my_modal("Modification du nom de l'utilisateur "+nom,body+button);
        $("#smmc-modal").modal({
            escapeClose: false,
            clickClose: false,
            showClose: false
            });
      
    });
    $(document).on("click","#btn-modifier-util-nom",function(){
        var id = $(this).attr("data-id");
        var nom = $("#nom-util-input").val();
        datapost ={
            id_util : id,
            nom : nom
        };
        $.post(url.updateNomUtil,datapost).done(function(data){
            $("#close-modal").trigger("click");
            $(".nom-util-"+id).html(data);
        });
        
    });
    
    $(document).on("click",".user-mdp",function(e){
        e.preventDefault();
        var id = $(this).parent().parent().parent().parent().find(".id-util").html();
        var nom = $(this).parent().parent().parent().parent().find(".nom-util-"+id).html();
        var body ="<div class='form-group' style='margin:1%' id='body-util-modal' ><label class= label-control'>Nouveau mots de passe :</label><input type='password' placeholder='Nouveau'   id='nmdp-util-input' class=' form-control'><label class= label-control'>Confirmation :</label><input type='password' placeholder='Confirmation'   id='cmdp-util-input' class=' form-control'><div id='erreur1'></div><div id='erreur2'></div></div>"
        var button = "<div class='col-sm-8 form-group width='50%' style='margin-left:50%'><button class='btn btn-sm btn-danger col-sm-4' style='margin:2%' ><a href='#' style='text-decoration:none;color:white' id='close-modal' rel='modal:close'>Annuler&nbsp;<i class='fa fa-times'></i></a></button><button  class='btn btn-sm btn-primary envoyer-modal col-sm-4' style='margin:2%' id='btn-modifier-util-mdp' data-id='"+id+"' >Envoyer&nbsp;<i class='fa fa-check'></i></button></div>";
        my_modal("Modification du mots de passe de l'utilisateur "+nom,body+button);
        $("#smmc-modal").modal({
            escapeClose: false,
            clickClose: false,
            showClose: false
            });
      
    });
    $(document).on("click","#btn-modifier-util-mdp",function(){
        
        var id = $(this).attr("data-id");
        var mdp = $("#nmdp-util-input").val();
        var cmdp = $("#cmdp-util-input").val();
        
        
        if(mdp == cmdp && mdp.length>6){
            
            datapost ={
                id_util : id,
                mdp : mdp
            };
            $.post(url.updateMdpUtil,datapost).done(function(data){
                $("#close-modal").trigger("click");
                
            });
        } if(mdp.length<6){
            $("#nmdp-util-input").val("");
            $("#cmdp-util-input").val("");
            //$("#erreur2").htlm("<p class='alert alert-danger'>Veuillez entrer un mots de passe contenant plus de 6 caractères </p>");
            $("#erreur2").html("<p class='alert alert-danger'>Veuillez entrer un mots de passe contenant plus de 6 caractères </p>");
                
        } if(mdp != cmdp){
            $("#erreur1").html("<p class='alert alert-danger'>Veuillez entrer le même mots de passe dans chaque champs de texte</p>");
            //$("#erreur1").html();
        }
        
    });
    $(document).on("click",".parametre-supp-cat",function(e){
        e.preventDefault();
        
        var id = $(this).parent().parent().find(".id-cat").html();
        var nom = $(this).parent().parent().find(".nom-cat-"+id).html();
        var url = $("#base_url").val()+ "/Parametre/deleteCategorie";
        var body ="<div class='row'> <p class='col-sm-12 alert alert-info ' style='margin:1%' >Vous voulez vraiment supprimer cette categorie avec tous les données qui y sont liés </p></div>";
        var button = "<div class='col-sm-8 form-group width='50%' style='margin-left:50%'><button class='btn btn-sm btn-danger col-sm-4' style='margin:2%' ><a href='#' style='text-decoration:none;color:white' id='close-modal' rel='modal:close'>Annuler&nbsp;<i class='fa fa-times'></i></a></button><button  class='btn btn-sm btn-primary envoyer-modal col-sm-4' style='margin:2%' id='parametre-supp' data-url='"+url+"' data-id='"+id+"' >Valider&nbsp;<i class='fa fa-check'></i></button></div>";
        my_modal("Suppression du categorie "+nom,body+button);
       
        
        $("#smmc-modal").modal({
            escapeClose: false,
            clickClose: false,
            showClose: false
            });
      
    });
    $(document).on("click",".parametre-supp-dep",function(e){
        e.preventDefault();
        var id = $(this).parent().parent().find(".id-dep").html();
        var nom = $(this).parent().parent().find(".nom-dep-"+id).html();
        var url = $("#base_url").val()+ "/Parametre/deleteDepartement";
        var body ="<div class='row'> <p class='col-sm-12 alert alert-info ' style='margin:1%' >Vous voulez vraiment dissoudre cette departement avec tous les données qui y sont liés </p></div>";
        var button = "<div class='col-sm-8 form-group width='50%' style='margin-left:50%'><button class='btn btn-sm btn-danger col-sm-4' style='margin:2%' ><a href='#' style='text-decoration:none;color:white' id='close-modal' rel='modal:close'>Annuler&nbsp;<i class='fa fa-times'></i></a></button><button  class='btn btn-sm btn-primary envoyer-modal col-sm-4' style='margin:2%' id='parametre-supp' data-url='"+url+"' data-id='"+id+"' >Valider&nbsp;<i class='fa fa-check'></i></button></div>";
        my_modal("Dissolution du departement "+nom,body+button);
       
        
        $("#smmc-modal").modal({
            escapeClose: false,
            clickClose: false,
            showClose: false
            });
      
    });

    $(document).on("click","#parametre-supp",function(){
       var id = $(this).attr("data-id");
       var url =  $(this).attr("data-url");
        $.post(url,{id : id}).done(function(data){
            $("#nom-"+id).parent().hide();
            $("#close-modal").trigger("click");
            
        });

    });
    $(document).on("click",".user-block",function(e){
        e.preventDefault();
        var id = $(this).parent().parent().parent().parent().find(".id-util").html();
        var url =  $("#base_url").val()+ "/Parametre/bloquer";
        var val =$(this).attr("data-val");
        $.post(url,{id : id,val : val}).done(function(data){
            window.location.href = $("#base_url").val()+"/Parametre/listeutilisateur";
        });
    });
    $


});
var animationAjax = function( container, loader, url, datapost = null  ){
         
    $( '#' + container ).html('');
    $( '#' + loader ).css('display','block');
   
       
    $.post( url, datapost ).done( function(result){
            setTimeout(function(){
               
                $( '#' + loader ).css('display','none');
                $( '#' + container ).html(result);
              },400);
   
    });
}
function my_modal(titre , corps ){
    $("#titre-modal").html(titre);
    $("#corps-modal").html(corps);
    //$("#modal-btn").trigger("click");
}