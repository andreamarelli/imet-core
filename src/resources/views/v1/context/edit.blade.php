<?php

/** @var \ImetCore\Controllers\Imet\v2\ContextController $controller */
/** @var \ImetCore\Models\Imet\v2\Imet $item */
/** @var string $step */

?>

@extends('imet-core::page.edit', [
    'controller' => $controller,
    'item' => $item,
    'step' => $step
])
