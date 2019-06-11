<?php

class UserFlowControllerTest extends TestCase
{
    /**
     * A basic functional test example.
     *
     * @return void
     */
    public function testList()
    {
        // Weekly User flow
        // TODO
        $response = $this->call('GET','/v1/flow/count/weekly');

        $this->assertEquals(200, $response->status());
    }



}