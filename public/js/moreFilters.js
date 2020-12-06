$(document).ready(function () {

// slider relativo a Laptop Noise
const $laptopNoise = $('#laptopNoise').find('input[type="range"]');
const $tooltipLaptopNoise = $('#range-tooltip-noise');
const sliderStatesLaptopNoise = [
    {name: "low", tooltip: "At this temperature the laptop will be comfortable if lapped on your knee.", range: _.range(30, 40) },
    {name: "med", tooltip: "Looks good! We can complete a project of this size within <strong>48 hours</strong> of launch.", range: _.range(41, 50)},
    {name: "high", tooltip: "With a project of this size we'd like to talk with you before setting a completion timeline.", range: [51, 65] },
];
var currentStateLaptopNoise;
var $handleLaptopNoise;

$laptopNoise
    .rangeslider({
        polyfill: false,
        onInit: function() {
            $handleLaptopNoise = $('.rangeslider__handle', this.$range);
            updateHandle($handleLaptopNoise[0], this.value);
            updateState($handleLaptopNoise[0], this.value);
        }
    })
    .on('input', function() {
        updateHandle($handleLaptopNoise[0], this.value);
        checkState($handleLaptopNoise[0], this.value);
    });

// Update the value inside the slider handle
function updateHandle(el, val) {
    el.textContent = val;
}

// Check if the slider state has changed
function checkState(el, val) {
    // if the value does not fall in the range of the current state, update that shit.
    if (!_.contains(currentStateLaptopNoise.range, parseInt(val))) {
        updateState(el, val);
    }
}

// Change the state of the slider
function updateState(el, val) {
    for (var j = 0; j < sliderStatesLaptopNoise.length; j++){
        if (_.contains(sliderStatesLaptopNoise[j].range, parseInt(val))) {
            currentStateLaptopNoise = sliderStatesLaptopNoise[j];
            // updateSlider();
        }
    }

    // Update handle color
    $handleLaptopNoise
        .removeClass (function (index, css) {
            return (css.match (/(^|\s)js-\S+/g) ||   []).join(' ');
        })
        .addClass("js-" + currentStateLaptopNoise.name);
    // Update tooltip
    $tooltipLaptopNoise.html(currentStateLaptopNoise.tooltip);
}

// slider relativo a Laptop Temperature
//     const $laptopTemperature = $('#laptopTemperature').find('input[type="range"]');
//     const $tooltipLaptopTemperature = $('#range-tooltip-temperature');
//     const sliderStatesLaptopTemperature = [
//         {name: "low", tooltip: "At this temperature the laptop will be comfortable if lapped on your knee.", range: _.range(30, 40) },
//         {name: "med", tooltip: "Looks good! We can complete a project of this size within <strong>48 hours</strong> of launch.", range: _.range(41, 50)},
//         {name: "high", tooltip: "With a project of this size we'd like to talk with you before setting a completion timeline.", range: [51, 65] },
//     ];
//     var currentStateLaptopTemperature;
//     var $handleLaptopTemperature;
//
//     $laptopTemperature
//         .rangeslider({
//             polyfill: false,
//             onInit: function() {
//                 $handleLaptopTemperature = $('.rangeslider__handle', this.$range);
//                 updateHandle($handleLaptopTemperature[0], this.value);
//                 updateState($handleLaptopTemperature[0], this.value);
//             }
//         })
//         .on('input', function() {
//             updateHandle($handleLaptopTemperature[0], this.value);
//             checkState($handleLaptopTemperature[0], this.value);
//         });
//
// // Update the value inside the slider handle
//     function updateHandle(el, val) {
//         el.textContent = val;
//     }
//
// // Check if the slider state has changed
//     function checkState(el, val) {
//         // if the value does not fall in the range of the current state, update that shit.
//         if (!_.contains(currentStateLaptopTemperature.range, parseInt(val))) {
//             updateState(el, val);
//         }
//     }
//
// // Change the state of the slider
//     function updateState(el, val) {
//         for (var j = 0; j < sliderStatesLaptopTemperature.length; j++){
//             if (_.contains(sliderStatesLaptopTemperature[j].range, parseInt(val))) {
//                 currentStateLaptopTemperature = sliderStatesLaptopTemperature[j];
//                 // updateSlider();
//             }
//         }
//         // // If the state is high, update the handle count to read 50+
//         // if (currentStateLaptopTemperature.name == "high") {
//         //     updateHandle($handleLaptopTemperature[0], "50+");
//         // }
//         // Update handle color
//         $handleLaptopTemperature
//             .removeClass (function (index, css) {
//                 return (css.match (/(^|\s)js-\S+/g) ||   []).join(' ');
//             })
//             .addClass("js-" + currentStateLaptopTemperature.name);
//         // Update tooltip
//         $tooltipLaptopTemperature.html(currentStateLaptopTemperature.tooltip);
//     }


})
