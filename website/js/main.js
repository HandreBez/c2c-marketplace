/* DELETE CONFIRMATION */

function confirmDelete(message = "Are you sure you want to delete this?") {
    return confirm(message);
}


/* IMAGE PREVIEW FOR PRODUCT UPLOAD */

function previewImage(event) {

    const preview = document.getElementById("image-preview");

    if (!preview) return;

    const file = event.target.files[0];

    if (file) {
        preview.src = URL.createObjectURL(file);
        preview.style.display = "block";
    }

}

