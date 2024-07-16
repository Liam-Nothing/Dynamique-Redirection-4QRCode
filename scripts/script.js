function editButton(buttonName, currentUrl, currentTitle, currentColor) {
    $('#buttonName').val(buttonName);
    $('#buttonUrl').val(currentUrl);
    $('#buttonTitle').val(currentTitle);
    $('#buttonColor').val(currentColor);
    $('#editButtonModal').modal('show');
}
