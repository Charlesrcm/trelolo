$('.floatingSelect').on('change', function () {
  var idEtat = $(this).val();
  var idTache = $(this).attr("tache");

  console.log("etat : "+idEtat, "tache : "+idTache);

  $.ajax({
    type: "POST",
    url: "/tache/modif",
    data: {
      idEtat: idEtat,
      idTache: idTache,
    },
    success: function (html, message) {
      let alert = $('#Etatmessage');

      alert.addClass("alert-success");
      alert.append(html.message);
            
      $('.alert').fadeOut(10000);
      setTimeout(function () {
        alert.removeClass("alert-success");        
      }, 11000)
    },
    error: function(xhr, status, error) {
      // Gérer les erreurs éventuelles
        console.error(xhr, status + " : " + error);
      }
  })
})



// if ($('.alert')) {
// $('.alert').fadeOut(10000); // fondu de l'alerte de 10sec

// Enlève la div alerte pour les prochaines
// setTimeout(function() {
//   $('.alert').remove();
// }, 5000);
// }