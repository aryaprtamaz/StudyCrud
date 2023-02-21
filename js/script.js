$(document).ready(function() { // $ atau jquery bisa memanggil jquery dengan singkat
// hilangkan tombol car
    $('#tombol-serch').hide();
// membuat event ketika keyword ditulis
$('#keyword').on('keyup', function() {
    // munculkan icon loading
    $('.loader').show(); // show memunculkan yg hilang jika hide menghilangkan yg muncul
    
    
    // ajax menggunakan load
    // $('#container').load('ajax/mahasiswa.php?keyword=' + $('#keyword').val());
    

    // $.get()
    $.get('ajax/mahasiswa.php?keyword=' + $('keyword').val(), function(data) {

        $('#container').html(data);
        $('.loader').hide();


        })

    });


});