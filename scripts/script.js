document.getElementById('myForm').addEventListener('submit', function(event) {
    event.preventDefault();
    const formData = new FormData(this);
    fetch('./save.php', {
        method: 'POST',
        body: formData
    })
    .then(response => response.text())
    .then(data => console.log('Form submitted successfully!'))
});
