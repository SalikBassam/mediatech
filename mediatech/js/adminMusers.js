const usersTable = document.getElementById("users");
const reservationsTable = document.getElementById("reservations");
const borrowedTable = document.getElementById("borrowed");

const usersOption = document.querySelector(".opt.users");
const reservationsOption = document.querySelector(".opt.reservations");
const borrowedOption = document.querySelector(".opt.borrowed");

usersOption.addEventListener("click", function() {
  usersTable.style.display = "table";
  reservationsTable.style.display = "none";
  borrowedTable.style.display = "none";
  usersOption.classList.add("active");
  reservationsOption.classList.remove("active");
  borrowedOption.classList.remove("active");
});

reservationsOption.addEventListener("click", function() {
  usersTable.style.display = "none";
  reservationsTable.style.display = "table";
  borrowedTable.style.display = "none";
  usersOption.classList.remove("active");
  reservationsOption.classList.add("active");
  borrowedOption.classList.remove("active");
});

borrowedOption.addEventListener("click", function() {
  usersTable.style.display = "none";
  reservationsTable.style.display = "none";
  borrowedTable.style.display = "table";
  usersOption.classList.remove("active");
  reservationsOption.classList.remove("active");
  borrowedOption.classList.add("active");
});