// const modal = document.querySelector('.modal');
// const modalOpen = document.querySelector('.modal_btn');
// const modalClose = document.querySelector('.close_btn');

// // //열기 버튼을 눌렀을 때 모달팝업이 열림
// // modalOpen.addEventListener('click',function(){
// //     modal.classList.add('on');
// // });
// // //닫기 버튼을 눌렀을 때 모달팝업이 닫힘
// // modalClose.addEventListener('click',function(){
// //     modal.classList.remove('on');
// // });

// // 2. 스타일 직접 변경
// //열기 버튼을 눌렀을 때 모달팝업이 열림
// modalOpen.addEventListener('click',function(){
//     modal.style.display = 'block';
// });
// //닫기 버튼을 눌렀을 때 모달팝업이 닫힘
// modalClose.addEventListener('click',function(){
//     modal.style.display = 'none';
// });

const modal = document.querySelector(".modal");
const openBtn = document.querySelector("#open");
const overlay = document.querySelector(".modal__overlay");
const closeBtn = document.querySelector("#close");

const openModal = () => {
  modal.classList.remove("hidden");
};
const closeModal = () => {
  modal.classList.add("hidden");
};

overlay.addEventListener("click", closeModal);
closeBtn.addEventListener("click", closeModal);
openBtn.addEventListener("click", openModal);