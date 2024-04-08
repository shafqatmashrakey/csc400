// Define questions for each difficulty level
const easyQuestions = [
    {
        question: "What does 'obrigado' mean in English?",
        choices: ["Hello", "Goodbye", "Thank you", "Please"],
        correctAnswer: "Thank you"
    },
    {
        question: "How do you say 'bom dia' in English?",
        choices: ["Good morning", "Goodnight", "Good afternoon", "Goodbye"],
        correctAnswer: "Good morning"
    },
    {
        question: "What is the translation of 'água' in English?",
        choices: ["Fire", "Water", "Air", "Earth"],
        correctAnswer: "Water"
    },
    {
        question: "How do you say 'olá' in English?",
        choices: ["Goodbye", "Thank you", "Hello", "Please"],
        correctAnswer: "Hello"
    },
    {
        question: "What is the translation of 'livro' in English?",
        choices: ["Pen", "Pencil", "Paper", "Book"],
        correctAnswer: "Book"
    }
];


const mediumQuestions = [
    {
        question: "What does 'celular' mean in English?",
        choices: ["Television", "Computer", "Telephone", "Radio"],
        correctAnswer: "Cell phone"
    },
    {
        question: "How do you say 'azul' in English?",
        choices: ["Red", "Blue", "Green", "Yellow"],
        correctAnswer: "Blue"
    },
    {
        question: "What is the translation of 'maçã' in English?",
        choices: ["Apple", "Banana", "Orange", "Grapes"],
        correctAnswer: "Apple"
    },
    {
        question: "How do you say 'school' in Portuguese?",
        choices: ["Escola", "Casa", "Rua", "Prédio"],
        correctAnswer: "Escola"
    },
    {
        question: "What does 'pão' mean in English?",
        choices: ["Rice", "Bread", "Meat", "Cheese"],
        correctAnswer: "Bread"
    }
];


const hardQuestions = [
    {
        question: "What does 'morango' mean in English?",
        choices: ["Apple", "Banana", "Orange", "Strawberry"],
        correctAnswer: "Strawberry"
    },
    {
        question: "How do you say 'computador' in English?",
        choices: ["Computer", "Television", "Telephone", "Radio"],
        correctAnswer: "Computer"
    },
    {
        question: "What does 'morango' mean in English?",
        choices: ["Apple", "Banana", "Orange", "Strawberry"],
        correctAnswer: "Strawberry"
    },
    {
        question: "How do you say 'beach' in Portuguese?",
        choices: ["Praia", "Casa", "Rua", "Prédio"],
        correctAnswer: "Praia"
    },
    {
        question: "What is the word for 'airplane' in Portuguese?",
        choices: ["Carro", "Moto", "Avião", "Barco"],
        correctAnswer: "Avião"
    }
];


// Variables to track quiz state
let currentQuestions = [];
let questionIndex = 0;
let score = 0;
let countdownTimer;

// Function to start the quiz with a specific difficulty
function startQuiz(difficulty) {
    // Hide home page, show quiz page
    document.getElementById('home-page').style.display = 'none';
    document.getElementById('quiz-page').style.display = 'block';

    // Set currentQuestions based on selected difficulty
    if (difficulty === 'easy') {
        currentQuestions = easyQuestions;
    } else if (difficulty === 'medium') {
        currentQuestions = mediumQuestions;
    } else if (difficulty === 'hard') {
        currentQuestions = hardQuestions;
    }

    // Initialize quiz
    questionIndex = 0;
    score = 0;
    updateScore();
    showNextQuestion();
}

// Function to show the next question
function showNextQuestion() {
    if (questionIndex < currentQuestions.length) {
        const question = currentQuestions[questionIndex];
        document.getElementById('question').textContent = question.question;

        const choicesContainer = document.getElementById('choices');
        choicesContainer.innerHTML = '';

        question.choices.forEach((choice, index) => {
            const button = document.createElement('button');
            button.textContent = choice;
            button.addEventListener('click', () => selectAnswer(index));
            choicesContainer.appendChild(button);
        });

        startTimer();
    } else {
        // Quiz ended
        endQuiz();
    }
}

// Function to handle answer selection
function selectAnswer(choiceIndex) {
    const question = currentQuestions[questionIndex];
    const selectedChoice = question.choices[choiceIndex];

    if (selectedChoice === question.correctAnswer) {
        // Correct answer
        score++;
        updateScore();
    }

    questionIndex++;
    showNextQuestion();
}

// Function to update score display
function updateScore() {
    document.getElementById('score').textContent = 'Score: ' + score;
}

// Function to start the countdown timer
function startTimer() {
    let timeLeft = 15;
    countdownTimer = setInterval(() => {
        if (timeLeft > 0) {
            document.getElementById('countdown').textContent = timeLeft;
            timeLeft--;
        } else {
            // Time's up
            clearInterval(countdownTimer);
            document.getElementById('countdown').textContent = 'Time\'s up!';
            setTimeout(() => {
                showNextQuestion();
            }, 1000);
        }
    }, 1000);
}

// Function to end the quiz
function endQuiz() {
    // Hide quiz page, show home page
    document.getElementById('quiz-page').style.display = 'none';
    document.getElementById('home-page').style.display = 'block';

    // Redirect to submit score page
    window.location.href = 'submit_score.html?score=' + score;
}

// Event listeners for difficulty selection buttons
document.getElementById('start-easy').addEventListener('click', () => startQuiz('easy'));
document.getElementById('start-medium').addEventListener('click', () => startQuiz('medium'));
document.getElementById('start-hard').addEventListener('click', () => startQuiz('hard'));
