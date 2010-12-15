$(document).ready(function () {

//Invoke Gauges when page loads
gauge('v');
gauge('s');
gauge('p');

$("input").focus( function(){
  
  //Empty input
  $(this).val('');

});

$("input").keypress( function(e){

  //This prevents non-digits (except the decimal point) from being typed
  if(e.which!=8 && e.which!=46 && e.which!=45 && e.which!=0 && (e.which<48 || e.which>57)){ return false; }

});

$("input").keyup( function(e){

  //Determines which gauge to modify
  var whichGauge  = $(this).attr('id');
  
  //Calls the Guage Function
  gauge(whichGauge);
});

function gauge(whichGauge){
  
  //Calculate the maximum fill height of the gauge
  var total     = $("#"+whichGauge+"BigNumber").attr("rel")*1;
  
  //Find the starting point of the gauge
  var used      = $("#"+whichGauge+"BigNumber").attr("alt")*1;
  
  //Value from the form input
  var input     = $("#"+whichGauge).val();
  
  //Find the sum of the starting value and what the user inputed
  used = used - input;

  //Prevent extreme values
  if(used<=-99){used='-99.00';};
  
  //Calculate the New Height of the Fill -- 140 is the physical height of the gauge
  var nHght    = ((used*1) / (total*1))*140;
  
  //Prevent bad values because you do not want the fill to leave the gauge
  if(nHght<0){nHght=0;}
  if(nHght>140){nHght=140;}
  
  //Break apart used value to accomidate Big and Small numbers in different Divs
  //Need to first convert used into a string
  used = used+'';
  var whereDec = used.indexOf('.');
  
  //If there is no decimal places, add .00 to prevent gauge show only whole number
  if(whereDec==-1){
    used=used+'.00';
    whereDec = used.indexOf('.');
  }
  
  //Breaking numbers into Big and Small 
  var bigNumber   = used.substring(0,whereDec);
  var smallNumber = used.substring(whereDec);
  
  //Preventing bad values
  if(smallNumber.length==2){smallNumber=smallNumber+"0";}
  if(smallNumber.length>2){smallNumber=smallNumber.substring(0,3);}
  if(isNaN(bigNumber)){smallNumber='.00';bigNumber='0';}
  
  //Update the numbers in the gauge
  $("#"+whichGauge+"BigNumber").html(bigNumber);
  $("#"+whichGauge+"SmallNumber").html(smallNumber);
  
  //IE does not like .animate method with 0, so test for no change and bypass animation
  var numTest = bigNumber + smallNumber;
  
  //Animate the fill by changing the height of the fill div
  if(0>numTest || numTest>0){
    $("#"+whichGauge+"Fill").animate({height:nHght}, 1000, "swing");
  };
  
  //Change the gauges based on the sign of the number
  if(numTest<0){
    $("#"+whichGauge+"BigNumber").css("color","#ff7433");
    $("#"+whichGauge+"SmallNumber").css("color","#ff7433");
  }
  
  if(numTest>0){
    $("#"+whichGauge+"BigNumber").css("color","#4b4b4b");
    $("#"+whichGauge+"SmallNumber").css("color","#4b4b4b");
  }
  
  if(numTest==0){
    $("#"+whichGauge+"BigNumber").css("color","#b4b4b4");
    $("#"+whichGauge+"SmallNumber").css("color","#b4b4b4");
  }
}
});