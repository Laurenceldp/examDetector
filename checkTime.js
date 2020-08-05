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