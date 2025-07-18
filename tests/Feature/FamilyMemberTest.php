<?php

namespace Tests\Feature;

use App\Models\User;
use App\Models\Family;
use App\Models\FamilyMember;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

class FamilyMemberTest extends TestCase
{
    use RefreshDatabase;

    public function test_user_can_create_family_member()
    {
        /** @var \App\Models\User $user */
        $user = User::factory()->create(['is_approved' => true, 'email_verified_at' => now()]);
        $family = Family::factory()->create(['user_id' => $user->id]);
        $this->actingAs($user);
        $response = $this->post(route('family.members.store', $family), [
            'name' => 'Anggota Satu',
            'relation' => 'Anak',
            'gender' => 'L',
            'birth_date' => '2010-01-01',
        ]);
        $response->assertRedirect(route('family.members.index', $family));
        $this->assertDatabaseHas('family_members', [
            'family_id' => $family->id,
            'name' => 'Anggota Satu',
        ]);
    }

    public function test_user_can_update_family_member()
    {
        /** @var \App\Models\User $user */
        $user = User::factory()->create(['is_approved' => true, 'email_verified_at' => now()]);
        $family = Family::factory()->create(['user_id' => $user->id]);
        $member = FamilyMember::factory()->create(['family_id' => $family->id, 'name' => 'Awal']);
        $this->actingAs($user);
        $response = $this->put(route('family.members.update', [$family, $member]), [
            'name' => 'Anggota Update',
            'relation' => 'Istri',
            'gender' => 'P',
            'birth_date' => '1990-05-05',
        ]);
        $response->assertRedirect(route('family.members.index', $family));
        $this->assertDatabaseHas('family_members', [
            'id' => $member->id,
            'name' => 'Anggota Update',
        ]);
    }

    public function test_user_can_delete_family_member()
    {
        /** @var \App\Models\User $user */
        $user = User::factory()->create(['is_approved' => true, 'email_verified_at' => now()]);
        $family = Family::factory()->create(['user_id' => $user->id]);
        $member = FamilyMember::factory()->create(['family_id' => $family->id]);
        $this->actingAs($user);
        $response = $this->delete(route('family.members.destroy', [$family, $member]));
        $response->assertRedirect(route('family.members.index', $family));
        $this->assertDatabaseMissing('family_members', [
            'id' => $member->id,
        ]);
    }

    public function test_user_cannot_manage_other_family_member()
    {
        /** @var \App\Models\User $user */
        $user = User::factory()->create(['is_approved' => true, 'email_verified_at' => now()]);
        $otherUser = User::factory()->create(['is_approved' => true, 'email_verified_at' => now()]);
        $otherFamily = Family::factory()->create(['user_id' => $otherUser->id]);
        $member = FamilyMember::factory()->create(['family_id' => $otherFamily->id]);
        $this->actingAs($user);
        $response = $this->delete(route('family.members.destroy', [$otherFamily, $member]));
        $response->assertStatus(403);
    }
}
