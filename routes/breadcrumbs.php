<?php

// Dashboard
Breadcrumbs::for('admin.dashboard', function ($trail) {
    $trail->push('Dashboard', route('dashboard'));
});

// Profile
Breadcrumbs::for('admin.profile', function ($trail) {
    $trail->parent('admin.dashboard');
    $trail->push('Profile', route('profile'));
});

// Dashboard > Users
Breadcrumbs::for('admin.users.index', function ($trail) {
    $trail->parent('admin.dashboard');
    $trail->push('Users', route('admin.users.index'));
});

// Dashboard > Users > [user]
Breadcrumbs::for('admin.users.show', function ($trail, $user) {
    $trail->parent('admin.users.index');
    $trail->push($user->name, route('admin.users.show', $user->id));
});

// Dashboard > Users > transactions
Breadcrumbs::for('admin.users.transactions', function ($trail, $user) {
    $trail->parent('admin.users.show', $user);
    $trail->push('Transactions');
});

// Dashboard > Users > [user]
Breadcrumbs::for('admin.users.edit', function ($trail, $user) {
    $trail->parent('admin.users.show', $user);
    $trail->push('Edit');
});


// Dashboard > Transactions
Breadcrumbs::for('admin.transactions.index', function ($trail) {
    $trail->parent('admin.dashboard');
    $trail->push('Transactions', route('admin.transactions.index'));
});

// Dashboard > Transactions > [transaction]
Breadcrumbs::for('admin.transactions.show', function ($trail, $transaction) {
    $trail->parent('admin.transactions.index');
    $trail->push($transaction->formattedAmount, route('admin.transactions.show', $transaction));
});