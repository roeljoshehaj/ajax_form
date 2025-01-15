document.getElementById('myForm').addEventListener('submit', function(event) {
    event.preventDefault();

    const first_name = document.getElementById('floating_first_name').value;
    const last_name = document.getElementById('floating_last_name').value;
    const city = document.getElementById('floating_city').value;
    const address = document.getElementById('floating_adress').value;

    alert(`Form submitted! \nName: ${firstName} ${lastName} \nCity: ${city} \nAddress: ${address}`);
});
