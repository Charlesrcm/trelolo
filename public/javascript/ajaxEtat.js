$('.floatingSelect').on('change', function () {
  let idEtat = $(this).val();
  let idTache = $(this).attr("tache");
  
  // s'il s'agit de terminer
  if (idEtat === "3") {
    let tache = $('#tache' + idTache);
    
    let img = $(tache.next());

    let container = tache.parent();

    container.addClass('fadeOut');
    tache.addClass('animate');
    img.addClass('animate');

    
    setTimeout(() => {
      tache.removeClass('animate');
      img.removeClass('animate');
      container.removeClass('fadeOut');
      tache.remove();
    }, 5000);
  }



  if(idEtat && idTache){
    $.ajax({
      type: "POST",
      url: "/tache/modif",
      data: {
        idEtat: idEtat,
        idTache: idTache,
      },
      success: function (html) {
        
        if (html !== undefined) {
          if(html.message !== undefined){
            let alert = $('#Etatmessage');

            if (alert.css('display', 'none'))
              alert.css('display', 'block')

            alert.addClass("alert-success");
            alert.html(html.message);
                  
            $('.alert').fadeOut(5000, function () {
              alert.removeClass("alert-success");
            });
          } else {
            $('#modal_display').append(html);
          }
        }
      },
      error: function(xhr, status, error) {
        // Gérer les erreurs éventuelles
          console.error(xhr, status + " : " + error);
        }
    })
  }
})
