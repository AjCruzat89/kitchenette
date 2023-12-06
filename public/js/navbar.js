const menuButton = document.querySelector('#menuButton');
const menuLists  = document.querySelector('#menuLists');
const closeButton = document.querySelector('#closeButton');

menuButton.addEventListener('click', () => {
    menuLists.classList.remove('d-none');
    menuLists.classList.add('d-flex');
})

closeButton.addEventListener('click', () => {
    menuLists.classList.remove('d-none');
    menuLists.classList.remove('d-flex');
    menuLists.classList.add('d-none');
})