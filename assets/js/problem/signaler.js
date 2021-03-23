$(document).ready(function(){
    
    var url = {
        signaler : $("#base_url").val()+ "/Problem/signaler",
        envoyer : $("#base_url").val()+ "/Problem/envoyer"
    };
    animationAjax("corps","loader",url.signaler);
    $(document).on("click","#envoyer",function(){
        var msg = getmessage();
        $('#erreur').html("");
        if(msg.titre == "" || msg.desc == ""){
            alert("ty");
            $( '#erreur' ).css('display','block');
            $('#erreur').html("<p>Les champs de texte Titre et Desciption sont obligatoires");
        }
        else if(msg.type == ""){
            $('#erreur').append("<p>Vous devez choisir un type de problème");
            $( '#erreur' ).css('display','block');
        }
        else if(msg.user == ""){
            $('#erreur').append("<p>Vous devez selectionner votre nom d'utilisateur ");
            $( '#erreur' ).css('display','block');
        }
        else{
            animationAjax("corps","loader",url.envoyer,msg);
            $("#acceuil").trigger("click");
        }
    });
    
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
var getmessage = function(){
    var message = {       
        user : $("#demandeur option:selected").val(),
        titre : $("#titre").val(),
        desc : $("#description").val(),
        type : $("#type option:selected").val()
    };
    return message;
}