var acc = document.getElementsByClassName("faq_item");
    var i;
    for (i = 0; i < acc.length; i++) {
        acc[i].addEventListener("click", function() {
        this.classList.toggle("faq_item_active");
        // var panel = this.nextElementSibling;
        // if (panel.style.display === "block") {
        //     panel.style.display = "none";
        // } else {
        //     panel.style.display = "block";
        //     // var firstElementChild = panel.children[0].id;
        //     // var secondElementChild = panel.children[1].id; 
        // }
        });
    }