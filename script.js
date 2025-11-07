$(document).ready(function() {
    $("#regForm").on("submit", function(e) {
        e.preventDefault(); // Prevent default form submission

        // Simple phone number validation
        const phone = $("input[name='phone']").val();
        if (!/^[0-9]{10}$/.test(phone)) {
            alert("Please enter a valid 10-digit phone number");
            return false;
        }

        // AJAX request to submit.php
        $.ajax({
            url: "submit.php",
            type: "POST",
            data: $(this).serialize(),
            success: function(response) {
                $("#message").html(response);
                $("#regForm")[0].reset();
            },
            error: function() {
                $("#message").html("<p style='color:red;'>Error submitting form</p>");
            }
        });
    });
});