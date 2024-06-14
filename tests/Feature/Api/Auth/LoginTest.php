<?php

use App\Models\User;

it('can login a user', function () {

    $user = User::factory()->create();

    $response = $this->post(route('login'), [
        'email' => $user->email,
        'password' => 'password',
    ], ['Accepts' => 'application/json']);

    $response->assertStatus(200);

});
