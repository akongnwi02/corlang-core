<?php

Breadcrumbs::for('admin.account.deposit.index', function ($trail) {
    $trail->parent('admin.dashboard');
    $trail->push(__('menus.backend.accounts.deposit.management'), route('admin.account.deposit.index'));
});

Breadcrumbs::for('admin.account.deposit.show', function ($trail, $id) {
    $trail->parent('admin.account.deposit.index');
    $trail->push(__('menus.backend.accounts.deposit.view'), route('admin.account.deposit.show', $id));
});
