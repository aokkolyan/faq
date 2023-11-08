<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Casts\Attribute;

class Answer extends Model
{
    use HasFactory;
    protected $table = 'answers';
    protected $fillable=['question_id','user_id','title_answer','image','video'];

    public function user()
    {
        return $this->belongsTo(User::class,'user_id');
    }

    public function question()
    {
        return $this->belongsTo(User::class,'user_id');
    }
    
    protected function body(): Attribute
    {
        return Attribute::make(
            set: fn (string $value) => $this->makeBodyContent($value),
        );
    }
    public function makeBodyContent($content)
    {
        $dom = new \DomDocument();
        $dom->loadHtml($content, LIBXML_HTML_NOIMPLIED | LIBXML_HTML_NODEFDTD);
        $imageFile = $dom->getElementsByTagName('img');
       
        foreach($imageFile as $item => $image){
            $data = $image->getAttribute('src');
            list($type, $data) = explode(';', $data);
            list(, $data)      = explode(',', $data);
            $imgeData = base64_decode($data);
            $image_name= "/uploads/" . time().$item.'.png';
            $path = public_path() . $image_name;
            file_put_contents($path, $imgeData);
                 
            $image->removeAttribute('src');
            $image->setAttribute('src', $image_name);
        }
       
        return $dom->saveHTML();
    }
}
