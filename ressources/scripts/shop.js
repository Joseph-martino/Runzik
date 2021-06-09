let wishlistButton = document.getElementsByClassName("fas");

    for( let i = 0; i < wishlistButton.length; i++) {
        wishlistButton[i].addEventListener("click", function(event){
            wishlistButton[i].classList.toggle("wishlist-unselected");
            wishlistButton[i].classList.toggle("wishlist-selected");
        })
    }





