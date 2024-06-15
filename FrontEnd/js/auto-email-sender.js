function sendEmails() {
    fetch('../../BackEnd/php/news_letter.php')
        .then(response => response.text())
        .then(data => console.log(data))
        .catch(error => console.error('Error:', error));
}

// Check if there is already a timer running
let emailTimer = sessionStorage.getItem('emailTimer');
if (!emailTimer) {
    // Start the interval and store the interval ID in sessionStorage
    emailTimer = setInterval(sendEmails, 3000000000); // 300000 milliseconds = 5 minutes
    sessionStorage.setItem('emailTimer', emailTimer.toString());
}
