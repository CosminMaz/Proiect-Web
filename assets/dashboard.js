window.addEventListener("DOMContentLoaded", async () => {
    const token = localStorage.getItem("token");
    console.log("Token from localStorage:", token);

    if (!token) {
        window.location.href = "login.html";
        return;
    }

    const response = await fetch("../main/api/dashboard_data.php", {
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

    if("geolocation" in navigator) {
        navigator.geolocation.getCurrentPosition(
            position => {
                const lat = position.coords.latitude;
                const lon = position.coords.longitude;
                console.log("Lat: ", lat, "Lon: ", lon);
            },
            error => {
                console.error("Eroare Geolocation: ", error.message);
            }
        );
    } else {
        console.warn("Geolocation nu este suportat in browser.");
    }

    document.getElementById("logoutBtn").addEventListener("click", (e) => {
        e.preventDefault();
        localStorage.removeItem("token");
        window.location.href = "../main/index.html"
    })
});
