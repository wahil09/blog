const barsBtn = document.querySelector(".bars");
const menuPhone = document.querySelector("#menuPhone");
const body = document.querySelector("#body");

barsBtn.addEventListener('click', function() {
    if(!(menuPhone.classList.value).split(" ").includes('afficher')) {
        menuPhone.classList.add("afficher");
    } else {
        menuPhone.classList.remove("afficher");
    }
})

/* ----- mettre le menu en display none quand en click sur un lien (li) ----- */
menuPhone.addEventListener("click", function(e) {
    menuPhone.classList.remove("afficher");
})

body.addEventListener("click", function(e) {
    if((menuPhone.classList.value).split(" ").includes('afficher')) {
        if(e.target.parentElement.id != "menuPhoneBox" && e.target.parentElement.parentElement.id != "menuPhoneBox" ) {
            menuPhone.classList.remove("afficher");
        }
    }
})

