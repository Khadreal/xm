<?php

namespace Tests\Feature;

use App\Mail\Notification;
use App\Models\CompanySymbol;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Illuminate\Http\Request;
use Mockery\MockInterface;
use Tests\TestCase;

class FrontendTest extends TestCase
{
    use RefreshDatabase;

    /**
     * Check if index page is working.
     */
    public function test_search_form(): void
    {
        $response = $this->get('/');

        $response->assertViewIs('index');

        $response->assertSuccessful();
    }

    public function testValidSymbolSearch()
    {
        CompanySymbol::factory()->create([
            'symbol' => 'ABTL',
            'name' => 'Faker name'
        ]);

        $response = $this->post('fetch-historical-data',[
            'symbol' => 'ABTL',
            'end_date' => '2022-10-01',
            'start_date' => '2022-09-01',
            'email' => 'faker@xm.com',
        ]);


        $response->assertSuccessful();
    }

    public function testInvalidSymbolSearch()
    {
        CompanySymbol::factory()->create([
            'symbol' => 'ABTL',
            'name' => 'Faker name'
        ]);

        $response = $this->post('fetch-historical-data',[
            'symbol' => 'XXXX',
            'end_date' => '2022-10-01',
            'start_date' => '2022-09-01',
            'email' => 'faker@xm.com',
        ]);


        $response->assertUnprocessable();
    }

    public function testInvalidDateSearch()
    {
        CompanySymbol::factory()->create([
            'symbol' => 'ABTL',
            'name' => 'Faker name'
        ]);

        $response = $this->post('fetch-historical-data',[
            'symbol' => 'ABTL',
            'end_date' => '2021-10-01',
            'start_date' => '2022-09-01',
            'email' => 'faker@xm.com',
        ]);


        $response->assertUnprocessable();
    }

    public function testInvalidEmail()
    {
        CompanySymbol::factory()->create([
            'symbol' => 'ABTL',
            'name' => 'Faker name'
        ]);

        $response = $this->post('fetch-historical-data',[
            'symbol' => 'ABTL',
            'end_date' => '2022-10-01',
            'start_date' => '2022-09-01',
            'email' => 'faker',
        ]);


        $response->assertUnprocessable();
    }

    public function testEmail()
    {
        CompanySymbol::factory()->create([
            'symbol' => 'ABTL',
            'name' => 'Company name should be here'
        ]);

        $request = new \Illuminate\Http\Request();
        $request->request->add([
            'symbol' => 'ABTL',
            'end_date' => '2022-10-01',
            'start_date' => '2022-09-01',
        ]);

        $mailable = new Notification($request->all(), 'faker-filepath.csv', 'Company name should be here');

        $mailable->assertFrom('noreply@xm.com');
        $mailable->assertHasSubject('Company name should be here');
        $mailable->assertHasAttachment('faker-filepath.csv');
    }
}
