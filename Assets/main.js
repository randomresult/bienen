var frameSrc = "/scanner/index.html";




$('#scanner').on('show.bs.modal', function (event) {
    $('iframe').attr("src",frameSrc);
});
$('#scanner').on('hidden.bs.modal', function (event) {
    $('iframe').attr("src","");
});
