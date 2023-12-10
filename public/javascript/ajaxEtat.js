$('.floatingSelect').on('change', function () {
  let idEtat = $(this).val();
  let idTache = $(this).attr("tache");

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
          if(html.message){
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

const btn = document.querySelector('#button');
if (btn) {
  
  btn.addEventListener('click', function () {
    
    if(btn.className == "button--loading")
      btn.classList.remove('button--loading')
    else
      btn.classList.add('button--loading')
  })
}