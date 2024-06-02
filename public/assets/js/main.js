// add hovered class to selected list item
let list = document.querySelectorAll(".navigation li");

function activeLink() {
  list.forEach((item) => {
    item.classList.remove("hovered");
  });
  this.classList.add("hovered");
}

list.forEach((item) => item.addEventListener("mouseover", activeLink));

// Menu Toggle
let toggle = document.querySelector(".toggle");
let navigation = document.querySelector(".navigation");
let main = document.querySelector(".main");

toggle.onclick = function () {
    navigation.classList.toggle("active");
    main.classList.toggle("active");
    document.querySelector(".logo-item").classList.toggle("hidden");
};

document.getElementById('addCategoryButton').addEventListener('click', function() {
    // Hiển thị modal popup
    document.getElementById('addCategoryModal').classList.add('show');

    // Tạo một phần nền mờ
    var backdrop = document.createElement('div');
    backdrop.classList.add('modal-backdrop');
    backdrop.classList.add('fade');
    backdrop.classList.add('show');
    document.body.appendChild(backdrop);
});

// Đóng modal popup khi click ra ngoài hoặc nhấn Esc
document.addEventListener('click', function(event) {
    var modal = document.getElementById('addCategoryModal');
    if (event.target == modal) {
        modal.classList.remove('show');
        var backdrop = document.querySelector('.modal-backdrop');
        backdrop.parentNode.removeChild(backdrop);
    }
});

document.addEventListener('keyup', function(event) {
    if (event.key === "Escape") {
        var modal = document.getElementById('addCategoryModal');
        modal.classList.remove('show');
        var backdrop = document.querySelector('.modal-backdrop');
        backdrop.parentNode.removeChild(backdrop);
    }
});



