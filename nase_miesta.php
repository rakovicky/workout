<div class="images">
<div class="articleBG">
<div class="text">
<script src="https://ajax.googleapis.com/ajax/libs/jquery/1.12.0/jquery.min.js"></script>
<script>
$(document).ready(function(){
	$('.petrzalka').hide(); // HIDE ALL INITIALLY
});
$(document).ready(function(){
	$(".sipka").click(function(){
        $(".petrzalka").toggle(400);
    });
});

</script>
<h1>Petržalka</h1>
<h2>Street-Workout Locomotiva</h2>
<p>
Naša komunita vznikla na jar v roku 2014, keď sme sa ako skupinka dobrovoľníkov rozhodli postaviť WORKOUT(ový) park Locomotiva na jazere Veĺký Draždiak v Petržalke. Priestor na tento účel nám poskytol majiteľ bufetu Pod Školou a mestská časť Petržalka, za ktorý sme vďačný a moc si ho vážime. Projekt Locomotiva sa stal za krátku dobu populárnym strediskom športu, kultúry ale aj oddychu a zábavy. Za účelom posunúť naše možnosti sme sa rozhodli založiť občianske združenie pod názvom Lokomotíva Petržalka. Cieľom organizácie je motivovať širokú verejnosť a prispieť svojimi znalosťami k rozvoju zdravého životného štýlu, športu a kultúry. Našou prioritou je inšpirovať mládež, ktorá v dnešnej modernej dobe trávi čoraz viac času pred monitormi smartfónov a tabletov. Snažíme sa odpútať ju od fyzicky neaktívneho spôsobu života a ukázať jej efektívnejšiu formu využitia voľného času.
</p>
<img src="img/workout_locomotiva.jpg">
<br />
<h2>A kde presne to je?<img class="sipka" style="cursor:pointer;" src="img/redo-arrow.png"></h2>
<div class="petrzalka">
<?php include('map_petrzalka.php'); ?>
<p></p>
</div>
<hr>
<script>
$(document).ready(function(){
	$('.raca').hide(); // HIDE ALL INITIALLY
});
$(document).ready(function(){
    $(".sipka2").click(function(){
        $(".raca").toggle(400);
    });
});
</script>
<h1>Rača</h1>

<h2>Street-Workout Seberevolta</h2>
<p>Ďaľšie ihrisko tentokrát na druhej strane Bratislavy. Rovnako dobre vybavené a kvalitne postavené.</p>
<img src="img/workout_raca.jpg">
 <br />
 <h2>A kde presne to je?<img class="sipka2" style="cursor:pointer;" src="img/redo-arrow.png"></h2>
 <div class="raca">
 <?php require('map_raca.php'); ?>
</div>
</div>
</div>
</div>