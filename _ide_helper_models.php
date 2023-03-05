<?php

// @formatter:off
/**
 * A helper file for your Eloquent Models
 * Copy the phpDocs from this file to the correct Model,
 * And remove them from this file, to prevent double declarations.
 *
 * @author Barry vd. Heuvel <barryvdh@gmail.com>
 */


namespace App\Models{
/**
 * App\Models\BufferUsers
 *
 * @property int $id
 * @property string $token
 * @property string $lastname
 * @property string $firstname
 * @property string $phone
 * @property string $email
 * @property string $birthdays
 * @property string $password
 * @property Carbon|null $created_at
 * @property Carbon|null $updated_at
 * @method static \Illuminate\Database\Eloquent\Builder|BufferUsers newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|BufferUsers newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|BufferUsers query()
 * @method static \Illuminate\Database\Eloquent\Builder|BufferUsers whereBirthdays($value)
 * @method static \Illuminate\Database\Eloquent\Builder|BufferUsers whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|BufferUsers whereEmail($value)
 * @method static \Illuminate\Database\Eloquent\Builder|BufferUsers whereFirstname($value)
 * @method static \Illuminate\Database\Eloquent\Builder|BufferUsers whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|BufferUsers whereLastname($value)
 * @method static \Illuminate\Database\Eloquent\Builder|BufferUsers wherePassword($value)
 * @method static \Illuminate\Database\Eloquent\Builder|BufferUsers wherePhone($value)
 * @method static \Illuminate\Database\Eloquent\Builder|BufferUsers whereToken($value)
 * @method static \Illuminate\Database\Eloquent\Builder|BufferUsers whereUpdatedAt($value)
 * @mixin \Eloquent
 */
	class BufferUsers extends \Eloquent {}
}

namespace App\Models{
/**
 * App\Models\Products
 *
 * @property int $id
 * @property string $the
 * @property string $sirop
 * @property string $perle
 * @property int $stock
 * @property \Illuminate\Support\Carbon|null $created_at
 * @property \Illuminate\Support\Carbon|null $updated_at
 * @method static \Illuminate\Database\Eloquent\Builder|Products newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|Products newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|Products query()
 * @method static \Illuminate\Database\Eloquent\Builder|Products whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Products whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Products wherePerle($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Products whereSirop($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Products whereStock($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Products whereThe($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Products whereUpdatedAt($value)
 * @property string $name
 * @method static \Illuminate\Database\Eloquent\Builder|Products whereName($value)
 * @property string $type
 * @method static \Illuminate\Database\Eloquent\Builder|Products whereType($value)
 * @mixin \Eloquent
 */
	class ProductsBubbles extends \Eloquent {}
}

namespace App\Models{
/**
 * App\Models\User
 *
 * @property int $id
 * @property string $name
 * @property string $email
 * @property Carbon|null $email_verified_at
 * @property string $password
 * @property string|null $remember_token
 * @property Carbon|null $created_at
 * @property Carbon|null $updated_at
 * @property-read DatabaseNotificationCollection<int, DatabaseNotification> $notifications
 * @property-read int|null $notifications_count
 * @property-read Collection<int, PersonalAccessToken> $tokens
 * @property-read int|null $tokens_count
 * @method static \Database\Factories\UserFactory factory($count = null, $state = [])
 * @method static \Illuminate\Database\Eloquent\Builder|User newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|User newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|User query()
 * @method static \Illuminate\Database\Eloquent\Builder|User whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|User whereEmail($value)
 * @method static \Illuminate\Database\Eloquent\Builder|User whereEmailVerifiedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|User whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|User whereName($value)
 * @method static \Illuminate\Database\Eloquent\Builder|User wherePassword($value)
 * @method static \Illuminate\Database\Eloquent\Builder|User whereRememberToken($value)
 * @method static \Illuminate\Database\Eloquent\Builder|User whereUpdatedAt($value)
 * @property-read DatabaseNotificationCollection<int, DatabaseNotification> $notifications
 * @property-read Collection<int, PersonalAccessToken> $tokens
 * @property-read DatabaseNotificationCollection<int, DatabaseNotification> $notifications
 * @property-read Collection<int, PersonalAccessToken> $tokens
 * @property-read DatabaseNotificationCollection<int, DatabaseNotification> $notifications
 * @property-read Collection<int, PersonalAccessToken> $tokens
 * @property string $lastname
 * @property string $firstname
 * @property string $birthdays
 * @property string $phone
 * @property string $token
 * @property-read DatabaseNotificationCollection<int, DatabaseNotification> $notifications
 * @property-read Collection<int, PersonalAccessToken> $tokens
 * @method static \Illuminate\Database\Eloquent\Builder|User whereBirthdays($value)
 * @method static \Illuminate\Database\Eloquent\Builder|User whereFirstname($value)
 * @method static \Illuminate\Database\Eloquent\Builder|User whereLastname($value)
 * @method static \Illuminate\Database\Eloquent\Builder|User wherePhone($value)
 * @method static \Illuminate\Database\Eloquent\Builder|User whereToken($value)
 * @property-read DatabaseNotificationCollection<int, DatabaseNotification> $notifications
 * @property-read Collection<int, PersonalAccessToken> $tokens
 * @property-read DatabaseNotificationCollection<int, DatabaseNotification> $notifications
 * @property-read Collection<int, PersonalAccessToken> $tokens
 * @property-read DatabaseNotificationCollection<int, DatabaseNotification> $notifications
 * @property-read Collection<int, PersonalAccessToken> $tokens
 * @property-read DatabaseNotificationCollection<int, DatabaseNotification> $notifications
 * @property-read Collection<int, PersonalAccessToken> $tokens
 * @property-read DatabaseNotificationCollection<int, DatabaseNotification> $notifications
 * @property-read Collection<int, PersonalAccessToken> $tokens
 * @property-read DatabaseNotificationCollection<int, DatabaseNotification> $notifications
 * @property-read Collection<int, PersonalAccessToken> $tokens
 * @property-read DatabaseNotificationCollection<int, DatabaseNotification> $notifications
 * @property-read Collection<int, PersonalAccessToken> $tokens
 * @property-read DatabaseNotificationCollection<int, DatabaseNotification> $notifications
 * @property-read Collection<int, PersonalAccessToken> $tokens
 * @property-read DatabaseNotificationCollection<int, DatabaseNotification> $notifications
 * @property-read Collection<int, PersonalAccessToken> $tokens
 * @property-read DatabaseNotificationCollection<int, DatabaseNotification> $notifications
 * @property-read Collection<int, PersonalAccessToken> $tokens
 * @mixin \Eloquent
 * @property-read \Illuminate\Notifications\DatabaseNotificationCollection<int, \Illuminate\Notifications\DatabaseNotification> $notifications
 * @property-read \Illuminate\Database\Eloquent\Collection<int, \Laravel\Sanctum\PersonalAccessToken> $tokens
 */
	class User extends \Eloquent {}
}

namespace App\Models{
/**
 * App\Models\Users_token
 *
 * @method static \Illuminate\Database\Eloquent\Builder|Users_token newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|Users_token newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|Users_token query()
 * @property int $id
 * @property int $users_id
 * @property string $token
 * @property \Illuminate\Support\Carbon|null $created_at
 * @property \Illuminate\Support\Carbon|null $updated_at
 * @method static \Illuminate\Database\Eloquent\Builder|Users_token whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Users_token whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Users_token whereToken($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Users_token whereUpdatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Users_token whereUsersId($value)
 * @mixin \Eloquent
 */
	class Users_token extends \Eloquent {}
}

