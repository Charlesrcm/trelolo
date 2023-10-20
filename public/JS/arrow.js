const arrow_flip = " fa-flip-vertical";
var arrow = $('.fa');

/**
 * fonction d'écoute pour changer le sens de la flèche et replier les projets sur une vue de téléphone
*/

arrow.on('click', function () {
  var section = $(this).parent().parent().next()
    
  // gestion de l'affichage de la flèche
  if ($(this).hasClass("fa-flip-vertical"))
    $(this).removeClass("fa-flip-vertical");
  else $(this).addClass(arrow_flip);

  // gestion du slide du projetContainer
  if (section.hasClass("active")) {

    section.slideUp("slow")
    // projets.css("display", "none")
    section.removeClass("active") // retire pour ne pas voir le block

  } else {

    section.slideDown("slow")
    // projets.css("display", "block")
    section.addClass("active"); // ajout lors de la vision du block

  }
});

