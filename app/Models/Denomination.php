<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Denomination extends Model
{
    use HasFactory;

    protected $fillable = [
        'type',
        'value',
        'image',
    ];

      // Accesor imagen
      public function getImagenAttribute() {
        
        if( $this->image != null ) {
            return (file_exists( 'storage/denominaciones/' . $this->image ) 
                    ? 'denominaciones/' . $this->image 
                    : 'noimg.png');
        } else {
            return 'noimg.png';
        }

    }
}
