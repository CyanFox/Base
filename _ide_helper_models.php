<?php

// @formatter:off
// phpcs:ignoreFile
/**
 * A helper file for your Eloquent Models
 * Copy the phpDocs from this file to the correct Model,
 * And remove them from this file, to prevent double declarations.
 *
 * @author Barry vd. Heuvel <barryvdh@gmail.com>
 */


namespace Modules\Core\Models{use AllowDynamicProperties;use Eloquent;use Illuminate\Database\Eloquent\Builder;use Illuminate\Database\Eloquent\Collection;use Illuminate\Support\Carbon;use Spatie\Activitylog\Models\Activity;use Spatie\LaravelPasskeys\Database\Factories\PasskeyFactory;use Webauthn\PublicKeyCredentialSource;
/**
 * @property int $id
 * @property int $authenticatable_id
 * @property string $name
 * @property string $credential_id
 * @property PublicKeyCredentialSource $data
 * @property Carbon|null $last_used_at
 * @property Carbon|null $created_at
 * @property Carbon|null $updated_at
 * @property-read Collection<int, Activity> $activitiesAsSubject
 * @property-read int|null $activities_as_subject_count
 * @property-read User $authenticatable
 * @method static PasskeyFactory factory($count = null, $state = [])
 * @method static Builder<static>|Passkey newModelQuery()
 * @method static Builder<static>|Passkey newQuery()
 * @method static Builder<static>|Passkey query()
 * @method static Builder<static>|Passkey whereAuthenticatableId($value)
 * @method static Builder<static>|Passkey whereCreatedAt($value)
 * @method static Builder<static>|Passkey whereCredentialId($value)
 * @method static Builder<static>|Passkey whereData($value)
 * @method static Builder<static>|Passkey whereId($value)
 * @method static Builder<static>|Passkey whereLastUsedAt($value)
 * @method static Builder<static>|Passkey whereName($value)
 * @method static Builder<static>|Passkey whereUpdatedAt($value)
 * @mixin Eloquent
 */
	#[AllowDynamicProperties]
	class IdeHelperPasskey {}
}

namespace Modules\Core\Models{use AllowDynamicProperties;use Eloquent;use Illuminate\Database\Eloquent\Builder;use Illuminate\Database\Eloquent\Collection;use Illuminate\Support\Carbon;use Spatie\Activitylog\Models\Activity;
/**
 * @property int $id
 * @property string $name
 * @property string $guard_name
 * @property Carbon|null $created_at
 * @property Carbon|null $updated_at
 * @property-read Collection<int, Activity> $activitiesAsSubject
 * @property-read int|null $activities_as_subject_count
 * @property-read Collection<int, Permission> $permissions
 * @property-read int|null $permissions_count
 * @property-read Collection<int, Role> $roles
 * @property-read int|null $roles_count
 * @property-read Collection<int, Permission> $teams
 * @property-read int|null $teams_count
 * @property-read Collection<int, User> $users
 * @property-read int|null $users_count
 * @method static Builder<static>|Permission newModelQuery()
 * @method static Builder<static>|Permission newQuery()
 * @method static Builder<static>|Permission permission($permissions, bool $without = false)
 * @method static Builder<static>|Permission query()
 * @method static Builder<static>|Permission role($roles, ?string $guard = null, bool $without = false)
 * @method static Builder<static>|Permission team($teams, bool $without = false)
 * @method static Builder<static>|Permission whereCreatedAt($value)
 * @method static Builder<static>|Permission whereGuardName($value)
 * @method static Builder<static>|Permission whereId($value)
 * @method static Builder<static>|Permission whereName($value)
 * @method static Builder<static>|Permission whereUpdatedAt($value)
 * @method static Builder<static>|Permission withoutPermission($permissions)
 * @method static Builder<static>|Permission withoutRole($roles, ?string $guard = null)
 * @method static Builder<static>|Permission withoutTeam($teams)
 * @mixin Eloquent
 */
	#[AllowDynamicProperties]
	class IdeHelperPermission {}
}

namespace Modules\Core\Models{use AllowDynamicProperties;use Eloquent;use Illuminate\Database\Eloquent\Builder;use Illuminate\Database\Eloquent\Collection;use Illuminate\Database\Eloquent\Model;use Illuminate\Support\Carbon;use Spatie\Activitylog\Models\Activity;
/**
 * @property int $id
 * @property string $tokenable_type
 * @property int $tokenable_id
 * @property string $name
 * @property string $token
 * @property array<array-key, mixed>|null $abilities
 * @property Carbon|null $last_used_at
 * @property Carbon|null $expires_at
 * @property Carbon|null $created_at
 * @property Carbon|null $updated_at
 * @property-read Collection<int, Activity> $activitiesAsSubject
 * @property-read int|null $activities_as_subject_count
 * @property-read Model|Eloquent $tokenable
 * @method static Builder<static>|PersonalAccessToken newModelQuery()
 * @method static Builder<static>|PersonalAccessToken newQuery()
 * @method static Builder<static>|PersonalAccessToken query()
 * @method static Builder<static>|PersonalAccessToken whereAbilities($value)
 * @method static Builder<static>|PersonalAccessToken whereCreatedAt($value)
 * @method static Builder<static>|PersonalAccessToken whereExpiresAt($value)
 * @method static Builder<static>|PersonalAccessToken whereId($value)
 * @method static Builder<static>|PersonalAccessToken whereLastUsedAt($value)
 * @method static Builder<static>|PersonalAccessToken whereName($value)
 * @method static Builder<static>|PersonalAccessToken whereToken($value)
 * @method static Builder<static>|PersonalAccessToken whereTokenableId($value)
 * @method static Builder<static>|PersonalAccessToken whereTokenableType($value)
 * @method static Builder<static>|PersonalAccessToken whereUpdatedAt($value)
 * @mixin Eloquent
 */
	#[AllowDynamicProperties]
	class IdeHelperPersonalAccessToken {}
}

namespace Modules\Core\Models{use AllowDynamicProperties;use Eloquent;use Illuminate\Database\Eloquent\Builder;use Illuminate\Database\Eloquent\Collection;use Illuminate\Support\Carbon;use Spatie\Activitylog\Models\Activity;
/**
 * @property int $id
 * @property string $name
 * @property string $guard_name
 * @property Carbon|null $created_at
 * @property Carbon|null $updated_at
 * @property-read Collection<int, Activity> $activitiesAsSubject
 * @property-read int|null $activities_as_subject_count
 * @property-read Collection<int, Permission> $permissions
 * @property-read int|null $permissions_count
 * @property-read Collection<int, User> $users
 * @property-read int|null $users_count
 * @method static Builder<static>|Role newModelQuery()
 * @method static Builder<static>|Role newQuery()
 * @method static Builder<static>|Role permission($permissions, bool $without = false)
 * @method static Builder<static>|Role query()
 * @method static Builder<static>|Role whereCreatedAt($value)
 * @method static Builder<static>|Role whereGuardName($value)
 * @method static Builder<static>|Role whereId($value)
 * @method static Builder<static>|Role whereName($value)
 * @method static Builder<static>|Role whereUpdatedAt($value)
 * @method static Builder<static>|Role withoutPermission($permissions)
 * @mixin Eloquent
 */
	#[AllowDynamicProperties]
	class IdeHelperRole {}
}

namespace Modules\Core\Models{use AllowDynamicProperties;use Eloquent;use Illuminate\Database\Eloquent\Builder;use Illuminate\Database\Eloquent\Collection;use Spatie\Activitylog\Models\Activity;
/**
 * @property string $id
 * @property int|null $user_id
 * @property string|null $ip_address
 * @property string|null $user_agent
 * @property string $payload
 * @property int $last_activity
 * @property-read Collection<int, Activity> $activitiesAsSubject
 * @property-read int|null $activities_as_subject_count
 * @property-read User|null $user
 * @method static Builder<static>|Session newModelQuery()
 * @method static Builder<static>|Session newQuery()
 * @method static Builder<static>|Session query()
 * @method static Builder<static>|Session whereId($value)
 * @method static Builder<static>|Session whereIpAddress($value)
 * @method static Builder<static>|Session whereLastActivity($value)
 * @method static Builder<static>|Session wherePayload($value)
 * @method static Builder<static>|Session whereUserAgent($value)
 * @method static Builder<static>|Session whereUserId($value)
 * @mixin Eloquent
 */
	#[AllowDynamicProperties]
	class IdeHelperSession {}
}

namespace Modules\Core\Models{use AllowDynamicProperties;use Eloquent;use Illuminate\Database\Eloquent\Builder;use Illuminate\Database\Eloquent\Collection;use Illuminate\Support\Carbon;use Spatie\Activitylog\Models\Activity;
/**
 * @property int $id
 * @property string $key
 * @property string|null $value
 * @property array<array-key, mixed>|null $properties
 * @property Carbon|null $created_at
 * @property Carbon|null $updated_at
 * @property-read Collection<int, SettingAccess> $access
 * @property-read int|null $access_count
 * @property-read Collection<int, Activity> $activitiesAsSubject
 * @property-read int|null $activities_as_subject_count
 * @method static Builder<static>|Setting newModelQuery()
 * @method static Builder<static>|Setting newQuery()
 * @method static Builder<static>|Setting query()
 * @method static Builder<static>|Setting whereCreatedAt($value)
 * @method static Builder<static>|Setting whereId($value)
 * @method static Builder<static>|Setting whereKey($value)
 * @method static Builder<static>|Setting whereProperties($value)
 * @method static Builder<static>|Setting whereUpdatedAt($value)
 * @method static Builder<static>|Setting whereValue($value)
 * @mixin Eloquent
 */
	#[AllowDynamicProperties]
	class IdeHelperSetting {}
}

namespace Modules\Core\Models{use AllowDynamicProperties;use Eloquent;use Illuminate\Database\Eloquent\Builder;use Illuminate\Database\Eloquent\Collection;use Illuminate\Database\Eloquent\Model;use Spatie\Activitylog\Models\Activity;
/**
 * @property-read Collection<int, Activity> $activitiesAsSubject
 * @property-read int|null $activities_as_subject_count
 * @property-read \Spatie\Permission\Models\Permission|null $permission
 * @property-read \Spatie\Permission\Models\Role|null $role
 * @property-read Model|Eloquent $setting
 * @property-read User|null $user
 * @method static Builder<static>|SettingAccess newModelQuery()
 * @method static Builder<static>|SettingAccess newQuery()
 * @method static Builder<static>|SettingAccess query()
 * @mixin Eloquent
 */
	#[AllowDynamicProperties]
	class IdeHelperSettingAccess {}
}

namespace Modules\Core\Models{use AllowDynamicProperties;use Eloquent;use Illuminate\Database\Eloquent\Builder;use Illuminate\Database\Eloquent\Collection;use Illuminate\Notifications\DatabaseNotification;use Illuminate\Notifications\DatabaseNotificationCollection;use Illuminate\Support\Carbon;use Spatie\Activitylog\Models\Activity;use Spatie\MediaLibrary\MediaCollections\Models\Collections\MediaCollection;use Spatie\MediaLibrary\MediaCollections\Models\Media;
/**
 * @property int $id
 * @property string|null $first_name
 * @property string|null $last_name
 * @property string $username
 * @property string $email
 * @property string|null $password
 * @property string $theme
 * @property string $language
 * @property bool $disabled
 * @property string|null $remember_token
 * @property Carbon|null $created_at
 * @property Carbon|null $updated_at
 * @property-read Collection<int, Activity> $activitiesAsSubject
 * @property-read int|null $activities_as_subject_count
 * @property-read MediaCollection<int, Media> $media
 * @property-read int|null $media_count
 * @property-read DatabaseNotificationCollection<int, DatabaseNotification> $notifications
 * @property-read int|null $notifications_count
 * @property-read Collection<int, \Spatie\LaravelPasskeys\Models\Passkey> $passkeys
 * @property-read int|null $passkeys_count
 * @property-read Collection<int, Permission> $permissions
 * @property-read int|null $permissions_count
 * @property-read Collection<int, Role> $roles
 * @property-read int|null $roles_count
 * @property-read Collection<int, Session> $sessions
 * @property-read int|null $sessions_count
 * @property-read Collection<int, Permission> $teams
 * @property-read int|null $teams_count
 * @property-read Collection<int, PersonalAccessToken> $tokens
 * @property-read int|null $tokens_count
 * @property-read Collection<int, UserSetting> $userSettings
 * @property-read int|null $user_settings_count
 * @method static Builder<static>|User newModelQuery()
 * @method static Builder<static>|User newQuery()
 * @method static Builder<static>|User permission($permissions, bool $without = false)
 * @method static Builder<static>|User query()
 * @method static Builder<static>|User role($roles, ?string $guard = null, bool $without = false)
 * @method static Builder<static>|User team($teams, bool $without = false)
 * @method static Builder<static>|User whereCreatedAt($value)
 * @method static Builder<static>|User whereDisabled($value)
 * @method static Builder<static>|User whereEmail($value)
 * @method static Builder<static>|User whereFirstName($value)
 * @method static Builder<static>|User whereId($value)
 * @method static Builder<static>|User whereLanguage($value)
 * @method static Builder<static>|User whereLastName($value)
 * @method static Builder<static>|User wherePassword($value)
 * @method static Builder<static>|User whereRememberToken($value)
 * @method static Builder<static>|User whereTheme($value)
 * @method static Builder<static>|User whereUpdatedAt($value)
 * @method static Builder<static>|User whereUsername($value)
 * @method static Builder<static>|User withoutPermission($permissions)
 * @method static Builder<static>|User withoutRole($roles, ?string $guard = null)
 * @method static Builder<static>|User withoutTeam($teams)
 * @mixin Eloquent
 */
	#[AllowDynamicProperties]
	class IdeHelperUser {}
}

namespace Modules\Core\Models{use AllowDynamicProperties;use Eloquent;use Illuminate\Database\Eloquent\Builder;use Illuminate\Database\Eloquent\Collection;use Illuminate\Support\Carbon;use Spatie\Activitylog\Models\Activity;
/**
 * @property int $id
 * @property int $user_id
 * @property string $key
 * @property string|null $value
 * @property array<array-key, mixed>|null $properties
 * @property Carbon|null $created_at
 * @property Carbon|null $updated_at
 * @property-read Collection<int, Activity> $activitiesAsSubject
 * @property-read int|null $activities_as_subject_count
 * @property-read User $user
 * @method static Builder<static>|UserSetting newModelQuery()
 * @method static Builder<static>|UserSetting newQuery()
 * @method static Builder<static>|UserSetting query()
 * @method static Builder<static>|UserSetting whereCreatedAt($value)
 * @method static Builder<static>|UserSetting whereId($value)
 * @method static Builder<static>|UserSetting whereKey($value)
 * @method static Builder<static>|UserSetting whereProperties($value)
 * @method static Builder<static>|UserSetting whereUpdatedAt($value)
 * @method static Builder<static>|UserSetting whereUserId($value)
 * @method static Builder<static>|UserSetting whereValue($value)
 * @mixin Eloquent
 */
	#[AllowDynamicProperties]
	class IdeHelperUserSetting {}
}

