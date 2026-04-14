<?php

namespace App\Services;

use Illuminate\Http\UploadedFile;

class SupabaseStorage
{
    protected $url;
    protected $key;
    protected $bucket;
    
    public function __construct()
    {
        $this->url = env('SUPABASE_URL');
        $this->key = env('SUPABASE_KEY');
        $this->bucket = env('SUPABASE_BUCKET', 'photos');
    }
    
    public function upload($file, $path = '')
    {
        if ($file instanceof UploadedFile) {
            $content = file_get_contents($file->getRealPath());
            $filename = $path . '/' . uniqid() . '_' . $file->getClientOriginalName();
        } else {
            $content = $file;
            $filename = $path;
        }
        
        $url = $this->url . '/storage/v1/object/' . $this->bucket . '/' . $filename;
        
        $ch = curl_init();
        curl_setopt($ch, CURLOPT_URL, $url);
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
        curl_setopt($ch, CURLOPT_CUSTOMREQUEST, 'POST');
        curl_setopt($ch, CURLOPT_POSTFIELDS, $content);
        curl_setopt($ch, CURLOPT_HTTPHEADER, [
            'Authorization: Bearer ' . $this->key,
            'Content-Type: application/octet-stream',
        ]);
        
        $response = curl_exec($ch);
        $httpCode = curl_getinfo($ch, CURLINFO_HTTP_CODE);
        curl_close($ch);
        
        if ($httpCode === 200) {
            return $this->getUrl($filename);
        }
        
        return null;
    }
    
    public function getUrl($path)
    {
        return $this->url . '/storage/v1/object/public/' . $this->bucket . '/' . $path;
    }
    
    public function delete($path)
    {
        $url = $this->url . '/storage/v1/object/' . $this->bucket . '/' . $path;
        
        $ch = curl_init();
        curl_setopt($ch, CURLOPT_URL, $url);
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
        curl_setopt($ch, CURLOPT_CUSTOMREQUEST, 'DELETE');
        curl_setopt($ch, CURLOPT_HTTPHEADER, [
            'Authorization: Bearer ' . $this->key,
        ]);
        
        $response = curl_exec($ch);
        $httpCode = curl_getinfo($ch, CURLINFO_HTTP_CODE);
        curl_close($ch);
        
        return $httpCode === 200;
    }
}