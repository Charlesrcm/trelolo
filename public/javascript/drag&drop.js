let projets = document.querySelectorAll('.projet')

for (let i = 0; i < projets.length; i++) {
  const projet = projets[i];
  projet.draggable = true;
}  



function allowDrop(ev) {
  ev.preventDefault();
}

function drag(ev) {
  ev.dataTransfer.setData("text", ev.target.id);
}

function drop(ev) {
  ev.preventDefault();
  let data = ev.dataTransfer.getData("text");
  let projet = document.getElementById(data);

  let targetSection = ev.target.closest('section');

  if (targetSection) {
    targetSection.appendChild(projet);
    
    console.log("Elément section trouvé avec l'id : " + targetSection.id);
    console.log("Elément projet trouvé avec l'id : " + projet.id);
    

    // ajax pour prendre en compte la modification de priorité pour le projet
    $.ajax({
      type: "POST",
      url: "/projet/prio",
      data: {
        idSection: targetSection.id,
        idProjet: projet.id
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
      error: function (xhr, status, error) {
        console.error(xhr, status + " : " + error);
      }
    })

  } else
    console.log("Section cible non trouvée.");
}