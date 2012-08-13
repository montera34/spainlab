$j("#slideshow > div:gt(0)").hide();

setInterval(function() { 
  $j('#slideshow > div:first')
    .fadeOut(1000)
    .next()
    .fadeIn(1000)
    .end()
    .appendTo('#slideshow');
},  6000);
