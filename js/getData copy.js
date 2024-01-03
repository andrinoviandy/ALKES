var search = document.getElementById("keyword")
var table = document.getElementById("table")
var load_flag = 0
var key = '';

const xhr = new XMLHttpRequest()
xhr.onreadystatechange = () => {
    if (xhr.readyState == 4 && xhr.status == 200) {
        table.innerHTML = xhr.responseText
    }
}

loadMore(load_flag, key)
function loadMore(start, keyword) {
    const page = getVars("page");
    if (keyword === '') {
        xhr.open('GET', "data/" + page + ".php?start=" + start, true)
    } else {
        xhr.open('GET', "data/" + page + ".php?start=" + start + "&cari=" + keyword, true)
    }
    xhr.send()
    load_flag = load_flag + 20
    console.log('Loading...', load_flag);
}

search.addEventListener('keyup', function () {
    loadMore(load_flag = 20, key = search.value)
})

jQuery(document).ready(function () {
    jQuery(window).scroll(function () {
        if (jQuery(window).scrollTop() >= jQuery(document).height() - jQuery(window).height() - 1) {
            loadMore(load_flag, key);
        }
    })
})

jQuery(window).ready(function () {
    setTimeout(() => {
        loadMore(load_flag, key)
    }, 500);

})