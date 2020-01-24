<?php


Breadcrumbs::for('admin.services.service.index', function ($trail) {
    $trail->parent('admin.dashboard');
    $trail->push(__('menus.backend.services.service.management'), route('admin.services.service.index'));
});

