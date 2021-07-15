const pswdfield = document.querySelector(".pwd");
const toggleIcon = document.querySelector("#show-icon");

toggleIcon.addEventListener("click",()=>{
    if(pswdfield.type === 'password'){
        pswdfield.type = 'text';
        toggleIcon.classList.add('active');
    }else{
        pswdfield.type = 'password';
        toggleIcon.classList.remove('active');
    }
})


