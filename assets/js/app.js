require('../css/app.scss');
const $ = require('bootstrap/dist/css/bootstrap.css');

let textCheckbox = document.getElementById("convert_ocrWordsOver");
let textColorSelectBox = document.getElementById("convert_ocrWordsColor");
let textFontSizeSelectBox = document.getElementById("convert_ocrWordsFontSize");
let labelFontSize = document.getElementById("labelFontSize");
let labelColorText = document.getElementById("labelWordColor");
let labelBoundingBoxColor = document.getElementById("labelBoundingBoxColor");
let checkBoxOcrWords = document.getElementById("convert_ocrWord");
let checkBoxOcrLines = document.getElementById("convert_ocrLine");
let checkBoxOcrParagraphs = document.getElementById("convert_ocrParagraph");
let boundingBoxColorSelectWord = document.getElementById("convert_boundingBoxColorWord");
let boundingBoxColorSelectLine = document.getElementById("convert_boundingBoxColorLine");
let boundingBoxColorSelectParagraph = document.getElementById("convert_boundingBoxColorParagraph");
let labelBoundingBoxColorWord = document.getElementById("labelBoundingBoxColorWord");
let labelBoundingBoxColorLine = document.getElementById("labelBoundingBoxColorLine");
let labelBoundingBoxColorParagraph = document.getElementById("labelBoundingBoxColorParagraph");

textCheckbox.addEventListener('change', (event) => {
  if (event.target.checked) {
    textColorSelectBox.style.display = 'block';
    textFontSizeSelectBox.style.display = 'block';
    labelFontSize.style.display = 'block';
    labelColorText.style.display = 'block';
  } else {
	textColorSelectBox.style.display = 'none';
	textFontSizeSelectBox.style.display = 'none';
	labelFontSize.style.display = 'none';
    labelColorText.style.display = 'none';
  }
})

checkBoxOcrWords.addEventListener('change', (event) => {
  if (event.target.checked) {
    boundingBoxColorSelectWord.style.display = 'block';
    labelBoundingBoxColorWord.style.display = 'block';
  } else {
    boundingBoxColorSelectWord.style.display = 'none';
    labelBoundingBoxColorWord.style.display = 'none';
  }
})

checkBoxOcrLines.addEventListener('change', (event) => {
  if (event.target.checked) {
    boundingBoxColorSelectLine.style.display = 'block';
    labelBoundingBoxColorLine.style.display = 'block';
  } else {
    boundingBoxColorSelectLine.style.display = 'none';
    labelBoundingBoxColorLine.style.display = 'none';
  }
})

checkBoxOcrParagraphs.addEventListener('change', (event) => {
  if (event.target.checked) {
    boundingBoxColorSelectParagraph.style.display = 'block';
    labelBoundingBoxColorParagraph.style.display = 'block';
  } else {
    boundingBoxColorSelectParagraph.style.display = 'none';
    labelBoundingBoxColorParagraph.style.display = 'none';
  }
})

/*var appMainComponent = new Vue({
    delimiters: ['${', '}'],
    el: '#app',
    data: {

    },
    components: {

    },
    methods: {
      showOptionsForText: function() {

      },
    },
    created: function () {

    }

});*/


