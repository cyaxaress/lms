<?php

namespace Cyaxaress\User\Tests\Feature;

use Cyaxaress\User\Models\User;
use Illuminate\Foundation\Testing\DatabaseMigrations;
use Mail;
use Tests\TestCase;

class ResetPasswordTest extends TestCase
{
    use DatabaseMigrations;

    public function test_user_can_see_reset_password_request_form()
    {
        $this->get(route('password.request'))->assertOk();
    }

    public function test_user_can_see_enter_verify_code_form_by_correct_email()
    {
        Mail::fake();
        $user = User::create(
            [
                'name' => 'Hemn',
                'email' => 'hemn791@gmail.com',
                'password' => bcrypt('A!123a'),
            ]
        );
        $this->call('get', route('password.sendVerifyCodeEmail'), ['email' => 'hemn791@gmail.com'])
            ->assertOk();
    }

    public function test_user_cannot_see_enter_verify_code_form_by_wrong_email()
    {
        $this->call('get', route('password.sendVerifyCodeEmail'), ['email' => 'hemn791.com'])
            ->assertStatus(302);
    }

    public function test_user_banned_after_6_attempt_to_reset_password()
    {
        for ($i = 0; $i < 5; $i++) {
            $this->post(route('password.checkVerifyCode'), ['verify_code', 'email' => 'hemn@gmail.com'])->assertStatus(302);
        }
        $this->post(route('password.checkVerifyCode'), ['verify_code', 'email' => 'hemn@gmail.com'])->assertStatus(429);
    }
}
