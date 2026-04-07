// Initialize EmailJS
(function () {
  emailjs.init("Jd-P5vC7K4wKYDiq4"); // 🔴 replace
})();

const form = document.getElementById("contact-form");
const statusMsg = document.getElementById("status-msg");

form.addEventListener("submit", function (e) {
  e.preventDefault();

  statusMsg.innerHTML = "⏳ Sending...";
  statusMsg.style.color = "blue";

  emailjs.sendForm(
    "service_gwr6tr5", 
    "template_m2qfpeb",
    form
  )
  .then(() => {
    statusMsg.innerHTML = "✅ Message sent!";
    statusMsg.style.color = "green";
    form.reset();
  })
  .catch((error) => {
    statusMsg.innerHTML = "❌ Failed!";
    statusMsg.style.color = "red";
    console.log(error);
  });
});

const hireBtn = document.getElementById("hire-btn");

hireBtn.addEventListener("click", function(e) {
  e.preventDefault();

  emailjs.send(
    "service_gwr6tr5",
    "template_m2qfpeb",
    {
      name: "Recruiter / Visitor",
      email: "portfolio@visitor.com",
      subject: "🚀 Hiring Opportunity",
      message: "A recruiter is interested in hiring you. Please check your portfolio contact."
    }
  )
  .then(() => {
    alert("✅ Request sent! I will contact you soon.");
  })
  .catch((error) => {
    alert("❌ Failed to send request");
    console.log(error);
  });
});