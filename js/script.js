const wrapper = document.querySelector('.wrapper');
const loginLink = document.querySelector('.login-link');
const registerLink = document.querySelector('.register-link');
var formBoxLogin = document.getElementById('form_login');
var formBoxRegister = document.getElementById('form_registro');

registerLink.addEventListener('click', ()=>{
    wrapper.classList.add('active');
});

loginLink.addEventListener('click', ()=>{
    wrapper.classList.remove('active');
});

function esconde() {
    formBoxLogin.style.display = "none";
    formBoxRegister.style.display = "block";
}

function aparece() {
    formBoxLogin.style.display = "block";
    formBoxRegister.style.display = "none";
}