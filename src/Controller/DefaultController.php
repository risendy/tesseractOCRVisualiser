<?php
namespace App\Controller;

use App\OCR\Tesseract;
use App\Service\FileService;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\File\Exception\FileException;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\HttpFoundation\Request;
use App\Form\UploadType;
use App\Form\ConvertType;

class DefaultController extends AbstractController
{
//    public function __construct(FileHelper $fileHelper, FileService $fileService, Tessaract $tessaractClient, DomParser $domParser)
//    {
//        $this->fileHelper = $fileHelper;
//        $this->fileService = $fileService;
//        $this->tessaractClient = $tessaractClient;
//        $this->domParser = $domParser;
//    }

    /**
     * @var FileService
     */
    private $fileService;
    /**
     * @var Tesseract
     */
    private $tesseract;

    public function __construct(FileService $fileService, Tesseract $tesseract)
    {
        $this->fileService = $fileService;
        $this->tesseract = $tesseract;
    }

    public function index(Request $request )
    {
        ini_set('xdebug.var_display_max_depth', '10');
        ini_set('xdebug.var_display_max_children', '256');
        ini_set('xdebug.var_display_max_data', '10024');

        $parsedText = '';
//
//        $imagePath = $this->getParameter('kernel.project_dir') . '/public/img/';
          $uploadPath = $this->getParameter('document_directory');
//        $pdfPath = $this->getParameter('pdf_path');

        $formUpload = $this->createForm(UploadType::class);
        $formFiles = $this->createForm(ConvertType::class);

        $formUpload->handleRequest($request);
        $formFiles->handleRequest($request);

        if ($formUpload->isSubmitted() && $formUpload->isValid()) {
            $documentFile = $formUpload['document']->getData();

            if ($documentFile) {
                try {
                    $this->fileService->uploadFile($documentFile, $uploadPath);

                    $this->addFlash('success', 'Plik został poprawnie zapisany');
                } catch (FileException $e) {
                    $this->addFlash('danger', 'Błąd podczas przesyłania pliku');
                }
            }
        }

        if ($formFiles->isSubmitted() && $formFiles->isValid()) {
            $file = $formFiles['fileList']->getData();
            $formatType = $formFiles['formatType']->getData();

            if ($file) {
                if ($formatType==0) {$formatType='hocr'; };

                if ($formatType==1) $formatType='txt';

                $this->tesseract->setOutputFormat($formatType);
                $parsedText = $this->tesseract->processImage($file->getFullPath());

                //$domResult = $this->domParser->scrapeLineByWord($parsedText, 'Sygnatura');
                //$domResult = $this->domParser->drawBoxesOnImage($parsedText, $file);
            }
        }

        return $this->render(
            'index.html.twig', [
                "parsedText" => $parsedText,
                'formUpload' => $formUpload->createView(),
                'formFiles' => $formFiles->createView(),
            ]
        );
    }
}