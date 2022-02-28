<?php

namespace Domain\App\Models;

use Domain\Tours\Models\Tour;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Operator extends Model
{

    protected $connection = 'mysql';

    protected $table = 'operators';

    /**
     * The attributes that aren't mass assignable.
     *
     * @var string[]|bool
     */
    protected $guarded = [];

    /**
     * Tours relation
     * @return HasMany
     */
    public function tours(){
        return $this->hasMany(Tour::class);
    }
}
