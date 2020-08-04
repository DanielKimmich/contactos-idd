<?php

namespace App\Providers;

use Storage;
use League\Flysystem\Filesystem;
use Illuminate\Support\ServiceProvider;
use Spatie\Dropbox\Client as DropboxClient;
use Spatie\FlysystemDropbox\DropboxAdapter;

class DropboxServiceProvider extends ServiceProvider
{
    /**
     * Register services.
     *
     * @return void
     */
    public function register()
    {
        //
    }

    /**
     * Bootstrap services.
     *
     * @return void
     */
    public function boot()
    {
        // Extendemos el Storage de Laravel agregando nuestro nuevo driver.
        Storage::extend('dropbox', function ($app, $config) { 
            $client = new DropboxClient(
               $config['authorizationToken'] // Hacemos referencia al hash
            );  
//dump($config['authorizationToken']);
//dump($config['appKey']);
//dump($config['appSecret']);

  /*          $client = new DropboxClient([
                $config['appKey'], // Hacemos referencia al hash
                $config['appSecret'] // Hacemos referencia al hash
            ]); */

            $adapter = new DropboxAdapter($client);
            
            $filesystem = new Filesystem($adapter, ['case_sensitive' => false]);
            
            return $filesystem; 
        });
    }
}
