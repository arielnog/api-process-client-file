<?php

namespace App\Services;

use App\DataTransferObjects\ProcessFileDTO;
use App\Entities\Collections\FileControlCollection;
use App\Enums\FileStatusEnum;
use App\Events\ProcessFile\ProcessFileEvent;
use App\Exceptions\ResourceNotFoundException;
use App\Factories\Entities\FileControlFactory;
use App\Repositories\Contracts\IFileControlRepository;
use App\ValueObjects\PathName;
use App\ValueObjects\Resource;
use App\ValueObjects\FileStatus;
use App\Exceptions\InvalidArgumentException;

use Ramsey\Uuid\Uuid;
use Throwable;

class FileControlService
{
    public function __construct(
        private IFileControlRepository $fileControlRepository,
        private ContentService         $contentService
    )
    {
    }

    /**
     * @throws InvalidArgumentException
     * @throws Throwable
     */
    public function save(array $files): bool
    {
        try {
            $fileCollection = new FileControlCollection();

            foreach ($files as $file) {
                $fileUuid = Uuid::uuid4()->toString();

                $pathName = new PathName([$fileUuid, time()]);

                $fileEntity = FileControlFactory::fromArray([
                        'uuid' => $fileUuid,
                        'file_name' => $file->getClientOriginalName(),
                        'path' => $pathName->generateToCsv(),
                        'status' => FileStatusEnum::UNPROCESSED->value
                    ]
                );

                $storage = $fileEntity->saveOnStorage($file);

                if (!$storage) {
                    throw new InvalidArgumentException(
                        message: "Error ao salvar arquivo no storage local.",
                    );
                }

                $fileCollection->addFile($fileEntity);

                $this->fileControlRepository->create($fileEntity);
            }

            event(ProcessFileEvent::EVENT_NAME, $fileCollection);

            return true;
        } catch (Throwable $exception) {
            throw $exception;
        }
    }

    public function processFile(ProcessFileDTO $fileDTO): void
    {
        try {
            $filesControl = $this->fileControlRepository
                ->getByStatusAndName(
                    new FileStatus('unprocessed'),
                    $fileDTO->getPathNames()
                );

            if ($filesControl->isEmpty()) {
                throw new ResourceNotFoundException(
                    message: 'Not file founds',
                );
            }

            foreach ($filesControl->getItems() as $item) {
                $fileResource = new Resource($item->getOnStorage());

                $content = $this->contentService->createFromParser($fileResource);

                if ($content) {
                    $this->fileControlRepository->updateStatus(
                        FileStatus::fromString(
                            FileStatusEnum::PROCESSED->value
                        ),
                        $item
                    );
                }
            }
        } catch (Throwable $throwable) {
            throw $throwable;
        }
    }

    public function get(): FileControlCollection
    {
        return $this->fileControlRepository
            ->getAll();
    }
}
