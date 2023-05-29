
const icona=document.getElementById('icona_sidebar');
icona.addEventListener('click', aprimenu);    
const menu=document.querySelector('.menulaterale');
menu.addEventListener('click', chiudimenu);

function aprimenu()
{
    menu.classList.add("classeclick");
}

function chiudimenu()
{
    menu.classList.remove("classeclick");
}



