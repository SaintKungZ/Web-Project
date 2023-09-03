const inputs = document.querySelectorAll(".input-field");
const toggle_btn = document.querySelectorAll(".switch_page");
const main = document.querySelector("main");
const bullets = document.querySelectorAll(".bullets span");
const images = document.querySelectorAll(".image");

// <--ส่วนจัดการช่องกรอกข้อมูล-->
inputs.forEach((inp) => {
  inp.addEventListener("focus", () => {
    inp.classList.add("active");
  });
  inp.addEventListener("blur", () => {
    if (inp.value != "") return;
    inp.classList.remove("active");
  });
});


// <--ส่วนจัดการ การสลับหน้า sign-in กับ sign-up-->
toggle_btn.forEach((btn) => {
  btn.addEventListener("click", switch_page);
});

function switch_page() {
  main.classList.toggle("sign-up-mode");
}


// <--ส่วนจัดการเลื่อนกล่องรูปภาพด้านข้าง-->

let silder_index = 1;

//ส่วน autoSlider()
autoSlider();

function autoSlider() {
  // ส่วนสลับรูป
  let currentImage = document.querySelector(`.img-${silder_index}`);
  images.forEach((img) => img.classList.remove("show"));
  currentImage.classList.add("show");

  //ส่วนสลับข้อความ
  const textSlider = document.querySelector(".text-group");
  textSlider.style.transform = `translateY(${-(silder_index - 1) * 2.2}rem)`;

  //ส่วนสลับแสดงตัว active ปัจจุบัน
  bullets.forEach((bull) => bull.classList.remove("active"));

  bullets[silder_index - 1].classList.add("active");

  silder_index++;

  if (silder_index > bullets.length) {
    silder_index = 1
  }

  setTimeout(autoSlider, 5000);
}

//ส่วน clickSlider()
bullets.forEach((bullet) => {
  bullet.addEventListener("click", clickSlider);
});

function clickSlider() {
  silder_index = this.dataset.value;

  //alert(index);

  // ส่วนสลับรูป
  let currentImage = document.querySelector(`.img-${silder_index}`);
  images.forEach((img) => img.classList.remove("show"));
  currentImage.classList.add("show");

  //ส่วนสลับข้อความ
  const textSlider = document.querySelector(".text-group");
  textSlider.style.transform = `translateY(${-(silder_index - 1) * 2.2}rem)`;

  //ส่วนสลับแสดงตัว active ปัจจุบัน
  bullets.forEach((bull) => bull.classList.remove("active"));
  this.classList.add("active");
}




