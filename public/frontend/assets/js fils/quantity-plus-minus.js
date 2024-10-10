var quantity = document.querySelector('.text-value'),
   qty = parseInt(quantity.value);
   
function quentity_increment() {
    qty = parseInt(quantity.value);
    quantity.value = qty + 1 ;
}
function quentity_decrement() {
    qty = parseInt(quantity.value);
    quantity.value = qty - 1 ;
    if(qty == 0){
        quantity.value = 0 ;
    }
}