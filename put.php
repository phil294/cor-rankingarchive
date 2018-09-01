<?php

require_once('global.php');
require_once('ranking.class.php');
require_once('simple_html_dom.php'); // TODO

echo 'I AM A CONRJOB';

$worldId=2; //Valhalla

$today_date = date('Y-m-d');

$ranking = new Ranking();

// already done today?
$last_insert = $ranking->get_last_insert_date();
if (empty($last_insert)) {
    dieee("last insert is empty?");
}
$last_date_utc = date("z", strtotime($last_insert . " UTC"));
$this_day_utc = date("z");
if ($last_date_utc == $this_day_utc) {
    dieee("date equal. $last_date_utc, $this_day_utc");
} elseif ($last_date_utc > $this_day_utc) {
    // new years eve
}

foreach (Ranking::$REALMS as $realmId => $realmName) {
    foreach (Ranking::$CLASSES as $classId => $className) {
        $url = "http://www.championsofregnum.com/index.php?l=1&ref=gmg&sec=19&rank=2&world=$worldId&realm=$realmId&class=$classId&range=2";
        $http = file_get_html($url);
        $player_c = 0;
        foreach ($http->find('.ranking-table tr') as $tr) {
            $tds = $tr->find('td');
            if (sizeof($tds) != 5) {
                continue;
            }
            $name = $tds[0]->plaintext;
            $player_class = $tds[1]->plaintext;
            $rlmp = intval($tds[4]->plaintext);

            // insert player or get id of existing player
            $player_id = $ranking->insert_ignore_player($name, $realmId, $player_class);

            // insert krp
            $ranking->insert_ignore_krp($player_id, $rlmp);

            $player_c++;
        }
        if ($player_c < 100) {
            dieee("player_c is $player_c: $classId,$realmId");
        }
    }
}
echo 'fin';