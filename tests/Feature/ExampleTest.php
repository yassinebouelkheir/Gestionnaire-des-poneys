<?php
use Illuminate\Support\Facades\Auth;

it('returns a successful response', function () {
    $user = $this->createAuthUser();
    $response = $this->get('/');

    $response->assertStatus(200);
});
