let updateButton = document.getElementById("validation-button");
let successMessage = document.getElementById("order-success-message-container");

function showSuccessMessage() {
    successMessage.classList.remove("hide-message");
    successMessage.classList.add("show-message");
}

function showMessageWithTimeOut() {
    setTimeout(showSuccessMessage(), 3000);
}


updateButton.addEventListener("click", showMessageWithTimeOut);