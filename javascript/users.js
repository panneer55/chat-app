////////////////////////////////////////

const searchBar = document.querySelector(".search input");
const searchbtn = document.querySelector(".search button");
const  users = document.querySelector(".users-list");

searchbtn.onclick = ()=>{
    searchBar.classList.toggle('show');
    searchBar.focus();
    searchbtn.classList.toggle('active');
    searchBar.value = '';
}
searchBar.onkeyup = ()=>{
    let searchTerm = searchBar.value;
    if( searchTerm != ''){
        searchBar.classList.add("active");
    }else{
        searchBar.classList.remove("active");
    }
    const xhr = new XMLHttpRequest();
    xhr.open('POST','php/search.php',true);
    xhr.onload = ()=>{
        if(xhr.readyState===XMLHttpRequest.DONE){
            if(xhr.status===200){
                let data = xhr.response;
                users.innerHTML = data;
            }
        }
    }
    xhr.setRequestHeader("content-type","application/x-www-form-urlencoded")
    xhr.send("searchTerm=" + searchTerm);
}

setInterval(()=>{
    const xhr = new XMLHttpRequest();
    xhr.open('GET','php/users.php',true);
    xhr.onload = ()=>{
        if(xhr.readyState===XMLHttpRequest.DONE){
            if(xhr.status===200){
                let data = xhr.response;
                console.log(data);
                if(!searchBar.classList.contains("active")){
                    users.innerHTML = data;
    
                }
            }
        }
    }
    xhr.send();

},1000)