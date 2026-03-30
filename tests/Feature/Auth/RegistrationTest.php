<?php

use App\Mail\WelcomeMail;
use Illuminate\Support\Facades\Mail;

test('registration screen can be rendered', function () {
    $response = $this->get(route('register'));

    $response->assertOk();
});

test('new users can register', function () {
    Mail::fake();

    $response = $this->post(route('register.store'), [
        'name' => 'John Doe',
        'email' => 'test@example.com',
        'password' => 'password',
        'password_confirmation' => 'password',
    ]);

    $response->assertSessionHasNoErrors()
        ->assertRedirect(route('dashboard', absolute: false));

    $this->assertAuthenticated();
});

test('welcome email is sent after registration', function () {
    Mail::fake();

    $this->post(route('register.store'), [
        'name' => 'Budi Santoso',
        'email' => 'budi@example.com',
        'password' => 'password',
        'password_confirmation' => 'password',
    ]);

    Mail::assertSent(WelcomeMail::class, function ($mail) {
        return $mail->hasTo('budi@example.com')
            && $mail->user->name === 'Budi Santoso';
    });
});