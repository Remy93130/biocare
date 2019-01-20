$('#file_upload_file').on('change',function(){
    var fileName = document.getElementById("file_upload_file").files[0].name;
    $(this).next('.custom-file-label').addClass("selected").html(fileName);
});