<?php

Breadcrumbs::for('admin.administration.currency.index', function ($trail) {
    $trail->parent('admin.dashboard');
    $trail->push(__('menus.backend.administration.currency.management'), route('admin.administration.currency.index'));
});

Breadcrumbs::for('admin.administration.currency.create', function ($trail) {
    $trail->parent('admin.administration.currency.index');
    $trail->push(__('menus.backend.administration.currency.create'), route('admin.administration.currency.create'));
});

Breadcrumbs::for('admin.administration.currency.edit', function ($trail, $id) {
    $trail->parent('admin.administration.currency.index');
    $trail->push(__('menus.backend.administration.currency.edit'), route('admin.administration.currency.edit', $id));
});
