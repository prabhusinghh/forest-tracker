<?php

use App\Models\User;
use App\Models\Report;

test('explorer cannot access dashboard and is redirected to explore', function () {
    $user = User::factory()->create(['role' => 'explorer', 'is_approved' => true]);

    $response = $this->actingAs($user)->get('/dashboard');

    $response->assertRedirect('/explore');
});

test('explorer cannot access reports list or creation forms', function () {
    $user = User::factory()->create(['role' => 'explorer', 'is_approved' => true]);

    $response = $this->actingAs($user)->get('/reports');
    $response->assertStatus(403);

    $response = $this->actingAs($user)->get('/reports/create');
    $response->assertStatus(403);
});

test('conservationist can access dashboard and reports', function () {
    $user = User::factory()->create(['role' => 'conservationist', 'is_approved' => true]);

    $response = $this->actingAs($user)->get('/dashboard');
    $response->assertStatus(200);

    $response = $this->actingAs($user)->get('/reports');
    $response->assertStatus(200);
});
