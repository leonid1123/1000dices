<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="bootstrap/css/bootstrap.min.css">
    <link href="bootstrap/js/bootstrap.min.js">
    <title>40000Rolls</title>

</head>

<body>
    <div class="container-md">
        <p>Приложение моделирует одну и туже ситуации 40000 раз. Например, один космодесантник стреляет из болтера в половине дистанции в десантника отступника. Два выстрела, а попадание 3+, на ранение 4+, спасбросок 3+. Именно эта ситуация просчитывается 40000 раз. В итоге будет написано сколько раз хаосит проваливал спасброски.</p>
        <form action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]); ?>" method="post">
            <div class="col-3 mb-3">
                <label for="exampleFormControlInput1" class="form-label">Number of attacks</label>
                <input type="number" class="form-control" id="exampleFormControlInput1" placeholder="1...100" name="numberOfAttacks">
            </div>
            <div class="form-check form-check-inline">
                <input class="form-check-input" type="radio" name="inlineRadioOptions" id="inlineRadio1" value="1" checked>
                <label class="form-check-label" for="inlineRadio1">1</label>
            </div>
            <div class="form-check form-check-inline">
                <input class="form-check-input" type="radio" name="inlineRadioOptions" id="inlineRadio2" value="2">
                <label class="form-check-label" for="inlineRadio2">D3</label>
            </div>
            <div class="form-check form-check-inline">
                <input class="form-check-input" type="radio" name="inlineRadioOptions" id="inlineRadio3" value="3">
                <label class="form-check-label" for="inlineRadio3">D6</label>
            </div>
            <div class="form-check form-check-inline">
                <input class="form-check-input" type="radio" name="inlineRadioOptions" id="inlineRadio4" value="4">
                <label class="form-check-label" for="inlineRadio4">2D6</label>
            </div>
            <p class="mt-3 mb-1">To Hit</p>
            <div class="col-3 mb-3">
                <select class="form-select" aria-label="ToHit" name="toHit" id="toHitInput">
                    <option value="2">2+</option>
                    <option value="3">3+</option>
                    <option value="4">4+</option>
                    <option value="5">5+</option>
                    <option value="6">6+</option>
                </select>
            </div>
            <div class="form-check form-check-inline">
                <input class="form-check-input" type="radio" name="inlineRadioOptions1" id="inlineRadio5" value="0" checked>
                <label class="form-check-label" for="inlineRadio5">Nothing</label>
            </div>
            <div class="form-check form-check-inline">
                <input class="form-check-input" type="radio" name="inlineRadioOptions1" id="inlineRadio6" value="1">
                <label class="form-check-label" for="inlineRadio6">ReRoll "1"</label>
            </div>
            <div class="form-check form-check-inline">
                <input class="form-check-input" type="radio" name="inlineRadioOptions1" id="inlineRadio7" value="2">
                <label class="form-check-label" for="inlineRadio7">Full ReRoll</label>
            </div>
            <div class="form-check form-check-inline">
                <input class="form-check-input" type="radio" name="inlineRadioOptions1" id="inlineRadio8" value="3">
                <label class="form-check-label" for="inlineRadio8">"6" AutoWound</label>
            </div>
            <div class="form-check form-check-inline">
                <input class="form-check-input" type="radio" name="inlineRadioOptions1" id="inlineRadio81" value="4" disabled>
                <label class="form-check-label" for="inlineRadio8">"6" AP-1</label>
            </div>
            <div class="col-3 mb-3">
                <p class="mt-3 mb-1">To Wound</p>
                <select class="form-select" aria-label="ToWound" name="toWound" id="toWoundInput">
                    <option value="2">2+</option>
                    <option value="3">3+</option>
                    <option value="4">4+</option>
                    <option value="5">5+</option>
                    <option value="6">6+</option>
                    <option value="1">AutoWound</option>
                </select>
            </div>
            <div class="form-check form-check-inline">
                <input class="form-check-input" type="radio" name="inlineRadioOptions2" id="inlineRadio9" value="0" checked>
                <label class="form-check-label" for="inlineRadio9">Nothing</label>
            </div>
            <div class="form-check form-check-inline">
                <input class="form-check-input" type="radio" name="inlineRadioOptions2" id="inlineRadio10" value="1">
                <label class="form-check-label" for="inlineRadio10">ReRoll "1"</label>
            </div>
            <div class="form-check form-check-inline">
                <input class="form-check-input" type="radio" name="inlineRadioOptions2" id="inlineRadio11" value="2">
                <label class="form-check-label" for="inlineRadio11">Full ReRoll</label>
            </div>
            <div class="col-3 mb-3">
                <p class="mt-3 mb-1">Save</p>
                <select class="form-select" aria-label="Save" name="save" id="saveInput">
                    <option value="2">2+</option>
                    <option value="3">3+</option>
                    <option value="4">4+</option>
                    <option value="5">5+</option>
                    <option value="6">6+</option>
                    <option value="7">No Save Roll</option>
                </select>
            </div>
            <div class="form-check form-check-inline">
                <input class="form-check-input" type="checkbox" id="inlineCheckbox1" value="1" name="inlineCheckbox1" disabled>
                <label class="form-check-label" for="inlineCheckbox1">Invul</label>
            </div>

            <div class="col-3 mb-3 mt-3">
                <button class="btn btn-outline-secondary" type="submit" id="button-addon1" name="go">ROLL!!!</button>
            </div>
        </form>
        <?php
        $allFailures = array();
        if (isset($_POST["go"])) {
            $numberOfAttacks = $_POST["numberOfAttacks"];
            $attacksMod = $_POST["inlineRadioOptions"];
            $toHit = $_POST["toHit"];
            $toHitMod = $_POST["inlineRadioOptions1"];
            $toWound = $_POST["toWound"];
            $toWoundMod = $_POST["inlineRadioOptions2"];
            $save = $_POST["save"];
            //$saveMod = $_POST["inlineCheckbox1"];
            if (is_integer((int)$numberOfAttacks)) {
                $numberOfAttacks = (int)$numberOfAttacks;
            } else {
                die("Ooops!");
            }
            switch ($attacksMod) {
                case 1:
                    $numberOfAttacks *= 1;
                    break;
                case 2:
                    $numberOfAttacks *= random_int(1, 3);
                    break;
                case 3:
                    $numberOfAttacks *= random_int(1, 6);
                    break;
                case 4:
                    $numberOfAttacks = $numberOfAttacks * random_int(1, 3) * random_int(1, 3);
                default:
                    die;
                    break;
            }
            //Начало цикла в 40000 итераций
            for ($j = 0; $j < 40000; $j++) {
                $numberOfHits = 0;
                $numberOfWounds = 0;
                //сколько раз попал
                for ($i = 0; $i < $numberOfAttacks; $i++) {
                    $x = random_int(1, 6);
                    if ($x >= $toHit) {
                        $numberOfHits++;
                    } else if ($toHitMod == 1 && $x == 1) { //переброс единиц
                        $x = random_int(1, 6);
                        if ($x > $toHit) {
                            $numberOfHits++;
                        }
                    } else if ($toHitMod == 2) { //полный переброс
                        $x = random_int(1, 6);
                        if ($x > $toHit) {
                            $numberOfHits++;
                        }
                    } else if($toHitMod==3 && $x==6){
                        $numberOfWounds++;
                        continue 1;
                    }
                }
                //сколько раз провундил
                for ($i = 0; $i < $numberOfHits; $i++) {
                    $y = random_int(1, 6);
                    if ($y >= $toWound) {
                        $numberOfWounds++;
                    } else if ($toWoundMod == 1 && $y == 1) { //переброс единиц
                        $y = random_int(1, 6);
                        if ($y >= $toWound) {
                            $numberOfWounds++;
                        }
                    } else if ($toWoundMod == 2) { //полный переброс
                        $y = random_int(1, 6);
                        if ($y >= $toWound) {
                            $numberOfWounds++;
                        }
                    }
                }
                $failedSaves = 0;
                for ($i = 0; $i < $numberOfWounds; $i++) {
                    $z = random_int(1, 6);
                    if ($z < $save) {
                        $failedSaves++;
                    }
                }
                $allFailures[$j] = $failedSaves;
            } //Конец цикла 40000 итераций
            $res = array_count_values($allFailures);
            arsort($res);
        }
        ?>
        <p class="mt-3">Результат:</p>
        <p>
            <?php
            if (isset($_POST["go"])) {
                foreach ($res as $key => $val) {
                    $percent = $val * 100 / 40000;
                    echo "<p>$key раз проваленный сейв - $val раз ($percent %) </p>";
                }
            }
            ?>
        </p>
    </div>
</body>

</html>