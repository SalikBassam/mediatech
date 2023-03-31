const deleteIcons = document.querySelectorAll('.delete-product');




title = document.querySelector(".title")
console.log(title.textContent);

trash = document.querySelectorAll(".delete-product")

trash.forEach(function(e){
e.addEventListener("click",function(){
document.querySelector("#product-name").textContent=e.parentNode.parentNode.childNodes[1].textContent
})
})


// Add event listener to all delete-product icons
deleteIcons.forEach(deleteIcon => {
  deleteIcon.addEventListener('click', () => {
    // Retrieve the ID of the product to be deleted
    const productId = deleteIcon.getAttribute('data-id');
    // Set the value of the delete-product-id input in the delete confirmation modal
    const deleteProductIdInput = document.getElementById('delete-product-id');
    deleteProductIdInput.value = productId;
    // Set the name of the product in the delete confirmation modal
    const productName = deleteIcon.parentNode.parentNode.querySelector('.title').textContent;
    document.getElementById('product-name').textContent = productName;
  });
});




// Add event listener to all update-product icons
const updateIcons = document.querySelectorAll('.update-product');
updateIcons.forEach(updateIcon => {
  updateIcon.addEventListener('click', () => {
    // Retrieve the ID of the product to be updated
    const productId = updateIcon.getAttribute('data-id');
    // Set the value of the update-product-id input in the update modal
    const updateProductIdInput = document.getElementById('update-product-id');
    updateProductIdInput.value = productId;
    // Set the current title and author of the product in the update modal
    const productTitle = updateIcon.parentNode.parentNode.querySelector('.title').textContent;
    const productAuthor = updateIcon.parentNode.parentNode.querySelector('p:first-child').textContent;
    document.getElementById('update-product-title').value = productTitle;
    document.getElementById('update-product-author').value = productAuthor;
  });
});