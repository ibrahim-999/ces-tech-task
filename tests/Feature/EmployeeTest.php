<?php

namespace Tests\Feature;

use App\User;
use App\Employee;
use Tests\TestCase;
use Illuminate\Foundation\Testing\WithFaker;
use Illuminate\Foundation\Testing\RefreshDatabase;

class EmployeeTest extends TestCase
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
    public function employee_can_be_add_to_company()
    {
        $this->withoutExceptionHandling();

        $response = $this->actingAs($this->user)->post('/employees', [
            'first_name' => 'john',
            'last_name' => 'doe', 
            'email' => 'hello@enov8.com', 
            'phone' => '08098756673',
            'company_id' => 1
        ]);

        $this->assertCount(1, Employee::all());
        $response->assertRedirect('/companies');
    }


    /** @test */
    public function employee_can_be_updated()
    {
        $this->withoutExceptionHandling();

        $this->actingAs($this->user)->post('/employees', [
            'first_name' => 'john',
            'last_name' => 'doe', 
            'email' => 'hello@enov8.com', 
            'phone' => '08098756673',
            'company_id' => 1
        ]);

        $employee = Employee::first();

        $response = $this->actingAs($this->user)->patch('/employees/'. $employee->id, [
            'first_name' => 'jane',
            'last_name' => 'phil', 
            'email' => 'hello@enov8.com', 
            'phone' => '08098756673',
            'company_id' => 1
        ]);


        $this->assertEquals('jane', Employee::first()->first_name);
        $this->assertEquals('phil', Employee::first()->last_name);

        $response->assertRedirect('/companies');
    }

    /** @test */
    public function employee_can_be_deleted()
    {
        $this->withoutExceptionHandling();

        $this->actingAs($this->user)->post('/employees', [
            'first_name' => 'john',
            'last_name' => 'doe', 
            'email' => 'hello@enov8.com', 
            'phone' => '08098756673',
            'company_id' => 1
        ]);

        $employee = Employee::first();
        $this->assertCount(1, Employee::all());

        $response = $this->actingAs($this->user)->delete('/employees/' . $employee->id);

        $this->assertCount(0, Employee::all());
        $response->assertRedirect('/companies');
    }
}
