<?php

namespace Tests\Feature;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;
use App\Models\Resto;
use App\Models\Review;
use App\Models\User;
use Laravel\Sanctum\Sanctum;

class RestoTest extends TestCase
{
    use RefreshDatabase;

    public function test_user_can_list_all_resto()
    {
        $count = 5;
        Resto::factory()->count($count)->create();

        $this->getJson(route('restos.index'))
            ->assertOk()
            ->assertJsonCount($count);
    }

    public function test_user_can_create_resto()
    {
        $data = Resto::factory()->makeOne()->toArray();

        $this->postJson(route('restos.store'), $data)->assertCreated();
    }

    public function test_user_can_show_resto()
    {
        $data = Resto::factory()->createOne();

        $this->getJson(route('restos.show', $data))
            ->assertOk()
            ->assertJsonStructure(['name', 'description', 'address']);
    }

    public function test_user_can_edit_resto()
    {
        $updatedData = Resto::factory()->makeOne()->toArray();
        $data = Resto::factory()->createOne();

        $this->patchJson(route('restos.update', $data), $updatedData)
            ->assertOk()
            ->assertJsonStructure(['name', 'description', 'address']);
    }

    public function test_user_can_delete_resto()
    {
        $data = Resto::factory()->createOne();

        $this->deleteJson(route('restos.destroy', $data))
            ->assertOk()
            ->assertJsonStructure(['name', 'description', 'address']);
    }

    public function test_user_can_list_reviews_for_this_record()
    {
        $reviewCount = 5;
        $record = Resto::factory()
            ->has(Review::factory()->count($reviewCount))
            ->create();

        $user = User::factory()->createOne();
        Sanctum::actingAs($user);

        $this->getJson(route('restos.reviews', $record))
            ->assertOk()
            ->assertJsonCount($reviewCount);
    }
}