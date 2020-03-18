$(document).ready(function()
{
    
// Mise en fonction des messages d'erreur
    function message_form(filtre, champ, messError)
    {
        var message = !filtre.test(champ) 
                    ? messError
                    : (filtreVide.test(champ) 
                        ? 'Renseignez le champs' 
                        : '');
        return message;
    }
    
    
// REGEX 
    var filtreVide = /^(\s*)?$/;
    var filtreText = /(^[\wéèêëûüîïôàçæœ\(\)\&\s\-\.\,\_\+\=\/\%€@\'\"\*\\`\!\?\;\[\]]*$)/i;
    var filtreAnnee = /(^(19|20){1}[0-9]{2}$)/;
    var filtreINT = /^[0-9]{1,4}$/;
    var filtrePrix = /(^[0-9]{1,10}\.[0-9]{2})/;
    var filtrePhoto = /(.(\.\w{1,5})?\.(png|tif|gif|jpg|jpeg|tiff))/;
    var filtreName = /(^[A-Zéèêëîïíôöòóœàáâäæç\-]+$)|(^(\s*)?$)/i;
    var filtreMail = /(^[\w\.-]+@[\w\.-]+\.[\w]{2,4}$)|(^(\s*)?$)/;
    
// Declaration des messages d'erreur
    var errChar = 'Vous utilisez des caractères interdits';
    var errAnn = 'Renseignez une année au format "2019"';
    var errPrix = 'Votre prix doit contenir les centimes (ex : 12.00 ou 21.99)';
    var errPict = 'Format non pris en charge';
    var errArt = 'Renseignez un artiste';
    var errMail = 'Renseignez une adresse mail valide';
    var errCom_pwd = 'Votre mot de passe doit comporter un chiffre, une minuscule et une majuscule';
    var errPwd = 'Vos mots de passe ne correspondent pas';

 /////////////////////////////////////////////////////////////////////////////////
    
// AJOUT D'UN ARTISTE      
    if($('#Artist_Add'))
    {
        $('#sendArt').click(function (event)
        {
            // Recuperaiton valeur 
            var newArt = $('#Artist_Add').val().trim();
            // Verification envoie
            var send_art = (!filtreText.test(newArt) || filtreVide.test(newArt)) ? false : true;
            
            if (send_art)
                document.forms[0].submit();
            else
            {
                event.preventDefault();
                // Recuperation message d'erreur
                var erreur = message_form(filtreText, newArt, errChar);
                   
               // Affichage message d'erreur
               $('#erreurArtist').html(erreur);
            }
        });
    }
/////////////////////////////////////////////////////////////////////////////////    
    
// MODIFICATION CD - Hors Image
    if($('#edit_cd'))
    {
        $('#edit_cd').click(function (event)
        {
             // Recuperation des valeur 
            var upTitle = $('#upTitre').val().trim();
            var upArt_id = $('#selectArtiste').val().trim();
            var upYear = $('#upAnnee').val().trim();
            var upGenre = $('#upGenre').val().trim();
            var upLabel = $('#upLabel').val().trim();
            var upPrice = $('#upPrix').val().trim();
            
            // Gestion de l'envoie du formulaire
            var send_up = (!filtreText.test(upTitle) || filtreVide.test(upTitle)) ? false : true;
            send_up = (!filtreINT.test(upArt_id) || filtreVide.test(upArt_id)) ? false : send_up;
            send_up = (!filtreAnnee.test(upYear) || filtreVide.test(upYear)) ? false : send_up;
            send_up = (!filtreText.test(upGenre) || filtreVide.test(upGenre)) ? false : send_up;
            send_up = (!filtreText.test(upLabel) || filtreVide.test(upLabel)) ? false : send_up;
            send_up = (!filtrePrix.test(upPrice) || filtreVide.test(upPrice)) ? false : send_up;
            
            
            if (send_up)
                document.forms[0].submit();
            else 
            {
                event.preventDefault();
                
                // Récupération des erreurs 
                var tabErreur_up = [];
                tabErreur_up['Title'] = message_form(filtreText, upTitle, errChar);
                tabErreur_up['Year'] = message_form(filtreAnnee, upYear, errAnn);
                tabErreur_up['Genre'] = message_form(filtreText, upGenre, errChar);
                tabErreur_up['Label'] = message_form(filtreText, upLabel, errChar);
                tabErreur_up['Price'] = message_form(filtrePrix, upPrice, errPrix);
                
                // Affichage des messages d'erreur
               $('#errUpTitle').html(tabErreur_up['Title']);
               $('#errUpYear').html(tabErreur_up['Year']);
               $('#errUpGenre').html(tabErreur_up['Genre']);
               $('#errUpLabel').html(tabErreur_up['Label']);
               $('#errUpPrice').html(tabErreur_up['Price']);
            }
        });
    }
//////////////////////////////////////////////////////////////////////////////////

// Modification PHOTO 
    if($('#picture_up'))
    {
        $('#picture_up').click(function (event)
        {
            // Recuperaiton valeur 
            var newPicture = $('#valuePict').val().trim();

            // Verification envoie
            var send_pict = (!filtrePhoto.test(newPicture) || filtreVide.test(newPicture)) ? false : true;
            
            if (send_pict)
                document.forms[0].submit();
            else
            {
                event.preventDefault();
                // Recuperation message d'erreur
                var erreurPict = message_form(filtrePhoto, newPicture, errPict);
                   
               // Affichage message d'erreur
               $('#errUpPict').html(erreurPict);
            }
        });
    }  
//////////////////////////////////////////////////////////////////////////////////

// AJOUT CD + IMAGE
    if($('#add_cd'))
    {
        $('#add_cd').click(function (event)
        {
             // Recuperation des valeur 
            var addTitle = $('#upTitre').val().trim();
            var addArt_id = $('#selectArtiste').val();
            var addYear = $('#upAnnee').val().trim();
            var addGenre = $('#upGenre').val().trim();
            var addLabel = $('#upLabel').val().trim();
            var addPrice = $('#upPrix').val().trim();
            var addPicture = $('#valuePict').val().trim();
            
            // Gestion de l'envoie du formulaire
            var send_add = (!filtreText.test(addTitle) || filtreVide.test(addTitle)) ? false : true;
            send_add = (!filtreINT.test(addArt_id) || filtreVide.test(addArt_id)) ? false : send_add;
            send_add = (!filtreAnnee.test(addYear) || filtreVide.test(addYear)) ? false : send_add;
            send_add = (!filtreText.test(addGenre) || filtreVide.test(addGenre)) ? false : send_add;
            send_add = (!filtreText.test(addLabel) || filtreVide.test(addLabel)) ? false : send_add;
            send_add = (!filtrePrix.test(addPrice) || filtreVide.test(addPrice)) ? false : send_add;
            send_add = (!filtrePhoto.test(addPicture) || filtreVide.test(addPicture)) ? false : send_add;
            
            
            if (send_add)
                document.forms[0].submit();
            else 
            {
                event.preventDefault();
                
                // Récupération des erreurs 
                var tabErreur_add = [];
                tabErreur_add['Title'] = message_form(filtreText, addTitle, errChar);
                tabErreur_add['Year'] = message_form(filtreAnnee, addYear, errAnn);
                tabErreur_add['Genre'] = message_form(filtreText, addGenre, errChar);
                tabErreur_add['Label'] = message_form(filtreText, addLabel, errChar);
                tabErreur_add['Price'] = message_form(filtrePrix, addPrice, errPrix);
                tabErreur_add['Picture'] = message_form(filtrePhoto, addPicture, errPict);
                tabErreur_add['Artiste'] = message_form(filtreINT, addArt_id, errArt);
                
                // Affichage des messages d'erreur
               $('#errAddTitle').html(tabErreur_add['Title']);
               $('#errAddArt').html(tabErreur_add['Artiste']);
               $('#errAddYear').html(tabErreur_add['Year']);
               $('#errAddGenre').html(tabErreur_add['Genre']);
               $('#errAddLabel').html(tabErreur_add['Label']);
               $('#errAddPrice').html(tabErreur_add['Price']);
               $('#errAddPict').html(tabErreur_add['Picture']);
            }
        });
    }
//////////////////////////////////////////////////////////////////////////////////

// NOUVEL UTILISATEUR 
    if($('#submit_newUser'))
    {
        $('#submit_newUser').click(function (event){
            // Recupération des valeurs
            var new_nom = $('#nameUser').val().trim();
            var new_prenom = $('#fisrtNameUser').val().trim();
            var new_email = $('#mailUser').val().trim();
            var new_pseudo = $('#nickName').val().trim();
            var new_mdp1 = $('#mdp_one').val().trim();
            var new_mdp2 = $('#mdp_conf').val().trim();
            var accept_form = $('#accept').prop("checked");
            
            // Recuperation des messages d'erreurs
            var send_new = (!filtreName.test(new_nom) || filtreVide.test(new_nom)) ? false : true;
            send_new = (!filtreName.test(new_prenom) || filtreVide.test(new_prenom)) ? false : send_new;
            send_new = (!filtreMail.test(new_email) || filtreVide.test(new_email)) ? false : send_new;
            send_new = (!filtreText.test(new_pseudo) || filtreVide.test(new_pseudo)) ? false : send_new;
            send_new = accept_form !== true ? false : send_new;
            
            // Complexité mdp 
            var fltInt = /[0-9]/;
            var fltMin = /[a-z]/;
            var fltMaj = /[A-Z]/;
            var res_flt = fltInt.test(new_mdp1) + fltMaj.test(new_mdp1) + fltMin.test(new_mdp1);
            send_new = res_flt !== 3 ? false : send_new;
            send_new = new_mdp1 !== new_mdp2 ? false : send_new;
            
            if(send_new)
                document.forms[0].submit();
            else
            {
                event.preventDefault();
                var tabErreur_new = [];
                tabErreur_new['name'] = message_form(filtreName, new_nom, errChar);
                tabErreur_new['ft_name'] = message_form(filtreName, new_prenom, errChar);
                tabErreur_new['mail'] = message_form(filtreMail, new_email, errMail);
                tabErreur_new['nk_name'] = message_form(filtreText, new_pseudo, errChar);
                // Accepte form
                tabErreur_new['accept'] = accept_form !== true ? 'Accepetez le traitement' : '';
                // mdp
                tabErreur_new['pwd'] = res_flt !== 3 
                                     ? errCom_pwd 
                                     : (new_mdp1 !== new_mdp2 
                                        ? errPwd 
                                        : '');

               // Affichage des erreurs
               $('#errNewName').html(tabErreur_new['name']);
               $('#errNewFtName').html(tabErreur_new['ft_name']);
               $('#errNewMail').html(tabErreur_new['mail']);
               $('#errNewPwd').html(tabErreur_new['pwd']);
               $('#errNkName').html(tabErreur_new['nk_name']);
               $('#errAccept').html(tabErreur_new['accept']);
            }
            
            
            
           
            
        });
    }
    
});

