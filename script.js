const loginForm = document.getElementById("login-form");
const username = document.getElementById("username");
const password = document.getElementById("password");

// Sample user data
const users = [
  {
    username: "lettuceman",
    password: "testing1234"
  },
  {
    username: "user2",
    password: "password2"
  }
];

// Save user data to localStorage
saveUserData();

// Load user data from localStorage
function loadUserData() {
  const storedUsers = localStorage.getItem("users");
  if (storedUsers) {
    users.push(...JSON.parse(storedUsers));
  }
}

// Check if user exists
function checkUser(username, password) {
  return users.some(user => user.username === username && user.password === password);
}

// Initialize user data
loadUserData();

// Handle login form submission
loginForm.addEventListener("submit", e => {
  e.preventDefault();
  if (checkUser(username.value, password.value)) {
    window.location.href = "AdminPanel.html";
  } else {
    alert("Invalid username or password.");
  }
});