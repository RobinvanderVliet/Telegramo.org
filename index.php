<?php

$grupoj = json_decode(file_get_contents("grupoj.json"), true);
$kategorioj = json_decode(file_get_contents("kategorioj.json"), true);

function akiriLigilon($ŝlosiloj) {
	global $grupoj;

	foreach ($ŝlosiloj as $valoro) {
		$grupo = $grupoj[$valoro];

		$tme = "/joinchat/";
		if (substr($grupo["ligilo"], 0, 1) == "/") {
			$tme = "";
		}

		$m = 0;
		$mteksto = "";
		if (is_numeric($grupo["membroj"])) {
			$m = $grupo["membroj"];
			$mteksto = sprintf(" <small><i>(%d membroj)</i></small>", $m);
		}
		$eligo[] = array(
		"teksto" => sprintf("<li><a class=\"emoji\" href=\"https://t.me%s%s\">%s</a> - %s%s</li>",
			$tme, $grupo["ligilo"], $grupo["nomo"], $grupo["priskribo"], $mteksto),
		"ordo" => $m);
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
	<p><a class="btn btn-lg btn-primary" href="elŝuti.php" role="button">Elŝuti &raquo;</a></p>
</div>
<?php

printiLigilojn(3, $kategorioj);

require_once("footer.php");

?>
