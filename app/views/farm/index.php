<!DOCTYPE html>
<!--
To change this license header, choose License Headers in Project Properties.
To change this template file, choose Tools | Templates
and open the template in the editor.
-->
<html>
    <head>
        <title>Farm Game</title>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <link href="<?= $_SERVER['REQUEST_URI'] ?>/css/bootstrap.min.css" rel="stylesheet" type="text/css"/>
        <link href="<?= $_SERVER['REQUEST_URI'] ?>/css/common.css" rel="stylesheet" type="text/css"/>
        <script src="<?= $_SERVER['REQUEST_URI'] ?>/scripts/jquery.min.js" type="text/javascript"></script>
        <script src="<?= $_SERVER['REQUEST_URI'] ?>/scripts/bootstrap.min.js" type="text/javascript"></script>
        <script src="<?= $_SERVER['REQUEST_URI'] ?>/scripts/custom.js" type="text/javascript"></script>
    </head>
    <body>
        <input type="hidden" class="request_uri" value="<?= $_SERVER['REQUEST_URI'] ?>"/>
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
                    <a href="#" class="btn btn-primary" id="newGame">New Game</a>
                </div>
                <div class="col-md-3">
                    <a href="#" class="btn btn-success" id="feed">Feed</a>
                </div>
            </div>
            <br/>

            <h2>Game Status :- <?= $data['game_status'] ?></h2>
            <h4>Total Round:- <?= count($data['record']) ?></h4>
            <input type="hidden" class="game_status" value="<?= $data['game_status'] ?>"/>

            <table class="table table-bordered feed_table">
                <thead>
                    <tr>
                        <th><img src="<?= $_SERVER['REQUEST_URI'] ?>/images/time.png" alt="Round"/></th>
                        <th style="<?= (in_array('FARMER', $data['life'])) ? 'background-color:#F05F5F' : ""; ?>"><img src="<?= $_SERVER['REQUEST_URI'] ?>/images/farmer.png" alt="Famer"/></th>
                        <th style="<?= (in_array('COW_1', $data['life'])) ? 'background-color:#F05F5F' : ""; ?>"><img src="<?= $_SERVER['REQUEST_URI'] ?>/images/cow.png" alt="Cow 1"/>1</th>
                        <th style="<?= (in_array('COW_2', $data['life'])) ? 'background-color:#F05F5F' : ""; ?>"><img src="<?= $_SERVER['REQUEST_URI'] ?>/images/cow.png" alt="Cow 2"/>2</th>
                        <th style="<?= (in_array('BUNNY_1', $data['life'])) ? 'background-color:#F05F5F' : ""; ?>"><img src="<?= $_SERVER['REQUEST_URI'] ?>/images/bunny.png" alt="Bunny 1"/>1</th>
                        <th style="<?= (in_array('BUNNY_2', $data['life'])) ? 'background-color:#F05F5F' : ""; ?>"><img src="<?= $_SERVER['REQUEST_URI'] ?>/images/bunny.png" alt="Bunny 2"/>2</th>
                        <th style="<?= (in_array('BUNNY_3', $data['life'])) ? 'background-color:#F05F5F' : ""; ?>"><img src="<?= $_SERVER['REQUEST_URI'] ?>/images/bunny.png" alt="Bunny 3"/>3</th>
                        <th style="<?= (in_array('BUNNY_4', $data['life'])) ? 'background-color:#F05F5F' : ""; ?>"><img src="<?= $_SERVER['REQUEST_URI'] ?>/images/bunny.png" alt="Bunny 4"/>4</th>
                    </tr>
                </thead>
                <tbody>
                    <?php
                    if (!empty($data['record'])) {
                        foreach ($data['record'] as $round => $fedLife) {
                            $image = '<img style="height:50px;width:50px;" src="' . $_SERVER['REQUEST_URI'] . '/images/food.png" alt="Fed"/>';
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
