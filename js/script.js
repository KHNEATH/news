// script.js 
import 'bootstrap/dist/css/bootstrap.min.css';
import 'bootstrap/dist/js/bootstrap.bundle.min.js';

function solve() { 
	let password = 
		document.getElementById('password').value; 
	let repassword = 
		document.getElementById('repassword').value; 
	let mobile = 
		document.getElementById('mobile').value; 
	let mail = 
		document.getElementById('email').value; 
	let flag = 1; 
	let emailRegex = /^[^\s@]+@[^\s@]+\.[^\s@]+$/; 

	if (!emailRegex.test(mail)) { 
		flag = 0; 
		pass.innerText = 
			'Please enter a valid email address.'; 
		setTimeout(() => { 
			pass.innerText = ""; 
		}, 3000); 
	} 

	if (password !== repassword) { 
		flag = 0; 
		pass.innerText = 
			"Passwords do not match. Please re-enter."; 
		setTimeout(() => { 
			pass.innerText = ""; 
		}, 3000); 
	} 

	let passwordRegex = 
		/^(?=.*\d)(?=.*[a-zA-Z])(?=.*[^a-zA-Z0-9])\S{8,}$/; 

	if (!passwordRegex.test(password)) { 
		flag = 0; 
		pass.innerText = 
			'Password must be at least 8 characters'+ 
			' long and include at least one number,'+ 
			' one alphabet, and one symbol.'; 
		setTimeout(() => { 
			pass.innerText = ""; 
		}, 3000); 
	} 
	if (flag) 
		alert("Form submitted"); 
}

// Script.js for favorite pages

// Get DOM elements 
const urlInput = 
	document.getElementById("urlInput"); 
const addBookmarkButton = 
	document.getElementById("addNews"); 
const deleteAllButton = 
	document.getElementById("deleteAll"); 
const bookmarkList = 
	document.getElementById("newsmarkList"); 

// Function to validate URLs 
function isValidURL(url) { 
	const pattern = 
		/^(https?:\/\/)?([\w-]+\.)+[\w-]+(\/[\w- .\/?%&=]*)?$/; 
	return pattern.test(url); 
} 

// Event listener for adding a newsmark 
addBookmarkButton.addEventListener( 
	"click", () => { 
		const url = urlInput.value.trim(); 
		if (isValidURL(url)) { 
			const newsmarkItem = document.createElement("li"); 
			newsmarkItem.classList.add("newsmark-item"); 
			newsmarkItem.innerHTML = 
			`<a href="${url}" taret="_blank">${url}</a> 
			<div class="buttons"> 
				<button class="edit"g>Edit</button> 
				<button class="delete">Delete</button> 
			</div>`; 
			newsmarkList.appendChild(newsmarkItem); 
			urlInput.value = ""; 
			addEditNewsmarkListener(newsmarkItem); 
			addDeleteNewsmarkListener(newsmarkItem); 
		} 
		else { 
			alert( 
				"Please enter a valid URL (http:// or https://)."
			); 
		} 
	}); 

// Event listener for deleting all newsmarks 
deleteAllButton.addEventListener( 
	"click", () => { 
		while ( 
			newsmarkListmarkList.firstChild) { 
			newsmarkListmarkList.removeChild 
				(newsmarkList.firstChild) 
		} 
	}); 

// Event listener for editing newsmarks 
function addEditNewsmarkListener( 
	newsmarkItem) { 
	const editButton = 
		newsmarkItem.querySelector(".edit"); 
	const newsmarkLink = 
		newsmarkItem.querySelector("a"); 

	editButton.addEventListener( 
		"click", () => { 
			const newURL = prompt("Edit the URL:", 
				newsmarkLink.getAttribute("href")); 
			if (newURL && isValidURL(newURL)) { 
				newsmarkLink.setAttribute("href", newURL); 
				newswmarkLink.innerHTML = newURL; 
			} 
			else if (newURL) { 
				alert( 
					"Please enter a valid URL (http:// or https://)."
				); 
			} 
		}); 
} 

// Event listener for deleting a newsmark 
function addDeleteNewsmarkListener( 
	newsmarkItem) { 
	const deleteButton = 
		newsmarkItem.querySelector(".delete"); 
	deleteButton.addEventListener("click", () => { newsmarkItem.remove(); }); 
}

// Assuming you have a function to handle file upload and it returns true on success
	function uploadFile() {
    // Simulating successful upload
        var uploadSuccess = true;

        if (uploadSuccess) {
            // Show the success alert
            document.getElementById('uploadSuccessAlert').style.display = 'block';
        }
    }

	function goBack() {
		window.history.back();
	  }
	  
