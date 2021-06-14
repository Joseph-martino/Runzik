const modalButton = document.querySelector("[data-toggle=modal]");
console.log(modalButton);

modalButton.addEventListener("click", function(event) {
    event.preventDefault();
    let target = this.dataset.target;
    let modal = document.querySelector(target);
    modal.classList.add("modal-show");
    const modalClose = document.querySelectorAll("[data-dismiss=dialog]");
    for(let close of modalClose) {
        close.addEventListener("click", () => {
            modal.classList.remove("modal-show");
        });
    }
    
});

