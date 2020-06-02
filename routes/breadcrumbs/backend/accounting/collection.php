<?php

Breadcrumbs::for('admin.accounting.collection.index', function ($trail) {
    $trail->parent('admin.dashboard');
    $trail->push(__('menus.backend.accounting.collections.management'), route('admin.accounting.collection.index'));
});

Breadcrumbs::for('admin.accounting.collection.show', function ($trail, $id) {
    $trail->parent('admin.accounting.collection.index');
    $trail->push(__('menus.backend.accounting.collections.view'), route('admin.accounting.collection.show', $id));
});
