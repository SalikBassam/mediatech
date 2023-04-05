let borrowed = document.getElementById("borrowed")
let reserved = document.getElementById("reserved")
let productCards = document.getElementById("productCards")
let productCardsBorrowed = document.getElementById("productCardsBorrowed")


productCardsBorrowed.style.display="none"

borrowed.onclick = function(){
    productCards.style.display="none"
    productCardsBorrowed.style.display=""
    borrowed.setAttribute("class","active")
    reserved.removeAttribute("class","active")
}

reserved.onclick = function(){
    productCardsBorrowed.style.display="none"
    productCards.style.display=""
    reserved.setAttribute("class","active")
    borrowed.removeAttribute("class","active")
}