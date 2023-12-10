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
    // }
  }
}





let arrows = document.querySelectorAll('#display_arrow');

for (let i = 0; i < arrows.length; i++) {
  const ARROW = arrows[i];

  ARROW.addEventListener("click", function (e) {

    let first_arrow = this.children[0];
    let second_arrow = this.children[1];

    let infoProjet = this.parentElement.nextElementSibling;
  
    e.preventDefault();
    DOMAnimations.slideToggle(infoProjet, first_arrow, second_arrow);
  })  
}


window.addEventListener('resize', function (e) {
  
  let largeurEcran = window.innerWidth;

  let arrows =  document.querySelectorAll("#arrow_prio");

  for (let i = 0; i < arrows.length; i++) {
    const ARROW = arrows[i];

    let section = ARROW.parentElement.parentElement.nextElementSibling;

    let display = window.getComputedStyle(section).display;

    if (largeurEcran > 426 && display === "none") {
      e.preventDefault();
      DOMAnimations.slideDown(section);
    }    
  }
})

