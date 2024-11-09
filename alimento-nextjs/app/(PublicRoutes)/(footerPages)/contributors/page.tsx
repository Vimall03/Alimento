"use client"
import { useEffect, useState } from 'react';
import Link from 'next/link';

export default function Contributors() {
  const [contributors, setContributors] = useState([]);

  useEffect(() => {
    async function fetchContributors() {
      let contributorsList = [];
      let page = 1;
      const perPage = 100; // Max per page is 100
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
            contributorsList = contributorsList.concat(data);
            page++;
          }
        } catch (error) {
          console.error("Error fetching contributors:", error);
          break; // Exit loop if there's an error
        }
      }

      setContributors(contributorsList);
    }

    fetchContributors();
  }, []);

  return (
    <div className="container mx-auto px-4 py-10">
      <div className="text-center mb-10">
        <h1 className="text-4xl font-bold">Our Contributors</h1>
      </div>

      <div id="contributors" className="grid grid-cols-1 sm:grid-cols-2 md:grid-cols-3 lg:grid-cols-4 gap-6">
        {contributors.map((contributor) => (
          <div key={contributor.id} className="contributor-card border p-4 rounded-lg shadow-md">
            <a href={contributor.html_url} target="_blank" rel="noopener noreferrer">
              <img
                src={contributor.avatar_url}
                alt={contributor.login}
                className="w-24 h-24 rounded-full mx-auto mb-4"
              />
            </a>
            <h3 className="text-lg font-semibold text-center mb-2">{contributor.login}</h3>
            <p className="text-center text-gray-600">Contributions: {contributor.contributions}</p>
          </div>
        ))}
      </div>
    </div>
  );
}
