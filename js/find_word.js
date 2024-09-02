let questions = [];
let currentQuestionIndex = 0;
let remainingGuesses = 2;
let correctGuesses = 0;

async function fetchQuestionsFromStorage() {
    try {
        const rawData = localStorage.getItem("questions");
        const questionsData = JSON.parse(rawData);

        if (Array.isArray(questionsData) && questionsData.length > 0) {
            questions = questionsData.map(item => ({
                question: item.Question,
                answer: item.Answer
            }));

        } else {
            console.error('No valid questions found in localStorage.');
        }
    } catch (error) {
        console.error('Error fetching questions:', error);
    }
}

function displayQuestion() {
    if (currentQuestionIndex < questions.length) {
        const currentQuestion = questions[currentQuestionIndex];
        document.getElementById("displayQuestion").textContent = currentQuestion.question;
        document.getElementById("answer-input").value = "";

        const questionsLeft = questions.length - currentQuestionIndex - 1;
        document.getElementById("questions-left").textContent = `Questions left: ${questionsLeft}`;
    }
}

function checkAnswer() {
    const answerInput = document.getElementById("answer-input").value.trim().toLowerCase();
    const currentQuestion = questions[currentQuestionIndex];
    const correctAnswer = currentQuestion.answer.toLowerCase().trim();

    if (answerInput === correctAnswer) {
        alert("Congratulations! You guessed the correct answer!");
        updateScore(true);
    } else {
        remainingGuesses--;
        if (remainingGuesses === 0) {
            alert("Sorry, you've used all your chances. The correct answer was: " + correctAnswer);
            updateScore(false);
        } else {
            alert("Sorry, that's incorrect. You have " + remainingGuesses + " chance(s) remaining. Try again!");
        }
    }

    document.getElementById("answer-input").value = "";
}

function updateScore(isCorrect) {
    if (isCorrect) {
        correctGuesses++;
    }

    if (currentQuestionIndex < questions.length - 1) {
        currentQuestionIndex++;
        remainingGuesses = 2;
        displayQuestion();
    } else {
        const finalScore = correctGuesses;
        const username = localStorage.getItem('username');
    }
}

function saveFinalScore(score, username) {
    const xhr = new XMLHttpRequest();
    xhr.open("POST", "Game_History.php", true);
    xhr.setRequestHeader("Content-Type", "application/x-www-form-urlencoded");
    xhr.onreadystatechange = function () {
        if (xhr.readyState === XMLHttpRequest.DONE) {
            if (xhr.status === 200) {
                console.log(xhr.responseText);
                window.location.href = "feedback.html";
            } else {
                console.error("Error saving final score:", xhr.statusText);
            }
        }
    };
    xhr.send("score=" + encodeURIComponent(score) + "&username=" + encodeURIComponent(username));
}

async function initializeGame() {
    try {
        await fetchQuestionsFromStorage();
        if (questions.length > 0) {
            currentQuestionIndex = 0;
            remainingGuesses = 2;
            correctGuesses = 0;
            displayQuestion();

        } else {
            console.error('No questions fetched.');
        }
    } catch (error) {
        console.error('Error initializing game:', error);
    }
}

document.getElementById("answer-input").addEventListener("keypress", function (event) {
    if (event.keyCode === 13) {
        event.preventDefault();
        if (currentQuestionIndex === questions.length - 1) {
            if (remainingGuesses > 0) {
                checkAnswer();
            } else {
                alert("Sorry, you've used all your chances.");
            }
            alert("To end the game, please click 'Skip Question'.");
        } else if (remainingGuesses > 0) {
            checkAnswer();
        } else {
            alert("Sorry, you've used all your chances.");
        }
    }
});

document.getElementById("next-question").addEventListener("click", function (event) {
    event.preventDefault();
    if (currentQuestionIndex < questions.length - 1) {
        currentQuestionIndex++;
        if (currentQuestionIndex === questions.length - 1) {
            document.getElementById("next-question").textContent = "Finish Game";
            document.getElementById("next-question").onclick = function () {
                const finalScore = correctGuesses;
                const username = localStorage.getItem('username');
                saveFinalScore(finalScore, username);
            };
        }
        displayQuestion();
    } else {
        const finalScore = correctGuesses;
        const username = localStorage.getItem('username');
        saveFinalScore(finalScore, username);
    }
});


initializeGame();
