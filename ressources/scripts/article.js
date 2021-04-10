let bannerPicture = document.getElementById("banner-product");
let productColourText = document.getElementById("product-colour-text");

const colors = document.querySelectorAll('input[name="product-colour"]'); 
if (colors.length) {
    colors.forEach(function (elem) {
      elem.addEventListener("change", function(event) {
          console.log(elem.id);
        

        productColourText.innerHTML = elem.value;
          if(elem.id === "0" || event.target.value === undefined) {
              bannerPicture.src = "ressources/images/banners/banner-watch.png"; // insérer ici une référence à la bonne page (watch, headphone, armband)
             
          } else if (elem.id === "1") {
            bannerPicture.src = "ressources/images/banners/watch-colour.png";
        
          }
      });
    });
  }