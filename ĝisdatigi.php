<?php

require_once("sekretoj.php");

if (isset($_GET["pasvorto"]) && $_GET["pasvorto"] == $pasvortoPorĜisdatigi) {
	$grupoj = json_decode(file_get_contents("grupoj.json"), true);

	foreach ($grupoj as $ŝlosilo => $grupo) {
		$datumoj = @file_get_contents("https://api.telegram.org/bot" . $EsperantoBotŜlosilo . "/getChat?chat_id=" . $grupo["identigilo"]);

		if ($datumoj !== false) {
			$datumoj = json_decode($datumoj, true);

			if ($datumoj !== null && isset($datumoj["ok"]) && $datumoj["ok"] === true && isset($datumoj["result"]) && isset($datumoj["result"]["title"]) && is_string($datumoj["result"]["title"])) {
				$grupoj[$ŝlosilo]["nomo"] = $datumoj["result"]["title"];
			}
		}

		$datumoj = @file_get_contents("https://api.telegram.org/bot" . $EsperantoBotŜlosilo . "/getChatMembersCount?chat_id=" . $grupo["identigilo"]);

		if ($datumoj !== false) {
			$datumoj = json_decode($datumoj, true);

			if ($datumoj !== null && isset($datumoj["ok"]) && $datumoj["ok"] === true && isset($datumoj["result"]) && is_int($datumoj["result"])) {
				$grupoj[$ŝlosilo]["membroj"] = $datumoj["result"];
			}
		}

		$datumoj = @file_get_contents("https://api.telegram.org/bot" . $EsperantoBotŜlosilo . "/getChatAdministrators?chat_id=" . $grupo["identigilo"]);

		if ($datumoj !== false) {
			$datumoj = json_decode($datumoj, true);

			if ($datumoj !== null && isset($datumoj["ok"]) && $datumoj["ok"] === true && isset($datumoj["result"]) && is_array($datumoj["result"])) {
				foreach ($datumoj["result"] as $ŝlosilo2 => $administranto) {
					$administranto["user"] = $administranto["user"]["id"];
					$datumoj["result"][$ŝlosilo2] = $administranto;
				}

				$grupoj[$ŝlosilo]["administrantoj"] = $datumoj["result"];
			}
		}
	}

	uasort($grupoj, function($a, $b) {
		return $b["membroj"] - $a["membroj"];
	});

	file_put_contents("grupoj.json", json_encode($grupoj, JSON_UNESCAPED_UNICODE | JSON_PRETTY_PRINT) . "\n");
}

?>
