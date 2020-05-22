<?php

namespace App;
use Google\ApiCore\ApiException;
use Google\Cloud\Vision\V1\ImageAnnotationContext;
use Google\Cloud\Vision\V1\ImageAnnotatorClient;
use Google\Cloud\Vision\VisionClient;

class app
{

    private $vision;

    public function __construct()
    {

        $this->vision = new VisionClient([
            'keyFile' =>  json_decode(file_get_contents(__DIR__ . '/../key.json')),
            true
        ]);

        var_dump($this->vision);

        return;
        $photo = fopen(__DIR__ . '/../storage/images/tony.jpg', 'r');
        $image = $this->vision->image($photo, ['FACE_DETECTION', 'WEB_DETECTION']);
        $result = $this->vision->annotate($image);
        var_dump($result);
    }

    private function detect_text($path){
        $imageAnnotator = new ImageAnnotatorClient();
        $imageAnnotator->

        $image = file_get_contents('C:\xampp\htdocs\projects\NLP\google_test\storage\images\test.png');
        try {
            $response = $imageAnnotator->textDetection($image);
            $texts = $response->getTextAnnotations();
            printf('%d texts found:' . PHP_EOL, count($texts));
            foreach ($texts as $text) {
                print($text->getDescription() . PHP_EOL);

                # get bounds
                $vertices = $text->getBoundingPoly()->getVertices();
                $bounds = [];
                foreach ($vertices as $vertex) {
                    $bounds[] = sprintf('(%d,%d)', $vertex->getX(), $vertex->getY());
                }
                print('Bounds: ' . join(', ', $bounds) . PHP_EOL);
            }

            $imageAnnotator->close();

        } catch (ApiException $e) {
            var_dump($e);
        }
    }
}