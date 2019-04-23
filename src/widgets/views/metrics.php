<?php

/** @var SimpleXMLElement $metrics */
/** @var string $packageDir */

use app\helpers\Html;

?><table class="table table-sm">
    <tr>
        <th></th>
        <th>CA</th>
        <th>CE</th>
        <th>CIS</th>
        <th>DIT</th>
    </tr>
    <?php foreach ($metrics->package as $ns) : ?>
        <?php $idx = 0; foreach ($ns as $class) : $idx++; ?>
            <tr data-ns="<?= $ns['name'] ?>" data-idx="<?= $idx ?>">
                <td>
                    &nbsp;&nbsp;&nbsp;&nbsp;<?= $ns['name'] ?>\<?= Html::a($class['name'], str_replace($packageDir, 'https://github.com/yiisoft/' . $package['id'] . '/tree/master', $class->file['name'])) ?>
                </td>
                <td><?= $class['ca'] ?></td>
                <td><?= $class['ce'] ?></td>
                <td><?= $class['cis'] ?></td>
                <td><?= $class['dit'] ?></td>
            </tr>
        <?php endforeach ?>
    <?php endforeach ?>
</table>

<div class="alert alert-info">
    <dl>
        <dt>CA (Afferent Coupling)</dt>
        <dd>Number of unique <em>incoming</em> dependencies from other artifacts of the same type.</dd>

        <dt>CE (Efferent Coupling)</dt>
        <dd>Number of unique <em>outgoing</em> dependencies to other artifacts of the same type.</dd>

        <dt>CID (Class Interface Size)</dt>
        <dd>Number of non private methods and properties of a class:
            <code>
                CIS = public(NOM + VARS)
            </code>
            <br>
            Measures the size of the interface from other parts of the system to a class.
        </dd>

        <dt>Depth of Inheritance Tree</dt>
        <dd>Depth of inheritance to root class</dd>
    </dl>
</div>