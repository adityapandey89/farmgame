<!DOCTYPE html>
<!--
  Created on : 12 Dec, 2018, 14 PM
  Author     : groot (Aditya Pandey)
  Description: The main view file to display the FARM GAME UI
-->
<?php
$uri = $_SERVER['REQUEST_URI'];
?>
<html>
    <head>
        <title>Farm Game</title>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <link href="<?= $uri ?>/css/bootstrap.min.css" rel="stylesheet" type="text/css"/>
        <link href="<?= $uri ?>/css/common.css" rel="stylesheet" type="text/css"/>
        <script src="<?= $uri ?>/scripts/jquery.min.js" type="text/javascript"></script>
        <script src="<?= $uri ?>/scripts/bootstrap.min.js" type="text/javascript"></script>
        <script src="<?= $uri ?>/scripts/custom.js" type="text/javascript"></script>
    </head>
    <body>
        <input type="hidden" class="request_uri" value="<?= $uri ?>"/>
        <nav class="navbar navbar-default">
            <div class="container-fluid">
                <div class="navbar-header">
                    <a class="navbar-brand" href="#">Farm Game</a>
                </div>                
            </div>
        </nav>
        <div class="container">
            <div class="row">
                <div class="col-md-3">
                    <button class="btn btn-primary" id="newGame">New Game</button>
                </div>
                <div class="col-md-3">
                    <button class="btn btn-success" id="feed">Feed</button>
                </div>
            </div>
            <br/>

            <h2>Game Status :- <?= $data['game_status'] ?></h2>
            <h4>Total Round:- <?= count($data['record']) ?></h4>
            <input type="hidden" class="game_status" value="<?= $data['game_status'] ?>"/>

            <table class="table table-bordered feed_table">
                <thead>
                    <tr>
                        <th><img src="<?= $uri ?>/images/time.png" alt="Round"/></th>
                        <th style="<?= (in_array('FARMER', $data['life'])) ? 'background-color:#F05F5F' : ""; ?>"><img src="<?= $uri ?>/images/farmer.png" alt="Famer"/></th>
                        <th style="<?= (in_array('COW_1', $data['life'])) ? 'background-color:#F05F5F' : ""; ?>"><img src="<?= $uri ?>/images/cow.png" alt="Cow 1"/>1</th>
                        <th style="<?= (in_array('COW_2', $data['life'])) ? 'background-color:#F05F5F' : ""; ?>"><img src="<?= $uri ?>/images/cow.png" alt="Cow 2"/>2</th>
                        <th style="<?= (in_array('BUNNY_1', $data['life'])) ? 'background-color:#F05F5F' : ""; ?>"><img src="<?= $uri ?>/images/bunny.png" alt="Bunny 1"/>1</th>
                        <th style="<?= (in_array('BUNNY_2', $data['life'])) ? 'background-color:#F05F5F' : ""; ?>"><img src="<?= $uri ?>/images/bunny.png" alt="Bunny 2"/>2</th>
                        <th style="<?= (in_array('BUNNY_3', $data['life'])) ? 'background-color:#F05F5F' : ""; ?>"><img src="<?= $uri ?>/images/bunny.png" alt="Bunny 3"/>3</th>
                        <th style="<?= (in_array('BUNNY_4', $data['life'])) ? 'background-color:#F05F5F' : ""; ?>"><img src="<?= $uri ?>/images/bunny.png" alt="Bunny 4"/>4</th>
                    </tr>
                </thead>
                <tbody>
                    <?php
                    if (!empty($data['record'])) {
                        foreach ($data['record'] as $round => $fedLife) {
                            $image = '<img style="height:50px;width:50px;" src="' . $uri . '/images/food.png" alt="Fed"/>';
                            ?>
                            <tr>
                                <td><?= $round + 1 ?></td>
                                <td style="<?= (in_array('FARMER', $data['life'])) ? 'background-color:#F05F5F' : ""; ?>"><?= ($fedLife == "FARMER") ? $image : "" ?></td>
                                <td style="<?= (in_array('COW_1', $data['life'])) ? 'background-color:#F05F5F' : ""; ?>"><?= ($fedLife == "COW_1") ? $image : "" ?></td>
                                <td style="<?= (in_array('COW_2', $data['life'])) ? 'background-color:#F05F5F' : ""; ?>"><?= ($fedLife == "COW_2") ? $image : "" ?></td>
                                <td style="<?= (in_array('BUNNY_1', $data['life'])) ? 'background-color:#F05F5F' : ""; ?>"><?= ($fedLife == "BUNNY_1") ? $image : "" ?></td>
                                <td style="<?= (in_array('BUNNY_2', $data['life'])) ? 'background-color:#F05F5F' : ""; ?>"><?= ($fedLife == "BUNNY_2") ? $image : "" ?></td>
                                <td style="<?= (in_array('BUNNY_3', $data['life'])) ? 'background-color:#F05F5F' : ""; ?>"><?= ($fedLife == "BUNNY_3") ? $image : "" ?></td>
                                <td style="<?= (in_array('BUNNY_4', $data['life'])) ? 'background-color:#F05F5F' : ""; ?>"><?= ($fedLife == "BUNNY_4") ? $image : "" ?></td>
                            </tr>  
                            <?php
                        }
                    } else {
                        ?>
                        <tr>
                            <td colspan="8" align="center"></td>
                        </tr>  
                        <?php
                    }
                    ?>
                </tbody>
            </table>
        </div>

    </body>
</html>
