<?php

Breadcrumbs::for('admin.sales.index', function ($trail) {
    $trail->parent('admin.dashboard');
    $trail->push(__('menus.backend.sales.management'), route('admin.sales.index'));
});
