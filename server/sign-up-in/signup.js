$(document).ready(function() {
    $('#client-form').submit(function(e) {
        e.preventDefault(); // Prevent default form submission
        $.ajax({
            type: 'POST',
            url: $(this).attr('action'), // URL from form's action attribute
            data: $(this).serialize(), // Serialize form data
            success: function(response) {
                // Handle response from the server
                var clientAlert = document.getElementById("client-alert");
                clientAlert.style="display:block !important;"
                console.log(response)
                if(response === "0"){
                    clientAlert.classList.remove("alert-warning");
                    // Add the 'alert-success' class
                    clientAlert.classList.add("alert-success");
                    document.getElementById("client-alert-head").innerHTML = "Success";
                    document.getElementById("client-alert-par").innerHTML = "User created successfully";
                }else if(response === "1"){
                    console.log("inside");
                    clientAlert.classList.remove("alert-success");
                    // Add the 'alert-success' class
                    clientAlert.classList.add("alert-warning");                    
                    document.getElementById("client-alert-head").innerHTML = "Alert!!";
                    document.getElementById("client-alert-par").innerHTML = "Username already used";
                }else if(response === "2"){
                    clientAlert.classList.remove("alert-success");
                    // Add the 'alert-success' class
                    clientAlert.classList.add("alert-warning");                    
                    document.getElementById("client-alert-head").innerHTML = "Alert!!";
                    document.getElementById("client-alert-par").innerHTML = "Email already used";
                }
            },
            error: function(xhr, status, error) {
                // Handle errors
                console.error(error);
            }
        });
    });
    $('#HR-form').submit(function(e) {
        e.preventDefault(); // Prevent default form submission
        $.ajax({
            type: 'POST',
            url: $(this).attr('action'), // URL from form's action attribute
            data: $(this).serialize(), // Serialize form data
            success: function(response) {
                // Handle response from the server
                console.log(response);
                if(response === "0"){
                    document.getElementById("HR_alert").style = "display: none !important;"
                    document.getElementById("HR_alert").innerHTML = ""
                }else if(response === "1"){
                    document.getElementById("HR_alert").style = "display: block !important;"
                    document.getElementById("HR_alert").innerHTML = "Password incorrect"
                }else if(response === "2"){
                    document.getElementById("HR_alert").style = "display: block !important;"
                    document.getElementById("HR_alert").innerHTML = "User not found"
                }
            },
            error: function(xhr, status, error) {
                // Handle errors
                console.error(error);
            }
        });
    });
});