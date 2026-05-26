<?php

test('registration screen can be rendered', function () {
    $response = $this->get('/register');

    $response->assertStatus(200);
});

test('new users can register as explorer and get auto-approved', function () {
    $response = $this->post('/register', [
        'name' => 'Test Explorer',
        'email' => 'explorer@example.com',
        'password' => 'password',
        'password_confirmation' => 'password',
        'role' => 'explorer',
    ]);

    $this->assertAuthenticated();
    $response->assertRedirect('/explore');

    $user = \App\Models\User::where('email', 'explorer@example.com')->first();
    expect($user->role)->toBe('explorer');
    expect($user->is_approved)->toBeTrue();
});

test('new users can register as conservationist and remain pending approval', function () {
    $response = $this->post('/register', [
        'name' => 'Test Conservationist',
        'email' => 'conservationist@example.com',
        'password' => 'password',
        'password_confirmation' => 'password',
        'role' => 'conservationist',
    ]);

    $this->assertAuthenticated();
    $response->assertRedirect(route('dashboard', absolute: false));

    $user = \App\Models\User::where('email', 'conservationist@example.com')->first();
    expect($user->role)->toBe('conservationist');
    expect($user->is_approved)->toBeFalse();
});
