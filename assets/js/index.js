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
	