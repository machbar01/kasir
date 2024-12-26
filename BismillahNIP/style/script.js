// Menambahkan efek interaktif jika diperlukan di sidebar atau kartu
document.querySelectorAll(".sidebar nav ul li a").forEach((link) => {
  link.addEventListener("click", function () {
    document
      .querySelectorAll(".sidebar nav ul li a")
      .forEach((el) => el.classList.remove("active"));
    this.classList.add("active");
  });
});
