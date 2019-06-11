<?php

class UserControllerTest extends TestCase
{
    /**
     * A basic functional test example.
     *
     * @return void
     */
    public function testSuccessLogin()
    {
      
        $user = factory('App\User')->create();

        $response = $this->call('POST', '/v1/auth/login', 
            [
                'email' => $user->email,
                'password' => env('TEMP_PASSWORD'),
            ]
        );

        $this->assertEquals(200, $response->status());

    }

    function testInvalidLogin () {

        $user = factory('App\User')->create();

        // Invalid login
        $response = $this->call('POST', '/v1/auth/login', 
            [
                'email' => $user->email,
                'password' => 344343,
            ]
        );

        $this->assertEquals(400, $response->status());
    }
}