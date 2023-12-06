class DOMAnimations {
  
  static slideUp(element) {
    
    element.style.height = element.offsetHeight + 'px';
    element.style.transitionProperty = "height, margin, padding";
    element.style.transitionDuration = "500ms";
    element.offsetHeight;
    element.style.overflow = "hidden";
    element.style.height = 0;
    element.style.paddingTop = 0;
    element.style.paddingBottom = 0;
    element.style.marginTop = 0;
    element.style.marginBottom = 0;

    window.setTimeout(function () {
        element.style.display = "none";
        element.style.removeProperty('height');
        element.style.removeProperty('padding-top');
        element.style.removeProperty('padding-bottom');
        element.style.removeProperty('margin-top');
        element.style.removeProperty('margin-bottom');
        element.style.removeProperty('overflow');
        element.style.removeProperty('transition-duration');
        element.style.removeProperty('transition-property');
    }, 500)
  };

  static slideDown(element) {

    element.style.removeProperty("display");
    element.style.display = window.getComputedStyle(element).display;
    let height = element.offsetHeight;
    
    element.style.overflow = "hidden";
    element.style.height = 0;
    element.style.paddingTop = 0;
    element.style.paddingBottom = 0;
    element.style.marginTop = 0;
    element.style.marginBottom = 0;
    element.offsetHeight // redessin
    element.style.transitionProperty = "height, margin, padding";
    element.style.transitionDuration = "500ms";
    element.style.height = height + "px";
    element.style.removeProperty('padding-top');
    element.style.removeProperty('padding-bottom');
    element.style.removeProperty('margin-top');
    element.style.removeProperty('margin-bottom');

    window.setTimeout(function () {
        element.style.removeProperty('height');
        element.style.removeProperty('overflow');
        element.style.removeProperty('transition-duration');
        element.style.removeProperty('transition-property');
    }, 500)
  };

  static slideToggle(element, first_arrow, second_arrow) {
    let display = window.getComputedStyle(element).display
    
    if (display === "none") {
      this.slideDown(element);
      first_arrow.style.transform = "rotate(45deg)";
      second_arrow.style.transform = "rotate(-45deg)";
    } else {
      this.slideUp(element);
      first_arrow.style.transform = "rotate(135deg)";
      second_arrow.style.transform = "rotate(-135deg)";
    }
  }
}





let arrows = document.querySelectorAll('#display_arrow');

for (let i = 0; i < arrows.length; i++) {
  const ARROW = arrows[i];

  let first_arrow =  ARROW.children[0];
  let second_arrow =  ARROW.children[1];
  
  // first_arrow.style.transform = "rotate(45deg)";
  // second_arrow.style.transform = "rotate(-45deg)";

  ARROW.addEventListener("click", function (e) {
    
    let infoProjet_display = true;

    let first_arrow = this.children[0];
    let second_arrow = this.children[1];

    let infoProjet = this.parentElement.nextElementSibling;
    
    if (infoProjet_display)
    {
      e.preventDefault();
      DOMAnimations.slideToggle(infoProjet, first_arrow, second_arrow);
      infoProjet_display = false;
    } else
    {
      e.preventDefault();
      DOMAnimations.slideToggle(infoProjet,first_arrow, second_arrow);
    }    
  })  
}


let projetParent = $('.projetParent');

/**
 * fonction d'écoute pour changer le sens de la flèche et replier la liste des projets sur une vue de téléphone
*/
for (let i = 1; i <= projetParent.length; i++) {
  

  let arrowContainer = $('#arrow' + [i])

  arrowContainer.on('click', function () {
    let section = $(this).parent().next()

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


