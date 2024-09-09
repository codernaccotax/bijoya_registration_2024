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