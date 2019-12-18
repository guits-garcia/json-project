
//função para mostrar as fotos de cada album inicio //
function show_pics(x){
    if (document.getElementsByClassName('title-x')){
        let album = x.parentNode.parentNode;
        let photos = album.childNodes[4];
        var close = album.childNodes[3].children[1];
        var title = album.childNodes[3].children[0];
        if (x.classList[0] == "album-title"){
            album.childNodes[3].style.justifyContent = "space-between";
            title.style.marginLeft = "50%"; //centra o título
            title.style.transform = "translate(-50%)"; //centra o título
            close.style.display= "block"; //mostra o botão de fechar
            album.style.width = "200%"; //aumenta a div
            album.style.transform = "translate(-25%)"; //centra a div
            photos.style.display = "flex"; //mostra as thumbnails e títulos
        } else if (x.classList[0] == "close"){
            album.childNodes[3].style.justifyContent = "center"; //tudo aqui é pra reverter as mudanças feitas ali em cima
            title.style.marginLeft = "0"; 
            title.style.transform = "translate(0)"; 
            close.style.display= "none"; 
            album.style.width = "100%"; 
            album.style.transform = "translate(0%)"; 
            photos.style.display = "none"; 
        }
    }
}
//função para mostrar as fotos de cada album fim //

//função para mover a nav das tarefas!!! inicio //
const nav_bullseye = document.querySelector("#bullseye");
const nav = document.getElementById('sidenav-tarefas');
var mousedownFlag;

nav_bullseye.addEventListener('mousedown', function(){
window.mousedownFlag = 1;
})

window.addEventListener('mouseup',function(){
    window.mousedownFlag = 0;
})

window.addEventListener('mousemove',function(){
    var x = event.clientX;
    var y = event.clientY; 
    if(window.mousedownFlag == 1){
        if ((x > 0 && y > 0) && (x < (window.innerWidth - 270) && y < (window.innerHeight - 90))){
            nav.style.top = `${y}px`;
            nav.style.left = `${x}px`;
        }
    }
});
//função para mover a nav das tarefas!!! fim //


//função para mostrar as tarefas início//
var concl = document.getElementsByClassName('concluidas')[0];
var not_concl = document.getElementsByClassName('not-concluidas')[0];
var concl_open = 0;
const concl_html = concl.children[0].innerHTML;
concl.children[0].addEventListener('click',function(){
    if (window.concl_open == 0){
        concl.children[1].style.display = "flex";
        concl.children[0].style.textAlign = "center";
        concl.children[0].innerHTML = "Clique nas tarefas para ver mais informações! &times;";
        window.concl_open = 1;
    } else if(window.concl_open == 1){
        concl.children[1].style.display = "none";
        concl.children[0].style.textAlign = "left";
        concl.children[0].innerHTML = concl_html;
        window.concl_open = 0;
    }
})

var not_concl = document.getElementsByClassName('not-concluidas')[0];
var not_concl_open = 0;
const not_concl_html = not_concl.children[0].innerHTML;
not_concl.children[0].addEventListener('click',function(){
    if (window.not_concl_open == 0){
        not_concl.children[1].style.display = "flex";
        not_concl.children[0].style.textAlign = "center";
        not_concl.children[0].innerHTML = "Clique nas tarefas para ver mais informações! &times;";
        window.not_concl_open = 1;
    } else if(window.not_concl_open == 1){
        not_concl.children[1].style.display = "none";
        not_concl.children[0].style.textAlign = "left";
        not_concl.children[0].innerHTML = not_concl_html;
        window.not_concl_open = 0;
    }
})

