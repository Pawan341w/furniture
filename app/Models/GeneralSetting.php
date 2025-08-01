<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class GeneralSetting extends Model
{
      protected $fillable = ['key', 'value','type'];

      protected $table="general_settings";
}
