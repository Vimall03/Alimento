document.addEventListener("DOMContentLoaded", function () {
    const form = document.querySelector("form");
    
    form.addEventListener("submit", function (event) {
        const preferences = document.querySelector("select[name='preferences[]']");
        const customIngredients = document.querySelector("input[name='custom_ingredients']");

        // Check if at least one preference is selected
        if (!preferences.selectedOptions.length) {
            alert("Please select at least one dietary preference.");
            event.preventDefault(); // Prevent form submission
            return;
        }

        // Check if custom ingredients are provided
        if (customIngredients.value.trim() === "") {
            alert("Please add custom ingredients.");
            event.preventDefault(); // Prevent form submission
            return;
        }
    });
});
