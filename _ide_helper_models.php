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
 * App\Models\Basket
 *
 * @property int $id
 * @property string $token
 * @property \Illuminate\Support\Carbon|null $created_at
 * @property \Illuminate\Support\Carbon|null $updated_at
 * @property-read \Illuminate\Database\Eloquent\Collection<int, \App\Models\BasketMenu> $basketMenu
 * @property-read int|null $basket_menu_count
 * @method static \Illuminate\Database\Eloquent\Builder|Basket newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|Basket newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|Basket query()
 * @method static \Illuminate\Database\Eloquent\Builder|Basket whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Basket whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Basket whereToken($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Basket whereUpdatedAt($value)
 */
	class Basket extends \Eloquent {}
}

namespace App\Models{
/**
 * App\Models\BasketMenu
 *
 * @property int $id
 * @property int $pearl_id
 * @property int $syrup_id
 * @property int $tea_id
 * @property int $menu_id
 * @property int $baskets_id
 * @property Carbon|null $created_at
 * @property Carbon|null $updated_at
 * @method static \Illuminate\Database\Eloquent\Builder|BasketMenu newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|BasketMenu newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|BasketMenu query()
 * @method static \Illuminate\Database\Eloquent\Builder|BasketMenu whereBasketsId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|BasketMenu whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|BasketMenu whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|BasketMenu whereMenuId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|BasketMenu wherePearlId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|BasketMenu whereSyrupId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|BasketMenu whereTeaId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|BasketMenu whereUpdatedAt($value)
 * @property-read \App\Models\Basket $basket
 * @property-read Collection<int, BasketSides> $basketSides
 * @property-read int|null $basket_sides_count
 * @property-read \App\Models\ProductsMenu|null $menu
 * @property-read \App\Models\ProductsPearl|null $pearl
 * @property-read \App\Models\ProductsSyrup|null $syrup
 * @property-read ProductsTea|null $tea
 * @mixin \Eloquent
 */
	class BasketMenu extends \Eloquent {}
}

namespace App\Models{
/**
 * App\Models\BasketSides
 *
 * @property int $id
 * @property int $basket_menus_id
 * @property int $side_id
 * @property \Illuminate\Support\Carbon|null $created_at
 * @property \Illuminate\Support\Carbon|null $updated_at
 * @method static \Illuminate\Database\Eloquent\Builder|BasketSides newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|BasketSides newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|BasketSides query()
 * @method static \Illuminate\Database\Eloquent\Builder|BasketSides whereBasketMenusId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|BasketSides whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|BasketSides whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|BasketSides whereSideId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|BasketSides whereUpdatedAt($value)
 * @property-read \App\Models\ProductsSide $side
 * @mixin \Eloquent
 */
	class BasketSides extends \Eloquent {}
}

namespace App\Models{
/**
 * App\Models\BufferUpdateEmail
 *
 * @property int $id
 * @property int $users_id
 * @property string $email
 * @property string|null $email_verified_at
 * @property \Illuminate\Support\Carbon|null $created_at
 * @property \Illuminate\Support\Carbon|null $updated_at
 * @method static \Illuminate\Database\Eloquent\Builder|BufferUpdateEmail newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|BufferUpdateEmail newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|BufferUpdateEmail query()
 * @method static \Illuminate\Database\Eloquent\Builder|BufferUpdateEmail whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|BufferUpdateEmail whereEmail($value)
 * @method static \Illuminate\Database\Eloquent\Builder|BufferUpdateEmail whereEmailVerifiedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|BufferUpdateEmail whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|BufferUpdateEmail whereUpdatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|BufferUpdateEmail whereUsersId($value)
 * @mixin \Eloquent
 */
	class BufferUpdateEmail extends \Eloquent {}
}

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
 * App\Models\DelayCommand
 *
 * @property int $id
 * @property \Illuminate\Support\Carbon|null $created_at
 * @property \Illuminate\Support\Carbon|null $updated_at
 * @property int $delay
 * @method static \Illuminate\Database\Eloquent\Builder|DelayCommand newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|DelayCommand newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|DelayCommand query()
 * @method static \Illuminate\Database\Eloquent\Builder|DelayCommand whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|DelayCommand whereDelay($value)
 * @method static \Illuminate\Database\Eloquent\Builder|DelayCommand whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|DelayCommand whereUpdatedAt($value)
 */
	class DelayCommand extends \Eloquent {}
}

namespace App\Models{
/**
 * App\Models\HomeViewAdmin
 *
 * @property int $id
 * @property string $content
 * @property int $usersAdmin_id
 * @property \Illuminate\Support\Carbon|null $created_at
 * @property \Illuminate\Support\Carbon|null $updated_at
 * @method static \Illuminate\Database\Eloquent\Builder|HomeViewAdmin newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|HomeViewAdmin newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|HomeViewAdmin query()
 * @method static \Illuminate\Database\Eloquent\Builder|HomeViewAdmin whereContent($value)
 * @method static \Illuminate\Database\Eloquent\Builder|HomeViewAdmin whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|HomeViewAdmin whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|HomeViewAdmin whereUpdatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|HomeViewAdmin whereUsersAdminId($value)
 */
	class HomeViewAdmin extends \Eloquent {}
}

namespace App\Models{
/**
 * App\Models\Invoices
 *
 * @property int $id
 * @property string $path
 * @property string $number
 * @property int $orders_id
 * @property int $users_id
 * @property \Illuminate\Support\Carbon|null $created_at
 * @property \Illuminate\Support\Carbon|null $updated_at
 * @property-read \App\Models\Orders $order
 * @property-read \App\Models\User $user
 * @method static \Illuminate\Database\Eloquent\Builder|Invoices newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|Invoices newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|Invoices query()
 * @method static \Illuminate\Database\Eloquent\Builder|Invoices whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Invoices whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Invoices whereNumber($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Invoices whereOrdersId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Invoices wherePath($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Invoices whereUpdatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Invoices whereUsersId($value)
 */
	class Invoices extends \Eloquent {}
}

namespace App\Models{
/**
 * App\Models\Orders
 *
 * @property int $id
 * @property int $users_id
 * @property string $status
 * @property string $total_price
 * @property \Illuminate\Support\Carbon|null $created_at
 * @property \Illuminate\Support\Carbon|null $updated_at
 * @property string $hours
 * @property-read \App\Models\Invoices|null $invoice
 * @property-read \Illuminate\Database\Eloquent\Collection<int, \App\Models\OrdersMenu> $ordersMenu
 * @property-read int|null $orders_menu_count
 * @property-read \App\Models\User $user
 * @method static \Illuminate\Database\Eloquent\Builder|Orders newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|Orders newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|Orders query()
 * @method static \Illuminate\Database\Eloquent\Builder|Orders whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Orders whereHours($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Orders whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Orders whereStatus($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Orders whereTotalPrice($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Orders whereUpdatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Orders whereUsersId($value)
 */
	class Orders extends \Eloquent {}
}

namespace App\Models{
/**
 * App\Models\OrdersMenu
 *
 * @property int $id
 * @property int $pearl_id
 * @property int $syrup_id
 * @property int $tea_id
 * @property int $menu_id
 * @property int $orders_id
 * @property string $price
 * @property \Illuminate\Support\Carbon|null $created_at
 * @property \Illuminate\Support\Carbon|null $updated_at
 * @property-read \App\Models\ProductsMenu $menus
 * @property-read \App\Models\ProductsPearl $pearls
 * @property-read \Illuminate\Database\Eloquent\Collection<int, \App\Models\OrdersSides> $sides
 * @property-read int|null $sides_count
 * @property-read \App\Models\ProductsSyrup $syrups
 * @property-read \App\Models\ProductsTea $teas
 * @method static \Illuminate\Database\Eloquent\Builder|OrdersMenu newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|OrdersMenu newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|OrdersMenu query()
 * @method static \Illuminate\Database\Eloquent\Builder|OrdersMenu whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|OrdersMenu whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|OrdersMenu whereMenuId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|OrdersMenu whereOrdersId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|OrdersMenu wherePearlId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|OrdersMenu wherePrice($value)
 * @method static \Illuminate\Database\Eloquent\Builder|OrdersMenu whereSyrupId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|OrdersMenu whereTeaId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|OrdersMenu whereUpdatedAt($value)
 */
	class OrdersMenu extends \Eloquent {}
}

namespace App\Models{
/**
 * App\Models\OrdersSides
 *
 * @property int $id
 * @property int $orders_menus_id
 * @property int $side_id
 * @property \Illuminate\Support\Carbon|null $created_at
 * @property \Illuminate\Support\Carbon|null $updated_at
 * @property-read \App\Models\ProductsSide $side
 * @method static \Illuminate\Database\Eloquent\Builder|OrdersSides newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|OrdersSides newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|OrdersSides query()
 * @method static \Illuminate\Database\Eloquent\Builder|OrdersSides whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|OrdersSides whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|OrdersSides whereOrdersMenusId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|OrdersSides whereSideId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|OrdersSides whereUpdatedAt($value)
 */
	class OrdersSides extends \Eloquent {}
}

namespace App\Models{
/**
 * App\Models\ProductsMenu
 *
 * @property int $id
 * @property string $name
 * @property int $sides
 * @property int $size
 * @property string $price
 * @property string $currency
 * @property \Illuminate\Support\Carbon|null $created_at
 * @property \Illuminate\Support\Carbon|null $updated_at
 * @property \Illuminate\Support\Carbon|null $deleted_at
 * @method static \Illuminate\Database\Eloquent\Builder|ProductsMenu newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|ProductsMenu newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|ProductsMenu onlyTrashed()
 * @method static \Illuminate\Database\Eloquent\Builder|ProductsMenu query()
 * @method static \Illuminate\Database\Eloquent\Builder|ProductsMenu whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|ProductsMenu whereCurrency($value)
 * @method static \Illuminate\Database\Eloquent\Builder|ProductsMenu whereDeletedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|ProductsMenu whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|ProductsMenu whereName($value)
 * @method static \Illuminate\Database\Eloquent\Builder|ProductsMenu wherePrice($value)
 * @method static \Illuminate\Database\Eloquent\Builder|ProductsMenu whereSides($value)
 * @method static \Illuminate\Database\Eloquent\Builder|ProductsMenu whereSize($value)
 * @method static \Illuminate\Database\Eloquent\Builder|ProductsMenu whereUpdatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|ProductsMenu withTrashed()
 * @method static \Illuminate\Database\Eloquent\Builder|ProductsMenu withoutTrashed()
 */
	class ProductsMenu extends \Eloquent {}
}

namespace App\Models{
/**
 * App\Models\ProductsPearl
 *
 * @property int $id
 * @property string $name
 * @property string $color
 * @property int $stock
 * @property \Illuminate\Support\Carbon|null $created_at
 * @property \Illuminate\Support\Carbon|null $updated_at
 * @property \Illuminate\Support\Carbon|null $deleted_at
 * @method static \Illuminate\Database\Eloquent\Builder|ProductsPearl newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|ProductsPearl newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|ProductsPearl onlyTrashed()
 * @method static \Illuminate\Database\Eloquent\Builder|ProductsPearl query()
 * @method static \Illuminate\Database\Eloquent\Builder|ProductsPearl whereColor($value)
 * @method static \Illuminate\Database\Eloquent\Builder|ProductsPearl whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|ProductsPearl whereDeletedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|ProductsPearl whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|ProductsPearl whereName($value)
 * @method static \Illuminate\Database\Eloquent\Builder|ProductsPearl whereStock($value)
 * @method static \Illuminate\Database\Eloquent\Builder|ProductsPearl whereUpdatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|ProductsPearl withTrashed()
 * @method static \Illuminate\Database\Eloquent\Builder|ProductsPearl withoutTrashed()
 */
	class ProductsPearl extends \Eloquent {}
}

namespace App\Models{
/**
 * App\Models\ProductsSide
 *
 * @property int $id
 * @property string $name
 * @property string|null $flavor
 * @property string $description
 * @property string $price
 * @property string $currency
 * @property int $quantity
 * @property string $image_url
 * @property int $stock
 * @property \Illuminate\Support\Carbon|null $created_at
 * @property \Illuminate\Support\Carbon|null $updated_at
 * @property \Illuminate\Support\Carbon|null $deleted_at
 * @method static \Illuminate\Database\Eloquent\Builder|ProductsSide newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|ProductsSide newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|ProductsSide onlyTrashed()
 * @method static \Illuminate\Database\Eloquent\Builder|ProductsSide query()
 * @method static \Illuminate\Database\Eloquent\Builder|ProductsSide whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|ProductsSide whereCurrency($value)
 * @method static \Illuminate\Database\Eloquent\Builder|ProductsSide whereDeletedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|ProductsSide whereDescription($value)
 * @method static \Illuminate\Database\Eloquent\Builder|ProductsSide whereFlavor($value)
 * @method static \Illuminate\Database\Eloquent\Builder|ProductsSide whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|ProductsSide whereImageUrl($value)
 * @method static \Illuminate\Database\Eloquent\Builder|ProductsSide whereName($value)
 * @method static \Illuminate\Database\Eloquent\Builder|ProductsSide wherePrice($value)
 * @method static \Illuminate\Database\Eloquent\Builder|ProductsSide whereQuantity($value)
 * @method static \Illuminate\Database\Eloquent\Builder|ProductsSide whereStock($value)
 * @method static \Illuminate\Database\Eloquent\Builder|ProductsSide whereUpdatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|ProductsSide withTrashed()
 * @method static \Illuminate\Database\Eloquent\Builder|ProductsSide withoutTrashed()
 */
	class ProductsSide extends \Eloquent {}
}

namespace App\Models{
/**
 * App\Models\ProductsSyrup
 *
 * @property int $id
 * @property string $name
 * @property string $color
 * @property int $stock
 * @property \Illuminate\Support\Carbon|null $created_at
 * @property \Illuminate\Support\Carbon|null $updated_at
 * @property \Illuminate\Support\Carbon|null $deleted_at
 * @method static \Illuminate\Database\Eloquent\Builder|ProductsSyrup newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|ProductsSyrup newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|ProductsSyrup onlyTrashed()
 * @method static \Illuminate\Database\Eloquent\Builder|ProductsSyrup query()
 * @method static \Illuminate\Database\Eloquent\Builder|ProductsSyrup whereColor($value)
 * @method static \Illuminate\Database\Eloquent\Builder|ProductsSyrup whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|ProductsSyrup whereDeletedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|ProductsSyrup whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|ProductsSyrup whereName($value)
 * @method static \Illuminate\Database\Eloquent\Builder|ProductsSyrup whereStock($value)
 * @method static \Illuminate\Database\Eloquent\Builder|ProductsSyrup whereUpdatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|ProductsSyrup withTrashed()
 * @method static \Illuminate\Database\Eloquent\Builder|ProductsSyrup withoutTrashed()
 */
	class ProductsSyrup extends \Eloquent {}
}

namespace App\Models{
/**
 * App\Models\ProductsTea
 *
 * @property int $id
 * @property string $name
 * @property string $image_url
 * @property int $stock
 * @property \Illuminate\Support\Carbon|null $created_at
 * @property \Illuminate\Support\Carbon|null $updated_at
 * @property \Illuminate\Support\Carbon|null $deleted_at
 * @method static \Illuminate\Database\Eloquent\Builder|ProductsTea newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|ProductsTea newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|ProductsTea onlyTrashed()
 * @method static \Illuminate\Database\Eloquent\Builder|ProductsTea query()
 * @method static \Illuminate\Database\Eloquent\Builder|ProductsTea whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|ProductsTea whereDeletedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|ProductsTea whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|ProductsTea whereImageUrl($value)
 * @method static \Illuminate\Database\Eloquent\Builder|ProductsTea whereName($value)
 * @method static \Illuminate\Database\Eloquent\Builder|ProductsTea whereStock($value)
 * @method static \Illuminate\Database\Eloquent\Builder|ProductsTea whereUpdatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|ProductsTea withTrashed()
 * @method static \Illuminate\Database\Eloquent\Builder|ProductsTea withoutTrashed()
 */
	class ProductsTea extends \Eloquent {}
}

namespace App\Models{
/**
 * App\Models\User
 *
 * @property int $id
 * @property string $lastname
 * @property string $firstname
 * @property string $birthdays
 * @property string $phone
 * @property string $email
 * @property \Illuminate\Support\Carbon|null $email_verified_at
 * @property string $password
 * @property \Illuminate\Support\Carbon|null $created_at
 * @property \Illuminate\Support\Carbon|null $updated_at
 * @property string|null $stripe_id
 * @property string|null $pm_type
 * @property string|null $pm_last_four
 * @property string|null $trial_ends_at
 * @property-read \App\Models\UsersInformations|null $information
 * @property-read \Illuminate\Notifications\DatabaseNotificationCollection<int, \Illuminate\Notifications\DatabaseNotification> $notifications
 * @property-read int|null $notifications_count
 * @property-read \Illuminate\Database\Eloquent\Collection<int, \App\Models\Orders> $orders
 * @property-read int|null $orders_count
 * @property-read \Illuminate\Database\Eloquent\Collection<int, \Laravel\Cashier\Subscription> $subscriptions
 * @property-read int|null $subscriptions_count
 * @property-read \App\Models\Users_token|null $token
 * @property-read \Illuminate\Database\Eloquent\Collection<int, \App\Models\Users_token> $tokenMany
 * @property-read int|null $token_many_count
 * @property-read \Illuminate\Database\Eloquent\Collection<int, \Laravel\Sanctum\PersonalAccessToken> $tokens
 * @property-read int|null $tokens_count
 * @property-read \App\Models\BufferUpdateEmail|null $updateEmail
 * @property-read \Illuminate\Database\Eloquent\Collection<int, \App\Models\BufferUpdateEmail> $updateEmailMany
 * @property-read int|null $update_email_many_count
 * @method static \Database\Factories\UserFactory factory($count = null, $state = [])
 * @method static \Illuminate\Database\Eloquent\Builder|User hasExpiredGenericTrial()
 * @method static \Illuminate\Database\Eloquent\Builder|User newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|User newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|User onGenericTrial()
 * @method static \Illuminate\Database\Eloquent\Builder|User query()
 * @method static \Illuminate\Database\Eloquent\Builder|User whereBirthdays($value)
 * @method static \Illuminate\Database\Eloquent\Builder|User whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|User whereEmail($value)
 * @method static \Illuminate\Database\Eloquent\Builder|User whereEmailVerifiedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|User whereFirstname($value)
 * @method static \Illuminate\Database\Eloquent\Builder|User whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|User whereLastname($value)
 * @method static \Illuminate\Database\Eloquent\Builder|User wherePassword($value)
 * @method static \Illuminate\Database\Eloquent\Builder|User wherePhone($value)
 * @method static \Illuminate\Database\Eloquent\Builder|User wherePmLastFour($value)
 * @method static \Illuminate\Database\Eloquent\Builder|User wherePmType($value)
 * @method static \Illuminate\Database\Eloquent\Builder|User whereStripeId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|User whereTrialEndsAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|User whereUpdatedAt($value)
 */
	class User extends \Eloquent {}
}

namespace App\Models{
/**
 * App\Models\UsersAdmin
 *
 * @property int $id
 * @property string $email
 * @property string $password
 * @property \Illuminate\Support\Carbon|null $created_at
 * @property \Illuminate\Support\Carbon|null $updated_at
 * @property-read \Illuminate\Notifications\DatabaseNotificationCollection<int, \Illuminate\Notifications\DatabaseNotification> $notifications
 * @property-read int|null $notifications_count
 * @property-read \Illuminate\Database\Eloquent\Collection<int, \Laravel\Sanctum\PersonalAccessToken> $tokens
 * @property-read int|null $tokens_count
 * @method static \Illuminate\Database\Eloquent\Builder|UsersAdmin newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|UsersAdmin newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|UsersAdmin query()
 * @method static \Illuminate\Database\Eloquent\Builder|UsersAdmin whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|UsersAdmin whereEmail($value)
 * @method static \Illuminate\Database\Eloquent\Builder|UsersAdmin whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|UsersAdmin wherePassword($value)
 * @method static \Illuminate\Database\Eloquent\Builder|UsersAdmin whereUpdatedAt($value)
 */
	class UsersAdmin extends \Eloquent {}
}

namespace App\Models{
/**
 * App\Models\UsersInformations
 *
 * @property int $id
 * @property int $users_id
 * @property string $street
 * @property string $country
 * @property string $postal_code
 * @property string $city
 * @property string|null $society
 * @property \Illuminate\Support\Carbon|null $created_at
 * @property \Illuminate\Support\Carbon|null $updated_at
 * @method static \Illuminate\Database\Eloquent\Builder|UsersInformations newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|UsersInformations newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|UsersInformations query()
 * @method static \Illuminate\Database\Eloquent\Builder|UsersInformations whereCity($value)
 * @method static \Illuminate\Database\Eloquent\Builder|UsersInformations whereCountry($value)
 * @method static \Illuminate\Database\Eloquent\Builder|UsersInformations whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|UsersInformations whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|UsersInformations wherePostalCode($value)
 * @method static \Illuminate\Database\Eloquent\Builder|UsersInformations whereSociety($value)
 * @method static \Illuminate\Database\Eloquent\Builder|UsersInformations whereStreet($value)
 * @method static \Illuminate\Database\Eloquent\Builder|UsersInformations whereUpdatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|UsersInformations whereUsersId($value)
 */
	class UsersInformations extends \Eloquent {}
}

namespace App\Models{
/**
 * App\Models\Users_token
 *
 * @property int $id
 * @property int $users_id
 * @property string $token
 * @property \Illuminate\Support\Carbon|null $created_at
 * @property \Illuminate\Support\Carbon|null $updated_at
 * @property-read \App\Models\User $user
 * @method static \Illuminate\Database\Eloquent\Builder|Users_token newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|Users_token newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|Users_token query()
 * @method static \Illuminate\Database\Eloquent\Builder|Users_token whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Users_token whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Users_token whereToken($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Users_token whereUpdatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Users_token whereUsersId($value)
 */
	class Users_token extends \Eloquent {}
}

