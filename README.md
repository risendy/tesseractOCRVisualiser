## Table of contents
* [General info](#general-info)
* [Requirements](#requirements)
* [Technologies](#technologies)
* [Features](#features)
* [Installation](#installation)
* [Screenshots](#screenshots)

## General info
Application which aims to visualise how OCR work (using tessaract OCR library and its HOCR output format).

## Requirements
* PHP 7.3+
* mySQL Database
* Tesseract Open Source OCR Engine - https://github.com/tesseract-ocr/tesseract
* ImageMagick
* PHP imagick module
	
## Technologies
Project is created with:
* Symfony 4
* Tesseract OCR for PHP - https://github.com/thiagoalessio/tesseract-ocr-for-php
* Imagick/ImageMagick
* PHPHtmlParser - https://github.com/paquettg/php-html-parser

## Features
* Displaying tessaractOCR bounding boxes on image (words, lines, paragraphs)
* Displaying recognised phrases over text on image
* Customisation of draw parameters - changing bounding box stroke color, font-size etc

## Installation
#### Clone the repository
#### Install front-end dependencies
```
yarn install
```
#### Compile assets
```
yarn encore dev
```
#### Run composer
```
composer install
```
##### Create database
```
 php bin/console doctrine:database:create
```
#### Run migrations
```
php bin/console doctrine:migrations:migrate
```

## Screenshots

### Homepage
![Main page](public/img/screen1.png)
### Image with all bounding boxes
![Single news page](public/img/screen2.png)
### Part of the image with recognised text
![Comments section](public/img/screen3.png)
