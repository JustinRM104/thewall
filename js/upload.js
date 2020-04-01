const realFileBtn = document.getElementById("real-file");
const customBtn = document.getElementById("custom-button");

customBtn.addEventListener("click", function() {
  realFileBtn.click();
});

realFileBtn.addEventListener("change", function() {
  if (realFileBtn.value) {
    customBtn.innerHTML = "↣ " + realFileBtn.value.match(
      /[\/\\]([\w\d\s\.\-\(\)]+)$/
    )[1];
  } else {
    customBtn.innerHTML = "Foto toevoegen";
  }
});
