<?php

namespace App\Policies;

use App\Models\User;
use App\Models\Post;

class RolePolicy
{
    /**
     * Create a new policy instance.
     */
    public function viewAny(User $user, Post $post)
    {
        return $this->roles()->where('name', 'admin')->exists();
    }

    public function view(User $user, Post $post) {
        return $this->roles()->where('name', 'admin')->exists() || $post->user_id;
    }

    public function create(User $user, Post $post){
        return $this->roles()->where('name', 'editor')->exists();
    }

    public function update(User $user, Post $post)
    {
        return $user->roles()->where('name', 'admin')->exists() || ($user->id === $post->user_id && $user->roles()->where('name', 'editor')->exists());
    }
    
    public function delete(User $user, Post $post){
        return $this->roles()->where('name', 'admin')->exists();
    }
}

