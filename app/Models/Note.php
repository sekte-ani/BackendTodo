<?php

namespace App\Models;

use App\Models\Category;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\SoftDeletes;

class note extends Model
{
    use HasFactory, SoftDeletes;
    
    protected $fillable = [
        'title',
        'description',
        'user_id',
        'kategori_id'
    ];

    /**
 * Get the user that owns the phone.
 */
    public function kategori(): BelongsTo
    {
        return $this->belongsTo(Category::class, 'kategori_id', 'id');
    }
}
