window.addEventListener("DOMContentLoaded", async () => {
    const token = localStorage.getItem("token");
    console.log("Token from localStorage:", token);

    if (!token) {
        window.location.href = "login.html";
        return;
    }

    const response = await fetch("../main/dashboard_data.php", {
        headers: {
            "Authorization": `Bearer ${token}`
        }
    });

    const data = await response.json();

    if (response.ok) {
        document.getElementById("userInfo").innerText = `Salutare ${data.nume} ${data.prenume}`;
    } else {
        alert("Acces neautorizat. Te redirectionam la login.");
        localStorage.removeItem("token");
        window.location.href = "login.html";
    }
});
