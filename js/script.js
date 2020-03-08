$(window).load(function(){
// Customer

let tl_customer = new TimeLineMax({paused: true});

tl_customer.staggerTo('.customer-anim', 0.15, {
  fill: 'rgb(26, 56, 101)'
  }, 0.08);



$('#customer').on('mouseenter', function() {
	tl_customer.timeScale(1).play();
}).on('mouseleave', function() {
	tl_customer.timeScale(1).reverse();
})

});