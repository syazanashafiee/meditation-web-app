// Define the necessary variables
let navbar = document.querySelector('.header .navbar');
let dropdown = document.querySelector('.dropdown');
let dropbtn = document.querySelector('.dropbtn');

// Toggle the dropdown menu when clicking the button
dropbtn.onclick = () => {
   dropdown.classList.toggle('active');
};

// Close the dropdown when clicking outside of it
window.onclick = (event) => {
   if (!event.target.matches('.dropbtn')) {
      if (dropdown.classList.contains('active')) {
         dropdown.classList.remove('active');
      }
   }
};

// Close the dropdown when scrolling
window.onscroll = () => {
   if (dropdown.classList.contains('active')) {
      dropdown.classList.remove('active');
   }
};

// Close the edit form container
document.querySelector('#close-edit').onclick = () => {
   document.querySelector('.edit-form-container').style.display = 'none';
   window.location.href = 'admin2.php';
};
