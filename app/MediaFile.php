<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class MediaFile extends Model
{
    protected $table='media_files';


    public function imagen()
    {
        //$img = str_replace('data:image/png;base64,', '', $this->code);
        //$img = str_replace(' ', '+', $img);
        //$data = base64_decode($img);
        //$png_url = "product-".time().".png";
        //\Storage::put('img/activities/'.$png_url, $data, 'public');
        //$this->path='img/activities/'.$png_url;
        //$this->save();

        //Sairio
        ob_start();
        $img = str_replace('data:image/png;base64,', '', $this->code);
        $img = str_replace('data:image/jpg;base64,', '', $img);
        $img = str_replace('data:image/jpeg;base64,', '', $img);
        $img = str_replace(' ', '+', $img);
        $data = base64_decode($img);
        $image_url = "product-".time().".jpeg";
        $this->path='img/activities/'.$image_url;
        \Storage::put($this->path, $data, 'public');
        //Solo para pruebas la siguiente linea
        //$path = '/var/www/html/yezzclub-admin/public/img/activities/';
        //$im = imagecreatefromstring($data);
        //$result = imagejpeg($im, $path.$image_url, 90);
        //$result = file_put_contents($path.$image_url, $img);
        //if ($result !== false) {
        //    return $this->save();
        //}
        //return false;

        sleep(1);
        ob_clean();
        return $this->save();
    }
}
