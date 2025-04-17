const inputEmail = document.getElementById('email');
const inputPassword = document.getElementById('password');
const btnLogin = document.getElementById('btnLogin');

btnLogin.addEventListener("click",function(){
    data = {
        email:      inputEmail.value,
        password :  inputPassword.value
    };
    
    fetch('/php/login.php',{
        method:'POST',
        headers:{
            "Content-Type":"application/json"
        },
        body:JSON.stringify(data)
    })
    .then(response => response.json())
    .then(result => {
        if(result.status === 'success'){
    
            window.location.href = '/GUIs/principal.php';
            console.log("Datos",result);
            localStorage.setItem('token',result.token);
            
        }else{
            console.log(result.message);
        }
    })
    .catch(error => {
        console.log("Inicio de sesion fallido ",error)
    })
});

