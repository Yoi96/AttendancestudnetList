// Initialize Firebase (replace with your Firebase project credentials)
var firebaseConfig = {
  apiKey: "YOUR_API_KEY",
  authDomain: "YOUR_PROJECT_ID.firebaseapp.com",
  databaseURL: "https://YOUR_PROJECT_ID.firebaseio.com",
  projectId: "YOUR_PROJECT_ID",
  storageBucket: "YOUR_PROJECT_ID.appspot.com",
  messagingSenderId: "YOUR_MESSAGING_SENDER_ID",
  appId: "YOUR_APP_ID"
};

// Initialize Firebase
firebase.initializeApp(firebaseConfig);
var database = firebase.database();

// Function to save the attendance list to Firebase
function saveAttendanceList(attendanceArray) {
    // Save to Firebase Realtime Database
    database.ref('attendanceList').set(attendanceArray);
}

// Function to load the attendance list from Firebase
function loadAttendanceList() {
    return new Promise((resolve, reject) => {
        database.ref('attendanceList').once('value', function(snapshot) {
            const data = snapshot.val();
            if (data) {
                resolve(data);
            } else {
                resolve([]);
            }
        });
    });
}

// Function to render the attendance list in the UI
async function renderAttendanceList() {
    const attendanceList = document.getElementById('attendanceList');
    attendanceList.innerHTML = '';
    const attendanceArray = await loadAttendanceList();
    attendanceArray.forEach((name, index) => {
        const listItem = document.createElement('li');
        listItem.textContent = name;

        const removeButton = document.createElement('button');
        removeButton.textContent = 'Remove';
        removeButton.onclick = function() {
            removeName(index);
        };

        listItem.appendChild(removeButton);
        attendanceList.appendChild(listItem);
    });
}

// Function to handle the saving of attendance
function saveAttendance() {
    const nameInput = document.getElementById('name');
    const name = nameInput.value.trim();
    if (name === "") {
        alert("Please enter a name");
        return;
    }

    loadAttendanceList().then(attendanceArray => {
        attendanceArray.push(name);
        saveAttendanceList(attendanceArray);
        renderAttendanceList();
        nameInput.value = ""; // Clear the input field
    });
}

// Function to remove a name from the attendance list
function removeName(index) {
    loadAttendanceList().then(attendanceArray => {
        attendanceArray.splice(index, 1); // Remove the name at the specified index
        saveAttendanceList(attendanceArray);
        renderAttendanceList();
    });
}

// Load and render the attendance list on page load
window.onload = function() {
    renderAttendanceList();
}
