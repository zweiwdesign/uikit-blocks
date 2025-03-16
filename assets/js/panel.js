document.addEventListener('DOMContentLoaded', () => {
    // Finde das less_code Textarea-Feld
    const lessCodeField = document.querySelector('textarea[name="less_code"]');

    if (lessCodeField) {
        // Erstelle einen Button
        const compileButton = document.createElement('button');
        compileButton.textContent = 'CSS kompilieren';
        compileButton.classList.add('button', 'button--primary', 'uikit-less-compile-button');
        compileButton.style.marginTop = '10px';

        // Füge den Button nach dem Textarea-Feld ein
        lessCodeField.parentElement.appendChild(compileButton);

        // Event Listener für den Button
        compileButton.addEventListener('click', async () => {
            const lessCode = lessCodeField.value;

            try {
                const response = await fetch(kirby.url + '/compile-css/compile', {
                    method: 'POST',
                    headers: {
                        'Content-Type': 'application/json'
                    },
                    body: JSON.stringify({ less_code: lessCode })
                });

                const result = await response.json();

                if (result.status === 'success') {
                    alert(result.message);
                    // Optional: Automatisches Aktualisieren des CSS-Links oder anderer UI-Elemente
                } else {
                    alert(result.message);
                }
            } catch (error) {
                alert('Ein Fehler ist aufgetreten: ' + error.message);
            }
        });
    }
});