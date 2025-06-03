console.log("login.js incarcat");

document.getElementById('loginForm').addEventListener('submit', async e => {
    e.preventDefault();
    console.log("Formular trimis");

    const formData = new FormData(e.target);

    try {
        const res = await fetch('../api/login.php', {
            method: 'POST',
            body: formData,
        });
        console.log("Status raspuns:", res.status);

        const json = await res.json();
        console.log("Raspuns JSON:", json);

        if (res.ok) {
            alert("Autentificare reusita! Se face redirect...");
            localStorage.setItem('token', json.token);
            window.location.href = '../dashboard/dashboard.html';
        } else {
            alert("Autentificare esuata: " + (json.error || 'Eroare necunoscuta'));
        }
    } catch (err) {
        alert("Eroare de retea sau parsare: " + err.message);
        console.error(err);
    }
});
