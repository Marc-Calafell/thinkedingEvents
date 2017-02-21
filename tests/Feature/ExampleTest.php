<?php

namespace Tests\Feature;

use App\Mail\WelcomeEmailMarkdown;
use Event;
use Illuminate\Auth\Events\Registered;
use Mail;
use Tests\TestCase;
use Illuminate\Foundation\Testing\WithoutMiddleware;
use Illuminate\Foundation\Testing\DatabaseMigrations;
use Illuminate\Foundation\Testing\DatabaseTransactions;

class ExampleTest extends TestCase
{
    /**
     * A basic test example.
     *
     * @return void
     */
    public function testBasicTest()
    {
        $response = $this->get('/');

        $response->assertStatus(200);
    }

    /**
     *
     */
    public function testRegisterUserSendWelcomeEmail()
    {
        Mail::fake();
        $user = new \App\User();
        $user->name = 'Ramon Zampón';
        $user->email = 'manelgavalda@gmail.com';
        event(new Registered($user));
        Mail::assertSent(WelcomeEmailMarkdown::class, function ($mail) use ($user) {
            return ($mail->user->name === $user->name) && ($mail->user->email === $user->email);
        });

    }

    public function testRegisterUserSendWelcomeEmail2()
    {
        Event::fake();
        $this->get('/registerUser');
        Event::assertDispatched(Registered::class, function ($event) {
            return $event->user->name === 'Provamare';
        });

    }
}
