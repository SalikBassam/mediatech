const usersSearch = document.getElementById("userstb");
const reservationsTable = document.getElementById("reservations");
const borrowedTable = document.getElementById("borrowed");
const reservationsOption = document.querySelector(".opt.reservations");
const borrowedOption = document.querySelector(".opt.borrowed");


reservationsOption.addEventListener("click", function() {
  usersSearch.style.display = "";
  reservationsTable.style.display = "table";
  borrowedTable.style.display = "none";
  reservationsOption.classList.add("active");
  borrowedOption.classList.remove("active");
});

borrowedOption.addEventListener("click", function() {
  usersSearch.style.display = "none";
  usersSearch.style.display = "none";
  reservationsTable.style.display = "none";
  borrowedTable.style.display = "table";
  reservationsOption.classList.remove("active");
  borrowedOption.classList.add("active");
});