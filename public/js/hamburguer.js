let show = true;

const menuSection = document.querySelector(".menu-section")
const menuToggle = menuSection.querySelector(".menu-toggle")

menuToggle.addEventListener("click", () =>{

    document.body.style.overflow = show ? "hidden" : "initial"
    /*show vai ser verificado, caso ele for true vai aplicado o hidden (no hamburguer ) para tirar a rolagem 
    Caso não for, ele vai aplicar o initial para ter a rolagem do site*/

    menuSection.classList.toggle("on", show) //Caso o show for falso ele vai tirar o on (Hamburguer)
    show = !show //Aqui ele retorna para true
});



// document.querySelector(".hamburguer").addEventListener("click", () =>
//     document.querySelector(".container").classList.toggle("show-menu") 
// );
