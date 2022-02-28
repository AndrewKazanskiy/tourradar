<?php

namespace Domain\App\Models;

use Domain\Imports\Models\Import;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class ImportsImage extends Model
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
    public function import(){
        return $this->belongsTo(Import::class);
    }
}
