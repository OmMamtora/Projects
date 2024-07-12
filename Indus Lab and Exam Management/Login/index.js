 var isDropdownOpen = { itdep: false, faculty: false };

        function toggleDropdown(item) 
        {
            var dropdownContent = document.getElementById(item + "DropdownContent");
            isDropdownOpen[item] = !isDropdownOpen[item]; // Toggle dropdown state
            
            if (isDropdownOpen[item]) 
            {
                dropdownContent.style.display = "block";
            } 
            else 
            {
                dropdownContent.style.display = "none";
            }
        }

        // Function to handle option selection
        function selectOption(url, option) 
        {
            if (confirm("Are you sure you want to select this option: " + option.innerText)) 
            {
                document.getElementById("iframeContainer").src = url;
            } 
            else 
            {
                window.location.href = "index.html";
            }
            
            // Close the dropdown after selection
            var item = option.closest(".side-item").id.replace("Item", "");
            isDropdownOpen[item] = false;
            var dropdownContent = option.parentElement;
            dropdownContent.style.display = "none";
        }

        // Function to close dropdown when clicking outside
        document.addEventListener("click", function(event) 
        {
            var itDropdownContent = document.getElementById("itDropdownContent");
            var facultyDropdownContent = document.getElementById("facultyDropdownContent");
           
            if (!event.target.closest("#itDepartmentItem") && !event.target.closest("#itDropdownContent")) 
            {
                isDropdownOpen.itdep = false;
                itDropdownContent.style.display = "none";
            }
           
            if (!event.target.closest("#facultyItem") && !event.target.closest("#facultyDropdownContent")) 
            {
                isDropdownOpen.faculty = false;
                facultyDropdownContent.style.display = "none";
            }
        });