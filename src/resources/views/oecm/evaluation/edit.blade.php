<?php

/** @var \ImetCore\Controllers\Imet\oecm\ContextController $controller */
/** @var \ImetCore\Models\Imet\oecm\Imet $item */
/** @var string $step */

?>

@extends('imet-core::page.edit', [
    'controller' => $controller,
    'item' => $item,
    'step' => $step
])
