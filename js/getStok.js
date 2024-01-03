console.log('GET STOK');
var kode = document.getElementById("kode")
var input_kode = document.getElementById("input_kode")
var data = document.getElementById("data")
var load_flag = 0
var key = '';
console.log('GET STOK');
var barang_discan = document.getElementById("barang_discan")
var barang_ditemukan = document.getElementById("barang_ditemukan")
var barang_tidakditemukan = document.getElementById("barang_tidakditemukan")

function getStok() {
    const id = getVars("id");

    const xhr1 = new XMLHttpRequest()
    xhr1.onreadystatechange = () => {
        if (xhr1.readyState == 4 && xhr1.status == 200) {
            barang_discan.innerHTML = xhr1.responseText
        }
    }
    xhr1.open('GET', "data/barangdiscan.php?id=" + id, true)
    xhr1.send()

    const xhr2 = new XMLHttpRequest()
    xhr2.onreadystatechange = () => {
        if (xhr2.readyState == 4 && xhr2.status == 200) {
            barang_ditemukan.innerHTML = xhr2.responseText
        }
    }
    xhr2.open('GET', "data/barangditemukan.php?id=" + id, true)
    xhr2.send()

    const xhr3 = new XMLHttpRequest()
    xhr3.onreadystatechange = () => {
        if (xhr3.readyState == 4 && xhr3.status == 200) {
            barang_tidakditemukan.innerHTML = xhr3.responseText
        }
    }
    xhr3.open('GET', "data/barangtidakditemukan.php?id=" + id, true)
    xhr3.send()
}
getStok();

kode.addEventListener('change', function() {
    getStok();
        const xhr = new XMLHttpRequest()
        xhr.onreadystatechange = () => {
            if (xhr.readyState == 4 && xhr.status == 200) {
                data.innerHTML = xhr.responseText
            }
        }
        const id = getVars("id");
        const kunci = getVars("kunci");
        const page = getVars("page");
        if (kode.value !== '') {
            xhr.open('GET', "data/data_stok.php?page=" + page + "&id=" + id + "&kode=" + kode.value, true)
            xhr.send()
            
            kode.value = '';
        }
    
})
    
