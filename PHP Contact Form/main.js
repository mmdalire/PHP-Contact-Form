const formContainer = document.querySelector(".form-body");
const next = document.querySelectorAll("#next");
const previous = document.querySelectorAll("#previous");

const verifyContent = (index) => {
  const error = document.querySelectorAll(".error");

  if (index === 0) {
    const name = document.querySelector("#name").value;
    const email = document.querySelector("#email").value;
    const age = document.querySelector("#age").value;
    const gender = document.querySelector("#gender").value;
    const address = document.querySelector("#address").value;

    if (name && email && age && gender && address) {
      if (!/\S+@\S+\.\S+/.test(email)) {
        error[index].textContent = "Invalid email!";
        error[index].style.display = "block";
        return false;
      }
      if (!parseInt(age) || parseInt(age) < 1) {
        error[index].textContent = "Invalid age!";
        error[index].style.display = "block";
        return false;
      }
      if (gender === "none") {
        error[index].textContent = "You must choose a gender!";
        error[index].style.display = "block";
        return false;
      }
      error[index].style.display = "none";
      return true;
    } else {
      error[index].textContent = "You must complete all fields first!";
      error[index].style.display = "block";
      return false;
    }
  } else if (index === 1) {
    const profession = document.querySelector("#professionList").value;
    const education = document.querySelector("#education").value;
    const workplace = document.querySelector("#currentWorkplace").value;
    const workplaceAddress = document.querySelector("#workplaceAddress").value;

    if (profession && education && workplace && workplaceAddress) {
      if (education === "none") {
        error[index].textContent = "You must choose an educational attainment!";
        error[index].style.display = "block";
        return false;
      } else {
        error[index].style.display = "none";
        return true;
      }
    } else {
      error[index].textContent = "You must complete all fields first!";
      error[index].style.display = "block";
      return false;
    }
  }
};

const proceedNextForm = (index) => {
  if (!verifyContent(index)) return;
  const active = document.querySelector(".active-form");
  const activeForm = document.querySelector(".active");

  if (active.nextElementSibling) {
    active.classList.remove("active-form");
    active.nextElementSibling.classList.add("active-form");

    activeForm.classList.remove("active");
    activeForm.nextElementSibling.classList.add("active");
  }
};

const proceedPreviousForm = () => {
  const active = document.querySelector(".active-form");
  const activeForm = document.querySelector(".active");

  if (active.previousElementSibling) {
    active.classList.remove("active-form");
    active.previousElementSibling.classList.add("active-form");

    activeForm.classList.remove("active");
    activeForm.previousElementSibling.classList.add("active");
  }
};

next.forEach((n, index) => {
  n.addEventListener("click", (e) => {
    e.preventDefault();
    proceedNextForm(index);
  });
});

previous.forEach((p) => {
  p.addEventListener("click", (e) => {
    e.preventDefault();
    proceedPreviousForm();
  });
});
