let videoStartTime;
//starts video stream
let video = document.querySelector("#videoElement");
if (navigator.mediaDevices.getUserMedia) {
    navigator.mediaDevices.getUserMedia({
        video: true
    }).then(function(stream) {
            video.srcObject = stream;
            setInterval(function() {
                objects();
            }, 4000);
        })
        .catch(function(err0r) {
            console.log("Video stream error", err0r);
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