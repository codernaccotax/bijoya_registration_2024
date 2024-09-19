
const checkbox = document.getElementById('agreeCheckbox');
const submitButton = document.getElementById('submitButton');
console.log(submitButton);
// Function to toggle the disabled state of the button
function toggleSubmitButton() {
    if (checkbox.checked) {
        submitButton.disabled = false;
        submitButton.classList.remove('disabled');
    } else {
        submitButton.disabled = true;
        submitButton.classList.add('disabled');
    }
}

// Add event listener to the checkbox
checkbox.addEventListener('change', toggleSubmitButton);





function validateForm() {
    const phone = document.getElementById("phone").value;
    const whatsapp = document.getElementById("whatsapp").value;
    const sameAsPhone = document.getElementById("same_as_phone").checked;
    const age = document.getElementById("age").value;

    if (!phone.match(/^\d{10}$/)) {
        alert("Phone number must be 10 digits.");
        return false;
    }

    if (!sameAsPhone && !whatsapp.match(/^\d{10}$/)) {
        alert("WhatsApp number must be 10 digits.");
        return false;
    }

    if (age <= 0 || age > 120) {
        alert("Please enter a valid age.");
        return false;
    }

    return true;
}

function toggleWhatsapp() {
    const sameAsPhone = document.getElementById("same_as_phone").checked;
    const whatsappInput = document.getElementById("whatsapp");
    whatsappInput.disabled = sameAsPhone;
}


