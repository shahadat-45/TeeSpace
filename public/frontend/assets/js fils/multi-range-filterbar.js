var lowerSlider = document.querySelector('#lower'),
   upperSlider = document.querySelector('#upper'),
   lowerVal = parseInt(lowerSlider.value);
   upperVal = parseInt(upperSlider.value);
   

upperSlider.oninput = function() {
   lowerVal = parseInt(lowerSlider.value);
   upperVal = parseInt(upperSlider.value);
  document.getElementById('price-end').innerHTML = '$' + upperVal;
  document.getElementById('price-start').innerHTML = '$' + lowerVal;    
   if (upperVal < lowerVal + 11) {
      lowerSlider.value = upperVal - 11;      
      
      if (lowerVal == lowerSlider.min) {
         upperSlider.value = 11;
         
      }
   }
};


lowerSlider.oninput = function() {
   lowerVal = parseInt(lowerSlider.value);
   upperVal = parseInt(upperSlider.value);   
   document.getElementById('price-start').innerHTML = '$' + lowerVal;
   document.getElementById('price-end').innerHTML = '$' + upperVal;
   if (lowerVal > upperVal - 11) {
      upperSlider.value = lowerVal + 11;
      
      
      if (upperVal == upperSlider.max) {
         lowerSlider.value = parseInt(upperSlider.max) - 11;
         
      }

   }
};