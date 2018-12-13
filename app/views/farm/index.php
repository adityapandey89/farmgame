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

            <h2>Feed Table</h2>

            <table class="table table-bordered feed_table">
                <thead>
                    <tr>
                        <th><img src="<?= $_SERVER['REQUEST_URI'] ?>/images/time.png" alt="Round"/></th>
                        <th><img src="<?= $_SERVER['REQUEST_URI'] ?>/images/farmer.png" alt="Famer"/></th>
                        <th><img src="<?= $_SERVER['REQUEST_URI'] ?>/images/cow.png" alt="Cow 1"/>1</th>
                        <th><img src="<?= $_SERVER['REQUEST_URI'] ?>/images/cow.png" alt="Cow 2"/>2</th>
                        <th><img src="<?= $_SERVER['REQUEST_URI'] ?>/images/bunny.png" alt="Bunny 1"/>1</th>
                        <th><img src="<?= $_SERVER['REQUEST_URI'] ?>/images/bunny.png" alt="Bunny 2"/>2</th>
                        <th><img src="<?= $_SERVER['REQUEST_URI'] ?>/images/bunny.png" alt="Bunny 3"/>3</th>
                        <th><img src="<?= $_SERVER['REQUEST_URI'] ?>/images/bunny.png" alt="Bunny 4"/>4</th>
                    </tr>
                </thead>
                <tbody>
                    <?php
                    if (!empty($data)) {
                        foreach ($data as $round => $fedLife) {
                            $image = '<img style="height:50px;width:50px;" src="' . $_SERVER['REQUEST_URI'] . '/images/food.png" alt="Fed"/>';
                            ?>
                            <tr>
                                <td><?= $round + 1 ?></td>
                                <td><?= ($fedLife == "FARMER") ? $image : "" ?></td>
                                <td><?= ($fedLife == "COW_1") ? $image : "" ?></td>
                                <td><?= ($fedLife == "COW_2") ? $image : "" ?></td>
                                <td><?= ($fedLife == "BUNNY_1") ? $image : "" ?></td>
                                <td><?= ($fedLife == "BUNNY_2") ? $image : "" ?></td>
                                <td><?= ($fedLife == "BUNNY_3") ? $image : "" ?></td>
                                <td><?= ($fedLife == "BUNNY_4") ? $image : "" ?></td>
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
