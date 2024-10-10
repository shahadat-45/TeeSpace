const dropArea = document.getElementById('drop-area');
const fileElem = document.getElementById('fileElem');
const browseFiles = document.getElementById('browse-files');
const previewContainer = document.getElementById('preview-container');

['dragenter', 'dragover', 'dragleave', 'drop'].forEach(eventName => {
    dropArea.addEventListener(eventName, preventDefaults, false);
});

['dragenter', 'dragover'].forEach(eventName => {
    dropArea.addEventListener(eventName, () => dropArea.classList.add('hover'), false);
});

['dragleave', 'drop'].forEach(eventName => {
    dropArea.addEventListener(eventName, () => dropArea.classList.remove('hover'), false);
});

dropArea.addEventListener('drop', handleDrop, false);
browseFiles.addEventListener('click', () => fileElem.click());
fileElem.addEventListener('change', handleFiles, false);

function preventDefaults(e) {
    e.preventDefault();
    e.stopPropagation();
}

function handleDrop(e) {
    let dt = e.dataTransfer;
    let files = dt.files;
    handleFiles({ target: { files } });
}

function handleFiles(e) {
    let files = e.target.files;
    if (files.length > 0) {
        previewFile(files[0]);
        uploadFile(files[0]);
    }
}

function previewFile(file) {
    let reader = new FileReader();
    reader.readAsDataURL(file);
    reader.onloadend = () => {
        previewContainer.innerHTML = ''; // Clear any existing preview
        let div = document.createElement('div');
        div.classList.add('preview');
        div.innerHTML = `<img src="${reader.result}" alt="Image preview">
                         <button class="remove-btn" onclick="removePreview()">x</button>`;
        previewContainer.appendChild(div);
    };
}

function removePreview() {
    previewContainer.innerHTML = ''; // Remove preview
    fileElem.value = ''; // Clear the file input
}

/*================= Sceond drop down ================================*/

const dropArea2 = document.getElementById('drop-area2');
const fileElem2 = document.getElementById('fileElem2');
const browseFiles2 = document.getElementById('browse-files2');
const previewContainer2 = document.getElementById('preview-container2');

['dragenter', 'dragover', 'dragleave', 'drop'].forEach(eventName => {
    dropArea2.addEventListener(eventName, preventDefaults, false);
});

['dragenter', 'dragover'].forEach(eventName => {
    dropArea2.addEventListener(eventName, () => dropArea2.classList.add('hover'), false);
});

['dragleave', 'drop'].forEach(eventName => {
    dropArea2.addEventListener(eventName, () => dropArea2.classList.remove('hover'), false);
});

dropArea2.addEventListener('drop', handleDrop2, false);
browseFiles2.addEventListener('click', () => fileElem2.click());
fileElem2.addEventListener('change', handleFiles2, false);

function preventDefaults(e) {
    e.preventDefault();
    e.stopPropagation();
}

function handleDrop2(e) {
    let dt = e.dataTransfer;
    let files = dt.files;
    handleFiles2({ target: { files } });
}

function handleFiles2(e) {
    let files = e.target.files;
    ([...files]).forEach(previewFile2);
    ([...files]).forEach(uploadFile);
}

function previewFile2(file) {
    let reader = new FileReader();
    reader.readAsDataURL(file);
    reader.onloadend = () => {
        let div = document.createElement('div');
        div.classList.add('preview2');
        div.innerHTML = `<img src="${reader.result}" alt="Image preview">
                         <button class="remove-btn" onclick="removePreview(this)">x</button>`;
        previewContainer2.appendChild(div);
    };
}

function removePreview(button) {
    button.parentElement.remove();
}