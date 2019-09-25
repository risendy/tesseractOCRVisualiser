<?php


namespace App\Service;


use App\Repository\FileRepository;

class FileService
{
    /**
     * @var FileRepository
     */
    private $fileRepository;

    public function __construct(FileRepository $fileRepository)
    {
        $this->fileRepository = $fileRepository;
    }

    public function uploadFile($documentFile, $uploadPath) {
        $originalFilename = pathinfo($documentFile->getClientOriginalName(), PATHINFO_FILENAME);
        $safeFileName = preg_replace( '/[^a-z0-9]+/', '-', strtolower( $originalFilename ) );
        $newFilename = $safeFileName.'-'.uniqid().'.'.$documentFile->guessExtension();

        $documentFile->move(
            $uploadPath,
            $newFilename
        );

        $this->fileRepository->addNewFile($originalFilename, $uploadPath.$newFilename);
    }
}