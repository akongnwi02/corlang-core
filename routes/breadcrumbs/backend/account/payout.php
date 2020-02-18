<?php

Breadcrumbs::for('admin.account.payout.index', function ($trail) {
    $trail->parent('admin.dashboard');
    $trail->push(__('menus.backend.accounts.payout.management'), route('admin.account.payout.index'));
});
