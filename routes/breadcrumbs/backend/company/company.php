<?php


Breadcrumbs::for('admin.companies.company.index', function ($trail) {
    $trail->parent('admin.dashboard');
    $trail->push(__('menus.backend.companies.company.management'), route('admin.companies.company.index'));
});

Breadcrumbs::for('admin.companies.company.create', function ($trail) {
    $trail->parent('admin.companies.company.index');
    $trail->push(__('menus.backend.companies.company.create'), route('admin.companies.company.create'));
});

Breadcrumbs::for('admin.companies.company.edit', function ($trail, $id) {
    $trail->parent('admin.companies.company.index');
    $trail->push(__('menus.backend.companies.company.edit'), route('admin.companies.company.edit', $id));
});

