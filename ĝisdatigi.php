<?php

require_once("sekretoj.php");

if (isset($_GET["pasvorto"]) && $_GET["pasvorto"] == $pasvortoPorĜisdatigi) {
	$grupoj = json_decode(file_get_contents("grupoj.json"), true);

	foreach ($grupoj as $ŝlosilo => $grupo) {
		$datumoj = @file_get_contents("https://api.telegram.org/bot" . $EsperantoBotŜlosilo . "/getChat?chat_id=" . $grupo["identigilo"]);

		if ($datumoj !== false) {
			$datumoj = json_decode($datumoj, true);

			if ($datumoj !== null && isset($datumoj["ok"]) && $datumoj["ok"] === true && isset($datumoj["result"])) {
				if (isset($datumoj["result"]["title"]) && is_string($datumoj["result"]["title"])) {
					$grupoj[$ŝlosilo]["nomo"] = $datumoj["result"]["title"];
				}

				if (isset($datumoj["result"]["description"]) && is_string($datumoj["result"]["description"])) {
					$grupoj[$ŝlosilo]["gruppriskribo"] = $datumoj["result"]["description"];
				} else {
					unset($grupoj[$ŝlosilo]["gruppriskribo"]);
				}

				if (isset($grupoj[$ŝlosilo]["subdomajno"]) && isset($datumoj["result"]["photo"]) && isset($datumoj["result"]["photo"]["big_file_id"]) && is_string($datumoj["result"]["photo"]["big_file_id"])) {
					$dosiero = @file_get_contents("https://api.telegram.org/bot" . $EsperantoBotŜlosilo . "/getFile?file_id=" . $datumoj["result"]["photo"]["big_file_id"]);

					if ($dosiero !== false) {
						$dosiero = json_decode($dosiero, true);

						if ($dosiero !== null && isset($dosiero["ok"]) && $dosiero["ok"] === true && isset($dosiero["result"])) {
							file_put_contents("/var/www/telegramo/grupbildoj/" . $grupoj[$ŝlosilo]["subdomajno"][0] . ".jpg", file_get_contents("https://api.telegram.org/file/bot" . $EsperantoBotŜlosilo . "/" . $dosiero["result"]["file_path"]));
						}
					}
				}
			}
		}

		$datumoj = @file_get_contents("https://api.telegram.org/bot" . $EsperantoBotŜlosilo . "/getChatMembersCount?chat_id=" . $grupo["identigilo"]);

		if ($datumoj !== false) {
			$datumoj = json_decode($datumoj, true);

			if ($datumoj !== null && isset($datumoj["ok"]) && $datumoj["ok"] === true && isset($datumoj["result"]) && is_int($datumoj["result"])) {
				$grupoj[$ŝlosilo]["membroj"] = $datumoj["result"];
			}
		}
	}

	uasort($grupoj, function($a, $b) {
		return $b["membroj"] - $a["membroj"];
	});

	file_put_contents("grupoj.json", json_encode($grupoj, JSON_UNESCAPED_UNICODE | JSON_PRETTY_PRINT) . "\n");
}
