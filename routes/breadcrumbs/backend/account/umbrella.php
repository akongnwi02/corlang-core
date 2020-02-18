<?php

Breadcrumbs::for('admin.account.umbrella.show', function ($trail, $id) {
    $trail->parent('admin.account.umbrella.index');
    $trail->push(__('menus.backend.accounts.umbrella.view'), route('admin.account.umbrella.show', $id));
});

Breadcrumbs::for('admin.account.umbrella.index', function ($trail) {
    $trail->parent('admin.dashboard');
    $trail->push(__('menus.backend.accounts.umbrella.management'), route('admin.account.umbrella.index'));
});
