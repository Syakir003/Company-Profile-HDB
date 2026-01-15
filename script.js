document.addEventListener("DOMContentLoaded", () => {
  /* ===== ELEMENT SELECTION ===== */
  const hamburger = document.getElementById("hamburger-btn");
  const navMenu = document.getElementById("nav-menu");
  const dropdownItems = document.querySelectorAll(".dropdown-item");
  const lightbox = document.getElementById("lightbox");
  const lightboxImg = document.getElementById("lightbox-img");
  const lightboxClose = document.getElementById("lightbox-close");
  const slider = document.getElementById("hero-slider");

  /* ===== HAMBURGER MENU ===== */
  if (hamburger && navMenu) {
    hamburger.addEventListener("click", (e) => {
      e.stopPropagation();
      navMenu.classList.toggle("active");

      const icon = hamburger.querySelector("i");
      if (icon) {
        icon.classList.toggle("fa-bars");
        icon.classList.toggle("fa-times");
      }
    });

    // Klik luar hamburger / nav
    document.addEventListener("click", () => {
      navMenu.classList.remove("active");
      if (hamburger.querySelector("i")) {
        hamburger.querySelector("i").classList.replace("fa-times", "fa-bars");
      }
      dropdownItems.forEach(item => item.classList.remove("active"));
    });
  }

  /* ===== DROPDOWN MOBILE ===== */
  dropdownItems.forEach(item => {
    const trigger = item.querySelector(".dropdown-toggle");
    if (trigger) {
      trigger.addEventListener("click", (e) => {
        if (window.innerWidth <= 991) {
          e.preventDefault();
          e.stopPropagation();
          item.classList.toggle("active");
        }
      });
    }
  });

  /* ===== FADE IN SCROLL ===== */
  const observer = new IntersectionObserver((entries, obs) => {
    entries.forEach(entry => {
      if (entry.isIntersecting) {
        entry.target.classList.add("is-visible");
        obs.unobserve(entry.target);
      }
    });
  }, { threshold: 0.1 });

  document.querySelectorAll(".fade-in-element").forEach(el => observer.observe(el));

  /* ===== LIGHTBOX ===== */
  if (lightbox && lightboxImg) {
    document.querySelectorAll(".gallery-item").forEach(item => {
      item.addEventListener("click", () => {
        const img = item.querySelector("img");
        if (img) {
          lightboxImg.src = img.src;
          lightbox.classList.add("active");
        }
      });
    });

    if (lightboxClose) {
      lightboxClose.addEventListener("click", () => lightbox.classList.remove("active"));
    }

    lightbox.addEventListener("click", (e) => {
      if (e.target === lightbox) lightbox.classList.remove("active");
    });
  }

  /* ===== HERO SLIDER ===== */
  if (slider) {
    const slides = slider.querySelectorAll(".slide");
    if (slides.length > 0) {
      let index = 0;
      slides[index].classList.add("active"); // mulai dari slide pertama

      setInterval(() => {
        slides[index].classList.remove("active");
        index = (index + 1) % slides.length;
        slides[index].classList.add("active");
      }, 3000);
    }
  }
});

/* ===== WHATSAPP FORM ===== */
function sendWA(event) {
  event.preventDefault();

  const name = document.getElementById("name")?.value.trim() || "";
  const phone = document.getElementById("phone")?.value.trim() || "";
  const email = document.getElementById("email")?.value.trim() || "";
  const subject = document.getElementById("subject")?.value.trim() || "";
  const message = document.getElementById("message")?.value.trim() || "";

  if (!name || !phone || !email || !subject || !message) {
    alert("Mohon lengkapi semua data terlebih dahulu.");
    return;
  }

  const waNumber = "6282333318107";
  const waMessage = `
Halo HDB Airconds,

Nama: ${name}
No HP: ${phone}
Email: ${email}
Subjek: ${subject}

Pesan:
${message}
  `;

  window.open(
    `https://wa.me/${waNumber}?text=${encodeURIComponent(waMessage)}`,
    "_blank"
  );
}
