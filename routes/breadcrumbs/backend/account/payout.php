<?php

Breadcrumbs::for('admin.account.payout.index', function ($trail) {
    $trail->parent('admin.dashboard');
    $trail->push(__('menus.backend.accounts.payout.management'), route('admin.account.payout.index'));
});

Breadcrumbs::for('admin.account.payout.show', function ($trail, $id) {
    $trail->parent('admin.account.payout.index');
    $trail->push(__('menus.backend.accounts.payout.view'), route('admin.account.payout.show', $id));
});
