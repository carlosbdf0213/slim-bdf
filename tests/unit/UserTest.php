<?php

class UserTest extends \PHPUnit\Framework\TestCase
{
    protected $user;

    public function setUp()
    {
        $this->user = new \App\Models\User;
    }

    public function testEmailVariablesContainCorrectValues()
    {
        $user = new \App\Models\User;
        $user->setFirstName('Carlos');
        $user->setLastName('Beyersdorf');
        $user->setEmail('carlosbdf0213@gmail.com');

        $emailVariables = $user->getEmailVariables();

        $this->assertArrayHasKey('full_name', $emailVariables);
        $this->assertArrayHasKey('email', $emailVariables);

        $this->assertEquals($emailVariables['full_name'], 'Carlos Beyersdorf');
        $this->assertEquals($emailVariables['email'], 'carlosbdf0213@gmail.com');
    }
}