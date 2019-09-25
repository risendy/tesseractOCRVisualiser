<?php


namespace App\Helper;


use PHPHtmlParser\Dom;
use Symfony\Component\DependencyInjection\ParameterBag\ParameterBagInterface;

class DomParser
{
    const resultTextWycinek = "
    <?xml version=\"1.0\" encoding=\"UTF-8\"?>
<!DOCTYPE html PUBLIC \"-//W3C//DTD XHTML 1.0 Transitional//EN\"
    \"http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd\">
<html xmlns=\"http://www.w3.org/1999/xhtml\" xml:lang=\"en\" lang=\"en\">
 <head>
  <title></title>
<meta http-equiv=\"Content-Type\" content=\"text/html;charset=utf-8\" />
  <meta name='ocr-system' content='tesseract 3.04.01' />
  <meta name='ocr-capabilities' content='ocr_page ocr_carea ocr_par ocr_line ocrx_word'/>
</head>
<body>
  <div class='ocr_page' id='page_1' title='image \"/home/kuba/knt-ocr/public/uploads/documents/converted-sad-wycinek-5d81e6b22a5ea.jpeg\"; bbox 0 0 953 532; ppageno 0'>
   <div class='ocr_carea' id='block_1_1' title=\"bbox 25 17 929 22\">
    <p class='ocr_par' dir='ltr' id='par_1_1' title=\"bbox 25 17 929 22\">
     <span class='ocr_line' id='line_1_1' title=\"bbox 25 17 929 22; baseline 0 0; x_size 2.5; x_descenders -1.25; x_ascenders 1.25\"><span class='ocrx_word' id='word_1_1' title='bbox 25 17 929 22; x_wconf 95' lang='pol' dir='ltr'><strong> </strong></span> 
     </span>
    </p>
   </div>
   <div class='ocr_carea' id='block_1_2' title=\"bbox 251 50 705 196\">
    <p class='ocr_par' dir='ltr' id='par_1_2' title=\"bbox 251 50 705 196\">
     <span class='ocr_line' id='line_1_2' title=\"bbox 251 50 705 91; baseline 0.002 -10; x_size 41; x_descenders 9; x_ascenders 9\"><span class='ocrx_word' id='word_1_2' title='bbox 251 50 323 90; x_wconf 86' lang='pol' dir='ltr'><strong>Sąd</strong></span> <span class='ocrx_word' id='word_1_3' title='bbox 339 50 539 91; x_wconf 86' lang='pol' dir='ltr'><strong>Okręgowy</strong></span> <span class='ocrx_word' id='word_1_4' title='bbox 552 59 585 82; x_wconf 98' lang='pol' dir='ltr'><strong>w</strong></span> <span class='ocrx_word' id='word_1_5' title='bbox 596 51 705 83; x_wconf 78' lang='pol' dir='ltr'><strong>Łodzi</strong></span> 
     </span>
     <span class='ocr_line' id='line_1_3' title=\"bbox 261 103 651 151; baseline 0.003 -17; x_size 41; x_descenders 9; x_ascenders 9\"><span class='ocrx_word' id='word_1_6' title='bbox 261 148 266 151; x_wconf 20' lang='pol' dir='ltr'><strong><em>W</em></strong></span> <span class='ocrx_word' id='word_1_7' title='bbox 305 103 311 134; x_wconf 99' lang='pol' dir='ltr'>I</span> <span class='ocrx_word' id='word_1_8' title='bbox 325 103 482 143; x_wconf 87' lang='pol' dir='ltr'><strong>Wydział</strong></span> <span class='ocrx_word' id='word_1_9' title='bbox 495 103 651 144; x_wconf 89' lang='pol' dir='ltr'>Cywilny</span> 
     </span>
     <span class='ocr_line' id='line_1_4' title=\"bbox 289 156 669 196; baseline 0.003 -10; x_size 40; x_descenders 9; x_ascenders 8\"><span class='ocrx_word' id='word_1_10' title='bbox 289 156 334 186; x_wconf 59' lang='pol' dir='ltr'><strong>PI-</strong></span> <span class='ocrx_word' id='word_1_11' title='bbox 350 156 634 196; x_wconf 84' lang='pol' dir='ltr'><strong>Dąbrowskiego</strong></span> <span class='ocrx_word' id='word_1_12' title='bbox 648 157 669 187; x_wconf 92' lang='pol'><strong><em>5</em></strong></span> 
     </span>
    </p>
   </div>
   <div class='ocr_carea' id='block_1_3' title=\"bbox 192 208 758 287\">
    <p class='ocr_par' dir='ltr' id='par_1_3' title=\"bbox 192 208 758 287\">
     <span class='ocr_line' id='line_1_5' title=\"bbox 358 208 597 239; baseline 0 0; x_size 41.333332; x_descenders 10.333333; x_ascenders 10.333334\"><span class='ocrx_word' id='word_1_13' title='bbox 358 208 481 239; x_wconf 88' lang='pol'><strong>90-921</strong></span> <span class='ocrx_word' id='word_1_14' title='bbox 499 208 597 239; x_wconf 90' lang='pol' dir='ltr'><strong>Łódź</strong></span> 
     </span>
     <span class='ocr_line' id='line_1_6' title=\"bbox 192 258 758 287; baseline 0.002 -1; x_size 37.222221; x_descenders 9.3055553; x_ascenders 9.3055553\"><span class='ocrx_word' id='word_1_15' title='bbox 192 258 239 286; x_wconf 83' lang='pol' dir='ltr'><strong>teL</strong></span> <span class='ocrx_word' id='word_1_16' title='bbox 254 259 293 286; x_wconf 91' lang='pol'><strong>42</strong></span> <span class='ocrx_word' id='word_1_17' title='bbox 305 259 345 286; x_wconf 89' lang='pol'><strong>68</strong></span> <span class='ocrx_word' id='word_1_18' title='bbox 359 259 398 287; x_wconf 91' lang='pol'><strong>50</strong></span> <span class='ocrx_word' id='word_1_19' title='bbox 410 259 471 287; x_wconf 91' lang='pol'><strong>400</strong></span> <span class='ocrx_word' id='word_1_20' title='bbox 484 259 533 287; x_wconf 83' lang='pol' dir='ltr'><strong>fax</strong></span> <span class='ocrx_word' id='word_1_21' title='bbox 544 259 585 287; x_wconf 87' lang='pol'><strong>42</strong></span> <span class='ocrx_word' id='word_1_22' title='bbox 597 259 637 287; x_wconf 89' lang='pol'><strong>68</strong></span> <span class='ocrx_word' id='word_1_23' title='bbox 651 260 691 287; x_wconf 89' lang='pol'><strong>50</strong></span> <span class='ocrx_word' id='word_1_24' title='bbox 702 260 758 287; x_wconf 87' lang='pol'><strong>401</strong></span> 
     </span>
    </p>
   </div>
   <div class='ocr_carea' id='block_1_4' title=\"bbox 26 314 591 317\">
    <p class='ocr_par' dir='ltr' id='par_1_4' title=\"bbox 26 314 591 317\">
     <span class='ocr_line' id='line_1_7' title=\"bbox 26 314 591 317; baseline 0 0; x_size 1.5; x_descenders -0.75; x_ascenders 0.75\"><span class='ocrx_word' id='word_1_25' title='bbox 26 314 591 317; x_wconf 95' lang='pol' dir='ltr'><strong> </strong></span> 
     </span>
    </p>
   </div>
   <div class='ocr_carea' id='block_1_5' title=\"bbox 137 403 748 458\">
    <p class='ocr_par' dir='ltr' id='par_1_5' title=\"bbox 137 403 748 458\">
     <span class='ocr_line' id='line_1_8' title=\"bbox 137 403 748 458; baseline 0.002 -13; x_size 56; x_descenders 13; x_ascenders 15\"><span class='ocrx_word' id='word_1_26' title='bbox 137 403 370 458; x_wconf 81' lang='pol' dir='ltr'>Sygnatura</span> <span class='ocrx_word' id='word_1_27' title='bbox 386 403 456 445; x_wconf 83' lang='pol' dir='ltr'><strong>akt</strong></span> <span class='ocrx_word' id='word_1_28' title='bbox 472 405 489 445; x_wconf 89' lang='pol' dir='ltr'>I</span> <span class='ocrx_word' id='word_1_29' title='bbox 507 404 543 446; x_wconf 91' lang='pol' dir='ltr'>C</span> <span class='ocrx_word' id='word_1_30' title='bbox 566 405 643 446; x_wconf 84' lang='pol'><strong>185</strong></span> <span class='ocrx_word' id='word_1_31' title='bbox 651 403 693 446; x_wconf 90' lang='pol'><strong>8/</strong></span> <span class='ocrx_word' id='word_1_32' title='bbox 701 405 715 445; x_wconf 79' lang='pol'>1</span> <span class='ocrx_word' id='word_1_33' title='bbox 726 405 748 446; x_wconf 88' lang='pol'>8</span> 
     </span>
    </p>
   </div>
   <div class='ocr_carea' id='block_1_6' title=\"bbox 141 474 744 507\">
    <p class='ocr_par' dir='ltr' id='par_1_6' title=\"bbox 141 474 744 507\">
     <span class='ocr_line' id='line_1_9' title=\"bbox 141 474 744 507; baseline 0.002 -8; x_size 32; x_descenders 7; x_ascenders 8\"><span class='ocrx_word' id='word_1_34' title='bbox 141 475 173 504; x_wconf 61' lang='pol' dir='ltr'><em>W</em></span> <span class='ocrx_word' id='word_1_35' title='bbox 183 474 336 506; x_wconf 83' lang='pol' dir='ltr'><strong>odpowiedzi</strong></span> <span class='ocrx_word' id='word_1_36' title='bbox 347 475 433 506; x_wconf 80' lang='pol' dir='ltr'>należy</span> <span class='ocrx_word' id='word_1_37' title='bbox 442 475 522 506; x_wconf 85' lang='pol' dir='ltr'><strong>podać</strong></span> <span class='ocrx_word' id='word_1_38' title='bbox 533 475 587 506; x_wconf 83' lang='pol' dir='ltr'>datę</span> <span class='ocrx_word' id='word_1_39' title='bbox 597 475 603 499; x_wconf 87' lang='pol' dir='ltr'>i</span> <span class='ocrx_word' id='word_1_40' title='bbox 615 483 683 507; x_wconf 13' lang='pol' dir='ltr'>sygno</span> <span class='ocrx_word' id='word_1_41' title='bbox 695 475 744 506; x_wconf 51' lang='pol' dir='ltr'><strong>aku</strong></span> 
     </span>
    </p>
   </div>
  </div>
 </body>
</html>
    ";
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

    public function drawBoxesOnImage($hocr, $file)
    {
        $imagePath = $this->params->get('kernel.project_dir') . '/public/img/';

        $imagick = new \Imagick;
        $imagick->readImage($file->getFilePath() . '/' . $file->getFileName());
        $draw = new \ImagickDraw();
        $strokeColorOuter = new \ImagickPixel('rgb(0, 0, 0)');
        $fillColor = new \ImagickPixel('none');
        $draw->setFillColor($fillColor);
        $draw->setStrokeWidth(3);
        $draw->setStrokeColor($strokeColorOuter);
        $draw->setStrokeOpacity(1);

        $dom = new Dom;
        $dom->load($hocr);

        $area = $dom->find('.ocr_line');
        $area2 = $dom->find('.ocr_par');

        foreach ($area as $a) {
            $boxCoorinates = $a->getTag()->getAttribute('title')['value'];

            $splitted = explode(';', $boxCoorinates);

            $splittedCoordinates = explode(' ', $splitted[0]);

            $x1 = $splittedCoordinates[1];
            $y1 = $splittedCoordinates[2];

            $x2 = $splittedCoordinates[3];
            $y2 = $splittedCoordinates[4];

            $draw->rectangle($x1, $y1, $x2, $y2);
        }

        foreach ($area2 as $b) {
            $boxCoorinates = $b->getTag()->getAttribute('title')['value'];

            $splittedCoordinates = explode(' ', $boxCoorinates);

            $x1 = $splittedCoordinates[1];
            $y1 = $splittedCoordinates[2];

            $x2 = $splittedCoordinates[3];
            $y2 = $splittedCoordinates[4];

            $draw->rectangle($x1, $y1, $x2, $y2);
        }

        //$draw->rectangle(10, 10, 100, 100);
        //$draw->rectangle(50, 50, 200, 200);

        $imagick->drawImage($draw);
        $imagick->writeImages($imagePath . 'boxes_'.$file->getFileName(), false);
    }
}