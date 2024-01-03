// JavaScript Documentvar xmlhttp = false;
 
try {
xmlhttp = new ActiveXObject("Msxml2.XMLHTTP");
} catch (e) {
try {
xmlhttp = new ActiveXObject("Microsoft.XMLHTTP");
} catch (E) {
xmlhttp = false;
}
}
 
if (!xmlhttp && typeof XMLHttpRequest != 'undefined') {
xmlhttp = new XMLHttpRequest();
}
 
//untuk pencarian mahasiswa
function mahasiswa(searching){
var obj=document.getElementById("pencarian");
var url='index.php?page=barang&searching='+searching;
 
xmlhttp.open("GET", url);
 
xmlhttp.onreadystatechange = function() {
if ( xmlhttp.readyState == 4 && xmlhttp.status == 200 ) {
obj.innerHTML = xmlhttp.responseText;
} else {
obj.innerHTML = "<div align ='center'><img src='ajax-loader.gif' alt='Loading' />Harap Bersabar</div>";
}
}
xmlhttp.send(null);
}