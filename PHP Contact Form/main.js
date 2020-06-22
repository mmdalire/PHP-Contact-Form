const formContainer = document.querySelector(".form-body");
const next = document.querySelectorAll("#next");
const previous = document.querySelectorAll("#previous");
const confirmTable = document.querySelector("table");

const form = {
  name: ["Name :"],
  email: ["Email :"],
  age: ["Age :"],
  gender: ["Gender :"],
  address: ["Address :"],
  profession: ["Profession :"],
  education: ["Highest Educational Attainment :"],
  workplace: ["Current Wokplace :"],
  workplaceAddress: ["Current Workplace Address :"],
};

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
      //Check for the value modifications first
      const modifiedGender = gender.slice(0, 1).toUpperCase() + gender.slice(1);

      form.name[1] = name;
      form.email[1] = email;
      form.age[1] = age;
      form.gender[1] = modifiedGender;
      form.address[1] = address;

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
        //Check for modifications in value
        const modifiedEducation =
          education
            .split(/(?=[A-Z])/)
            .join(" ")
            .slice(0, 1)
            .toUpperCase() +
          education
            .split(/(?=[A-Z])/)
            .join(" ")
            .slice(1);

        form.profession[1] = profession;
        form.education[1] = modifiedEducation;
        form.workplace[1] = workplace;
        form.workplaceAddress[1] = workplaceAddress;
        confirmDetails(form);

        error[index].style.display = "none";
        return true;
      }
    } else {
      error[index].textContent = "You must complete all fields first!";
      error[index].style.display = "block";
      return false;
    }
  } else {
    return true;
  }
};

const confirmDetails = (form) => {
  confirmTable.textContent = "";
  //Count form length
  let key;
  for (key in form) {
    const tableRow = document.createElement("tr");
    const tableDataHeader = document.createElement("td");
    const tableData = document.createElement("td");

    tableDataHeader.textContent = form[key][0];
    tableData.textContent = form[key][1];
    tableRow.appendChild(tableDataHeader);
    tableRow.appendChild(tableData);
    confirmTable.appendChild(tableRow);
  }
};

const proceedNextForm = (e, index) => {
  if (!verifyContent(index)) {
    e.preventDefault();
    return;
  }
  const activeForm = document.querySelector(".active-form");
  const active = document.querySelector(".active");

  console.log(active.nextElementSibling);
  if (active.nextElementSibling) {
    activeForm.classList.remove("active-form");
    activeForm.nextElementSibling.classList.add("active-form");

    active.classList.remove("active");
    active.nextElementSibling.classList.add("active");
  }
};

const proceedPreviousForm = () => {
  const activeForm = document.querySelector(".active-form");
  const active = document.querySelector(".active");

  if (active.previousElementSibling) {
    activeForm.classList.remove("active-form");
    activeForm.previousElementSibling.classList.add("active-form");

    active.classList.remove("active");
    active.previousElementSibling.classList.add("active");
  }
};

next.forEach((n, index) => {
  n.addEventListener("click", (e) => {
    proceedNextForm(e, index);
  });
});

previous.forEach((p) => {
  p.addEventListener("click", (e) => {
    proceedPreviousForm();
  });
});
