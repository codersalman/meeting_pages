<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="assets/login.css">
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.6.0/jquery.min.js"></script>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/@sweetalert2/theme-dark@5/dark.css"/>
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11/dist/sweetalert2.min.js"></script>
    <title>LOGIN</title>
</head>
<body>
<section>
    <h2>😃 Good Morning, Admin </h2>
    <br>
    <div class="form bg">
        <h2 class="bg"><span>🔐</span> LOGIN</h2>
        <form class="bg" action="#">
            <label class="bg" style="text-align: left;">Email</label><br>
            <input type="email"name="email" placeholder="Enter Your Email Address">
            <br>
            <label class="bg" style="text-align: left;">Password</label><br>
            <input type="password" name="password" placeholder="Enter Your Password Here">
            <br>
            <button type="submit" id="login">LOGIN</button>
        </form>
    </div>


    <script>const Toast = Swal.mixin({
            toast: true,
            position: 'top',
            showConfirmButton: false,
            timer: 3000,
            timerProgressBar: true,
            didOpen: (toast) => {
                toast.addEventListener('mouseenter', Swal.stopTimer)
                toast.addEventListener('mouseleave', Swal.resumeTimer)
            }
        })
    </script>
</section>
<script>


    $(function () {
        $('#login').bind('click', function (event) {

            // using this page stop being refreshing
            event.preventDefault();


            $("#spinner-div").show(); //Request is complete so hide spinner

            $.ajax({
                type: 'POST',
                url: 'do_login.php',
                data: $('form').serialize(),

                success: function (response) {

                    $("#spinner-div").hide(); //Request is complete so hide spinner
                    var jsonData = JSON.parse(response);

                    // user is logged in successfully in the back-end
                    // let's redirect

                    switch (jsonData.response) {
                        case 0:

                            Toast.fire({
                                icon: 'success',
                                title: 'Logged in successfully 🥳 '
                            }).then(function () {
                                window.location = "dashboard.php";
                            });
                            break;
                        case 'USER_DISABLED':
                            Toast.fire({
                                icon: 'warning',
                                title: 'Your Account is Banned 😕'
                            }).then(function () {
                                //
                            });
                            break;
                        case 'INVALID_PASSWORD':
                            Toast.fire({
                                icon: 'warning',
                                title: 'The password you entered is incorrect 😐'
                            }).then(function () {
                                //
                            });
                            break;
                        case 'A password must be a string with at least 6 characters.':
                            Toast.fire({
                                icon: 'info',
                                title: 'Use at least 6 characters password 😐'
                            }).then(function () {

                            });
                            break;
                        case 'TOO_MANY_ATTEMPTS_TRY_LATER : Access to this account has been temporarily disabled due to many failed login attempts. You can immediately restore it by resetting your password or you can try again later.':
                            Toast.fire({
                                icon: 'warning',
                                title: ' Access to this account has been temporarily disabled due to many failed login attempts 😐'
                            }).then(function () {
                                //
                            });
                            break;
                        case 2:
                            Toast.fire({
                                icon: 'info',
                                title: 'User Not Found 🥲'
                            }).then(function () {
                                //
                            });
                    }

                }
            });
            Error(function (XMLHttpRequest, textStatus, errorThrown) {
                alert("Try Again " + textStatus);
                $("#spinner-div").hide(); //Request is complete so hide spinner


            });

        });
    });


</script>
</body>
</html>