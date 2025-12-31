document.addEventListener("DOMContentLoaded", () => {
  const servicesTab = document.querySelector("#services-tab");
  const dropdownMenu = document.querySelector("#services-dropdown");

  let hideTimeout;

  // Show dropdown menu when hovering over the services tab or the dropdown itself
  const showDropdown = () => {
    clearTimeout(hideTimeout); // Cancel any hide timeout
    dropdownMenu.classList.remove("hidden");
  };

  // Hide dropdown menu after a delay of 0.5 seconds
  const hideDropdown = () => {
    hideTimeout = setTimeout(() => {
      dropdownMenu.classList.add("hidden");
    }, 500); // 500ms delay
  };

  servicesTab.addEventListener("mouseenter", showDropdown);
  dropdownMenu.addEventListener("mouseenter", showDropdown);

  servicesTab.addEventListener("mouseleave", hideDropdown);
  dropdownMenu.addEventListener("mouseleave", hideDropdown);
});
