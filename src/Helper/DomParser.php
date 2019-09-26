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

    public function drawBoxesOnImage($hocr, $file, $ocrWord, $ocrLine, $ocrParagraph)
    {
        $imagePath = $this->params->get('kernel.project_dir') . '/public/img/';

        $imagick = new \Imagick;
        $imagick->readImage($file->getFullPath());
        $draw = new \ImagickDraw();
        $strokeColorOuter = new \ImagickPixel('rgb(0, 0, 0)');
        $fillColor = new \ImagickPixel('none');
        $draw->setFillColor($fillColor);
        $draw->setStrokeWidth(1);
        $draw->setStrokeColor($strokeColorOuter);
        $draw->setStrokeOpacity(1);

        $dom = new Dom;
        $dom->load($hocr);

        $words = $dom->find('.ocrx_word');
        $lines = $dom->find('.ocr_line');
        $paragraphs = $dom->find('.ocr_par');

        if ($ocrWord) {
            foreach ($words as $a) {
                $boxCoorinates = $a->getTag()->getAttribute('title')['value'];

                $splitted = explode(';', $boxCoorinates);
                $splittedCoordinates = explode(' ', $splitted[0]);

                $draw->rectangle($splittedCoordinates[1], $splittedCoordinates[2], $splittedCoordinates[3], $splittedCoordinates[4]);
            }
        }

        if ($ocrLine){
            foreach ($lines as $a) {
                $boxCoorinates = $a->getTag()->getAttribute('title')['value'];

                $splitted = explode(';', $boxCoorinates);
                $splittedCoordinates = explode(' ', $splitted[0]);

                $draw->rectangle($splittedCoordinates[1], $splittedCoordinates[2], $splittedCoordinates[3], $splittedCoordinates[4]);
            }
        }

        if ($ocrParagraph) {
            foreach ($paragraphs as $b) {
                $boxCoorinates = $b->getTag()->getAttribute('title')['value'];
                $splittedCoordinates = explode(' ', $boxCoorinates);

                $draw->rectangle($splittedCoordinates[1], $splittedCoordinates[2], $splittedCoordinates[3], $splittedCoordinates[4]);
            }
        }

        $imagick->drawImage($draw);
        $imagick->writeImages($imagePath . 'boxes_'.$file->getFileName().'.'.$imagick->getImageFormat(), false);

        header('Content-Type: image/'.$imagick->getImageFormat());
        echo $imagick;
    }
}