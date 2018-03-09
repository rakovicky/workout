$(function(){
  $(".Fr-star.userChoose").Fr_star(function(rating){
  	var a_id = $(".Fr-star.userChoose").attr('data-id');

    $.post("rating/ajax_rate.php", {'id' : 'index_page', 'rating': rating, 'a_id': a_id}, function(){
      alert("Ohodnotené " + rating + " !!");
    });
  });
});
