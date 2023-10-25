$('.floatingSelect').on('change', function () {
  var idEtat = $(this).val();
  var idTache = $(this).attr("tache");

  $.ajax({
    type: "POST",
    url: "/tache/modif",
    data: {
      idEtat: idEtat,
      idTache: idTache,
    },
    success: function (html) {
      let alert = $('#Etatmessage');

      if (alert.css('display', 'none'))
        alert.css('display', 'block')

      alert.addClass("alert-success");
      alert.html(html.message);
            
      $('.alert').fadeOut(5000, function () {
        alert.removeClass("alert-success");
      });
    },
    error: function(xhr, status, error) {
      // Gérer les erreurs éventuelles
        console.error(xhr, status + " : " + error);
      }
  })
})