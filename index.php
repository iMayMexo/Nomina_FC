<?php
require_once __DIR__ . '/app/controller.php';

?>
<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8">
    <title>PayRoll</title>
    <link rel="stylesheet" href="bootstrap.min.css">
    <link rel="stylesheet" href="style.css">
    <link rel="stylesheet" href="https://cdn.datatables.net/1.10.24/css/jquery.dataTables.min.css">
</head>
<body>

<div class="container text-center">
    <div class="row">
        <div class="col-xs-12 col-sm-12 col-md-12 col-lg-12">
            <h1>Resuelve FC Payroll</h1>
        </div>
    </div>
    <br>
    <div class="row">
        <h4>General dashboard</h4>
        <div class="col-xs-12 col-sm-12 col-md-12 col-lg-12">
            <table id="main" class="table">
                <thead>
                <tr>
                    <td>Team</td>
                    <td>Complete name</td>
                    <td>Level</td>
                    <td>Goals scored</td>
                    <td>Salary</td>
                    <td>Bonus</td>
                    <td>Ind. %</td>
                    <td>Mean %</td>
                    <td>Total</td>
                </tr>
                </thead>
                <tbody>
                <?php
                foreach ($players->data['jugadores'] as $item => $value): ?>
                    <tr>
                        <td><?= $value['equipo'];  ?></td>
                        <td><?= $value['nombre'];  ?></td>
                        <td><?= $value['nivel'];   ?></td>
                        <td><?= $value['goles'];   ?></td>
                        <td>$<?= number_format($value['sueldo'],2);  ?></td>
                        <td>$<?= number_format($value['bono'],2);    ?></td>
                        <td><?= $value['productivity']; ?> %</td>
                        <td><?= $value['mean'];?> %</td>
                        <td>$ <?=number_format($value['total'],2);?></td>
                    </tr>
                <?php endforeach; ?>
                </tbody>
            </table>
        </div>
    </div>
    <br>
    <div class="row">
        <h4>Goal Summary</h4>
        <div class="col-xs-12 col-sm-12 col-md-6 col-lg-6">
            <table class="table">
                <thead>
                    <tr>
                        <td>Team</td>
                        <td>Total goals to achieve</td>
                        <td>Total goals scored</td>
                        <td>Team %</td>
                    </tr>
                </thead>
                <tbody>
                <?php foreach ($players->teamSummary as $item => $value): ?>
                <tr>
                    <td><?= $item ?></td>
                    <td><?= $value['goals'] ?></td>
                    <td><?= $value['scored'] ?></td>
                    <td><?= $value['productivity'] ?> %</td>
                </tr>
                <?php endforeach;?>
                </tbody>
            </table>
        </div>
        <div class="col-xs-12 col-sm-12 col-md-6 col-lg-6"></div>
    </div>
    <div class="row">
        <div class="col-xs-12 col-sm-12 col-md-12 col-lg-12">
            <strong>By Carlos M. G&oacute;mez</strong>
            <?php // ___($players->teamSummary) ?>
        </div>
    </div>
</div>

<script type="text/javascript" src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.2.1/jquery.js"></script>
<script src="https://unpkg.com/@popperjs/core@2"></script>
<script type="text/javascript" src="https://cdn.datatables.net/1.10.24/js/jquery.dataTables.min.js"></script>
<script type="text/javascript" src="bootstrap.min.js"></script>
<script type="text/javascript" src="app.js"></script>
</body>
</html>
