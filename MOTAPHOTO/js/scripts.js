let liencontact = document.querySelectorAll(".btn-contact");
// let modale = document.querySelector(".modale");
let modale = document.querySelector(".overlay");


liencontact.forEach(function(e){
    e.addEventListener("click", toggleNav)

    function toggleNav(e){
        e.preventDefault()
    	modale.classList.toggle("active") 
    }
})

window.addEventListener("click", function(e){
    console.log(e.target)
    if(e.target.classList.contains("overlay")) {
        console.log("clic en dehors de la modale")
        modale.classList.remove("active")
    }
})

//MENU TOGGLE
let menuburger = document.querySelector(".menu-toggle");
let navhover = document.querySelector("#menu-main-menu");


menuburger.addEventListener("click", togglemenu)

function togglemenu(e){
    
	navhover.classList.toggle("active");
    menuburger.classList.toggle("active");
    navhover.addEventListener("click" , togglemenu) 
}

//CHARGER PLUS

var page = 4;

jQuery(function($) {
    $('body').on('click', '.loadmore', function() {
        $.ajax({
            type:'POST',
            url:ajax_data.ajaxurl,
            data:{
                action:"load_posts",
                
                
            },
            success:function(response){
                console.log(response)
                $('.galerie').append(response);//append ajoute les elements en plus des autres
                $('.loadmore').hide()
                // ajouter les événements sur le "carré"
                const ouvertureLightbox = document.querySelectorAll('.fullscreen.more');
                // const lightbox=document.querySelector('.lightbox');
                const lb_img = document.querySelector('#lightbox-img');
                const lb_cat = document.querySelector('#lightbox-cat');
                const lb_ref = document.querySelector('#lightbox-ref');

                ouvertureLightbox.forEach(function(carre) {
                carre.addEventListener('click', function() {
                    lightbox.classList.toggle('show');
                    lb_img.setAttribute('src', carre.dataset.src);
                    lb_cat.innerHTML =  carre.dataset.cat;
                    lb_ref.innerHTML =  carre.dataset.ref;
                })
                })
                // recalculer le tableau 
                chargeListe();

            },
            error:function(response){

            },


        })
    })
    

    //FILTRES PHOTO

    $('#listecategories').on('change',function(event){
            $.ajax({
            type:'POST',
            url:ajax_data.ajaxurl,
            data:{
                action:"filtrephoto",
                categorie:$('#listecategories').val(),
                format:$('#listeformats').val(),
                ordre:$('#ordre').val(),
            },
            success:function(response){
                console.log(response)
                $('.galerie') .html (response);
                $('.loadmore').hide()

            },
            error:function(response){

            },


        })
    })

    $('#listeformats').on('change',function(event){
        $.ajax({
        type:'POST',
        url:ajax_data.ajaxurl,
        data:{
            action:"filtrephoto",
            categorie:$('#listecategories').val(),
            format:$('#listeformats').val(),
            ordre:$('#ordre').val(),
        },
        success:function(response){
            console.log(response)
            $('.galerie') .html (response);
            $('.loadmore').hide()

        },
        error:function(response){

        },


    })
})

$('#ordre').on('change',function(event){
    $.ajax({
    type:'POST',
    url:ajax_data.ajaxurl,
    data:{
        action:"filtrephoto",
        categorie:$('#listecategories').val(),
        format:$('#listeformats').val(),
        ordre:$('#ordre').val(),
    },
    success:function(response){
        console.log(response)
        $('.galerie') .html (response);

    },
    error:function(response){

    },


})
})

// PAGINATION

if($('.link-prev').length) {
    $('.link-prev').on('mouseenter',function(event){
        $('.imgprev').fadeIn('slow');
    });
    $('.link-prev').on('mouseleave',function(event){
        $('.imgprev').fadeOut('slow');
    });
};

if($('.link-next').length) {
    $('.link-next').on('mouseenter',function(event){
        $('.imgnext').fadeIn('slow');
    });
    $('.link-next').on('mouseleave',function(event){
        $('.imgnext').fadeOut('slow');
    });
};


})
