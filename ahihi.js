let retryCount = 0;
const maxRetries = Math.floor(Math.random() * 4) + 4;

function retryConnection() {
    retryCount++;
    
    if (retryCount >= maxRetries) {
        window.location.href = "surprise.html";
    } else {

        document.querySelector("h1").innerText = "Connection error...";
        setTimeout(() => {
            document.querySelector("h1").innerText = "No Internet Connection";
        }, 1000);
    }
}
