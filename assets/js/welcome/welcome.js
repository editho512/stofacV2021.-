var username = "editho";
var timer;
var Data ={};
var body ="";
var myChart;
$(document).ready(function(){
    var url= {
        
        connecter :  $("#base_url").val()+"/Welcome/connecter/" ,
        listeProblem: $("#base_url").val() + "/Welcome/listeProblem/",
        listeErreur: $("#base_url").val() + "/Welcome/listErreur/",
        deconnecter : $("#base_url").val()+ "/Welcome/deconnection",
        last:          $("#base_url").val() + "/Welcome/listErreur/",
        getmessage: $("#base_url").val() + "/Welcome/getmessage/",
        setmessage: $("#base_url").val() + "/Welcome/setmessage/",
        gettdb : $("#base_url").val() + "/Welcome/tdbData/"
    };
    //---------------------- FUNCTION ---------------
    
    function form_notify(selecteur,type){
        type = (type == undefined)?1:0;
        if(type == 1){
            // 1 si l'operation est un succé.
            $(selecteur).removeClass("alert-danger");
            $(selecteur).addClass("alert-success");
        }else if(type == 0){
            // 0 si l'operation est un echec.
            $(selecteur).removeClass("alert-success");
            $(selecteur).addClass("alert-danger");           
        }
    }
    // ---------------------- CODE -------------------
    $(document).on("click","#log_id",function(e){
        e.preventDefault();       
        var user = $("#user").val();
        var mdp = $("#mdp").val();

        if(user ==""){          
            form_notify("#user",0);
        }else if(user !="" && mdp==""){
            form_notify("#user");
        }
       
        if(mdp==""){
            form_notify("#mdp",0);
        }else if(user =="" && mdp!=""){
            form_notify("#mdp");
        }

        if(user !="" && mdp!=""){
            var button = $(this);
             button.parent().parent().parent().parent().hide();
             $('#loader1').css("display","block");
            var dataPost ={               
                mdp:mdp,
                user:user
            };
            $.post(url.connecter,dataPost , dataType = "JSON").done(function(data){
                var res = $.parseJSON(data);
                $('#loader1').css("display","none");
                button.parent().parent().parent().parent().show();
                if(res.statuts == 0){
                    form_notify("#user",0);
                    form_notify("#mdp",0);
                    $("#connecter_notif p").html("Ce compte n'existe pas encore.").parent().css("display","block");
                }else if(res.statuts == 1){
                    $("body").html(res.message);   
                }else if(res.statuts == 2){
                    form_notify("#user");
                    form_notify("#mdp",0);
                    $("#connecter_notif p").html("Mots de passe incorret.").parent().css("display","block");
                }
                //alert(res.message);
            })
            //animationAjax("corps","loader",url.connecter,data,tempon);
 
        }
       
    });
    /*
    var tempon = $('#corps').html();
    var titre = $("#titrePage").html();
    $(".datepicker").datepicker({
        update : true,
        language: 'fr',
        autoclose: true,
        format: 'yyyy-mm-dd',
        orientation: "bottom"
    });
    $(document).on("click",".filtre-tdb",function(){
        var debut = ( $(this).html() == 'Tout')?"0":$("#date-debut").val();
        var fin = ( $(this).html() == 'Tout')?"0":$("#date-fin").val();
        if(debut == ""){
            $("#date-debut").addClass("is-invalid");
        }else if(fin == ""){
            $("#date-fin").addClass("is-invalid");
        }else if(debut>fin){
            $("#date-debut").addClass("is-invalid");
            $("#date-fin").addClass("is-invalid");
        }
        else{
            $("#date-debut").removeClass("is-invalid");
            $("#date-fin").removeClass("is-invalid");
            if($(this).html() != 'Tout'){
                $("#titre-plus").html(" Du "+debut+" au "+fin);
            }else{
                $("#titre-plus").html("");
                $("#date-debut").val("");
                $("#date-fin").val("");
            }
            debut +=" 00:00:00";
            fin +=" 00:00:00";
            myChart.destroy();
            var ctx = document.getElementById('myChart').getContext('2d');
             myChart = new Chart(ctx, {
            type: 'bar',
            
            data: {
                labels: [],
                datasets: [{
                    label: "Nombre d'erreur par departement",
                    data: [],
                    backgroundColor: [],
                    borderColor: [],
                    borderWidth: 1
                }]
            },
            options: {
                responsive: true,
                maintainAspectRatio : false,
                scales: {
                    yAxes: [{
                        ticks: {
                            beginAtZero: true
                        }
                    }]
                }
        
                }
            });
            var data = null;
            
            if( $(this).html() != 'Tout'){

                data ={debut : debut, fin : fin};
            }
        $.post(url.gettdb,data, dataType = "JSON").done(function(data){
            var res = $.parseJSON(data);
            $("#bilan-body").html("");
            addData(myChart,'Total ('+res['total']+')',res['total']);
            for(i = 0; i< res['data'].length ; i++){
                var val = res['data'][i].nb;
                var nom = res['data'][i].departement_nom;
                addData(myChart,nom+' ('+val+')',val);
                
            }
            for(i = 0; i< res['mode'].length ; i++){
                var total = res['total'];
                var val = res['mode'][i]['nb'];
                var nom = res['mode'][i]['departement_nom'];
                $("#bilan-body").prepend("<tr><td>"+nom+"</td><td>"+val+"</td><td>"+Math.round((100*val)/total)+"%</td></tr>");
            }
            $("#bilan-total").html(res['total']);
        });
        }
    });
   
    //$("#acceuil").css("color","yellow");
   // chargement liste:
   if(titre =="Tableau de bord"){
            var ctx = document.getElementById('myChart').getContext('2d');
             myChart = new Chart(ctx, {
            type: 'bar',
            
            data: {
                labels: [],
                datasets: [{
                    label: "Nombre d'erreur par departement",
                    data: [],
                    backgroundColor: [],
                    borderColor: [],
                    borderWidth: 1
                }]
            },
            options: {
                responsive: true,
                maintainAspectRatio : false,
                scales: {
                    yAxes: [{
                        ticks: {
                            beginAtZero: true
                        }
                    }]
                }
        
                }
            });
        $.post(url.gettdb,null, dataType = "JSON").done(function(data){
            var res = $.parseJSON(data);
            
            addData(myChart,'Total ('+res['total']+')',res['total']);
            for(i = 0; i< res['data'].length ; i++){
                var val = res['data'][i].nb;
                var nom = res['data'][i].departement_nom;
                addData(myChart,nom+' ('+val+')',val);
                
            }
            for(i = 0; i< res['mode'].length ; i++){
                var total = res['total'];
                var val = res['mode'][i]['nb'];
                var nom = res['mode'][i]['departement_nom'];
                $("#bilan-body").prepend("<tr><td>"+nom+"</td><td>"+val+"</td><td>"+Math.round((100*val)/total)+"%</td></tr>");
            }
            $("#bilan-total").html(res['total']);
        });
   }else  if(titre !="CONNEXION"){

    //animationAjax("table-list","loader",url.listeErreur);
    }
  
   

   $(document).on("click","#pagination a",function(e){

        e.preventDefault();
        off = $(this).data("ci-pagination-page") ;
        var url = $(this).attr('href');
        url.last = url;
        console.log(url);
        Data.off = off;
        animationAjax( "table-list","loader",url , Data );
    
    });
    
    $(document).on("click",".repondre",function(){
        var id = $(this).data("id_message");
        
        var titre = $(this).parent().parent().find(".titre").html();
        var date = $(this).parent().parent().find(".date").html();
        var departement = $(this).parent().parent().find(".departement").html();
        var auteur = $(this).parent().parent().find(".auteur").html();
        var id_auteur = $(this).parent().parent().find(".auteur").data("id_auteur");
        var problem = $(this).parent().parent().find(".description").html();
        var title = "<h3 style='text-align:center'>"+titre+" - "+departement+"</h3>";
        var corps= "<p>"+auteur+" du departement "+departement+" a signalé :"+"</p>";
        corps += "<br><div style='font-style: italic;width:70%' class='alert alert-success'> "+problem+".";
        corps +="<p style='font-size:70%'>envoyé le "+date+"</p></div>";
        var form = "<div class='col-sm-12 form-group'><label for='repondre' class='label-control'>Réponse :</label><input type='text' name='reponse' id='reponse-modal' class='form-control'></div>";
        var button = "<div class='col-sm-8 form-group width='50%' style='margin-left:50%'><button class='btn btn-sm btn-danger col-sm-4' style='margin:2%' ><a href='#' style='text-decoration:none;color:white' rel='modal:close'>Annuler&nbsp;<i class='fa fa-times'></i></a></button><button  class='btn btn-sm btn-primary envoyer-modal col-sm-4' style='margin:2%' id='btn-repondre' data-id_message ='"+id+"' data-id_auteur='"+id_auteur+"'>Envoyer&nbsp;<i class='fa fa-check'></button></div>";
        var button2 = "<div class='col-sm-8 form-group width='30%' style='margin-left:70%'><button class='btn btn-sm btn-danger col-sm-4' style='margin:2%' ><a href='#' style='text-decoration:none;color:white' rel='modal:close'>Fermer&nbsp;<i class='fa fa-times'></a></button></div> ";
        body = corps;
        dataPost = {
            id_message : id
        };
        $.post(url.getmessage,dataPost, dataType = "JSON").done(function(data){
        var res = $.parseJSON(data);
           if(res.length == 0){
              my_modal(title, corps+form+button);
              $("#smmc-modal").modal({
                escapeClose: false,
                clickClose: false,
                showClose: false
                });
           }else{
               corps += "<br><div style='font-style: italic;width:70%;margin-left:30%;text-align:right' class='alert alert-info'> "+res[0].reponse_contenue+".";
               corps +="<p style='font-size:70%'>envoyé le "+res[0].reponse_date+"</p></div>"+button2;

               my_modal(title, corps);
                $("#smmc-modal").modal({
                    escapeClose: false,
                    clickClose: false,
                    showClose: false
                });
           }
           //$("#modal-btn").trigger("click");
        });
    });

    $(document).on("click",".pas-repondu",function(){
        var titre = $(this).parent().parent().find(".titre").html(); 
        var title = "<h3 style='text-align:center'>"+titre+"</h3>";

        var corps = "<br><div style='font-style: italic;width:94%;text-align:center;margin:3%' class='alert alert-danger'><span class='fa fa-times'></span>&nbsp;En attente de réponse!</div>";
        var button2 = "<div class='col-sm-10 form-group width='30%' style='margin-left:70%'><button class='btn btn-sm btn-danger col-sm-4' style='margin:2%' ><a href='#' style='text-decoration:none;color:white' rel='modal:close'>Fermer&nbsp;<i class='fa fa-times'></a></button></div> ";

        my_modal(title, corps+button2);
    });
   
   $(document).on("click",".envoyer-modal",function(){
        var id_message = $(this).attr("data-id_message");
        var id_auteur = $(this).attr("data-id_auteur");
        var message = $("#reponse-modal").val();
        var dataPost = {
            id_message : id_message,
            id_auteur : id_auteur,
            message : message
        };
        
        $.post(url.setmessage,dataPost, dataType = "JSON").done(function(){
        var button = "<div class='col-sm-8 form-group width='30%' style='margin-left:70%'><button class='btn btn-sm btn-danger col-sm-4' style='margin:2%' ><a href='#' style='text-decoration:none;color:white' id='reload' rel='modal:close'>Fermer&nbsp;<i class='fa fa-times'></a></button></div> ";

           $("#corps-modal").html("<div style='margin:2%;width:100%' class='row' ><p class='col-sm-12 alert alert-success' >Votre message a été bien envoyé</p></div>"+button);
        });
        
   });
   $(document).on("click","#reload",function(e){
       e.preventDefault();
       window.location.href = $("#base_url").val()+"/Welcome/";
   });
    $(document).on("keyup","#tadiavo",function(){
       
        clearTimeout(timer);
        timer = setTimeout(function(){
            var tadiavo = $("#tadiavo").val().trim();
            Data.search = tadiavo;
            Data.off = '';
            animationAjax( "table-list","loader",url.last , Data );
        },400);
    });
    $(document).on("click","#btn-tadiavo",function(e){
        e.preventDefault();
        
    });
    $(document).on("change",".select-filtre",function(){
        var categorie = $("#filtre-categorie").val();
        var auteur = $("#filtre-auteur").val();
        var departement = $("#filtre-departement").val();
        Data.categorie = categorie;
        Data.auteur = auteur;
        Data.departement = departement;
        animationAjax( "table-list","loader",url.last , Data );
    });
*/

});
       var animationAjax = function( container, loader, url, datapost = null , tempon = null ){
         
           $( '#' + container ).html('');
           $( '#' + loader ).css('display','block');
           $( '#footer' ).css('display','none');
              
           $.post( url, datapost ).done( function(result){
               if(result == 0){
                   $( '#' + loader ).css('display','none');
                $( '#' + container ).html("");
                   setTimeout(function(){
                       $( '#' + container ).html(tempon);
                       $("#alert p").html($("#alert p").html()+"<p>Veuillez saisir des  informations correctes à propos de votre compte s'il vous plait</p>");
                       $("#alert").css("display","block");
                      
                   },300);
               }
               if(result == 1){
                window.location.href = $("#base_url").val()+"/Welcome/";
               // $("#acceuil").html(username);
                //$("#deconnection").remove();
               // $("#grand").append("<li><a id='deconnection' class='nav-link' style='color:white !important'  href='"+$("#base_url").val()+ "/Welcome/deconnection'>Se deconnecter</a></li>");
                  
               }
               else{
                setTimeout(function(){
                        $( '#' + loader ).css('display','none');
                        $( '#' + container ).html(result);
                    },200);
               }
               $( '#footer' ).css('display','block');
         
           });
       }
    function my_modal(titre , corps ){
        $("#titre-modal").html(titre);
        $("#corps-modal").html(corps);
        $("#modal-btn").trigger("click");
    }
    function addData(chart, label, data) {
        
        chart.data.labels.push(label);
        
        chart.data.datasets.forEach((dataset) => {
            dataset.data.push(data);
            dataset.backgroundColor.push(random_rgba());
        });
        
        chart.update();
    }

    function random_rgba() {
        var o = Math.round, r = Math.random, s = 255;
        return 'rgba(' + o(r()*s) + ',' + o(r()*s) + ',' + o(r()*s) + ',' +0.35 + ')';
    }
   