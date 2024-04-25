<?php

namespace App\Http\Controllers;

use App\Exceptions\InvalidArgumentException;
use App\Http\Requests\SaveFileRequest;
use App\Services\FileControlService;
use App\Traits\Response;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use Throwable;

class FileControlController extends Controller
{
    use Response;

    public function __construct(
        private FileControlService $fileControlService
    )
    {
    }

    /**
     * @throws Throwable
     * @throws InvalidArgumentException
     */
    public function save(Request $request): JsonResponse
    {
        $files = $request->allFiles();

        if (empty($files))
            throw new InvalidArgumentException(
                message: 'Not parameter need on request'
            );

        $file = current($files);

        $this->fileControlService->save(
            $file,
        );

        return $this->responseSuccess(
            message: "File save on success"
        );
    }

    public function get(): JsonResponse
    {
        $files = $this->fileControlService->get();

        return $this->responseSuccess(
            resource: $files->toResponse()
        );
    }
}
