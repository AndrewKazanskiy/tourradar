<?php

namespace Domain\Imports\Models;


use Domain\App\Models\ImportsImage;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\hasMany;
use Illuminate\Support\Collection;

class Import extends Model
{

    protected $connection = 'mysql';

    protected $table = 'imports';

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
        return $this->hasMany(ImportsImage::class);
    }

    /**
     * Overwrite tags
     * @param  array  $images
     * @return Collection<ImportsImage>
     */
    public function overwriteImages(string | array $images): Collection
    {
        if (! is_array($images)) {
            $images = func_get_args();
        }

        $this->images()->detach();

        return $this->attachTags($images);
    }
}
