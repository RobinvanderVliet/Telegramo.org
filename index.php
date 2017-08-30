<?php

$grupoj = json_decode(file_get_contents("grupoj.json"), true);

function akiriLigilon($ŝlosiloj) {
	global $grupoj;

	foreach ($ŝlosiloj as $valoro) {
		$grupo = $grupoj[$valoro];

		if (substr($grupo["ligilo"], 0, 1) == "/") {
			$eligo[] = array("teksto" => "<li><a href=\"https://t.me" . $grupo["ligilo"] . "\">" . $grupo["nomo"] . "</a> - " . $grupo["priskribo"] . ($grupo["membroj"] != null ? " <small><i>(" . $grupo["membroj"] . " membroj)</i></small>" : "") . "</li>", "ordo" => $grupo["membroj"] != null ? $grupo["membroj"] : 0);
		} else {
			$eligo[] = array("teksto" => "<li><a href=\"https://t.me/joinchat/" . $grupo["ligilo"] . "\">" . $grupo["nomo"] . "</a> - " . $grupo["priskribo"] . ($grupo["membroj"] != null ? " <small><i>(" . $grupo["membroj"] . " membroj)</i></small>" : "") . "</li>", "ordo" => $grupo["membroj"] != null ? $grupo["membroj"] : 0);
		}
	}

	usort($eligo, function($a, $b) {
		return $b["ordo"] - $a["ordo"];
	});

	echo "<p><ul>";

	foreach ($eligo as $valoro) {
		echo $valoro["teksto"];
	}

	echo "</ul></p>";
}

require_once("header.php");

?>
<div class="jumbotron">
	<h1>Telegram</h1>
	<p>Telegram estas nuba mesaĝilo, kiu flue sinkronigas ĉiujn viajn datumojn kun ĉiuj viaj aparatoj. Oni povas sendi ĉiajn dosierojn ĝis 1,5 GB. Aldone ĝi estas tute senpaga, la aplikaĵoj estas malfermitkodaj kaj la oficialaj aplikaĵoj ne enhavas reklamojn.</p>
	<p><a class="btn btn-lg btn-primary" href="elŝuti.php" role="button">Elŝuti &raquo;</a></p>
</div>

<h3>La ĉefaj Esperantaj grupoj:</h3>
<?php akiriLigilon(array("esperantujo", "voĉmesaĝejo")); ?>

<h3>Temaj Esperantaj grupoj:</h3>
<h4>Kulturo</h4>
<?php akiriLigilon(array("artumejo", "enlakuirejokuntelegramo", "fotoj", "glumarkujo", "modo", "muziko", "ridigumin", "sakurojkajcunderoj", "sportoj")); ?>

<h4>Lingvoj</h4>
<?php akiriLigilon(array("lingvemuloj", "literaturababilejo", "skribsistemoj")); ?>

<h4>Ludoj</h4>
<?php akiriLigilon(array("homlupo", "homlupoamnezia", "kartojkontraŭesperantujo", "ludemuloj", "ludojenesperanto", "minecraft", "pokemongo", "ŝakludantoj")); ?>

<h4>Agado</h4>
<?php akiriLigilon(array("agadujo", "amikumu", "muzaiko", "pasportaservo", "tejotelegrame", "telegramo", "vikipedioagado", "zagrebametodo")); ?>

<h4>Homoj</h4>
<?php akiriLigilon(array("amikojdenaturo", "duolingo", "egalecen", "esperantoenfamilio", "felanoj", "glatajesperantistoj", "skoltismo", "spiritismokajesperanto")); ?>

<h4>Eventoj</h4>
<?php akiriLigilon(array("paralelauniverso")); ?>

<h4>Amaskomunikiloj</h4>
<?php akiriLigilon(array("heroldodeesperanto", "kernpunkto", "polaretradio")); ?>

<h4>Regionoj</h4>
<?php akiriLigilon(array("karejo", "irano", "urbo barcelono", "urbo bavario", "urbo berlino", "urbo francilio", "urbo hamburgo", "urbo hameleno", "urbo hanovro", "urbo rodanoalpoj", "urbo stutgarto")); ?>

<h4>Aliaj</h4>
<?php akiriLigilon(array("enigmoj", "esperantokajteĥniko", "filmtekstfarado", "katamantoj", "kino", "landoj", "lingvokonstruado", "reddit", "religiopolitikokajaliajtiklajtemoj", "scienco", "sekretajaferetoj", "stackexchange", "vivukajlasuvivi")); ?>

<h3>Dulingvaj grupoj por paroli la alian lingvon aŭ priparoli ĝin Esperante:</h3>
<h4>Ĝermanaj</h4>
<?php akiriLigilon(array("dulingva af", "dulingva da", "dulingva de", "dulingva en", "dulingva is", "dulingva nl", "dulingva sv")); ?>

<h4>Latinidaj</h4>
<?php akiriLigilon(array("dulingva ca", "dulingva es", "dulingva fr", "dulingva it", "dulingva ptbr")); ?>

<h4>Slavaj</h4>
<?php akiriLigilon(array("dulingva pl", "dulingva ru", "dulingva cs sk")); ?>

<h4>Aziaj</h4>
<?php akiriLigilon(array("dulingva ar", "dulingva fa", "dulingva he", "dulingva id", "dulingva ko", "dulingva ja")); ?>

<h4>Aliaj naturaj</h4>
<?php akiriLigilon(array("dulingva hu", "dulingva la", "dulingva sw", "dulingva tr")); ?>

<h4>Planlingvaj</h4>
<?php akiriLigilon(array("dulingva artpandunia", "dulingva arttokipona", "dulingva io", "dulingva jbo", "dulingva tlh", "dulingva vo", "dulingva aw", "dulingva ko")); ?>
<?php require_once("footer.php"); ?>
