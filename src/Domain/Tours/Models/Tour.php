<?php

namespace Domain\Tours\Models;

use Domain\App\Models\Image;
use Domain\App\Models\Operator;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\hasMany;
use Illuminate\Support\Collection;

class Tour extends Model
{

    protected $connection = 'mysql';

    protected $table = 'tours';

    /**
     * The attributes that aren't mass assignable.
     *
     * @var string[]|bool
     */
    protected $guarded = [];

    /**
     * Images relation
     * @return HasMany
     */
    public function images()
    {
        return $this->hasMany(Image::class);
    }

    /**
     * Operator relation
     * @return BelongsTo
     */
    public function operator(){
        return $this->belongsTo(Operator::class);
    }

}
