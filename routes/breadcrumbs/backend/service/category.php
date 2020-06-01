<?php


Breadcrumbs::for('admin.services.category.index', function ($trail) {
    $trail->parent('admin.dashboard');
    $trail->push(__('menus.backend.services.category.management'), route('admin.services.category.index'));
});

Breadcrumbs::for('admin.services.category.edit', function ($trail, $id) {
    $trail->parent('admin.services.category.index');
    $trail->push(__('menus.backend.services.category.edit'), route('admin.services.category.edit', $id));
});
