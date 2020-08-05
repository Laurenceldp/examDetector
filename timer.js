//timer function to get current timestamp
let pageLoadtime;
let endPageTime;

function addZero(num) {
    return num < 10 ? `0${num}` : num;
}

function dateTime() {
    const today = new Date();
    const hours = addZero(today.getHours());
    const minutes = addZero(today.getMinutes());
    const secs = addZero(today.getSeconds());
    return `${hours}:${minutes}:${secs}`;
};

onload = (pageLoadtime = dateTime());
console.log(dateTime());

