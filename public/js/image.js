
var input = document.querySelector("input[type=file]"),
    img = document.querySelector("img");

input.addEventListener("change", function(){
    var file = this.files[0],
        reader = new FileReader();
          
    reader.addEventListener("load", function(e){
      if (img.style.opacity == 0){
        img.src = e.target.result;
      img.style.opacity = 1;
        }
    else{
        img.style.opacity = 0;
      setTimeout(function(){
          img.src = e.target.result;
          img.style.opacity = 1;
            }, 2250);
        }
    }, false);
        
  reader.readAsDataURL(file);
}, false);