<?php

namespace Domain\App\Models;

use Domain\Tours\Models\Tour;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\hasMany;

class Image extends Model
{

    protected $connection = 'mysql';

    protected $table = 'images';

    /**
     * The attributes that aren't mass assignable.
     *
     * @var string[]|bool
     */
    protected $guarded = [];

    /**
     * Tours relation
     * @return BelongsTo
     */
    public function tour(){
        return $this->belongsTo(Tour::class);
    }
}
