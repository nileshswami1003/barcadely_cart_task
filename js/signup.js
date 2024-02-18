// USER SIGNUP PROCESS START ======================================
$("#btnSignupSubmit").click(function (e) {
    e.preventDefault();
    validateForm();
});
// SIGNUP VALIDATION PROCESS START
function validateForm() {
    var fname = $("#fname").val().trim();
    var lname = $("#lname").val().trim();
    var email = $("#email").val().trim();
    var cpass = $("#cpass").val().trim();

    // Reset error messages
    $(".error-message").remove();

    // Validate First Name
    if (fname === "") {
        $("#fname").after('<div class="error-message text-danger">Please enter your First Name</div>');
    }

    // Validate Last Name
    if (lname === "") {
        $("#lname").after('<div class="error-message text-danger">Please enter your Last Name</div>');
    }

    // Validate Email
    if (email === "") {
        $("#email").after('<div class="error-message text-danger">Please enter your Email</div>');
    } else {
        var emailRegex = /^[^\s@]+@[^\s@]+\.[^\s@]+$/;
        if (!emailRegex.test(email)) {
            $("#email").after('<div class="error-message text-danger">Please enter a valid Email</div>');
        }
    }

    // Validate Create Password
    if (cpass === "") {
        $("#cpass").after('<div class="error-message text-danger">Please enter your Create Password</div>');
    } else {
        // Password should contain at least one lowercase letter, one uppercase letter,
        // one digit, no special characters, and be between 8 to 50 characters long
        var passwordRegex = /^(?=.*[a-z])(?=.*[A-Z])(?=.*\d)(?=.*[@$!%*?&])[A-Za-z\d@$!%*?&]{8,50}$/;
        if (!passwordRegex.test(cpass)) {
            $("#cpass").after('<div class="error-message text-danger">Password must meet the criteria</div>');
        }
    }

    // Check if there are no error messages, then submit the form
    if ($(".error-message").length === 0) {
        // Uncomment the following line to submit the form
        // $("form").submit();
        // alert("Form submitted successfully!");
        submitSignupForm();
    }
}
// SIGNUP VALIDATION PROCESS END
// SIGNUP FORM SUBMIT PROCESS START
function submitSignupForm() {
    var formData = {
        fname: $("#fname").val(),
        lname: $("#lname").val(),
        email: $("#email").val(),
        cpass: $("#cpass").val()
    };

    $.ajax({
        type: "POST",
        url: "submitSignupForm.php", // Replace with the actual PHP file to handle form submission
        data: formData,
        success: function (response) {
            if (response.success) {
                // Display success message
                $("#formMessage").removeClass("text-danger").addClass("text-success").html(response.message);
                clearSignupForm();
            } else {
                // Display error message
                $("#formMessage").removeClass("text-success").addClass("text-danger").html(response.message);
            }
            // You can add further actions here based on the server response
        },
        error: function (xhr, status, error) {
            console.error("AJAX error: " + status, error);
        }
    });
}
// SIGNUP FORM SUBMIT PROCESS END
// SIGNUP FORM CLEAR PROCESS START
function clearSignupForm() {
    // Clear form fields
    $("#fname, #lname, #email, #cpass").val('');
}
// SIGNUP FORM CLEAR PROCESS END
// USER SIGNUP PROCESS END ========================================
