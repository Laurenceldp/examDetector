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