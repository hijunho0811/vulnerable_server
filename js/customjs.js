function chkext(){
    var fileext = document.getElementById('my-file-selecter.value').value;

    fileext = fileext.slice(fileext.indexOf(".") + 1).toLowerCase();

    if(fileext != "jpg" && fileext!="png" && fileext !="gif" && fileext != "bmp" && fileext != "zip" && fileext!="pdf" &&fileext != "txt"){
        alert('허용된 확장자가 아닙니다!');
        return false;
    }

}
