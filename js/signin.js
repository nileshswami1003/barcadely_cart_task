    // USER SIGNIN PROCESS START ======================================
    $("#btnSinginSubmit").click(function (e) {
        e.preventDefault();
        authenticateUser();
    });
    // AUTHENTICATION PROCESS START 
    function authenticateUser() {
        var email = $("#email").val().trim();
        var pass = $("#pass").val().trim();

        // Reset error messages
        $(".error-message").remove();

        // Validate Email
        if (email === "") {
            $("#email").after('<div class="error-message text-danger">Please enter your Email</div>');
            return;
        }

        // Validate Password
        if (pass === "") {
            $("#pass").after('<div class="error-message text-danger">Please enter your Password</div>');
            return;
        }

        var formData = {
            email: email,
            pass: pass
        };

        $.ajax({
            type: "POST",
            url: "submitSigninForm.php", // Replace with the actual PHP file for handling login
            data: formData,
            dataType: "json",
            success: function (response) {
                if (response.success) {
                    // Login successful
                    $("#formMessage").removeClass("text-danger").addClass("text-success").html(response.message);
                    // Clear form fields
                    clearSigninForm();
                    console.log('Role:', response.role);
                    // Redirect based on user role
                    if (response.role === '2') {
                        window.location.href = 'adminDashboard.php';
                    } else if (response.role === '1') {
                        window.location.href = 'customerDashboard.php';
                    }
                } else {
                    // Login failed
                    $("#formMessage").removeClass("text-success").addClass("text-danger").html(response.message);
                }
            },
            error: function (xhr, status, error) {
                console.error("AJAX error: " + status, error);
            }
        });

    }
    // AUTHENTICATION PROCESS END 
    // CLEAR SIGNIN FORM START 
    function clearSigninForm() {
        // Clear form fields
        $("#email, #pass").val('');
    }
    // CLEAR SIGNIN FORM END 
    // USER SIGNIN PROCESS END ========================================
