function updateImageDescription() {
    const input = document.getElementById('image');
    const description = document.getElementById('image-description');
    if (input.files && input.files[0]) {
        description.textContent = 'Selected image: ' + input.files[0].name;
    } else {
        description.textContent = '';
    }
}

function updateImagesDescription() {
    const input = document.getElementById('images');
    const description = document.getElementById('images-description');
    if (input.files && input.files.length) {
        description.textContent = 'Selected images: ' + Array.from(input.files).map(file => file.name).join(', ');
    } else {
        description.textContent = '';
    }
}

document.addEventListener('DOMContentLoaded', () => {

    const inputElement = document.getElementById('images');
    const inputElementImage = document.getElementById('image');
    
    if (inputElement) {
        inputElement.addEventListener('change', updateImagesDescription);
    }
    if (inputElementImage) {
        inputElementImage.addEventListener('change', updateImageDescription);
    }
});
