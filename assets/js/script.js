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

