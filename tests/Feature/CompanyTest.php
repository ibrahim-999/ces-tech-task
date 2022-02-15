<?php

namespace Tests\Feature;

use App\User;
use App\Company;
use Tests\TestCase;
use Illuminate\Foundation\Testing\WithFaker;
use Illuminate\Foundation\Testing\RefreshDatabase;

class CompanyTest extends TestCase
{
    use RefreshDatabase;

    private $user;

    public function setUp(): void
    {
        parent::setUp();

        $this->user = factory(User::class)->create([
            'email' => 'admin@admin.com',
            'password' => bcrypt('password123'),
        ]);
    }

    /** @test */
    public function company_can_be_created()
    {
        $this->withoutExceptionHandling();

        $response = $this->actingAs($this->user)->post('/companies', [
            'name' => 'enov8',
            'location' => 'Lagos', 
            'email' => 'hello@enov8.com', 
            'phone' => '08098756673',
            'user_id' => 1
        ]);

        $this->assertCount(1, Company::all());
        $response->assertRedirect('/companies');
    }


    /** @test */
    public function company_can_be_updated()
    {
        $this->withoutExceptionHandling();

        $this->actingAs($this->user)->post('/companies', [
            'name' => 'enov8',
            'location' => 'Lagos', 
            'email' => 'hello@enov8.com', 
            'phone' => '08098756673',
            'user_id' => 1
        ]);

        $company = Company::first();

        $response = $this->actingAs($this->user)->patch('/companies/'. $company->id, [
            'name' => 'enov8 solutions',
            'location' => 'Lekki', 
            'email' => 'hello@enov8.com', 
            'phone' => '08098756673'
        ]);


        $this->assertEquals('enov8 solutions', Company::first()->name);
        $this->assertEquals('Lekki', Company::first()->location);

        $response->assertRedirect('/companies/'. $company->id);
    }

    /** @test */
    public function company_can_be_deleted()
    {
        $this->withoutExceptionHandling();

        $response = $this->actingAs($this->user)->post('/companies', [
            'name' => 'enov8',
            'location' => 'Lagos', 
            'email' => 'hello@enov8.com', 
            'phone' => '08098756673',
            'user_id' => 1
        ]);

        $company = Company::first();
        $this->assertCount(1, Company::all());

        $response = $this->actingAs($this->user)->delete('/companies/' . $company->id);

        $this->assertCount(0, Company::all());
        $response->assertRedirect('/companies');
    }
}
