function toggleDarkMode() {
    	// Store the high contrast mode preference in localStorage
    	const darkModeToggle = localStorage.getItem('highContrastMode') === 'true';
	localStorage.setItem('highContrastMode', !darkModeToggle);

	const body = document.getElementsByTagName('body')[0];
    	const navbar = document.querySelector('nav');
    	const navLinks = document.querySelectorAll('nav a');
	
    	if (!darkModeToggle) {
        	// Dark mode style
        	body.style.backgroundColor = '#000000';
        	body.style.color = '#ffffff';
        	navbar.style.backgroundColor = '#000000';
        	for (var i = 0; i < navLinks.length; i++) {
           		navLinks[i].style.color = '#ffffff';
        	}
    	} else {
       		// Light mode style 
        	body.style.backgroundColor = '';
        	body.style.color = '';
        	navbar.style.backgroundColor = '';
        	for (var i = 0; i < navLinks.length; i++) {
            		navLinks[i].style.color = '';
        	}
    	}
	toggle(darkModeToggle);
}

// Check if high contrast mode preference exists in localStorage and apply it
document.addEventListener('DOMContentLoaded', function () {
	const body = document.getElementsByTagName('body')[0];
    	const navbar = document.querySelector('nav');
    	const navLinks = document.querySelectorAll('nav a');
    
	if (localStorage.getItem('highContrastMode') === 'true') {
        	// Dark mode style
        	body.style.backgroundColor = '#000000';
        	body.style.color = '#ffffff';
        	navbar.style.backgroundColor = '#000000';
        	for (var i = 0; i < navLinks.length; i++) {
            	navLinks[i].style.color = '#ffffff';
        	}
    	}
});
