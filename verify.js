
document.addEventListener('DOMContentLoaded', (event) => {
    const inputs = document.querySelectorAll('#otp > input');
    for (let i = 0; i < inputs.length; i++) {
        inputs[i].addEventListener('input', function() {
            if (this.value.length === 1 && i < inputs.length - 1) {
                inputs[i + 1].focus();
            }
            let code = '';
            inputs.forEach(input => {
                code += input.value;
            });
            document.getElementById('code').value = code;
        });
        inputs[i].addEventListener('keydown', function(e) {
            if (e.key === 'Backspace' && this.value === '' && i > 0) {
                inputs[i - 1].focus();
            }
        });
    }

    document.getElementById('otp').addEventListener('paste', function(e) {
        const paste = e.clipboardData.getData('text');
        const pasteArray = paste.split('');
        if (pasteArray.length === inputs.length) {
            inputs.forEach((input, index) => {
                input.value = pasteArray[index];
            });
            let code = '';
            inputs.forEach(input => {
                code += input.value;
            });
            document.getElementById('code').value = code;
        }
        e.preventDefault();
    });
});
