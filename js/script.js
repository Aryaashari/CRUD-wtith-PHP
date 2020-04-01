// ambil elemen2 yang dibutuhkan
var keyword = document.getElementById('keyword');
var tabel = document.getElementById('tabel');

// tambahkan event
keyword.addEventListener('keyup', function() {

    // siapkan object ajax
    var xhr = new XMLHttpRequest();

    // cek kesiapan ajax
    xhr.onreadystatechange = function(){

        if (xhr.readyState == 4 && xhr.status == 200){
                tabel.innerHTML = xhr.responseText;
        }
    }

    xhr.open('GET', 'ajax/data.php?keyword=' + keyword.value, true);
    xhr.send();

});