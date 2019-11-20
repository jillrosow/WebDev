/*
 Define variables for the values computed by the grabber event
 handler but needed by mover event handler
*/
var diffX, diffY, theElement;


// The event handler function for grabbing the word
function grabber(event) {

// Set the global variable for the element to be moved

  theElement = event.currentTarget;

// Determine the position of the word to be grabbed,
//  first removing the units from left and top

  var posX = parseInt(theElement.style.left);
  var posY = parseInt(theElement.style.top);

// Compute the difference between where it is and
// where the mouse click occurred

  diffX = event.clientX - posX;
  diffY = event.clientY - posY;

// Now register the event handlers for moving and
// dropping the word

  document.addEventListener("mousemove", mover, true);
  document.addEventListener("mouseup", dropper, true);

// Stop propagation of the event and stop any default
// browser action

  event.stopPropagation();
  event.preventDefault();

}  //** end of grabber

// *******************************************************

// The event handler function for moving the word

function mover(event) {
// Compute the new position, add the units, and move the word

  theElement.style.left = (event.clientX - diffX) + "px";
  theElement.style.top = (event.clientY - diffY) + "px";

// Prevent propagation of the event

  event.stopPropagation();
}  //** end of mover

// *********************************************************
// The event handler function for dropping the word

function dropper(event) {

// Unregister the event handlers for mouseup and mousemove

  document.removeEventListener("mouseup", dropper, true);
  document.removeEventListener("mousemove", mover, true);

// Prevent propagation of the event

  event.stopPropagation();
}  //** end of dropper

// arrays with images
let puzzle1 = new Array();
puzzle1[0] = "<img src=./images1/img1-12.jpg width=100 height=100>";
puzzle1[1] = "<img src=./images1/img1-11.jpg width=100 height=100>";
puzzle1[2] = "<img src=./images1/img1-10.jpg width=100 height=100>";
puzzle1[3] = "<img src=./images1/img1-9.jpg width=100 height=100>";
puzzle1[4] = "<img src=./images1/img1-8.jpg width=100 height=100>";
puzzle1[5] = "<img src=./images1/img1-7.jpg width=100 height=100>";
puzzle1[6] = "<img src=./images1/img1-6.jpg width=100 height=100>";
puzzle1[7] = "<img src=./images1/img1-5.jpg width=100 height=100>";
puzzle1[8] = "<img src=./images1/img1-4.jpg width=100 height=100>";
puzzle1[9] = "<img src=./images1/img1-3.jpg width=100 height=100>";
puzzle1[10] = "<img src=./images1/img1-2.jpg width=100 height=100>";
puzzle1[11] = "<img src=./images1/img1-1.jpg width=100 height=100>";

let puzzle2 = new Array();
puzzle2[0] = "<img src=./images2/img2-12.jpg width=100 height=100>";
puzzle2[1] = "<img src=./images2/img2-11.jpg width=100 height=100>";
puzzle2[2] = "<img src=./images2/img2-10.jpg width=100 height=100>";
puzzle2[3] = "<img src=./images2/img2-9.jpg width=100 height=100>";
puzzle2[4] = "<img src=./images2/img2-8.jpg width=100 height=100>";
puzzle2[5] = "<img src=./images2/img2-7.jpg width=100 height=100>";
puzzle2[6] = "<img src=./images2/img2-6.jpg width=100 height=100>";
puzzle2[7] = "<img src=./images2/img2-5.jpg width=100 height=100>";
puzzle2[8] = "<img src=./images2/img2-4.jpg width=100 height=100>";
puzzle2[9] = "<img src=./images2/img2-3.jpg width=100 height=100>";
puzzle2[10] = "<img src=./images2/img2-2.jpg width=100 height=100>";
puzzle2[11] = "<img src=./images2/img2-1.jpg width=100 height=100>";

let puzzle3 = new Array();
puzzle3[0] = "<img src=./images3/img3-12.jpg width=100 height=100>";
puzzle3[1] = "<img src=./images3/img3-11.jpg width=100 height=100>";
puzzle3[2] = "<img src=./images3/img3-10.jpg width=100 height=100>";
puzzle3[3] = "<img src=./images3/img3-9.jpg width=100 height=100>";
puzzle3[4] = "<img src=./images3/img3-8.jpg width=100 height=100>";
puzzle3[5] = "<img src=./images3/img3-7.jpg width=100 height=100>";
puzzle3[6] = "<img src=./images3/img3-6.jpg width=100 height=100>";
puzzle3[7] = "<img src=./images3/img3-5.jpg width=100 height=100>";
puzzle3[8] = "<img src=./images3/img3-4.jpg width=100 height=100>";
puzzle3[9] = "<img src=./images3/img3-3.jpg width=100 height=100>";
puzzle3[10] = "<img src=./images3/img3-2.jpg width=100 height=100>";
puzzle3[11] = "<img src=./images3/img3-1.jpg width=100 height=100>";


// load function to populate with images
var time;
function load(event) {
  time = setInterval(count, 1000);
  let spans = document.getElementsByTagName("span");
  let indexOut = Math.floor (Math.random() * 3);
  let indexes = [0,1,2,3,4,5,6,7,8,9,10,11];

  for (let i = 0; i < 12; i++) {
    let j = Math.floor (Math.random() * indexes.length);
    let num = indexes.splice(j, 1);
    if (indexOut == 0) {
      spans[i].innerHTML = puzzle1[num];
    }
    else if (indexOut == 1) {
      spans[i].innerHTML = puzzle2[num];
    }
    else if (indexOut == 2) {
      spans[i].innerHTML = puzzle3[num];
    }
  }
}

var counter = 0;
function count () {
  counter++;
}

function reportTime(event) {
  var hours = Math.floor(counter / 3600);
  counter %= 3600;
  var minutes = Math.floor(counter / 60);
  var seconds = counter % 60;
  document.getElementById("time").innerHTML = hours + " hours " + minutes + " minutes "
                                              + seconds + " seconds";
}
