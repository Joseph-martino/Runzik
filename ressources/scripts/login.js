const buttonSignin = document.getElementById('signIn');
const buttonSignUp = document.getElementById('signUp');

const container = document.getElementById('main-container');

buttonSignin.addEventListener('click', function (){
    container.classList.remove('right-panel-active');
});

buttonSignUp.addEventListener('click', function (){
    container.classList.add('right-panel-active');
});