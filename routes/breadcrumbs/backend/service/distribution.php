<?php

Breadcrumbs::for('admin.services.distribution.index', function ($trail) {
    $trail->parent('admin.dashboard');
    $trail->push(__('menus.backend.services.distribution.management'), route('admin.services.distribution.index'));
});

Breadcrumbs::for('admin.services.distribution.create', function ($trail) {
    $trail->parent('admin.services.distribution.index');
    $trail->push(__('menus.backend.services.distribution.create'), route('admin.services.distribution.create'));
});

Breadcrumbs::for('admin.services.distribution.edit', function ($trail, $id) {
    $trail->parent('admin.services.distribution.index');
    $trail->push(__('menus.backend.services.distribution.edit'), route('admin.services.distribution.edit', $id));
});

