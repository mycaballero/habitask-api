<?php

namespace App\Builders\UserProfile;

use Illuminate\Database\Eloquent\Builder;

class UserProfileBuilder extends Builder
{
    /**
     * @param string|null $userName
     * @return self
     */
    public function whereUserNameProfile(?string $userName): self
    {
        return $this->when(isset($userName), function ($q) use ($userName) {
            $q->where('name', 'like', '%' . $userName . '%');
        });
    }

    /**
     * @param int|null $position
     * @return self
     */
    public function whereUserPosition(?int $position): self
    {
        return $this->when(isset($position), function ($q) use ($position) {
            $q->whereHas('position', function ($q2) use ($position) {
                $q2->select('name')
                    ->where('position_id', $position);
            });
        });
    }

    /**
     * @return self
     */
    public function selectUserDetails(): self
    {
        return $this->select([
            'id',
            'name',
            'binding_date',
            'birth_date',
            'photo',
            'education_level_id',
            'enabled',
            'city_id',
            'last_name',
            'first_name',
            'email',
            'name',
            'phone',
            'position_id'
        ]);
    }

    /**
     * @return self
     */
    public function withRelations(): self
    {
        return $this->with([
            'technology:id,name',
            'projects.client:id,name',
            'city:id,name',
            'languages:id,name',
            'educationLevel:id,name',
            'position:id,name',
            'logbooks' => function ($q) {
                $q->orderBy('id', 'desc');
            }
        ]);
    }

    /**
     * @param $id
     * @return self
     */
    public function whereUserId($id): self
    {
        return $this->where('id', $id);
    }

}
