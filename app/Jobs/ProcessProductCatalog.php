<?php

namespace App\Jobs;

use App\Models\ProductCatalog;
use Illuminate\Bus\Queueable;
use Illuminate\Queue\SerializesModels;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Bus\Dispatchable;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\DB;

class ProcessProductCatalog implements ShouldQueue
{
    use Dispatchable, InteractsWithQueue, Queueable, SerializesModels;

    public $product;
    public $imagePath;
    public $galleryPaths;

    public function __construct(ProductCatalog $product, $imagePath = null, $galleryPaths = [])
    {
        $this->product = $product;
        $this->imagePath = $imagePath;
        $this->galleryPaths = $galleryPaths;
    }

 public function handle()
{
    if($this->imagePath){
        if($this->product->image && Storage::disk('public')->exists($this->product->image)){
            Storage::disk('public')->delete($this->product->image);
        }
        $this->product->update(['image' => $this->imagePath]);
    }

    if(!empty($this->galleryPaths)){
        $oldGallery = $this->product->gallery ?? [];
        foreach($oldGallery as $old){
            if(Storage::disk('public')->exists($old)){
                Storage::disk('public')->delete($old);
            }
        }
        $this->product->update(['gallery' => $this->galleryPaths]);
    }
    
        // DB::disconnect();

}

}
