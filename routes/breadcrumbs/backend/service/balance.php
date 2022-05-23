<?php

Breadcrumbs::for('admin.services.balance.index', function ($trail) {
    $trail->parent('admin.dashboard');
    $trail->push(__('menus.backend.services.balance.management'), route('admin.services.balance.index'));
});

