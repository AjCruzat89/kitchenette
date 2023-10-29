const navbarButton = document.querySelector('.bi.bi-list');
const sidebar = document.getElementById('sidebar');
const main = document.querySelector('#main');
const closeButton = document.querySelector('.bi.bi-x-lg');

navbarButton.addEventListener('click', () => {
    if(screen.width > 768){
        sidebar.classList.toggle('d-md-flex');
        if(sidebar.classList.contains('d-md-flex')){
            main.style.marginLeft = '300px'
        }
        else{
            main.style.marginLeft = '0px'
        }
    }

    else{
        sidebar.classList.toggle('d-none');
        sidebar.classList.toggle('d-flex');
        closeButton.addEventListener('click', () => {
            sidebar.classList.remove('d-flex');
            sidebar.classList.remove('d-none');
            sidebar.classList.add('d-none');
        })
    }
})

function resize(){
    if(screen.width > 768 & sidebar.classList.contains('d-flex')){
        sidebar.classList.remove('d-flex');
        sidebar.classList.add('d-none');
    }
}

window.addEventListener('resize', resize)

