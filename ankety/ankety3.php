<?php

	require_once('ankety/Question.php');

?>

    <script type="text/javascript">
        function add(id, choice)
        {
            $.get("ankety/pridaj_hlas.php?id=" + id + "&choice=" + choice);
            $('.item').load(document.URL +  ' .item');
            return false;
        }
    </script>

	<?php

		$questions = Question::fetch($conn);

		$id_q = 1;
		$id_c = 0;

	?>

	<div class="item" style="font-size:12px; font-family: 'PT Sans', sans-serif;">
    <h3 style="margin-bottom:10px; font-weight:bold">Ankety</h3>
            <?php foreach($questions as $q){ ?>
            <div class="question" style="margin:0px 0px 15px 0px;">
                <p style="font-weight:bold;margin-bottom:2px; padding:2px"><?= $q['name'] ?></p>
                <?php unset($q['name']); unset($q[4]); $max = $q['max']; unset($q['max']); $i = 0; $id = $q['id']; unset($q['id']); foreach($q as $item){ ?>
                    <?php $vals = $item[1]; $qst = $item[0] ?>
                <?php } ?>
                <?php foreach($vals as $v){ ?>
                    <div style="margin:-5px 0px 0px 0px; padding:0px">
                    <?php $perc = ($v == 0) ? 0 : round(((100 * $v) / $max), 1) ?>
                    <?php echo("<p style=\"text-decoration: underline; color:black;cursor:pointer; display:table; padding-top:-10px; margin-bottom:1px\" onclick=\"add(" . $id . "," . $id_c++ . ")\">" . $qst[$i++] . "</p><div style=\"background-image:url('images/ankety_bg.png'); width:" . round($perc) . "%; height:10px; overflow:hidden; display:block; border:1px solid darkblue\"></div>" . $v . " hlasov (" . $perc . "%)") ?>
                </div>
                <?php } ?>
            </div>
            <?php $id_q++; $id_c = 0; } ?>
    </div>