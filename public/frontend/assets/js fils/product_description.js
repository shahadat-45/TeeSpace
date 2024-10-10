var abx = document.querySelectorAll("li.desp_item");
var div = document.querySelectorAll(".product_description > .container > div");
    var i;
    for (i = 0; i < abx.length; i++) {
        abx[i].addEventListener("click", function() {
            abx.forEach(abx => abx.classList.remove("tab_active"))
            this.classList.toggle("tab_active");
            
            div.forEach(div => div.classList.remove("active"))
            div[this.value].classList.add('active');

            div.forEach(div => div.classList.remove("show"))
            div[this.value].classList.add('show');           
        });
    }