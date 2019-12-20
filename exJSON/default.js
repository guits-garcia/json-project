
//função para mostrar as fotos de cada album inicio //
function show_pics(x){
    if (document.getElementsByClassName('title-x')){
        let album = x.parentNode.parentNode;
        let photos = album.childNodes[4];
        var close = album.childNodes[3].children[1];
        var title = album.childNodes[3].children[0];
        if (x.classList[0] == "album-title"){
            album.childNodes[3].style.justifyContent = "space-between";
            close.style.display= "block"; //mostra o botão de fechar
            photos.style.height = "2432px"; //mostra as thumbnails e títulos
            photos.style.visibility = "visible";
            photos.style.opacity = "1";
        } else if (x.classList[0] == "close"){
            album.childNodes[3].style.justifyContent = "center"; //tudo aqui é pra reverter as mudanças feitas ali em cima
            close.style.display= "none"; 
            photos.style.visibility = "hidden";
            photos.style.height = "0";
            photos.style.opacity = "0";
            
        }
    }
}
//função para mostrar as fotos de cada album fim //

//função para mover a nav das tarefas!!! inicio //
if (document.getElementById('autor-page')){
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
}
//função para mostrar as tarefas FIM//


//ABRIR MODAIS DAS IMAGENS - AUTOR-PAGE.PHP INÍCIO //
var modal = document.getElementById('modal');
var modal_img = document.getElementById('modal-img');
var modal_close_btwn = document.getElementById('modal-close');
var modal_caption = document.getElementById('modal-caption');
function showModal(x){
modal.style.display = "block"; //mostra o modal
modal.style.visibility = "visible";
setTimeout(function(){
    modal.style.opacity = "0.95";
}, 5);
var url = x.dataset.url; //pega a url
var caption = x.parentNode.children[1].innerHTML;
console.log(caption);
modal_img.src=`${url}`; //bota na src da img
modal_caption.innerHTML = caption;
}

function closeModal(){
modal.style.display = "none";
modal.style.visibility = "hidden";
modal.style.opacity = "0";
}
//ABRIR MODAIS DAS IMAGENS - AUTOR-PAGE.PHP FIM //

//MOSTRAR INFO PHONE-WEB-MAIL AUTOR-LIST.PHP INICIO //
function showInfo(x){
    x.style.transform = "scale(1.2)";
    x.style.filter = "drop-shadow(0px 0px 1px gray)";
    x.style.paddingRight = "5px";
    var info = x.dataset.info;
    x.parentNode.parentNode.children[3].innerHTML = info;
    x.parentNode.parentNode.children[3].style.display = "block";
    x.parentNode.parentNode.children[3].style.visibility = "visible";
    setTimeout(function(){
        x.parentNode.parentNode.children[3].style.opacity = "0.95";
    }, 5);
}
function hideInfo(x){
    x.style.transform = "scale(1)";
    x.style.filter = "none";
    x.style.paddingRight = "0";
    x.parentNode.parentNode.children[3].style.display = "none";
    x.parentNode.parentNode.children[3].style.visibility = "hidden";
    x.parentNode.parentNode.children[3].style.opacity = "0";
}
//MOSTRAR INFO PHONE-WEB-MAIL AUTOR-LIST.PHP FIM //


//FUNÇÃO PARA MOSTRAR OS COMENTÁRIOS INDEX.PHP INICIO //
function showComments(x){
    var title = x.parentNode.parentNode.children[1];
    var content = x.parentNode.parentNode.children[3];
    var post = x.parentNode.parentNode.parentNode;
    var comments = post.children[1];
    if(x.dataset.after == 'veja comentários..'){
        console.log(x);
        console.log(x.parentNode.parentNode);
        x.setAttribute('data-after', 'Fechar comentários');
        title.style.fontSize = "38px";
        title.style.marginBottom = "10px";
        content.style.fontSize = "22px";
        content.style.padding = "15px";
        content.style.marginBottom = "15px";
        post.style.width = "100%";
        post.style.height = "fit-content";
        comments.style.display = 'block';
    } else if (x.dataset.after == 'Fechar comentários'){
        x.setAttribute('data-after', 'veja comentários..');
        title.style.fontSize = "28px";
        title.style.marginBottom = "0px";
        content.style.fontSize = "18px";
        content.style.padding = "0px";
        content.style.marginBottom = "0px";
        post.style.width = "45%";
        post.style.height = "215px";
        comments.style.display = 'none';
    }
   
}
//FUNÇÃO PARA MOSTRAR OS COMENTÁRIOS INDEX.PHP FIM //
function layoutDynamic(x){
x.style.top = "12%";
x.style.left = "25%";
x.parentNode.children[1].style.top = "5%";
x.parentNode.children[2].style.top = "22%";
x.parentNode.children[2].style.opacity = "1";
x.parentNode.children[3].style.top = "30%";
x.parentNode.children[3].style.opacity = "1";
x.parentNode.children[4].style.top = "38%";
x.parentNode.children[4].style.opacity = "1";
x.parentNode.children[5].style.zIndex = "1";
x.parentNode.children[5].style.opacity = "1";
x.parentNode.children[5].style.top = "12%";
x.parentNode.children[5].style.left = "85%";
}

//FUNÇÃO PARA O BACKGROUND IMAGE EM AUTOR LIST INICIO //
var startPos = 582;    
var passo = 50;
function getYoUrl(x){
        var img_url = x.src;
        // console.log(img_url);
        // var profile_pics = document.getElementsByClassName('middle-img')[0];
        var movingPic = document.getElementsByClassName('middle-img-behind')[0];
        movingPic.src = img_url;
        movingPic.style.opacity = 1;
        movingPic.style.left = `${startPos}px`;
        startPos = startPos - passo;
        if (startPos <= -25){
            passo *= -1;
        } else if (startPos >= 583){
            passo *= -1;
        }
        console.log(startPos);
        // movingPic.style.left = "120px";
    }
    function hideYoImg(x){
        var img_url = x.src;
        var movingPic = document.getElementsByClassName('middle-img-behind')[0];
        movingPic.style.opacity = 0;
    }
//FUNÇÃO PARA O BACKGROUND IMAGE EM AUTOR LIST INICIO //


// var texts = document.getElementsByClassName('album-anchor')[0].textContent;
// document.getElementsByClassName('album-anchor')[0].classList.add('effect');
if (document.getElementsByClassName('album-anchor')){
    function type(){
        if (count === texts.length){
            count = 0;
        }
        currentText = texts;
        letter = currentText.slice(0, ++index);
        document.getElementsByClassName('album-anchor')[indexAutor].textContent = letter;
        if (letter.length === currentText.length){
            count++;
            index = 0;
            indexAutor++;
            if  (indexAutor >= document.getElementsByClassName('album-anchor').length ) {
                indexAutor = 0;
            } else if ( indexAutor < 0 ){
               indexAutor = document.getElementsByClassName('album-anchor').length;
            }
            autorDaVez = document.getElementsByClassName('album-anchor')[indexAutor];
            texts = document.getElementsByClassName('album-anchor')[indexAutor].textContent;
        }
        setTimeout(type,200);
       };
       
    function type1(){
        this.indexAutor = 0;
        this.autorDaVez = document.getElementsByClassName('album-anchor')[indexAutor];
        this.tempo_sorteado = Math.floor(Math.random() * (600 - 300 + 1)) + 300;
        this.texts = document.getElementsByClassName('album-anchor')[indexAutor].textContent;
        this.count = 0;
        this.index = 0;
        this.currentText = '';
        this.letter = '';
        type();
    }
    type1();
    
}


//funçào popup index //

function abrirPopUp(x){
    if(x.dataset.after == 'veja comentários..'){
    // document.querySelector('.popup-blog').style.display = 'inline-flex';
    document.querySelector('.popup-blog').style.transform = 'translate(-50%,-50%)';
    document.querySelector('.popup-blog').style.left = '50%';
    // document.querySelector('.popup-blog').style.animation = 'rotation 2s linear';
    var conteudo = x.textContent; //pega tudo o que está escrito
    var conteudo_separado = conteudo.split(":"); //separa onde tem dois pontos, [1] é o id
    // var botarAqui = document.querySelector('#autor-id-blog');
    // botarAqui.innerText = conteudo_separado[1];
    var numero_id = conteudo_separado[1].replace(/\s+/g, '');
    
    $(document).ready(function(){
        var Url =`https://jsonplaceholder.typicode.com/posts?id=${numero_id}`;
        $.ajax({
            url:Url,
            type:"GET",
            success: function(result){
               const output = result;
                console.log(output[0]['id']);
               const popUp = document.querySelector('.popup-blog');
               popUp.innerHTML += `<div class='post'>
                                        <div class='post-stuff'>
                                            <div class='post-info'>
                                                <p>post número ${output[0]['id']} </p>
                                                <div class="fechar-popup" onclick='abrirPopUp(this)'>&times;</div>
                                            </div>
                                        
                                        <p class='title'>${output[0]['title']}</p>
                                       `;

               
                $(document).ready(function(){
                    var Url =`https://jsonplaceholder.typicode.com/users?id=${output[0]['userId']}`;
                    $.ajax({
                        url:Url,
                        type:"GET",
                        success: function(result){
                            popUp.innerHTML += `<a class='autor' href='autor-portfl.php?autor-id=${output[0]['userId']}'>Escrito por ${result[0]['name']}</p>`;
                            popUp.innerHTML += `<p class='content'>${output[0]['body']}</p>
                                                </div>`;
                                                

      
                                                $(document).ready(function(){
                                                    var Url =`https://jsonplaceholder.typicode.com/comments?postId=${numero_id}`;
                                                    $.ajax({
                                                        url:Url,
                                                        type:"GET",
                                                        success: function(result){
                                                            popUp.innerHTML += `<div class='comentarios'>
                                                            <p> COMENTÁRIOS </p>`;
                                                           
                                                            function myFunction(item){
                                                                popUp.innerHTML += `
                                                                                   
                                                                                        
                                                                                        <hr>
                                                                                        <div class='comentario'>
                                                                                        <div class='comentario-info'>
                                                                                            <p>${item['email']} diz:</p>
                                                                                        </div>
                                                                                        <div class='comentario-conteudo'>
                                                                                            <p> ${item['name']} </p>
                                                                                            <p> ${item['body']} </p>
                                                                                        </div>
                                                                                    </div>`;
                                                            }
                                                            result.forEach(myFunction);
                                                            popUp.innerHTML +=`</div>`;
                                                        },
                                                        error: function(result){
                                                            console.error(result);
                                                        }
                                                    })
                                                });
                                            







                        },
                        error: function(result){
                            console.error(result);
                        }
                    })
                });

            },
            error:function(error){
                console.log(`Error ${error}`);
            }
        })
    })
    }else if (x.classList[0] == 'fechar-popup'){
        document.querySelector('.popup-blog').style.transform = ' rotate(0) translate(-100%,-50%)';
        document.querySelector('.popup-blog').style.left = '0';
        document.querySelector('.popup-blog').style.animation = 'none';
        document.querySelector('.popup-blog').innerHTML = "";
    }
       
   
  
}


