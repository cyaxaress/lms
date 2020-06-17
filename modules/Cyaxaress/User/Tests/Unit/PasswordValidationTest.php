<?php

namespace Cyaxaress\User\Tests\Unit;

use Cyaxaress\User\Rules\ValidPassword;
use PHPUnit\Framework\TestCase;

class PasswordValidationTest extends TestCase
{
    /**
     * A basic unit test example.
     *
     * @return void
     */
    public function test_password_should_not_be_less_than_6_character()
    {
        $result = (new ValidPassword())->passes('', 'A12a!');
        $this->assertEquals(0, $result);
    }

    public function test_password_should_include_sign_character()
    {
        $result = (new ValidPassword())->passes('', 'A12a25241');
        $this->assertEquals(0, $result);
    }

    public function test_password_should_include_digit_character()
    {
        $result = (new ValidPassword())->passes('', 'A!@!@aasdf');
        $this->assertEquals(0, $result);
    }

    public function test_password_should_include_Capital_character()
    {
        $result = (new ValidPassword())->passes('', '!@!@aasdf');
        $this->assertEquals(0, $result);
    }

    public function test_password_should_include_small_character()
    {
        $result = (new ValidPassword())->passes('', '!@!@ASDFWESD');
        $this->assertEquals(0, $result);
    }

}
