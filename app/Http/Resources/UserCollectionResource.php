<?php
declare(strict_types=1);

namespace App\Http\Resources;

use AutoSwagger\Resources\PaginatedResource;

class UserCollectionResource extends PaginatedResource
{
    public function initCollection()
    {
        return $this->collection->map(function ($user) {
            return new UserResource($user);
        });
    }
}
