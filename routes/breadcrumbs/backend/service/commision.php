<?php

Breadcrumbs::for('admin.services.commission.index', function ($trail) {
    $trail->parent('admin.dashboard');
    $trail->push(__('menus.backend.services.commission.management'), route('admin.services.commission.index'));
});

Breadcrumbs::for('admin.services.commission.create', function ($trail) {
    $trail->parent('admin.dashboard');
    $trail->push(__('menus.backend.services.commission.create'), route('admin.services.commission.create'));
});

Breadcrumbs::for('admin.services.commission.edit', function ($trail, $id) {
    $trail->parent('admin.dashboard');
    $trail->push(__('menus.backend.services.commission.edit'), route('admin.services.commission.edit', $id));
});

