<?php

namespace App\Http\Controllers\Admin\V1;

use App\Http\Controllers\Controller;
use App\Http\Helpers\Traits\UploaderHelper;
use App\Http\Requests\Admin\Media\UploadFileRequest;
use App\Http\Requests\Admin\UploadRequest;
use App\Http\Resources\Admin\MediaResource;
use App\Models\Media;

class MediaController extends Controller
{
    use UploaderHelper;

    /**
     * @param UploadRequest $request
     * @return \App\Http\Response\Response|void
     * upload file and return id and path using upload helper class
     */
    public function upload(UploadRequest $request)
    {
        $file = $request->file('file');
        $base_folder = 'uploads/images';
        $folder_name = ($request->has('folder')) ? $base_folder."/".$request->get('folder') : $base_folder;
        $file_data = $this->handleUploadWithResize($file, $folder_name);
        $media = Media::query()->create([
            'size'      => $file_data['size'],
            'extension' => $file_data['extension'],
            'type'      => $file_data['type'],
            'name'      => $file_data['name'],
            'path'      => $file_data['path'],
        ]);
        if ($media) {

            return $this->response->statusOk(["data" =>new MediaResource($media),"message"=> "file uploaded successfully"]);
        }
    }

    public function uploadFile(UploadFileRequest $request)
    {
        $file = $request->file('file');
        $base_folder = 'uploads/pdf';
        $folder_name = ($request->has('folder')) ? $base_folder."/".$request->get('folder') : $base_folder;
        $file_data = $this->handleUploadWithResize($file, $folder_name);
        $media = Media::query()->create([
            'size'      => $file_data['size'],
            'extension' => $file_data['extension'],
            'type'      => $file_data['type'],
            'name'      => $file_data['name'],
            'path'      => $file_data['path'],
        ]);
        if ($media) {

            return $this->response->statusOk(["data" =>new MediaResource($media),"message"=> trans('admin.file_uploaded_successfully')]);
        }
    }


}
