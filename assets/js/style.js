
function active_menu(menu,selecteur){
    menu = (menu == undefined)?"menu":menu;
    if(menu == "menu"){

    }else if(menu == "sous_menu" || menu =="side_bar"){
        selecteur.parent().parent().find(".active").removeClass("active");
        selecteur.addClass("active");
    }else if(menu =="side_bar_"){
        selecteur.parent().parent().find(".active").removeClass("active");
        selecteur.parent().addClass("active");
    }
}

function mampiasa_loader(niveau,sense){
    
    if(sense == 1){
        if(niveau == 1 || niveau == 2){
            $("#body-sans-sb").css("display","none");
            $("#body-avec-sb").css("display","none");
            $("#loader-1").css("display","block");
        }else if(niveau == 3){  
            /*$("#body-sans-sb").css("display","none");          
            $("#body-avec-sb").css("display","none");
            $("#loader-1").css("display","block");     */
            $("#body-sans-sb").css("display","none");
            $("#body-avec-sb").css("display","none");
            $("#loader-1").css("top","60%");
            $("#loader-1").css("display","block");       
        }
    }else if(sense == 2){
        if(niveau == 1){  
            $("#loader-1").css("display","none");         
            $("#body-avec-sb").show();
        }else if(niveau == 2){   
            $("#loader-1").css("display","none");          
            $("#body-sans-sb").show();
        } else if(niveau == 3){
            $("#loader-1").css("display","none"); 
            $("#loader-1").css("top","20%");         
            $("#body-avec-sb").show();
        }
    }
}
function ajout_content(titre, content, type, side_bar){
    if(type == "side_bar"){
        //$("#body-sans-sb").css("display","none");
       // $("#body-avec-sb").show();
        $("#body-avec-sb #side_bar").html(side_bar);           
        $("#body-avec-sb .content").html(content);
        $("#body-avec-sb .titre_page").html(titre);
   }else{
       
        //$("#body-avec-sb").css("display","none");
       // $("#body-sans-sb").show();                 
        $("#body-sans-sb .content").html(content);
        $("#body-sans-sb .titre_page").html(titre);
      
        }
 
}
function my_modal(titre , corps ,selecteur){
    selecteur = (selecteur == undefined)? null : selecteur;
    if( selecteur == null){
        
        $("#titre-modal").html(titre);
        $("#corps-modal").html(corps);
        $("#stofac-modal").modal();
    }else{
        selecteur.find(".titre-modal").html(titre);
        selecteur.modal();
    }
  /* $("#stofac-modal").modal({
        escapeClose: false,
        clickClose: false,
        showClose: true ,
        backdrop : false,
     
        });*/
    
    //$("#modal-btn").trigger("click");
}
function ajouter_bouton(position ,nom_boutons1 , nom_boutons2, id_boutons1 , id_boutons2 , type1, type2){
    pos = (position == undefined)?1:position;
    nom_b1 = (nom_boutons1 == undefined || nom_boutons1 == null)?"Ajouter":nom_boutons1;
    nom_b2 = (nom_boutons2 == undefined || nom_boutons2 == null)?"Retour":nom_boutons2;
    id_b1 = (id_boutons1 == undefined || id_boutons1 == null)?"btn-ajouter":id_boutons1;
    id_b2 = (id_boutons2 == undefined || id_boutons2 == null)?"btn-retour":id_boutons2;
    t1 = (type1 == undefined || type1 == null  )?"btn-primary":type1;
    t2 = (type2 == undefined || type2 == null  )?"btn-primary":type2;
    
    if(pos == 1){ 
        // bouton ajout ny resaka
        $(".boutons1").html(nom_b1);
        $(".boutons1").attr("id",id_b1);
        $(".boutons1").removeClass("btn-primary btn-secondary btn-success").addClass(t1);
        $(".boutons1").show();
        $(".boutons2").hide();
    }else if(pos == 2){
        $(".boutons2").html(nom_b2);
        $(".boutons2").attr("id",id_b2);
        $(".boutons2").removeClass("btn-danger btn-secondary btn-primary btn-default").addClass(t2);
        $(".boutons2").show();
        $(".boutons1").hide();
    }else if(pos == 3){           
        $(".boutons1").find("span").html(nom_b1);
        $(".boutons1").attr("id",id_b1);
        $(".boutons1").removeClass("btn-primary btn-secondary btn-success").addClass(t1);
        $(".boutons1").show();
        $(".boutons2").find("span").html(nom_b2);
        $(".boutons2").attr("id",id_b2);
        $(".boutons2").removeClass("btn-danger btn-secondary btn-primary btn-default").addClass(t2);
        $(".boutons2").show();
    }
}
    function parcours(menu, sous_menu, side_bar){
        sous_menu = (sous_menu == undefined)? "" : sous_menu;
        side_bar = (side_bar == undefined)? "" :side_bar;

        $(".parcours-menu").html(menu);
        $(".parcours-sous_menu").html(sous_menu);
        $(".parcours-side_bar").html(side_bar);
     
    }
