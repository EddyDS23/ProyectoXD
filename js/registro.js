
 const inputName = document.getElementById('name');
 const inputEmail = document.getElementById('email');
 const inputPassword = document.getElementById('password');
 const btnSend = document.getElementById('btnSend');

 btnSend.addEventListener("click",function(){

    data = {
        name:       inputName.value,
        email:      inputEmail.value,
        password:   inputPassword.value
    };
   
    
    fetch('/php/procesar.php',{
        method:'POST',
        headers:{
            'Content-Type':'application/json'
        },
        body:JSON.stringify(data)
    })
    .then(response => response.json())
    .then(result => {
        console.log("Usuario agregado ",result);
    })
    .catch(error => {
        console.error("Usuario fallido ",error);
        alert("Usurario",error);
    })

 });