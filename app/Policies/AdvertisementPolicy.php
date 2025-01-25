<?php

namespace App\Policies;

use App\Models\Advertisement;
use App\Models\User;

class AdvertisementPolicy
{
    public function update(User $user, Advertisement $advertisement)
    {
        return $user->id === $advertisement->user_id;
    }

    public function delete(User $user, Advertisement $advertisement)
    {
        return $user->id === $advertisement->user_id;
    }
}