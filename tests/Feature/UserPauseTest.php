<?php

namespace Tests\Feature;

use App\Models\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

class UserPauseTest extends TestCase
{
    use RefreshDatabase;

    public function test_paused_user_can_view_get_routes(): void
    {
        $user = User::factory()->create(['is_paused' => true]);

        $response = $this->actingAs($user)->get('/user/dashboard');

        $response->assertStatus(200);
    }

    public function test_paused_user_cannot_submit_post_request(): void
    {
        $user = User::factory()->create(['is_paused' => true]);

        $response = $this->actingAs($user)->post('/logout');

        $response->assertStatus(403);
    }

    public function test_paused_user_cannot_submit_patch_request(): void
    {
        $user = User::factory()->create(['is_paused' => true]);

        $response = $this->actingAs($user)->patch('/profile', [
            'name' => 'Updated Name',
        ]);

        $response->assertStatus(403);
    }

    public function test_paused_user_cannot_submit_delete_request(): void
    {
        $user = User::factory()->create(['is_paused' => true]);

        $response = $this->actingAs($user)->delete('/profile');

        $response->assertStatus(403);
    }

    public function test_normal_user_can_submit_post_request(): void
    {
        $user = User::factory()->create(['is_paused' => false]);

        $response = $this->actingAs($user)->post('/logout');

        $this->assertGuest();
        $response->assertRedirect('/');
    }

    public function test_owner_can_pause_user(): void
    {
        $owner = User::factory()->create(['role' => 'owner', 'is_paused' => false]);
        $target = User::factory()->create(['role' => 'user', 'is_paused' => false]);

        $response = $this->actingAs($owner)
            ->patch(route('owner.users.pause', $target));

        $response->assertSessionHas('success');
        $this->assertTrue($target->fresh()->is_paused);
    }

    public function test_owner_can_unpause_user(): void
    {
        $owner = User::factory()->create(['role' => 'owner', 'is_paused' => false]);
        $target = User::factory()->create(['role' => 'user', 'is_paused' => true]);

        $response = $this->actingAs($owner)
            ->patch(route('owner.users.pause', $target));

        $response->assertSessionHas('success');
        $this->assertFalse($target->fresh()->is_paused);
    }

    public function test_non_owner_cannot_pause_user(): void
    {
        $user = User::factory()->create(['role' => 'user', 'is_paused' => false]);

        $response = $this->actingAs($user)
            ->patch(route('owner.users.pause', User::factory()->create()));

        $response->assertStatus(403);
    }
}
