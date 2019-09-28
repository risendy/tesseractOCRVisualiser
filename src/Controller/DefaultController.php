<?php
namespace App\Controller;

use App\Helper\DomParser;
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
    /**
     * @var DomParser
     */
    private $domParser;

    public function __construct(FileService $fileService, Tesseract $tesseract, DomParser $domParser)
    {
        $this->fileService = $fileService;
        $this->tesseract = $tesseract;
        $this->domParser = $domParser;
    }

    public function index(Request $request )
    {
        $parsedText = '';

        //$imagePath = $this->getParameter('kernel.project_dir') . '/public/img/';
        $uploadPath = $this->getParameter('document_directory');
        //$pdfPath = $this->getParameter('pdf_path');

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
            $ocrWord = $formFiles['ocrWord']->getData();
            $ocrLine = $formFiles['ocrLine']->getData();
            $ocrParagraph = $formFiles['ocrParagraph']->getData();
            $ocrWordsOver = $formFiles['ocrWordsOver']->getData();
            $ocrWordsOverColor = $formFiles['ocrWordsColor']->getData();
            $ocrWordsFontSize = $formFiles['ocrWordsFontSize']->getData();
            $boundingBoxColorWord = $formFiles['boundingBoxColorWord']->getData();
            $boundingBoxColorLine = $formFiles['boundingBoxColorLine']->getData();
            $boundingBoxColorParagraph = $formFiles['boundingBoxColorParagraph']->getData();

            if ($file) {
                $this->tesseract->setOutputFormat($formatType);
                $parsedText = $this->tesseract->processImage($file->getFullPath());

                if ($ocrWord || $ocrLine || $ocrParagraph || $ocrWordsOver) {
                    $this->domParser->drawBoxesOnImage($parsedText, $file, $ocrWord, $ocrLine, $ocrParagraph, $boundingBoxColorWord, $boundingBoxColorLine, $boundingBoxColorParagraph, $ocrWordsOver, $ocrWordsOverColor, $ocrWordsFontSize);
                }
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