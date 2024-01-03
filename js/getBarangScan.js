console.log('GET STOK');
var barang_discan = document.getElementById("barang_discan")
var barang_ditemukan = document.getElementById("barang_ditemukan")
var barang_tidakditemukan = document.getElementById("barang_tidakditemukan")


jQuery(window).ready(function () {
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
})