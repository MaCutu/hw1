function checkname(event){
    const input=event.currentTarget;

    if (input.value.length>0){
        input.parentNode.classList.remove('errorinsert');
    }else{
        input.parentNode.classList.add('errorinsert');
    }
}

function checksurname(event){
    const input=event.currentTarget;

    if (input.value.length>0){
        input.parentNode.classList.remove('errorinsert');
    }else{
        input.parentNode.classList.add('errorinsert');
    }
}

function jsonUsercheck(json){
    if(json.exists===false){
        document.querySelector('.username').classList.remove('errorinsert');
    }else{
        document.querySelector('.username span').textContent="Username già utilizzato";
        document.querySelector('.username').classList.add('errorinsert');
    }
}

function jsonemailcheck(json){
    if(json.exists===false){
        document.querySelector('.email').classList.remove('errorinsert');
    }else{
        document.querySelector('.email span').textContent="Email già utilizzata";
        document.querySelector('.email').classList.add('errorinsert')
    }
}

function fetchResponse(response){
    if(!response.ok) return null;
    return response.json();
}


function checkusername(event){
    const input=event.currentTarget;
    if(/^[a-zA-Z0-9_]{1,15}$/.test(input.value)){
        input.parentNode.classList.remove('errorinsert');
        fetch("check_user.php?q="+encodeURIComponent(input.value)).then(fetchResponse).then(jsonUsercheck);
    }else{
        input.parentNode.classList.add('errorinsert');
    }
}

function checkemail(event){
    const email_input=event.currentTarget;
    if(/^(([^<>()\[\]\\.,;:\s@"]+(\.[^<>()\[\]\\.,;:\s@"]+)*)|(".+"))@((\[[0-9]{1,3}\.[0-9]{1,3}\.[0-9]{1,3}\.[0-9]{1,3}\])|(([a-zA-Z\-0-9]+\.)+[a-zA-Z]{2,}))$/.test(String(email_input.value).toLowerCase())){
        email_input.parentNode.classList.remove('errorinsert');
        fetch("check_email.php?q="+encodeURIComponent(String(email_input.value).toLowerCase())).then(fetchResponse).then(jsonemailcheck);
    }else{
        email_input.parentNode.classList.add('errorinsert');
    }

}


function checkpassword(event){
    const password_input=event.currentTarget;
    if(password_input.value.length>=8){
        password_input.parentNode.classList.remove('errorinsert');
    }else{
        password_input.parentNode.classList.add('errorinsert');
    }
}
function checkconf_password(event){
    const confpass_input=event.currentTarget;
    if(confpass_input.value===document.querySelector('.password input').value){
        confpass_input.parentNode.classList.remove('errorinsert');
    }else{
        confpass_input.parentNode.classList.add('errorinsert');
    }
}



document.querySelector('.name input').addEventListener('blur', checkname);
document.querySelector('.surname input').addEventListener('blur', checksurname);
document.querySelector('.username input').addEventListener('blur', checkusername);
document.querySelector('.email input').addEventListener('blur', checkemail);
document.querySelector('.password input').addEventListener('blur', checkpassword);
document.querySelector('.conf_password input').addEventListener('blur', checkconf_password);