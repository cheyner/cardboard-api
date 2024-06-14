<?php

it('can register a user', function () {

    $email = fake()->email;

    $response = $this->post(route('register'), [
        'email' => $email,
        'password' => 'password',
    ], ['Accepts' => 'application/json']);

    $response->assertStatus(200);

    $this->assertDatabaseHas('users', [
        'email' => $email,
    ]);
});
