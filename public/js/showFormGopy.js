function showFormGopy(){
     document.getElementById('nav').classList.add('is-visible');
     document.getElementById('menu').classList.add('is-visible');
     document.getElementById('main').classList.add('is-visible');
     document.getElementById('footer').classList.add('is-visible');
     document.getElementById('formGopy').style.display = 'block';
}

function closeFormGopy(){
     document.getElementById('formGopy').style.display = 'none';
     document.getElementById('nav').classList.remove('is-visible');
     document.getElementById('menu').classList.remove('is-visible');
     document.getElementById('main').classList.remove('is-visible');
     document.getElementById('footer').classList.remove('is-visible');
}
