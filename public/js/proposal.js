
window.onscroll = function() {myFunction()};

var navbar = document.getElementById("body");

var sticky = navbar.offsetTop;

function myFunction() {
  if (window.pageYOffset >= sticky) {
    navbar.classList.add("sticky")
  } else {
    navbar.classList.remove("sticky");
  }
}

var div = document.getElementById("full");

function getRandomColor() {
    var letters = '0123456789ABCDEF';
    var color = array('#552AFF', '#FFFFFF');
    for (var i = color.length - 1; i >= 0; i--) {
      color[i];
    }
        
    }
    return color[];
}

function changeColor(){
  div.style.backgroundColor= getRandomColor();
}

setInterval(changeColor,1000);
