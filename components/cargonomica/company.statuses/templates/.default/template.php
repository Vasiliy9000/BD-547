<?php

if (!defined("B_PROLOG_INCLUDED") || B_PROLOG_INCLUDED !== true) {
    die();
}
global $APPLICATION;

?>
<link href="//cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
<link href="//fonts.googleapis.com/css2?family=Roboto:wght@400;700&display=swap" rel="stylesheet">
<style>
    .statuses .product {
        color: #B0B4BA;
    }

    .statuses .basic {
        color: #888888;
    }

    .statuses .inn {
        color: #474747;
    }

    .statuses .security,
    .statuses .false,
    .statuses .potential,
    .statuses .black,
    .statuses .grey,
    .statuses .green {
        display: flex;
        align-items: center;
        justify-content: center;
        text-align: center;
        font-weight: 500;
        font-size: 9px;
        line-height: 11px;
        margin: auto;
        text-transform: uppercase;
        border-radius: 2px;
        color: #FFF;
    }

    .statuses .false, .statuses .potential {
        display: none;
    }

    .statuses .security {
        width: 96px;
        height: 17px;
    }

    .statuses .black {
        background-color: #000;
    }

    .statuses .grey {
        background-color: #848484;
    }

    .statuses .green {
        background-color: #00C136;
    }

    .statuses .active,
    .statuses .former {
        width: 28px;
        height: 28px;
        display: flex;
        align-items: center;
        justify-content: center;
        border-radius: 2px;
        margin: auto;
        font-weight: 900;
        font-size: 1.2em;
    }

    .statuses .active {
        background-color: #05E300;
        color: #F9F9F9;
    }

    .statuses .former {
        background-color: #E7E7E7;
        color: #A4A4A4;
    }

    .statuses th, .statuses td {
        font-family: 'Roboto', sans-serif;
        text-align: center;
        vertical-align: middle;
        min-width: 150px;
    }

    .statuses th {
        font-weight: 700;
        font-size: 13px;
    }
</style>
<div class="table-responsive statuses">
    <table class="table table-bordered">
        <thead>
        <tr>
            <th scope="col" class="inn">ИНН</th>
            <th scope="col" class="basic">Общий статус</th>
            <?php foreach ($arResult["products"] as $product): ?>
                <?php if (!in_array($product["FIELD_TYPE"], ["basic", "security"])): ?>
                    <th scope="col" class="product"><?= $product["SHORT_NAME"] ?></th>
                <?php endif; ?>
            <?php endforeach; ?>
        </tr>
        </thead>
        <tbody>
        <?php foreach ($arResult["company"]["inns"] as $inn => $data): ?>
            <tr>
                <th scope="row" class="inn">
                    <div><?= $inn ?></div>
                    <div><?= $data["shortName"] ?></div>
                    <div class="security <?= $data["security"]["VALUE"] ?? "false" ?>">
                        <?= $arResult["products"]["security"]["VALUES"][$data["security"]["VALUE"]]["NAME"] ?? "" ?>
                    </div>
                </th>
                <td>
                    <div class="<?= $data["basic"]["VALUE"] ?? "false" ?>">
                        <?= in_array($data["basic"]["VALUE"] ?? "false", ["active", "former"]) ? "✓" : "" ?>
                    </div>
                </td>
                <?php foreach ($arResult["products"] as $product => $value): ?>
                    <?php if (!in_array($product, ["basic", "security"])): ?>
                        <td>
                            <div class="<?= $arResult["company"]["inns"][$inn][$product]["VALUE"] ?? "false" ?>">✓</div>
                        </td>
                    <?php endif; ?>
                <?php endforeach; ?>
            </tr>
        <?php endforeach; ?>
        </tbody>
    </table>
</div>
