<?php

namespace Tests\Feature;

use App\Models\TodoList;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;

class TodoListTest extends TestCase
{
    /**
     * A basic feature test example.
     *
     * @return void
     */
    use RefreshDatabase;
    private $list;
    public function setUp(): void{
        parent::setUp();
        $this->list = TodoList::factory()->create();
    }
    public function test_fetch_todo_list_all()
    {

        // preparation / prepare

        //TodoList::create(['name' => 'My Todo List']);

        // action / preform
        $response = $this->getJson(route('todo-list.index'));

        // assertion /predict
        $this->assertEquals(1, count($response->json()));
    }

    public function test_fetch_single_todo_list()
    {
        // preparation / prepare
        // $list = TodoList::factory()->create();

        // action / preform
        $response = $this->getJson(route('todo-list.show',$this->list->id))
                    ->assertOk()
                    ->json();

        // assertion /predict
        // $response->assertStatus(200);
        $this->assertEquals($response['name'], $this->list->name);
    }
    public function test_new_todo_list() {

        // preparation / prepare
        $list = TodoList::factory()->make(); // make is create value but not store in the database

        // action / preform
        $response = $this->postJson(route('todo-list.store',['name' => $list->name]))
                ->assertCreated()
                ->json();

        $this->assertEquals($list->name,$response['name']);

        $this->assertDatabaseHas('todo_lists',['name' => $list->name]);

        // assertion / predict

    }
    public function test_input_list_validation() {

        // preparation / prepare

        // action / preform

        $this->withExceptionHandling(); // to avoid parent omit exception handling

        $this->postJson(route('todo-list.store'))
            ->assertUnprocessable()
            ->assertJsonValidationErrors(['name']);

        // assertion / predict
    }
}
