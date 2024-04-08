const beginnerWords = ['hola', 'adios', 'gracias', 'cuando', 'donde', 'familia', 'amigo'];
const intermediateWords = ['viajar', 'nadar', 'comprar', 'manejar'];
const advancedWords = ['felicitaciones', 'solucionar', 'cuatrocientos', 'restaurante'];

let words = beginnerWords;

function chooseLevel(level) {
    document.getElementById('score').innerText = '0';
    score = 0;
    switch (level) {
        case 'beginner':
            words = beginnerWords;
            break;
        case 'intermediate':
            words = intermediateWords;
            break;
        case 'advanced':
            words = advancedWords;
            break;
        default:
            words = beginnerWords;
    }
    createWord();
}

function difficulty() {
    chooseLevel(document.getElementById('mode').options[document.getElementById('mode').selectedIndex].value);
}


document.addEventListener('DOMContentLoaded', function() {
    document.getElementById('mode').addEventListener('change', difficulty);
});

let wordDisplay;
let mixed;
let score = 0;

function createWord() {
    wordDisplay = Math.floor(Math.random() * words.length);
    const word = words[wordDisplay];
    mixed = jumble(word);
    document.getElementById('word').innerText = mixed;
    document.getElementById('userInput').value = '';
    document.getElementById('message').innerText = '';
}

function jumble(word) {
    const array = word.split('')
    for (let i = array.length - 1; i > 0; i--) {
        const j = Math.floor(Math.random() * (i + 1));
        [array[i], array[j]] = [array[j], array[i]];
    }
    return array.join('');
}

function findWord() {
    const predict = document.getElementById('userInput').value.toLowerCase();
    const primaryWord = words[wordDisplay];

    if (predict === primaryWord) {
        document.getElementById('message').innerText = 'Correct';
        score++;
        document.getElementById('score').innerText = score;
    } else {
        document.getElementById('message').innerText = 'Incorrect';
    }
}

createWord();