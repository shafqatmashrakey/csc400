let paragraphText = document.getElementById('paragraphText');

function speakParagraphEnglish() {
    const speech = new SpeechSynthesisUtterance(paragraphText.innerText);
    speech.lang = 'en-US';
    speech.volume = 1;
    speech.rate = 1;
    speech.pitch = 1;

    window.speechSynthesis.speak(speech);
}

