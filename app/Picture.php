<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Picture extends Model
{
    /**
     * The database table used by the model.
     *
     * @var string
     */
    protected $table = 'pictures';

    /**
    * The database primary key value.
    *
    * @var string
    */
    protected $primaryKey = 'id';

    /**
     * Attributes that should be mass-assignable.
     *
     * @var array
     */
    protected $fillable = ['title', 'description','photo','album_id'];

    public function album()
    {
        return $this->belongsTo('App\Album');
    }
    
}
