document.addEventListener("DOMContentLoaded", function() {
    document.getElementById('contactForm').addEventListener('submit', event => {
        event.preventDefault();

        var form = document.getElementById("contactForm");
        const name = document.getElementById('name').value;
        const email = document.getElementById('email').value;
        const message = document.getElementById('message').value;
        var formData = new FormData(form);

        var xhr = new XMLHttpRequest();
        xhr.open("POST", "submit.php", true);

        xhr.onload = function() {
            if (xhr.status === 200) {
                document.getElementById("contactForm").innerHTML = "<p>Thank you, " + form.querySelector('input[name="name"]').value.trim() + ", for contacting me!</p>";
            } else {
                alert("Error: " + xhr.statusText);
            }
        };

        xhr.send(formData);
    });
});