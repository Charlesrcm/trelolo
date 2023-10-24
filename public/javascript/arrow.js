(function () {
  window.onload = function () {

    var projetParent = $('.projetParent');
    var i;

    /**
     * fonction d'écoute pour changer le sens de la flèche et replier la liste des projets sur une vue de téléphone
    */
    for (i = 1; i <= projetParent.length; i++) {
      let arrowContainer = $('#arrow' + [i])

      arrowContainer.on('click', function () {
        var section = $(this).parent().next()

        // gestion du slide du projetContainer
        if (section.hasClass("active")) {
          section.slideUp("slow")
          section.removeClass("active") // retire pour ne pas voir le block
          $(this).children().addClass("fa-flip-vertical");
          
        } else {
          $(this).children().removeClass("fa-flip-vertical");
          section.slideDown("slow")
          section.addClass("active"); // ajout lors de la vision du block
        }
      });
    }



    /**
     * fonction pour replier un projet pour une meilleure visibilité
     */
    var arrow_projet = $('.arrowProjet');

    for (let i = 0; i < arrow_projet.length; i++) {
      let element = $(arrow_projet[i]);
      
      element.on('click', function () {        
        
        if ($(this).hasClass('activate')) {

          $(this).parent().next().slideDown(); 
          $(this).removeClass('activate');
          $(this).removeClass("fa-flip-vertical");
        
        } else {

          $(this).parent().next().slideUp();
          $(this).addClass('activate');
          $(this).addClass("fa-flip-vertical");
        }        
        
      })

    }
  }
})()
