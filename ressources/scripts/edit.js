let updateButton = document.getElementById("update-button");
let successMessage = document.getElementById("update-information-panel-container");

function showSuccessMessage() {
    successMessage.classList.remove("hide-message");
    successMessage.classList.add("show-message");
}

function showMessageWithTimeOut() {
    setTimeout(showSuccessMessage(), 3000);
}


updateButton.addEventListener("click", showMessageWithTimeOut);
   