const btn = document.querySelector('#connection_button');
if (btn) { 
  btn.addEventListener('click', function () {
    
    if(btn.className == "button--loading")
      btn.classList.remove('button--loading')
    else
      btn.classList.add('button--loading')
  })
}