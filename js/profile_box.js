let login_btn = document.querySelector("#login-btn");
login_btn.onclick = () => {
 if (login_btn.classList.contains("active-user")) {
  document.querySelector(".profile-box").classList.toggle("active");
 }
};
document.querySelector(".profile-box-close").onclick = () => {
 document.querySelector(".profile-box").classList.remove("active");
};
