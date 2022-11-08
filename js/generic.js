"use strict";

// image show on file upload

let image_file = document.querySelector("#file");
let target_image = document.querySelector("#target");

function showImage(src, target) {
  let fr = new FileReader();
  fr.onload = function () {
    target.src = fr.result;
  };
  fr.readAsDataURL(src.files[0]);
}

function putImage() {
  let src = image_file;
  let target = target_image;
  showImage(src, target);
}

image_file.addEventListener("change", function () {
  target_image.style.display = "block";
});
