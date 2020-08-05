
                                    //check for audio permission
                                    navigator.permissions.query({
                                        name: 'microphone'
                                    }).then(function(result) {
                                        if (result.state == 'granted') {
                                            // soundProcess('granted');
                                        } else if (result.state == 'prompt') {
                                            //  soundProcess();
                                            console.log('prompted');
                                        } else if (result.state == 'denied') {
                                            console.log('denied');
                                        }
                                        console.log(result.state + " result state");
                                        result.onchange = function() {

                                        };
                                    });

                                    var audioContext = null;
                                    var meter = null;
                                    var canvasContext = null;
                                    var WIDTH = 500;
                                    var HEIGHT = 50;
                                    var rafID = null;

                                    window.onload = function() {

                                        // monkeypatch Web Audio
                                        window.AudioContext = window.AudioContext || window.webkitAudioContext;

                                        // grab an audio context
                                        audioContext = new AudioContext();

                                        // Attempt to get audio input
                                        try {
                                            // monkeypatch getUserMedia
                                            navigator.getUserMedia =
                                                navigator.getUserMedia ||
                                                navigator.webkitGetUserMedia ||
                                                navigator.mozGetUserMedia;

                                            // ask for an audio input
                                            navigator.getUserMedia({
                                                "audio": {
                                                    "mandatory": {
                                                        "googEchoCancellation": "false",
                                                        "googAutoGainControl": "false",
                                                        "googNoiseSuppression": "false",
                                                        "googHighpassFilter": "false"
                                                    },
                                                    "optional": []
                                                },
                                            }, gotStream, didntGetStream);
                                        } catch (e) {
                                            alert('getUserMedia threw exception :' + e);
                                        }

                                    }


                                    function didntGetStream() {
                                        alert('Stream generation failed.');
                                    }

                                    var mediaStreamSource = null;

                                    function gotStream(stream) {
                                        console.log('got stream 178');
                                        // Create an AudioNode from the stream.
                                        mediaStreamSource = audioContext.createMediaStreamSource(stream);

                                        // Create a new volume meter and connect it.
                                        meter = createAudioMeter(audioContext);
                                        mediaStreamSource.connect(meter);
                                        setInterval(function() {
                                            if (meter.volume>0.00){
                                              console.log(volumeAudioProcess().this.volume);
                                              meter.shutdown();  
                                            }
                                             }, 1000);;
                                        // kick off the visual updating
                                        //  drawLoop();
                                    }
                                    /*  var audioContext = null;
                                     var meter = null;
                                     var canvasContext = null;
                                     var WIDTH = 500;
                                     var HEIGHT = 50;
                                     var rafID = null;

                                     audioContext = new AudioContext();

                                     function soundProcess() {
                                         const handleSuccess = function(stream) {
                                             const context = new AudioContext();
                                             const source = context.createMediaStreamSource(stream);
                                             const processor = context.createScriptProcessor(1024, 1, 1);

                                             source.connect(processor);
                                             processor.connect(context.destination);

                                             processor.onaudioprocess = function(e) {
                                                 gotStream()
                                                 // Do something with the data, e.g. convert it to WAV
                                                 // console.log(e.inputBuffer);
                                             };
                                         };

                                         navigator.mediaDevices.getUserMedia({
                                                 audio: true,

                                             })
                                             .then(handleSuccess);
                                     }

                                     var mediaStreamSource = null;

                                     function gotStream(stream) {
                                         // Create an AudioNode from the stream.
                                         mediaStreamSource = audioContext.createMediaStreamSource(stream);

                                         // Create a new volume meter and connect it.
                                         meter = createAudioMeter(audioContext);
                                         mediaStreamSource.connect(meter);
                                         console.log(volumeAudioProcess().this.volume);
                                         // kick off the visual updating
                                         // drawLoop();
                                     } */