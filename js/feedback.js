function getUsernameFromLocalStorage() {
    return localStorage.getItem('username');
}

function getFinalScoreFromServer(username) {
    const xhr = new XMLHttpRequest();
    xhr.open("POST", "find_score.php", true);
    xhr.setRequestHeader("Content-Type", "application/x-www-form-urlencoded");
    xhr.onreadystatechange = function () {
        if (xhr.readyState === XMLHttpRequest.DONE) {
            if (xhr.status === 200) {
                const score = xhr.responseText;
                document.getElementById("score").textContent = score;
                updateFeedbackText(score);
                showNextButton(score);
            } else {
                console.error("Error retrieving final score:", xhr.statusText);
            }
        }
    };
    xhr.send("username=" + encodeURIComponent(username));
}

function updateFeedbackText(score) {
    const feedbackTextElement = document.getElementById("feedback-text");
    if (parseInt(score) >= 7) {
        feedbackTextElement.textContent = "Congratulations, you passed! Please click Next to print your certification.";
    } else {
        feedbackTextElement.textContent = "Unfortunately, you did not pass this quiz. Please review your notes before attempting again.";
    }
}

function showNextButton(score) {
    const nextButton = document.getElementById("next-button");
    if (parseInt(score) >= 7) {
        nextButton.textContent = "Next";
        nextButton.onclick = function () {
            window.location.href = 'certification.html';
        };
        nextButton.style.display = "block";
    } else {
        nextButton.textContent = "Try Again";
        nextButton.onclick = function () {
            window.location.href = 'find_word_content.html';
        };
        nextButton.style.display = "block";
    }
}


function goToNextPage() {
    window.location.href = 'certification.html';
}

window.onload = function () {
    const username = getUsernameFromLocalStorage();
    if (username) {
        getFinalScoreFromServer(username);
    } else {
        console.error("Username not found in localStorage.");
    }

};
