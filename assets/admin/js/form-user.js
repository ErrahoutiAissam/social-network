const form = document.querySelector("#form-add-user");

console.log(form);

const adminRadio = form.querySelector("#admin");
const clientRadio = form.querySelector("#client");

const adminForm = form.querySelector("#admin-form");
const clientForm = form.querySelector("#client-form");

adminRadio.addEventListener("change", (e) => {
  if (e.target.checked) {
    adminForm.style = "display: block;";
    clientForm.style = "display: none;";
  } else {
    adminForm.style = "display: none;";
    clientForm.style = "display: block;";
  }
});

clientRadio.addEventListener("change", (e) => {
  if (e.target.checked) {
    clientForm.style = "display: block;";
    adminForm.style = "display: none;";
  } else {
    clientForm.style = "display: none;";
    adminForm.style = "display: block;";
  }
});
