// const images = document.querySelector(".lightbox__container__photo img");
const links = document.querySelectorAll('.galerie_photos img');
const galleryimg = document.querySelector("galerie img");
const closelightbox = document.querySelector(".lightbox__close");
const lightbox = document.querySelector(".lightbox");
const lightboxnext = document.querySelector(".lightbox__next");
const lightboxprev = document.querySelector(".lightbox__prev");

//Fermeture Lightbox

closelightbox.addEventListener("click", lightboxclose);

function lightboxclose() {
  
  lightbox.classList.remove("show");

}  

// OUVERTURE LIGHTBOX 

const ouvertureLightbox = document.querySelectorAll('.fullscreen');
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

  
/* Lightbox Informations Slider*/
function chargeListe() {
  let currentImage = 0
  const lightboxlist = []
  
  let dataImages = document.querySelectorAll(".fullscreen")
  dataImages.forEach((img)=>{
    let item = {
      src: img.dataset.src,
      ref: img.dataset.ref,
      cat: img.dataset.cat,  
    }
    lightboxlist.push(item)
    console.table(lightboxlist);  
  })
  
  lightboxnext.addEventListener('click', function() {
    currentImage++;
    if(currentImage > lightboxlist.length) {
      currentImage = 0;
    }
    lb_img.setAttribute('src', lightboxlist[currentImage].src);
    lb_cat.innerHTML =  lightboxlist[currentImage].cat;
    lb_ref.innerHTML =  lightboxlist[currentImage].ref;
  })

  lightboxprev.addEventListener('click', function() {
    currentImage--;
    if(currentImage < 0) {
      currentImage = lightboxlist.length;
    }
    lb_img.setAttribute('src', lightboxlist[currentImage].src);
    lb_cat.innerHTML =  lightboxlist[currentImage].cat;
    lb_ref.innerHTML =  lightboxlist[currentImage].ref;
  })

  //console.log(lightboxlist);
}

chargeListe();