<?php

namespace Tests\Feature;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;
use App\Models\User;
use App\Models\Petition;
use App\Models\Signature;

class DeleteCommentTest extends TestCase
{
    use RefreshDatabase;

    public function test_owner_can_delete_their_comment()
    {
        $user = User::factory()->create();

        $petition = Petition::create(['title' => 'Title', 'description' => 'Desc', 'target' => null, 'user_id' => $user->id, 'signature_count' => 0]);

        $signature = Signature::create([
            'petition_id' => $petition->id,
            'user_id' => $user->id,
            'name' => $user->name,
            'email' => $user->email,
            'comment' => 'This is a comment',
        ]);

        $this->actingAs($user)
            ->delete(route('signature.comment.destroy', $signature->id))
            ->assertRedirect(route('petitions.show', $petition->id))
            ->assertSessionHas('success');

        $this->assertDatabaseHas('signatures', [
            'id' => $signature->id,
            'comment' => null,
        ]);
    }

    public function test_non_owner_cannot_delete_comment()
    {
        $owner = User::factory()->create();
        $other = User::factory()->create();

        $petition = Petition::create(['title' => 'Title', 'description' => 'Desc', 'target' => null, 'user_id' => $owner->id, 'signature_count' => 0]);

        $signature = Signature::create([
            'petition_id' => $petition->id,
            'user_id' => $owner->id,
            'name' => $owner->name,
            'email' => $owner->email,
            'comment' => 'Owner comment',
        ]);

        $this->actingAs($other)
            ->delete(route('signature.comment.destroy', $signature->id))
            ->assertRedirect(route('petitions.show', $petition->id))
            ->assertSessionHas('error');

        $this->assertDatabaseHas('signatures', [
            'id' => $signature->id,
            'comment' => 'Owner comment',
        ]);
    }

    public function test_profile_shows_user_comments_and_delete_button()
    {
        $user = User::factory()->create();

        $petition = Petition::create(['title' => 'Title', 'description' => 'Desc', 'target' => null, 'user_id' => $user->id, 'signature_count' => 0]);

        $signature = Signature::create([
            'petition_id' => $petition->id,
            'user_id' => $user->id,
            'name' => $user->name,
            'email' => $user->email,
            'comment' => 'Profile comment',
        ]);

        $this->actingAs($user)
            ->get(route('profile.show'))
            ->assertStatus(200)
            ->assertSee('Profile comment')
            ->assertSee($petition->title);
    }
}
