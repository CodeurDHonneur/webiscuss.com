<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

/**
 * 
 *
 * @property int $id
 * @property int $message_id
 * @property string $name
 * @property string $path
 * @property string $mime
 * @property int $size
 * @property \Illuminate\Support\Carbon|null $created_at
 * @property \Illuminate\Support\Carbon|null $updated_at
 * @method static \Illuminate\Database\Eloquent\Builder|MessageAttachement newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|MessageAttachement newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|MessageAttachement query()
 * @method static \Illuminate\Database\Eloquent\Builder|MessageAttachement whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|MessageAttachement whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|MessageAttachement whereMessageId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|MessageAttachement whereMime($value)
 * @method static \Illuminate\Database\Eloquent\Builder|MessageAttachement whereName($value)
 * @method static \Illuminate\Database\Eloquent\Builder|MessageAttachement wherePath($value)
 * @method static \Illuminate\Database\Eloquent\Builder|MessageAttachement whereSize($value)
 * @method static \Illuminate\Database\Eloquent\Builder|MessageAttachement whereUpdatedAt($value)
 * @mixin \Eloquent
 */
class MessageAttachement extends Model
{
    use HasFactory;

    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = [
        'message_id',
        'name',
        'path',
        'mime',
        'size',
    ];
}
