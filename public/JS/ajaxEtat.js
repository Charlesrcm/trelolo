(function () {
  window.onload = function () {

    $('select').on('change', function () {
      var idEtat = $(this).val();
      var idTache = $(this).attr("tache");

      $.ajax({
        type: "POST",
        url: "/tache/modif",
        data: {
          idEtat: idEtat,
          idTache: idTache,
        },
        success: function () {

          // recharger la page pour afficher le flash message
          setTimeout(function() {
            location.reload();
          }, 10);
        },
        error: function(xhr, status, error) {
          // Gérer les erreurs éventuelles
            console.error(status + " : " + error);
          }
      })
   })
  }


  if ($('.alert')) {
    $('.alert').fadeOut(10000); // fondu de l'alerte de 10sec

    // Enlève la div alerte pour les prochaines
    setTimeout(function() {
      $('.alert').remove();
    }, 5000);
  }
})()