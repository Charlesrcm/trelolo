// function start(e) {
//   e.dataTransfer.effectAllowed = "move";
//   e.dataTransfer.setData("text", e.target.getAttribute("id"));
// }

// function over(e) {
//   e.currentTarget
// }

// function drop(e) {
//   let object = e.dataTransfer.getData("text");
//   e.currentTarget.appendChild(document.getElementById(object));
//   e.stopPropagation();
//   return false;
// }

var sections = document.getElementsByClassName('active');

for(section of sections){
  var projets = document.getElementById('projet');
  // console.log(section, projets);

}