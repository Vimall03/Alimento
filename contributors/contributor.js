document.addEventListener("DOMContentLoaded", () => {
  const contributorsContainer = document.getElementById("contributors");

  async function fetchContributors() {
    let contributors = [];
    let page = 1;
    let perPage = 100; // Max per page is 100
    let moreContributors = true;

    while (moreContributors) {
      try {
        const response = await fetch(
          `https://api.github.com/repos/Vimall03/Alimento/contributors?page=${page}&per_page=${perPage}`
        );
        const data = await response.json();

        // If no more contributors, stop fetching
        if (data.length === 0) {
          moreContributors = false;
        } else {
          contributors = contributors.concat(data);
          page++;
        }
      } catch (error) {
        console.error("Error fetching contributors:", error);
        break; // Exit loop if there's an error
      }
    }

    displayContributors(contributors);
  }

  function displayContributors(contributors) {
    contributorsContainer.innerHTML = "";
    contributors.forEach((contributor) => {
      const contributorCard = document.createElement("div");
      contributorCard.classList.add("bg-white", "text-black", "rounded-lg", "shadow-lg", "border", "border-gray-300", "overflow-hidden", "transition-transform", "hover:scale-110", "duration-300");

      // contributorCard.innerHTML = `
      //   <a href="${contributor.html_url}" target="_blank" rel="noopener noreferrer">
      //     <img src="${contributor.avatar_url}" alt="${contributor.login}">
      //   </a>
      //   <h3>${contributor.login}</h3>
      //   <p>Contributions: ${contributor.contributions}</p>
      // `;
      contributorCard.innerHTML = `

          <div class="p-6 text-center">
              <img
                src=${contributor.avatar_url}
                alt=${contributor.login}
                class="w-24 h-24 rounded-full mx-auto mb-4 border-4 border-gray-200"
              />
              <h3 class="font-bold text-xl">${contributor.login}</h3>
              <p class="text-sm text-gray-500 mb-2">${contributor.type}</p>
              <div class="mt-4 bg-gray-100 rounded-full py-2 px-4 inline-block">
                <span class="font-semibold">${contributor.contributions} contributions</span>
              </div>
          </div>
          <div class="bg-gray-100 py-3 px-6 flex justify-between items-center">
              <a
                href=${contributor.html_url}
                target="_blank"
                rel="noopener noreferrer"
                class="text-black hover:text-gray-700 transition-colors flex items-center"
              >
                  <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5 mr-2" viewBox="0 0 20 20" fill="currentColor">
                    <path d="M11 3a1 1 0 100 2h2.586l-6.293 6.293a1 1 0 101.414 1.414L15 6.414V9a1 1 0 102 0V4a1 1 0 00-1-1h-5z" />
                    <path d="M5 5a2 2 0 00-2 2v8a2 2 0 002 2h8a2 2 0 002-2v-3a1 1 0 10-2 0v3H5V7h3a1 1 0 000-2H5z" />
                  </svg>
                View Profile
              </a>
              <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" strokeWidth="2" strokeLinecap="round" strokeLinejoin="round" class="text-muted-foreground">
                <path d="M9 19c-5 1.5-5-2.5-7-3m14 6v-3.87a3.37 3.37 0 0 0-.94-2.61c3.14-.35 6.44-1.54 6.44-7A5.44 5.44 0 0 0 20 4.77 5.07 5.07 0 0 0 19.91 1S18.73.65 16 2.48a13.38 13.38 0 0 0-7 0C6.27.65 5.09 1 5.09 1A5.07 5.07 0 0 0 5 4.77a5.44 5.44 0 0 0-1.5 3.78c0 5.42 3.3 6.61 6.44 7A3.37 3.37 0 0 0 9 18.13V22"></path>
              </svg>
          </div>
        `;

      contributorsContainer.appendChild(contributorCard);
    });
  }

  fetchContributors();
});

// <div class="p-6 text-center">
//     <img
//       src={avatar_url}
//       alt={login}
//       class="w-24 h-24 rounded-full mx-auto mb-4 border-4 border-gray-200"
//     />
//     <h3 class="font-bold text-xl">{login}</h3>
//     <p class="text-sm text-gray-500 mb-2">{type}</p>
//     <div class="mt-4 bg-gray-100 rounded-full py-2 px-4 inline-block">
//       <span class="font-semibold">{contributions} contributions</span>
//     </div>
//   </div>
//   <div class="bg-gray-100 py-3 px-6 flex justify-between items-center">
//     <a
//       href={html_url}
//       target="_blank"
//       rel="noopener noreferrer"
//       class="text-black hover:text-gray-700 transition-colors flex items-center"
//     >
//       <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5 mr-2" viewBox="0 0 20 20" fill="currentColor">
//         <path d="M11 3a1 1 0 100 2h2.586l-6.293 6.293a1 1 0 101.414 1.414L15 6.414V9a1 1 0 102 0V4a1 1 0 00-1-1h-5z" />
//         <path d="M5 5a2 2 0 00-2 2v8a2 2 0 002 2h8a2 2 0 002-2v-3a1 1 0 10-2 0v3H5V7h3a1 1 0 000-2H5z" />
//       </svg>
//       View Profile
//     </a>
//     <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" strokeWidth="2" strokeLinecap="round" strokeLinejoin="round" class="text-muted-foreground">
//       <path d="M9 19c-5 1.5-5-2.5-7-3m14 6v-3.87a3.37 3.37 0 0 0-.94-2.61c3.14-.35 6.44-1.54 6.44-7A5.44 5.44 0 0 0 20 4.77 5.07 5.07 0 0 0 19.91 1S18.73.65 16 2.48a13.38 13.38 0 0 0-7 0C6.27.65 5.09 1 5.09 1A5.07 5.07 0 0 0 5 4.77a5.44 5.44 0 0 0-1.5 3.78c0 5.42 3.3 6.61 6.44 7A3.37 3.37 0 0 0 9 18.13V22"></path>
//     </svg>
//   </div>
