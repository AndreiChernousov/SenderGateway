<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

/**
 * App\Models\Recipient
 *
 * @property int $id
 * @property string $code
 * @property int|null $phone
 * @property string|null $telegram_id
 * @property string|null $email
 * @property \Illuminate\Support\Carbon|null $created_at
 * @property \Illuminate\Support\Carbon|null $updated_at
 * @method static \Illuminate\Database\Eloquent\Builder|Recipient newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|Recipient newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|Recipient query()
 * @method static \Illuminate\Database\Eloquent\Builder|Recipient whereCode($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Recipient whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Recipient whereEmail($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Recipient whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Recipient wherePhone($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Recipient whereTelegramId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Recipient whereUpdatedAt($value)
 * @mixin \Eloquent
 */
class Recipient extends Model
{
    use HasFactory;
}
