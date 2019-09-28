<?php


namespace App\Helper;


use PHPHtmlParser\Dom;
use Symfony\Component\DependencyInjection\ParameterBag\ParameterBagInterface;

class DomParser
{
    /**
     * @var ParameterBagInterface
     */
    private $params;

    public function __construct(ParameterBagInterface $params)
    {
        $this->params = $params;
    }

    public function clearHtml($html)
    {
        $html = strip_tags($html, "<div><span><p>");

        return $html;
    }

    public function scrapeLineByWord($html, $wordAnchor)
    {
        $sentence = '';
        $html = $this->clearHtml($html);

        $dom = new Dom;
        $dom->load($html);

        $words = $dom->find('.ocrx_word');

        foreach ($words as $word) {
            if ($word->text == $wordAnchor) {

                $line = $word->getParent();

                foreach ($line as $lineWords) {
                    $sentence .= $lineWords->text . ' ';
                }
            }
        }

        return $sentence;
    }

    public function drawBoxesOnImage($hocr, $file, $ocrWord, $ocrLine, $ocrParagraph, $boundingBoxColorWord, $boundingBoxColorLine, $boundingBoxColorParagraph, $ocrWordsOver, $ocrWordsOverColor, $fontSize)
    {
        $imagePath = $this->params->get('kernel.project_dir') . '/public/img/';

        $imagick = new \Imagick;
        $imagick->readImage($file->getFullPath());
        $draw = new \ImagickDraw();
        $strokeColorOuter = new \ImagickPixel('rgb(0, 0, 0)');
        $fillColor = new \ImagickPixel('none');
        $draw->setFillColor($fillColor);
        $draw->setStrokeColor($strokeColorOuter);
        $draw->setStrokeWidth(2);
        $draw->setStrokeOpacity(1);

        $dom = new Dom;
        $dom->load($hocr);

        $words = $dom->find('.ocrx_word');
        $lines = $dom->find('.ocr_line');
        $paragraphs = $dom->find('.ocr_par');

        if ($ocrWord) {
            $boundingBoxColorWord = new \ImagickPixel($boundingBoxColorWord);
            $draw->setStrokeColor($boundingBoxColorWord);

            foreach ($words as $a) {
                $boxCoorinates = $a->getTag()->getAttribute('title')['value'];

                $splitted = explode(';', $boxCoorinates);
                $splittedCoordinates = explode(' ', $splitted[0]);

                $draw->rectangle($splittedCoordinates[1], $splittedCoordinates[2], $splittedCoordinates[3], $splittedCoordinates[4]);
            }
        }

        if ($ocrLine){
            $boundingBoxColorLine = new \ImagickPixel($boundingBoxColorLine);
            $draw->setStrokeColor($boundingBoxColorLine);

            foreach ($lines as $a) {
                $boxCoorinates = $a->getTag()->getAttribute('title')['value'];

                $splitted = explode(';', $boxCoorinates);
                $splittedCoordinates = explode(' ', $splitted[0]);

                $draw->rectangle($splittedCoordinates[1], $splittedCoordinates[2], $splittedCoordinates[3], $splittedCoordinates[4]);
            }
        }

        if ($ocrParagraph) {
            $boundingBoxColorParagraph = new \ImagickPixel($boundingBoxColorParagraph);
            $draw->setStrokeColor($boundingBoxColorParagraph);

            foreach ($paragraphs as $b) {
                $boxCoorinates = $b->getTag()->getAttribute('title')['value'];
                $splittedCoordinates = explode(' ', $boxCoorinates);

                $draw->rectangle($splittedCoordinates[1], $splittedCoordinates[2], $splittedCoordinates[3], $splittedCoordinates[4]);
            }
        }

        if ($ocrWordsOver) {
            $strokeColorOuter = new \ImagickPixel($ocrWordsOverColor);

            $draw->setFontSize($fontSize);
            $draw->setStrokeWidth(1);
            $draw->setStrokeColor($ocrWordsOverColor);
            $draw->setFillColor($ocrWordsOverColor);

            foreach ($words as $a) {
                $boxCoorinates = $a->getTag()->getAttribute('title')['value'];
                $text = $a->firstChild()->text;

                $splitted = explode(';', $boxCoorinates);

                $splittedCoordinates = explode(' ', $splitted[0]);

                $x1 = $splittedCoordinates[1];
                $y1 = $splittedCoordinates[2];

                $imagick->annotateImage($draw, $x1, $y1-3, 0, $text);
            }
        }

        $imagick->drawImage($draw);
        $imagick->writeImages($imagePath . 'boxes_'.$file->getFileName().'.'.$imagick->getImageFormat(), false);

        header('Content-Type: image/'.$imagick->getImageFormat());
        echo $imagick;
    }
}