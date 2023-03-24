let trash = document.querySelectorAll(".trash")
let modal = document.querySelector(".modal-body")

trash.forEach(e => {
e.addEventListener("click",function(){
    modal.innertext+="teste"
})
});

