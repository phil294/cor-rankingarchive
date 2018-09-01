<!DOCTYPE html>
<html>
<head>
    <title>CoR Ranking Archive</title>
    <link rel="stylesheet" href="css.1.css"/>
    <link href="https://fonts.googleapis.com/css?family=Open+Sans" rel="stylesheet">
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.2.1/jquery.min.js"></script>
    <script src="canvasjs.min.js"></script> <!-- this library is proprietary / 30 days evaluation. not included in this repo -->
    <script src="helpers.js"></script>
    <script src="js4.js"></script>
    <?php
    require_once("ranking.class.php");
    $ranking = new Ranking();
    ?>
</head>
<body class="padding">

<div id="screen1">
    <h2>Regnum Ranking - RLMP archive</h2>

    <div class="box">
        <div class="padding">
            <h4>Archive of all players</h4>
            <input type="text" id="character" placeholder="Charaktername..."/>
            <p id="character_click_notice">Click a character:</p>
            <ul id="characters"></ul>
            <div id="chartcontainer"></div>
            <div id="share">
                <p>Share:</p>
                <input type="text" readonly/>
            </div>
        </div>
    </div>

    <br/>
    <div class="box" id="alltimeranking">
        <div class="padding">
            <h4>Top 100 - <a onclick="show_top_x()" id="show_top_x_s">show</a><a
                        onclick="hide_top_x()" id="hide_top_x_s">hide</a></h4>
            <table>
                <tr>
                    <th>Name</th>
                    <th>Class</th>
                    <th>Max. RLMP</th>
                    <th>At</th>
                </tr>
                <?php $players = $ranking->get_all_time_top(100);
                foreach ($players as $player): ?>
                    <tr>
                        <td class="padding realm<?= $player["realm"] ?>"><?= $player["name"] ?></td>
                        <td class="padding"><?= $player["class"] ?></td>
                        <td class="padding"><?= $player["rlmp"] ?></td>
                        <td class="padding"><?= $player["date"] ?></td>
                    </tr>
                <?php endforeach; ?>
            </table>
        </div>
    </div>

    <br/>
    <div class="box" id="newtorank">
        <div class="padding">
            <h4>New since last week:</h4>
            <table>
                <tr>
                    <th>Name</th>
                    <th>Class</th>
                    <th>At</th>
                </tr>
                <?php $players = $ranking->get_players_that_are_new_to_ranking_since_x_days(7);
                foreach ($players as $player): ?>
                    <tr>
                        <td class="padding realm<?= $player["realm"] ?>"><?= $player["name"] ?></td>
                        <td class="padding"><?= $player["class"] ?></td>
                        <td class="padding"><?= $player["date"] ?></td>
                    </tr>
                <?php endforeach; ?>
            </table>
        </div>
    </div>

</div>

<footer class="padding" id="footer">
    <p>Source by <a href="mailto:eochgls@web.de"><span style="color:#EEEEEE; text-decoration:underline;">Blauhirn</span></a>: <a href="https://github.com/phil294/cor-rankingarchive">https://github.com/phil294/cor-rankingarchive</a></p>
</footer>

</body>
</html>