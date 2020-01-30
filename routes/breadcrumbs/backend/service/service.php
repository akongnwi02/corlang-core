<?php

Breadcrumbs::for('admin.services.service.index', function ($trail) {
    $trail->parent('admin.dashboard');
    $trail->push(__('menus.backend.services.service.management'), route('admin.services.service.index'));
});

Breadcrumbs::for('admin.services.service.edit', function ($trail, $id) {
    $trail->parent('admin.services.service.index');
    $trail->push(__('menus.backend.services.service.edit'), route('admin.services.service.edit', $id));
});


Breadcrumbs::for('admin.services.service.create', function ($trail) {
    $trail->parent('admin.services.service.index');
    $trail->push(__('menus.backend.services.service.create'), route('admin.services.service.create'));
});

