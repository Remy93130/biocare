<?php

namespace App\Services;

use Symfony\Component\HttpFoundation\File\UploadedFile;
use Symfony\Component\HttpFoundation\File\Exception\FileException;

/**
 * Service for file upload, rename the file and move it in
 * the selected directory
 * @author remyb
 *
 */
class FileUploader
{
    /**
     * The directory where store files
     * @var string
     */
    private $targetDirectory;

    public function __construct($targetDirectory)
    {
        $this->targetDirectory = $targetDirectory;
    }
    
    /**
     * Generate a unique identifier for the file and move in to the download directory
     * @param UploadedFile $file
     * @throws FileException
     * @return string
     */
    public function upload(UploadedFile $file): string
    {
        $fileName = md5(uniqid()) . "." . $file->guessExtension();

        try {
            $file->move($this->getTargetDirectory(), $fileName);
        } catch (FileException $e) {
            throw new FileException();
        }
        
        return $fileName;
    }
    
    /**
     * Get the targetDirectory
     * @return string
     */
    public function getTargetDirectory(): string
    {
        return $this->targetDirectory;
    }
}
