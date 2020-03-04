// Nav bar -- Menu gauche
document.addEventListener('DOMContentLoaded', function() {
    var elems = document.querySelectorAll('.sidenav');
    var instances = M.Sidenav.init(elems);
  });
  
// SELECT
document.addEventListener('DOMContentLoaded', function() {
  var options = {
      classes: 'selectForLabel'
  }
  var elems = document.querySelectorAll('select');
  var instances = M.FormSelect.init(elems, options);
});

// Modal
document.addEventListener('DOMContentLoaded', function() {
    var elems = document.querySelectorAll('.modal');
    var instances = M.Modal.init(elems);
  });
  
// Retour Bouton - History Back
// Verification de la présence du bouton
if(document.getElementById('returnBtn'))
{
    document.getElementById('returnBtn').addEventListener('click', function(event)
    {
        window.history.back();
    });
}

// Photo dynamique ajout de photo : Evenement change sur le input type file
if(document.getElementById('id_image_load'))
{
    document.getElementById('file_pict').addEventListener('change', function (event){
        var input = document.getElementById('file_pict');
        if(input.files && input.files[0])
        {
            var reader = new FileReader();
            reader.onload = function (e){
                document.getElementById('id_image_load').setAttribute('src', e.target.result);
            };
            reader.readAsDataURL(input.files[0]);
        }
    });
}






