<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="../assets/meeting_page.css">
    <title>Room - <?php echo $_POST['meeting_name'] ?></title>
    <script src='https://meet.jit.si/external_api.js'></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.6.0/jquery.min.js"></script>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/@sweetalert2/theme-dark@5/dark.css"/>
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11/dist/sweetalert2.min.js"></script>
</head>

<body>
<div id="spinner-div">
    <div class="spinner-border text-primary" role="status">
    </div>
</div>
<section>
    <div class="timer">
        <span id="date_time">⏳ </span>
    </div>

    <form id="leave_form">

        <div class="meet">
            <span>🖥   <?php echo $_POST['meeting_name'] ?> </span>
            <button id="leave">LEAVE</button>


            <input type="hidden" value="<?php echo $participent_name ?>" name="participents_name">
            <input type="hidden" value="<?php echo $meeting_title ?>" name="meeting_title">
            <input type="hidden" value="<?php echo $timestamp ?>" name="time_stamp">

    </form>
    </div>

    <section id="main_meet" class="main">

        <h2 class="sorry_text">Sorry 😢 </h2>
        <div id="meeting"></div>

    </section>

</section>


<script type="text/javascript">
    const domain = 'meet.jit.si';
    const options = {
        roomName: '<?php echo $meeting_id;?>',
        width: "100%",
        height: 530.6,
        parentNode: document.querySelector('#meeting'),
        interfaceConfigOverwrite: {
            SHOW_CHROME_EXTENSION_BANNER: false,
        },

        userInfo: {
            displayName: '<?php echo $participent_name;?>'
        },
        configOverwrite: {
            enableWelcomePage: false,
            enableClosePage: false,
        },
        onload: function () {
        }
    };
    const api = new JitsiMeetExternalAPI(domain, options);

    document.querySelectorAll(".toolbox-button").forEach(i => i.addEventListener(
        "click",
        e => {
            alert(e.currentTarget.dataset.myDataContent);
        }));
</script>
<script>
    const Toast = Swal.mixin({
        toast: true,
        position: 'top-end',
        showConfirmButton: false,
        timer: 3000,
        timerProgressBar: true,
        didOpen: (toast) => {
            toast.addEventListener('mouseenter', Swal.stopTimer)
            toast.addEventListener('mouseleave', Swal.resumeTimer)
        }
    })

    $(function () {
        $('#leave').bind('click', function (event) {

            // using this page stop being refreshing
            event.preventDefault();


            $("#spinner-div").show(); //Request is complete so hide spinner

            $.ajax({
                type: 'POST',
                url: 'leave.php',
                data: $('#leave_form').serialize(),

                success: function (response) {

                    $("#spinner-div").hide(); //Request is complete so hide spinner
                    var jsonData = JSON.parse(response);

                    // user is logged in successfully in the back-end
                    // let's redirect

                    switch (jsonData.response) {
                        case 0:
                            Toast.fire({
                                icon: 'info',
                                title: 'Thank you for Joining 🥲'
                            }).then(function () {
                                window.location = "index.php";

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

<script type="text/javascript">
    const c_date = new Date();

    var filterd_date = c_date.toLocaleDateString('hi-IN', options);
    var filterd_time = c_date.toLocaleTimeString('hi-IN', options);

    function startTime() {
        const today = new Date();
        let h = today.getHours();
        let m = today.getMinutes();
        let s = today.getSeconds();
        var ampm = h >= 12 ? ' PM' : ' AM';
        m = checkTime(m);
        s = checkTime(s);
        setTimeout(startTime, 1000);
        document.getElementById('date_time').innerHTML = "⏳" + h + ":" + m + ":" + s + ampm + "  -  " + "📆" + filterd_date;
    }

    startTime();

    function checkTime(i) {
        if (i < 10) {
            i = "0" + i
        }
        ;  // add zero in front of numbers < 10
        return i;
    }


</script>


</body>
</html>