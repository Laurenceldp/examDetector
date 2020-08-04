<?php
//checks for user logged in 
session_start();
include("conn.php");
ob_start();
if (!isset($_SESSION['clientloggedin'])) {
    header('location:signup.php');
    ob_end_flush();
    $_SESSION['ClientID'];
} else {
    $user = $_SESSION['clientloggedin'];
}
?>

<!doctype html>
<html lang="en">

<head>
    <!-- Required meta tags -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">

    <!-- Bootstrap CSS -->
    <script src="https://cdn.jsdelivr.net/npm/@tensorflow/tfjs/dist/tf.min.js"> </script>
    <script src="https://cdn.jsdelivr.net/npm/@tensorflow-models/facemesh"></script>

    <!-- Load the coco-ssd model. -->
    <script src="https://cdn.jsdelivr.net/npm/@tensorflow-models/coco-ssd@2.0.3"></script>
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>

    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.4.1/css/bootstrap.min.css" integrity="sha384-Vkoo8x4CGsO3+Hhxv8T/Q5PaXtkKtu6ug5TOeNV6gBiFeWPGFN9MuhOf23Q9Ifjh" crossorigin="anonymous">
    <!-- CSS-->
    <link rel="stylesheet" href="css/stylesheet.css">
    <!--Fontawesome CSS-->
    <script src="https://kit.fontawesome.com/1f937cfd44.js" crossorigin="anonymous"></script>


    <title>QuizCheck</title>

    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
</head>
<!--TODO Checks for usertype then displays 2 options for the navbar; client logged or admin logged in.-->

<!--TODO build brain.js model to train from data -->

<body>
    <script>
        //timer function to get current timestamp
        let pageLoadtime;
        let endPageTime;

        function dateTime() {
            let today = new Date();
            let hours = addZero(today.getHours());
            let minutes = addZero(today.getMinutes());
            let secs = addZero(today.getSeconds());
            let currentTime = `${hours}:${minutes}:${secs}`;
            return currentTime;
        };

        function addZero(num) {
            return num < 10 ? `0${num}` : num;
        }
        onload = (pageLoadtime = dateTime());
        console.log(dateTime());
    </script>

    <!--direct css for box and video (issues as part of css file - Bootstrap compatibility? -->
    <style>
        #container {
            margin: 0px auto;
            width: 200px;
            height: 150px;
            border: 2px #333 solid;
        }

        #videoElement {
            width: 200px;
            height: 150px;
            background-color: #666;
        }
    </style>
    <!--nav bar using Bootstrap-->
    <nav class="navbar fixed-top navbar-expand-lg navbar-dark   navbar-custom">
        <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarTogglerDemo01" aria-controls="navbarTogglerDemo01" aria-expanded="false" aria-label="Toggle navigation">
            <span class="navbar-toggler-icon"></span>
        </button>
        <div class="collapse navbar-collapse" id="navbarTogglerDemo01">
            <ul class="navbar-nav mr-auto mt-2 mt-lg-0">
                <li class="nav-itema">
                    <a class="nav-link" href="index.php">Home<span class="sr-only">(current)</span></a>
                </li>
                <li class="nav-itemb">
                    <a class="nav-link" href="about.php">About</a>
                </li>
        </div>
    </nav>

    <div class="row mt-5"></div>
    <div class="container mt-5"> </div>
    <div class="card-body">
        <div class="jumbotron jumbotron-fluid">
            <div class="container">
                <div class="row">
                    <div class="card-body">
                        <div class='col-sm'>
                            <video autoplay="true" id="videoElement">
                                <script>
                                    let videoStartTime;
                                    //starts video stream
                                    var video = document.querySelector("#videoElement");
                                    if (navigator.mediaDevices.getUserMedia) {
                                        navigator.mediaDevices.getUserMedia({
                                                video: true
                                            })
                                            .then(function(stream) {
                                                video.srcObject = stream;
                                                setInterval(function() {
                                                    objects();
                                                }, 4000);
                                            })
                                            .catch(function(err0r) {
                                                console.log("Video stream error");
                                            });
                                    }
                                    //function to check and predict if there are foregin objects in stream - phones, books, TODO headphones
                                    //TODO - train model for better detection
                                    //TODO - return image and alert data to database
                                    async function objects() {
                                        cocoSsd.load().then(model => {
                                            // detect objects in the image.
                                            model.detect(video).then(predictions => {
                                                console.log('Predictions: ', predictions);
                                            });
                                        });

                                    }
                                </script>
                            </video>
                        </div>
                    </div>
                </div>

                <script>
                    const videoFeed = document.querySelector('stream');
                    let model;
                    // checking the video has loaded in, loading face model and setting 3 sec interval to check movements 
                    video.onloadeddata = async (event) => {
                        videoStartTime = dateTime();
                        console.log('video loaded @' + dateTime());
                        // Load the MediaPipe facemesh model.
                        model = await facemesh.load();
                        console.log(model);
                        setInterval(function() {
                            main();
                        }, 3000);
                    };
                    //creating the ajax to store the variables in the database
                    let dir;
                    let canvas;
                    let dataURI;

                    function storingData(ntip) {
                        var formData = {
                            'ntxaxis': ntip[0],
                            'ntyaxis': ntip[1],
                            'ntzaxis': ntip[2],
                            'direct': dir,
                            'canvas': dataURI
                        };

                        // process the form
                        $.ajax({
                            type: 'POST',
                            url: 'https://laurencefay.com/examdetector/pro.php',
                            data: formData,
                            dataType: 'json',
                        })
                    };

                    //main function uses faceMesh to determine and collect 3D facial points and return data 
                    async function main() {
                        const videoElem = document.querySelector('#videoElement');
                        const predictions = await model.estimateFaces(videoElem);
                        if (typeof model.estimateFaces(videoElem) == 'undefined') {
                            console.log('no face present');
                        } else {
                            const ntip = predictions[0]['annotations']['noseTip'];
                            const lCheek = predictions[0]['annotations']['leftCheek'];
                            const rCheek = predictions[0]['annotations']['rightCheek'];
                            const midEye = predictions[0]['annotations']['midwayBetweenEyes'];

                            if (predictions.length > 0) {
                                for (let i = 0; i < predictions.length; i++) {
                                    // console.log(predictions);
                                    const keypoints = predictions[i].annotations;
                                    console.log(ntip[0]);

                                    //nose tip recognition - creates x,y,z axis data points 
                                    //returns alongside captured image to be returned to admin panel.
                                    if (ntip[0][0] > 420) {
                                        dir = 'left';
                                        console.log('Left')
                                        //creating the image canvas for recording alert
                                        canvas = document.createElement('canvas');
                                        canvas.width = 320;
                                        canvas.height = 240;
                                        let ctx = canvas.getContext('2d');
                                        ctx.drawImage(video, 0, 0, canvas.width, canvas.height);
                                        dataURI = canvas.toDataURL('image/jpeg');
                                        // console.log(dataURI);
                                        storingData(ntip[0]);

                                    } else if (ntip[0][0] < 300) {
                                        dir = 'right';
                                        canvas = document.createElement('canvas');
                                        canvas.width = 320;
                                        canvas.height = 240;
                                        let ctx = canvas.getContext('2d');
                                        //draw image to canvas. scale to target dimensions
                                        ctx.drawImage(video, 0, 0, canvas.width, canvas.height);

                                        //convert to desired file format
                                        dataURI = canvas.toDataURL('image/jpeg');
                                        // alert('Head facing Left');
                                        // console.log(dataURI);
                                        console.log('Right')
                                        // alert('Head facing right');
                                        storingData(ntip[0]);
                                    }

                                    //cheek facial point recognition - creates x,y,z axis data points 
                                    //returns alongside captured image to be returned to admin panel.

                                    if ((rCheek[0][0] > 325) || (lCheek[0][0] < 350)) {
                                        if (lCheek[0][0] < 350) {
                                            dir = 'right';
                                            console.log('facing right')
                                            canvasr = document.createElement('canvas');
                                            canvasr.width = 320;
                                            canvasr.height = 240;
                                            let ctxr = canvasr.getContext('2d');
                                            ctxr.drawImage(video, 0, 0, canvasr.width, canvasr.height);
                                            dataURIRC = canvasr.toDataURL('image/jpeg');

                                            // TODO storingData(rCheek[0]);


                                        } else if (rCheek[0][0] > 325) {
                                            dir = 'left';
                                            console.log('facing left')
                                            canvasr = document.createElement('canvas');
                                            canvasr.width = 320;
                                            canvasr.height = 240;
                                            let ctxr = canvasr.getContext('2d');
                                            ctxr.drawImage(video, 0, 0, canvasr.width, canvasr.height);
                                            dataURIRC = canvasr.toDataURL('image/jpeg');

                                            // TODO storingData(lCheek[0]);
                                        }

                                        //   console.log(rCheek[0]+" left cheek "+dateTime());
                                    }
                                    //midEye facial point recognition - creates x,y,z axis data points 
                                    //based on the y axis
                                    //returns alongside captured image to be returned to admin panel.

                                    console.log("mideye " + midEye[0]);

                                    if (midEye[0][1] < 245) {
                                        dir = 'up';
                                        console.log('looking up')
                                        canvasu = document.createElement('canvas');
                                        canvasu.width = 320;
                                        canvasu.height = 240;
                                        let ctxu = canvasu.getContext('2d');
                                        ctxu.drawImage(video, 0, 0, canvasu.width, canvasu.height);
                                        dataURIU = canvasu.toDataURL('image/jpeg');
                                        // TODO storingData(midEye[0]);

                                    } else if (midEye[0][1] > 295) {
                                        dir = 'down';
                                        console.log("looking down");
                                        canvasu = document.createElement('canvas');
                                        canvasu.width = 320;
                                        canvasu.height = 240;
                                        let ctxu = canvasu.getContext('2d');
                                        ctxu.drawImage(video, 0, 0, canvasu.width, canvasu.height);
                                        dataURIU = canvasu.toDataURL('image/jpeg');
                                        // TODO  storingData(midEye[0]);
                                    }
                                }
                            }
                        }
                    }
                </script>


                <script>
                    let visibleChangeCount = 0;
                    let notVisibleChangeCount = 0;
                    let visibleTimeCount;
                    let notVisibleTimeCount;
                    let totalVisTime = 1;
                    let countTime = 0;
                    let dateAndTime
                    let secsOffTab;
                    //checks if the visibility has changed 
                    document.addEventListener("visibilitychange", function() {
                        if (document.visibilityState === 'visible') {
                            startTimer();
                            visibleTimeCount = dateTime();
                            console.log('visible ' + visibleTimeCount);
                            visibleChangeCount += 1;
                            console.log('visible total count =' + visibleChangeCount)
                        } else {
                            //countTime = endTimer();
                            notVisibleTimeCount = dateTime();
                            console.log('not visible ' + notVisibleTimeCount);
                            notVisibleChangeCount += 1;
                            console.log('not visible total count =' + notVisibleChangeCount)

                            /* 
                            TODO issue with returning total times
                            
                            // console.log(endTimer() + " is end timer alone");
                              //console.log(countTime + " this is the seconds as a count inside end");
                              // totalVisTime += countTime; */
                        }
                        let timeES;
                        if (notVisibleChangeCount > 0) {
                            /* let timeStart = new Date();
                    let timeEnd = new Date();
                   visibleTimeCount.split(':');
                    notVisibleTimeCount.split(':');

                    timeStart.setHours(visibleTimeCount[0], visibleTimeCount[1], visibleTimeCount[2], 0)
                    timeEnd.setHours(notVisibleTimeCount[0], notVisibleTimeCount[1], notVisibleTimeCount[2], 0)

                   timeES= (timeEnd - timeStart)/1000;
                     */
                            // millisecond 
                            /* secsOffTab = (notVisibleTimeCount - visibleTimeCount)/1000;
                            secsOffTab /=60;
                            Math.abs(Math.round(secsOffTab));
                            console.log('difference in time is ' + secsOffTab); */
                        }
                        //not working
                        // console.log(totalVisTime + " is total vis time");
                    });

                    //function timeCalc(num1, num2){
                    //    return num1-num2;
                    // }
                </script>

                <script>
                    //checking the time
                    let startTime, endTime, seconds = 0;

                    function startTimer() {
                        startTime = performance.now();
                    };

                    function endTimer() {
                        endTime = performance.now();
                        var timeDiff = endTime - startTime; //in ms 
                        // strip the ms 
                        timeDiff /= 1000;
                        // get seconds 
                        seconds = Math.round(timeDiff);
                        //console.log(seconds + " inside endTime seconds");
                        return seconds;
                    }
                </script>

                <!-- TODO get permission at start of session for all screen access, run 
                in background, take screengrab without click if alerts triggered
                <script src=js/screenGrab.js> </script> </html> -->

                </style>

                <div class='row'>

                    <div class='col'>
                        <h1>Quiz one - no cheating!</h1>
                        <p class="lead">
                            <p>
                                <h1> Name the members of the Beatles (first names only):</h1> <br />
                                <div class="row mt-5"></div>
                                <div class="container">
                                    <form action="goal.php" method="POST">

                                        <div class="row">
                                            <div class="col-lg-4">
                                                <input type="text" class="form-control form-group" placeholder="First" name="first">
                                            </div>
                                            <div class="col-lg-4">
                                                <input type="text" class="form-control form-group" placeholder="Second" name="second">
                                            </div>
                                            <div class="col-lg-4">
                                                <input type="text" class="form-control form-group" placeholder="Third" name="third">
                                            </div>

                                            <div class="col-lg-4">
                                                <input type="text" class="form-control form-group" placeholder="Fourth" name="fourth">
                                            </div>
                                        </div>
                                        <div class="row">
                                            <div class="col-lg-4">
                                                <form class='form-inline my-2 my-lg-0'>
                                                    <a href='qtwo.php' onclick='(endPageTime=dateTime())' class='btn btn-outline-secondary my-2 my-sm-0' name='q1'>Submit</a>
                                                </form>

                                            </div>
                                            <div class="row mt-5"></div>
                                        </div>

                                </div>
                    </div>
                </div>
            </div>



            <footer class="footer">
                <div class="container">
                    <footer class="navbar-fixed-bottom page-footer font-small black darken-3">
                        <div class="container-fluid my-auto">
                            <div class="row">
                                <div class="col-md-4 py-5">
                                </div>
                                <div class="col-md-8 py-5">
                                    <div class="mb-5 flex-center">

                                        <a class="yt-ic" href="https://www.youtube.com/channel/UC0rqucBdTuFTjJiefW5t-IQ">
                                            <i class="fab fa-youtube fa-lg white-text mr-md-5 mr-3 fa-2x"> </i>
                                        </a>

                                        <a class="li-ic" href="https://www.linkedin.com/in/laurence-fay-37a754109/">
                                            <i class="fab fa-linkedin-in fa-lg white-text mr-md-5 mr-3 fa-2x"> </i>
                                        </a>

                                    </div>
                                    <div class="footer-copyright" style="color:rgb(112, 156, 142);" href="https://www.tensorflow.org/">
                                        <p>This project uses TensorFlow</p>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </footer>


</body>

</html>