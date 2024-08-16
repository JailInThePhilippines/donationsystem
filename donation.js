function updateDonationOptions() {
    var donationType = document.getElementById("donationType").value;
    var quantityInput = document.getElementById("quantityInput");
    var cashOptions = document.getElementById("cashOptions");
    var customAmount = document.getElementById("customAmount");
    var foodMaterialsInput = document.getElementById("foodMaterialsInput");

    // Hide all options initially
    quantityInput.style.display = "none";
    cashOptions.style.display = "none";
    customAmount.style.display = "none";
    foodMaterialsInput.style.display = "none";

    // Show the relevant options based on the selected donation type
    if (donationType === "food" || donationType === "materials") {
        quantityInput.style.display = "block";
    } else if (donationType === "cash") {
        cashOptions.style.display = "block";
        updateCustomAmount(); // Ensure custom amount is updated based on initial selection
    }
}

function updateCustomAmount() {
    var cashAmount = document.getElementById("cashAmount").value;
    var customAmount = document.getElementById("customAmount");

    // Show the custom amount input if "custom" is selected in the cash options
    customAmount.style.display = cashAmount === "custom" ? "block" : "none";
}

