document.getElementById('journalForm').addEventListener('submit', function(event) {
    event.preventDefault();
    
    const formData = new FormData(this);
    
    fetch('submit.php', {
        method: 'POST',
        body: formData
    })
    .then(response => response.text())
    .then(data => {
        if (data === 'success') {
            document.getElementById('confirmationMessage').classList.remove('hidden');
            startConfetti();
        } else {
            alert('There was an error submitting your journal. Please try again.');
        }
    })
    .catch(error => console.error('Error:', error));
});

function startConfetti() {
    const confettiSettings = { target: 'confettiCanvas', max: '80', size: '1', animate: true, props: ['circle', 'square', 'triangle', 'line'], colors: [[165, 104, 246], [230, 61, 135], [0, 199, 228], [253, 214, 126]], clock: '25', rotate: true, width: window.innerWidth, height: window.innerHeight, start_from_edge: true, respawn: true };
    const confetti = new ConfettiGenerator(confettiSettings);
    confetti.render();

    setTimeout(() => {
        confetti.clear();
    }, 5000);
}
