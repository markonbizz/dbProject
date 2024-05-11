ImagePreview.onchange = evt => {
    const [file] = ImagePreview.files
    if (file) {
        blah.src = URL.createObjectURL(file)
    }
}