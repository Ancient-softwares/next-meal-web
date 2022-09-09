// Get the modal
const modalRegistro = document.getElementById("modalRegistro");
const modalLogin = document.getElementById("modalLogin");

// Get the button that opens the modal
const btnRegistro = document.getElementById("btn-registro");
const btnLogin = document.getElementById("btn-login");

const btnAbrirRegistro = document.getElementById("btn-abrirRegistro");
const btnAbrirLogin = document.getElementById("btn-abrirLogin")

// Get the <span> element that closes the modal
const fecharModalRegistro = document.getElementsByClassName("fechaRegistro");
const fecharModalLogin = document.getElementsByClassName("fechaLogin");


// When the user clicks the button, open the modal 
btnRegistro.onclick = () => {
  modalRegistro.style.display = "block";
}
// When the user clicks the button, open the modal 
btnLogin.onclick = () => {
  modalLogin.style.display = "block";
}

// When the user clicks on <span> (x), close the modal
fecharModalRegistro.onclick = () => {
  fecharModalRegistro.style.display = "none";
}
// When the user clicks on <span> (x), close the modal
fecharModalLogin.onclick = () => {
  fecharModalLogin.style.display = "none";
}

// When the user clicks anywhere outside of the modal, close it
window.onclick = (event) => {
  if (event.target == modalRegistro) modalRegistro.style.display = "none";
  else if (event.target == modalLogin) modalLogin.style.display = 'none'; 
}

btnAbrirRegistro.onclick = (event) =>{
  if(event.target == btnAbrirRegistro) {
    modalLogin.style.display = "none";
    modalRegistro.style.display = "block";

  }
}

btnAbrirLogin.onclick = (event) =>{
  if(event.target == btnAbrirLogin){
    modalRegistro.style.display = "none";
    modalLogin.style.display = "block";
  }
}