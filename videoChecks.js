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
                        if (predictions.length == 0) {
                            console.log ('no faces detected');
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
                