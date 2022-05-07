function disableselect(e){ 
    return false 
} 
    
function reEnable(){ 
    return true 
}

function disableImageDrag() {
    return false
}

//if IE4+ 
document.onselectstart = new Function ("return false") 
document.oncontextmenu = new Function ("return false") 
document.ondragstart = new Function ("return false")
//if NS6 
if (window.sidebar){ 
    document.onmousedown = disableselect
    document.onclick = reEnable
}