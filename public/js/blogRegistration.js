$(function () {
    $("#registrationForm").on('submit',function (event) { event.preventDefault()});
    $("#registrationForm").validate({
        focusInvalid: false, 
        rules: {
            username: {
                required: true,
                maxlength: 50
            },
            email: {
                required: true,
                maxlength: 50,
                email: true,
            },
            password: {
                required: true,
                minlength: 8
            },
            repassword: {
                required: true,
                minlength: 8,
                equalTo: "#password"
            }, 
        },
        messages: {
            username: {
                required: "Please enter username",
                maxlength: "Your maxlength should be 50 characters long."
            },
            email: {
                required: "Please enter valid email",
                email: "Please enter valid email",
                maxlength: "The email name should less than or equal to 50 characters",
            },
            password: {
                required: "Please provide a password",
                minlength: "Your password must be at least 8 characters long"
            },
            repassword: {
                required: "Please re-type your password",
                minlength: "Your password must be at least 8 characters long",
                equalTo: "Please enter the same password as above"
            },
        },
        submitHandler: function() {
            document.querySelector('.email').textContent= '';
            document.querySelector('.username').textContent= '';
            let MyUrl= $("#registrationForm").attr('action');
            var registrationForm= document.getElementById('registrationForm');
            var myData = new FormData(registrationForm);
            $.ajax({
                url: MyUrl,
                processData: false,
                contentType: false,
                type: "POST",
                data : myData,
                dataType:"JSON",
                success: function(response) {
                    iziToast.success({
                        message: response.success,
                        position: 'topRight'
                    });
                    console.log('success');
                    console.log(response);
                    $('#myModal').modal('hide');
                },
                error: function (err) {
                    if (err.status == 422) {
                        console.log(err.responseJSON);
                        // you can loop through the errors object and show it to the user
                        console.warn(err.responseJSON.errors);
                        // display errors on each form field
                        $.each(err.responseJSON.errors, function (i, error) {
                            document.querySelector('.'+i).textContent= error[0];
                        });
                    }
                }
            });
        }
    })
});
