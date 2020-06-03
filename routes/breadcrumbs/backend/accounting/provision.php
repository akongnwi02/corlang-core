<?php

Breadcrumbs::for('admin.accounting.provision.index', function ($trail) {
    $trail->parent('admin.dashboard');
    $trail->push(__('menus.backend.accounting.provisions.management'), route('admin.accounting.provision.index'));
});

Breadcrumbs::for('admin.accounting.provision.show', function ($trail, $id) {
    $trail->parent('admin.accounting.provision.index');
    $trail->push(__('menus.backend.accounting.provisions.view'), route('admin.accounting.provision.show', $id));
});
