/*//////////////*/
const liElements = document.querySelectorAll('ul li');
liElements.forEach(li => {
  li.addEventListener('click', () => {
    liElements.forEach(li => li.classList.remove('active'));
    li.classList.add('active');
  });
});

let searchInput= document.querySelector("#search")
let searchBtn= document.querySelector(".searchBtn")

document.querySelector(".searchIcon").onclick =function(){
    liElements.forEach(li => {
        li.style.display="none"
        searchInput.style.display="block"
        searchBtn.style.display="block"
        searchInput.focus();
      });
}

