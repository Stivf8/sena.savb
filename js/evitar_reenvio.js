if(window.history.replaceState){
    console.log("aprobado");
    window.history.replaceState(null,null,window.location.href)
}