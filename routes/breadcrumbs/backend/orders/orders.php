<?php

Breadcrumbs::for('admin.orders.index', function ($trail) {
    $trail->parent('admin.dashboard');
    $trail->push(__('menus.backend.orders.management'), route('admin.orders.index'));
});
