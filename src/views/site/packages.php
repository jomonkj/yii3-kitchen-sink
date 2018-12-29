<?php

use idk\app\helpers\DocHelper;
use idk\app\helpers\Html;

/** @var array $packages */
/** @var string $title */
/** @var string $subTitle */

$this->title = $title;
$this->subTitle = $subTitle;

?>

<?= DocHelper::doc('3-Packages') ?>

<hr />

<p>
    The current on-going effort is to make the grid below all green:
</p>

<div class="packages">
<?php foreach ($packages as $package => $infos): ?>
    <div class="item">
        <?= $package ?><br />
        <?= Html::o('mark-github') ?><br />
        <a href="https://travis-ci.<?= $infos['travis'] ?>/yiisoft/<?= $package ?>">
            <img src="https://travis-ci.<?= $infos['travis'] ?>/yiisoft/<?= $package ?>.svg?branch=master" />
        </a>
    </div>
<?php endforeach ?>
</div>