<?php

//namespace Backpack\BackupManager\app\Http\Controllers;
namespace App\Http\Controllers\Admin;

//use Backpack\BackupManager\app\Http\Controllers as BackupControllerOriginal; 
use Artisan;
use Exception;
use Illuminate\Routing\Controller;
use League\Flysystem\Adapter\Local;
use Log;
use Request;
use Response;
use Storage;
use Illuminate\Support\Facades\Validator;

class BackupController extends Controller
{
    public function index()
    {
        $this->data['backups'] = [];

        $disk_name = config('db-snapshots.disk');
        $disk = Storage::disk($disk_name);
        $adapter = $disk->getDriver()->getAdapter();
        $files = $disk->allFiles();

        // make an array of backup files, with their filesize and creation date
        $files_ext = array('sql', 'gz');
        foreach ($files as $k => $f) {
            $file_ext = pathinfo($f, PATHINFO_EXTENSION);
            if ( in_array($file_ext, $files_ext) && $disk->exists($f) ) {
                    $this->data['backups'][] = [
                     //   'file_path'     => $f,
                     //   'file_name'     => str_replace('backups/', '', $f),
                        'file_name'     => $f,
                        'file_size'     => $disk->size($f),
                        'last_modified' => $disk->lastModified($f),
                        'disk'          => $disk_name,
                        'download'      => ($adapter instanceof Local) ? true : false,
                    ];
            }
        }

        // reverse the backups, so the newest one would be on top
        $this->data['backups'] = array_reverse($this->data['backups']);
        $this->data['title'] = 'Backups';

        return view('backup_restore', $this->data);
    }

    public function create()
    {
        $message = 'success';

        try {
            ini_set('max_execution_time', 600);

            Log::info('Backpack\BackupManager -- Called backup:run from admin interface');
            Artisan::call('snapshot:create');
            
            $output = Artisan::output();
            if (strpos($output, 'Backup failed because')) {
                preg_match('/Backup failed because(.*?)$/ms', $output, $match);
                $message = "Backpack\BackupManager -- backup process failed because ";
                $message .= isset($match[1]) ? $match[1] : '';
                Log::error($message.PHP_EOL.$output);
            } else {
                Log::info("Backpack\BackupManager -- backup process has started");
            }
        } catch (Exception $e) {
            Log::error($e);
            return Response::make($e->getMessage(), 500);
        }

        return $message;
    }

    public function restore($file_name)
    {
        $message = 'success';
        $disk_name = config('db-snapshots.disk');
        $disk = Storage::disk($disk_name);
 
        if ($disk->exists($file_name)) {
            $pathinfo = pathinfo($file_name);
            if ($pathinfo['extension'] === 'gz') {
                $file_name = $pathinfo['filename'];
            }
            $pathinfo = pathinfo($file_name);
            if ($pathinfo['extension'] === 'sql') {
                $file_name = $pathinfo['filename'];
            }
            try {
                ini_set('max_execution_time', 600);

                Log::info('Backpack\BackupManager -- Called restore:run from admin interface');

                // Artisan::call('backup:run --disable-notifications --only-db');
                Artisan::call('snapshot:load ' .$file_name);
            
                $output = Artisan::output();
                if (strpos($output, 'does not exist')) {
                    preg_match('/does not exist(.*?)$/ms', $output, $match);
                    $message = "Backpack\BackupManager -- restore process failed because ";
                    $message .= isset($match[1]) ? $match[1] : '';
                    Log::error($message.PHP_EOL.$output);
                } else {
                    Log::info("Backpack\BackupManager -- load process has started");
                }
            } catch (Exception $e) {
                Log::error($e);
                return Response::make($e->getMessage(), 500);
            }
        } else {
            Log::error('Backpack\BackupManager -- Restore File Not exist ' .$file_name);
         //   return trans('backup.backup_doesnt_exist');
            abort(404, trans('backup.backup_doesnt_exist'));
        }
        return $message;
    }


    public function upload() //Request $request
    {
        Log::info('Backpack\BackupManager -- Called Upload');

        $file = Request::file('backupfile');
/*
        $file_ext = $file->getClientOriginalExtension();
        $file_name = $file->getClientOriginalName();
        $rules = array( 'backupfile' => 'required|mimes:gz' );
        $validator = Validator::make(Request::all(), $rules);
        if ($validator->fails()) {
            //Enviar errores
            $data['success'] = false;
            $data['message'] = 'La extension del archivo "' .$file_name .'" no es correcta';
            Log::error('Backpack\BackupManager -- Error Ext_File ' .$file_name);
        } else {

*/
            $new_name = 'upload_' .$file->getClientOriginalName();
            $disk_name = config('db-snapshots.disk');
            $disk = Storage::disk($disk_name);
            $storage_path = $disk->getDriver()->getAdapter()->getPathPrefix();

            //$file->move(public_path('uploads'), $file_name);
            $file->move($storage_path, $new_name);

            $data['success'] = true; //$saved;
            $data['message'] = $new_name;
            Log::info('Backpack\BackupManager -- Upload File ' .$storage_path .$new_name);
     //   }

        return $data;
    

/*
        if(Input::hasFile('file'))
        {
            $f = Input::file('file');
            $att = new Attachment;
            $att->name = $f->getClientOriginalName();
            $att->file = base64_encode(file_get_contents($f->getRealPath()));
            $att->mime = $f->getMimeType();
            $att->size = $f->getSize();
            $att->save();
            //Return success
        }
*/
    }


    /**
     * Downloads a backup zip file.
     */
    public function download($file_name)
    {
        $disk_name = config('db-snapshots.disk');
        $disk = Storage::disk($disk_name);
        $file_name = urldecode($file_name);
        $adapter = $disk->getDriver()->getAdapter();

        if ($adapter instanceof Local) {
            $storage_path = $disk->getDriver()->getAdapter()->getPathPrefix();

            if ($disk->exists($file_name)) {
                return response()->download($storage_path.$file_name);
            } else {
                abort(404, trans('backup.backup_doesnt_exist'));
            }
        } else {
            abort(507, trans('backup.only_local_downloads_supported'));
        }
    }

    /**
     * Deletes a backup file.
     */

    public function delete($file_name)
    {
        $disk_name = config('db-snapshots.disk');
        $disk = Storage::disk($disk_name);
        
        if ($disk->exists($file_name)) {
            $disk->delete($file_name);
            Log::info('Backpack\BackupManager -- Delete File ' .$file_name);
            return 'success';
        } else {
            Log::error('Backpack\BackupManager -- File not exist ' .$file_name);
         //   return trans('backup.backup_doesnt_exist');
            abort(404, trans('backup.backup_doesnt_exist'));

        }
    }
}
