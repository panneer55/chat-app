const form = document.querySelector('.typing-area');
const inputField = form.querySelector(".input-field");
const sendbtn = form.querySelector('button');
const chatBox = document.querySelector(".chat-box");

form.onsubmit = (e)=>{
    e.preventDefault();
}

inputField.focus();
inputField.onkeyup = ()=>{
    if(inputField.value != ""){
        sendbtn.classList.add("active");
    }else{
        sendbtn.classList.remove("active");
    }
}
sendbtn.onclick = ()=>{
    const xhr = new XMLHttpRequest();
    xhr.open('POST','php/insert-chat.php',true);
    xhr.onload = ()=>{
        if(xhr.readyState===XMLHttpRequest.DONE){
            if(xhr.status===200){
                inputField.value = ''; 
                scrollToBottom();      
            }
        }
    }
    let formdata = new FormData(form)
    xhr.send(formdata);
}
chatBox.onmouseenter = ()=>{
    chatBox.classList.add("active");
}

chatBox.onmouseleave = ()=>{
    chatBox.classList.remove("active");
}

setInterval(()=>{
    const xhr = new XMLHttpRequest();
    xhr.open('POST','php/get-chat.php',true);
    xhr.onload = ()=>{
        if(xhr.readyState===XMLHttpRequest.DONE){
            if(xhr.status===200){
                let data = xhr.response;
                chatBox.innerHTML = data;
                scrollToBottom();    
            }
        }
    }
    let formdata = new FormData(form)
    xhr.send(formdata);

},500)

function scrollToBottom(){
    chatBox.scrollTop = chatBox.scrollHeight;
    console.log("lalala");
  }

