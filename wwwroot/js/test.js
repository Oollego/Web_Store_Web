//document.addEventListener('DOMContentLoaded', function() {


//     duration	Number	200	//Transition duration in milliseconds.
// dist	Number	-100	//Perspective zoom. If 0, all items are the same size.
// shift	Number	0	//Set the spacing of the center item.
// padding	Number	0	//Set the padding between non center items.
// numVisible	Number	5	//Set the number of visible items.
// fullWidth	Boolean	false	//Make the carousel a full width slider like the second example.
// indicators	Boolean	false	//Set to true to show indicators.
// noWrap	Boolean	false	//Don't wrap around and cycle through items.
// onCycleTo	Function	null	//Callback for when a new slide is cycled to.

//  });
document.addEventListener('DOMContentLoaded', function () {
    // M.AutoInit();
    // var instance = M.Carousel.init({
    //     fullWidth: true
    //   });
    var elemsColaps = document.querySelectorAll('.collapsible');
    M.Collapsible.init(elemsColaps, {"accordion": true});

    // var carouseloptions = {
    //     "duration": 300,	    //Transition duration in milliseconds.
    //     "dist": 100,	        //Perspective zoom. If 0, all items are the same size.
    //     "shift": 0,	        //Set the spacing of the center item.
    //     "padding": 15,	        //Set the padding between non center items.
    //     "numVisibler": 2,	    //Set the number of visible items.
    //     "fullWidth": true,	//Make the carousel a full width slider like the second example.
    //     "indicators": true,	//Set to true to show indicators.
    //     "noWrap": false,	    //Don't wrap around and cycle through items.
    //     "onCycleTo": null	    //Callback for when a new slide is cycled to.
    // };
   
    var elems = document.querySelector('.carousel');
    var instance = M.Carousel.init(elems, {"duration": 300, "padding": 15, "numVisibler": 1});


    setInterval(() => {
        instance.next();
    }, 7000);

})
