// imageZoom effect
let zoom_btn = 0;
let zoom_val = 0;
function zoomStart(){
  if (zoom_val == 0) {
    zoom_btn = 1;
    zoom_val = 1;
    document.getElementById('zooming_img').style.opacity = 0 ;
    document.getElementById('search_icon').style.color = 'black' ;
  }
  else{
    zoom_btn = 0;
    zoom_val = 0;
    document.getElementById('search_icon').style.color = '#7E7E7E' ;
  }
}
function zoom(e){
  var zoomer = e.currentTarget;
  zoomer.style.borderRadius = '12px';
  e.offsetX ? offsetX = e.offsetX : offsetX = e.touches[0].pageX
  e.offsetY ? offsetY = e.offsetY : offsetX = e.touches[0].pageX
  x = offsetX/zoomer.offsetWidth*100
  y = offsetY/zoomer.offsetHeight*100
  if (zoom_btn == 1) {
    zoomer.style.backgroundPosition = x + '% ' + y + '%';
    zoomer.style.backgroundSize = 'unset';
  } 
  else{
    zoomer.style.backgroundSize = 'cover';
  }
}


var sync1 = $(".owl_slider");
var sync2 = $(".navigation-thumbs");


var thumbnailItemClass = '.owl-item';

var slides = sync1.owlCarousel({
	video:true,
  startPosition: 12,
  items:1,
  loop:true,
  margin:10,
  autoplay:false,
  autoplayTimeout:6000,
  autoplayHoverPause:false,
  nav: false,
  dots: false,
}).on('changed.owl.carousel', syncPosition);

function syncPosition(el) {
  $owl_slider = $(this).data('owl.carousel');
  var loop = $owl_slider.options.loop;

  if(loop){
    var count = el.item.count-1;
    var current = Math.round(el.item.index - (el.item.count/2) - .5);
    if(current < 0) {
        current = count;
    }
    if(current > count) {
        current = 0;
    }
  }else{
    var current = el.item.index;
  }

  var owl_thumbnail = sync2.data('owl.carousel');
  var itemClass = "." + owl_thumbnail.options.itemClass;


  var thumbnailCurrentItem = sync2
  .find(itemClass)
  .removeClass("synced")
  .eq(current);

  thumbnailCurrentItem.addClass('synced');

  if (!thumbnailCurrentItem.hasClass('active')) {
    var duration = 300;
    sync2.trigger('to.owl.carousel',[current, duration, true]);
  }   
}

var thumbs = sync2.owlCarousel({
  startPosition: 12,
  items:4,
  loop:false,
  margin:10,
  autoplay:false,
  nav: true,
  dots: false,
  onInitialized: function (e) {
    var thumbnailCurrentItem =  $(e.target).find(thumbnailItemClass).eq(this._current);
    thumbnailCurrentItem.addClass('synced');
  },
  responsiveClass:true,
    responsive:{
        0:{
            items:1,
        },
        350:{
            items:2,
        },
        500:{
            items:3,
        },
        670:{
            items:4,
        },
        800:{
            items:2,
        },
        900:{
            items:3,
        },
        1300:{
            items:4,
        },
    },
})
.on('click', thumbnailItemClass, function(e) {
    e.preventDefault();
    var duration = 300;
    var itemIndex =  $(e.target).parents(thumbnailItemClass).index();
    sync1.trigger('to.owl.carousel',[itemIndex, duration, true]);
}).on("changed.owl.carousel", function (el) {
  var number = el.item.index;
  $owl_slider = sync1.data('owl.carousel');
  $owl_slider.to(number, 100, true);
});
