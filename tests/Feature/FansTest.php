<?php

namespace Tests\Feature;

use Tests\TestCase;
use Illuminate\Foundation\Testing\WithFaker;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithoutMiddleware;
use Session;

class FansTest extends TestCase
{
    /**
     * A basic feature test example.
     *
     * @return void
     */
    public function testFansList()
    {
        $response = $this->get('/fans');

        $response->assertStatus(200);
    }

    public function testFansCreateView()
    {
        $response = $this->get('/fans/create');
        $response->assertSee('data');
    }

    public function testFansCreateShow()
    {
        $response = $this->get('/fans/2');
        $response->assertSee('data');
    }

    public function testFansCreatePost()
    {
        Session::start();

        $response = $this->json('POST','/fans',
            [
                '_token'       => Session::token(),
                'name'         => 'wandre',
                'document'     => '053.457.811-09',
                'email'        =>  'wandre@mail.com',
                'telephone'    => '(61) 9 94295752' ,
                'active'       => '1',
                'addressName'  => 'Quadra 103 Casa 17',
                'neighborhood' => 'Jardim Ingá',
                'estado'       => '2',
                'cidade'       => '14'
            ]
        );

        $response->assertSessionHas('msg', $value = null);
    }

    public function testFansCreateUpdate()
    {
        Session::start();

        $response = $this->json('POST','/fans/2',
            [
                '_token'       => Session::token(),
                '_method'      => 'PUT',
                'name'         => 'wandre',
                'document'     => '053.457.811-09',
                'email'        =>  'wandre@mail.com',
                'telephone'    => '(61) 9 94295752' ,
                'active'       => '1',
                'addressName'  => 'Quadra 103 Casa 17',
                'neighborhood' => 'Jardim Ingá',
                'estado'       => '2',
                'cidade'       => '14'
            ]
        );

        $response->assertSessionHas('msg', $value = null);
    }
}
