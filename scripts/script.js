document.addEventListener("DOMContentLoaded", function () {
    document.getElementById("myForm").addEventListener("submit", function (event) {
        event.preventDefault();

        let formData = new FormData(this);

        fetch("save.php", {
            method: "POST",
            body: formData
        })
        .then(response => response.text())
        .then(data => {
            alert(data);
            if (data.includes("success")) {
                this.reset();
            }
        })
        .catch(error => console.error("Error:", error));
    });
});
