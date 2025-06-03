document.getElementById('registerForm').addEventListener('submit', function(e) {
    e.preventDefault(); // previne trimiterea normala a formularului

    const formData = new FormData(this);

    fetch('../api/register.php', {
        method: 'POST',
        body: formData
    })
    .then(async response => {
        const text = await response.text();

        if (response.ok) {
            window.location.href = '../login/login.html';
        } else {
            alert(text); 
        }
    })
    .catch(() => alert('Eroare la comunicarea cu serverul.'));
});
