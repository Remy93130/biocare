<?php

namespace App\Services;

use Symfony\Component\HttpFoundation\File\UploadedFile;
use Symfony\Component\HttpFoundation\File\Exception\FileException;

class FileUploader
{
    private $targetDirectory;

    public function __construct($targetDirectory)
    {
        $this->targetDirectory = $targetDirectory;
    }
    
    public function upload(UploadedFile $file)
    {
        $fileName = md5(uniqid()) . "." . $file->guessExtension();

        try {
            $file->move($this->getTargetDirectory(), $fileName);
        } catch (FileException $e) {
            throw new FileException();
        }
        
        return $fileName;
    }
    
    public function getTargetDirectory()
    {
        return $this->targetDirectory;
    }
}
