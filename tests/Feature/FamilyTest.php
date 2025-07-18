<?php

namespace Tests\Feature;

use App\Models\User;
use App\Models\Family;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

class FamilyTest extends TestCase
{
    use RefreshDatabase;

    public function test_user_can_create_family()
    {
        $user = User::factory()->create(['is_approved' => true, 'email_verified_at' => now()]);
        $this->actingAs($user);
        $response = $this->post(route('family.store'), [
            'family_name' => 'Keluarga Test',
            'description' => 'Deskripsi test',
        ]);
        $response->assertRedirect(route('family.index'));
        $this->assertDatabaseHas('families', [
            'family_name' => 'Keluarga Test',
            'user_id' => $user->id,
        ]);
    }

    public function test_user_can_update_family()
    {
        $user = User::factory()->create(['is_approved' => true, 'email_verified_at' => now()]);
        $family = Family::factory()->create(['user_id' => $user->id, 'family_name' => 'Awal']);
        $this->actingAs($user);
        $response = $this->put(route('family.update', $family), [
            'family_name' => 'Keluarga Update',
            'description' => 'Update',
        ]);
        $response->assertRedirect(route('family.index'));
        $this->assertDatabaseHas('families', [
            'family_name' => 'Keluarga Update',
            'user_id' => $user->id,
        ]);
    }

    public function test_user_can_delete_family()
    {
        $user = User::factory()->create(['is_approved' => true, 'email_verified_at' => now()]);
        $family = Family::factory()->create(['user_id' => $user->id]);
        $this->actingAs($user);
        $response = $this->delete(route('family.destroy', $family));
        $response->assertRedirect(route('family.index'));
        $this->assertDatabaseMissing('families', [
            'id' => $family->id,
        ]);
    }

    public function test_family_name_must_be_unique_per_user()
    {
        $user = User::factory()->create(['is_approved' => true, 'email_verified_at' => now()]);
        Family::factory()->create(['user_id' => $user->id, 'family_name' => 'Unik']);
        $this->actingAs($user);
        $response = $this->post(route('family.store'), [
            'family_name' => 'Unik',
            'description' => 'Deskripsi',
        ]);
        $response->assertSessionHasErrors('family_name');
    }
}
