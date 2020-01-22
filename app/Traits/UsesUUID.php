<?php


namespace App\Traits;


use App\Exceptions\Core\InvalidUUID;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Model;
use Ramsey\Uuid\Uuid;

trait UsesUUID
{
    /**
     * Retrieve the model for a bound value.
     *
     * @param mixed $value
     * @return Model|null
     * @throws InvalidUUID
     */
    public function resolveRouteBinding($value)
    {
        if (Uuid::isValid($value)) {
            /** @var Model|Builder $this */
            return $this->where($this->getRouteKeyName(), $value)->first();
        }
        throw new InvalidUUID();
    }
}
