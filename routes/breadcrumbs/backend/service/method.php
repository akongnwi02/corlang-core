<?php

Breadcrumbs::for('admin.services.method.index', function ($trail) {
    $trail->parent('admin.dashboard');
    $trail->push(__('menus.backend.services.method.management'), route('admin.services.method.index'));
});

Breadcrumbs::for('admin.services.method.edit', function ($trail, $id) {
    $trail->parent('admin.services.method.index');
    $trail->push(__('menus.backend.services.method.edit'), route('admin.services.method.edit', $id));
});
