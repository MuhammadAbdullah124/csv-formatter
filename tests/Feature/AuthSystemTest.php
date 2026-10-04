<?php

it('has a login page for guests', function () {
    $this->get('/login')->assertOk();
});

it('redirects unauthenticated users away from the dashboard', function () {
    $this->get('/dashboard')->assertRedirect('/login');
});
