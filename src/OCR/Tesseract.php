<?php


namespace App\OCR;


use thiagoalessio\TesseractOCR\TesseractOCR;

class Tesseract
{
    /**
     * @var TesseractOCR
     */
    private $tesseract;

    public function __construct()
    {
        $this->tesseract = new TesseractOCR;
        $this->tesseract->lang('pol');
    }

    public function processImage($path) {
        $this->tesseract->image($path);
        return $this->tesseract->run();
    }

    public function setOutputFormat($format) {
        $this->tesseract->format($format);
    }
}