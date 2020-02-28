function upload_images() {
    $('#photoSelection').click();
}

$('#photoSelection').change(function () {
    $('#styledUploader > div').html("<i class='notched circle loading big blue icon'></i><br><br>Upload in Progress");
    $('#uploadPhotos').submit();
});

