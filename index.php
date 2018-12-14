<?php

$grupoj = json_decode(file_get_contents("/var/www/telegramo/grupoj.json"), true);
$kategorioj = json_decode(file_get_contents("/var/www/telegramo/kategorioj.json"), true);

function akiriLigilon($ŝlosiloj) {
	global $grupoj;

	foreach ($ŝlosiloj as $valoro) {
		if (isset($grupoj[$valoro])) {
			$grupo = $grupoj[$valoro];

			$ligilo = "https://" . idn_to_ascii($grupo["subdomajno"][0]) . ".telegramo.org/";

			$m = 0;
			$mteksto = "";
			if (is_numeric($grupo["membroj"])) {
				$m = $grupo["membroj"];
				$mteksto = sprintf(" <small><i>(%d membroj)</i></small>", $m);
			}

			$eligo[] = array(
			"teksto" => sprintf("<li><a class=\"emoji\" href=\"%s\">%s</a> - %s%s</li>", $ligilo, $grupo["nomo"], $grupo["priskribo"], $mteksto),
			"ordo" => $m);
		}
	}

	usort($eligo, function($a, $b) {
		return $b["ordo"] - $a["ordo"];
	});

	echo "<div><ul>";

	foreach ($eligo as $valoro) {
		echo $valoro["teksto"];
	}

	echo "</ul></div>";
}

function printiLigilojn($n, $vlisto) {
	foreach ($vlisto as $nomo => $valoro) {
		echo "<h" . $n . ">" . $nomo . "</h" . $n . ">";

		if (isset($valoro[0])) {
			akiriLigilon($valoro);
		} else {
			printiLigilojn($n + 1, $valoro);
		}
	}
}

require_once("header.php");

?>
<div class="jumbotron">
	<h1>Telegram</h1>
	<p>Telegram estas simpla senpaga mesaĝilo por komputiloj kaj poŝtelefonoj. Esperantistoj uzas ĝin por sendi tekstajn kaj voĉajn mesaĝojn, kaj por voki aliajn parolantojn. Eblas sendi per ĝi ĉian enhavon. Ekzistas multaj grupoj, per kiuj esperantistoj povas paroli pri diversaj temoj.</p>
	<p><a class="btn btn-primary btn-lg" href="elŝuti.php" role="button">Elŝuti &raquo;</a></p>
</div>
<?php

printiLigilojn(3, $kategorioj);
require_once("footer.php");

?>
