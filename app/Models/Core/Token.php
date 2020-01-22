<?php

namespace App\Models\Core;

use App\Models\User;
use Eloquent;
use Illuminate\Database\Eloquent\Builder;
use Laravel\Passport\Client;
use Laravel\Passport\Token as PassportToken;

/**
 * App\Models\Core\Token
 *
 * @property-read Client $client
 * @property-read User $user
 * @method static Builder|Token newModelQuery()
 * @method static Builder|Token newQuery()
 * @method static Builder|Token query()
 * @mixin Eloquent
 * @property string $id
 * @property string|null $user_id
 * @property int $client_id
 * @property string|null $name
 * @property array|null $scopes
 * @property bool $revoked
 * @property string|null $created_at
 * @property string|null $updated_at
 * @property \Illuminate\Support\Carbon|null $expires_at
 * @property string|null $ip
 * @property string|null $user_agent
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Core\Token whereClientId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Core\Token whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Core\Token whereExpiresAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Core\Token whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Core\Token whereIp($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Core\Token whereName($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Core\Token whereRevoked($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Core\Token whereScopes($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Core\Token whereUpdatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Core\Token whereUserAgent($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Core\Token whereUserId($value)
 */
class Token extends PassportToken
{
    protected static function boot()
    {
        self::creating(function (Token $token) {
            $token->ip = request()->ip();
            $token->user_agent = request()->userAgent();
        });
        parent::boot();
    }
}
