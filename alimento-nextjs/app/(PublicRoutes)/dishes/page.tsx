"use client";

import React, { useEffect, useState } from "react";
import toast, { Toaster } from "react-hot-toast";
import DishCardFE from "./components/dishCardFE";
import { DishWithImages } from "@/app/vendor/[vendorId]/page";
import { getAllDishes } from "@/actions/dish/dishGETALL";
import { Category, Tag } from "@prisma/client";
import { Search } from "lucide-react";
import TagSelectorCreateDish from "@/components/vendor/tagSelectorCreateDishForm";
import CategorySelectorDishPage from "./components/selectMultipleCategories";

const FoodPage: React.FC = () => {
  const [foodItems, setFoodItems] = useState<DishWithImages[]>([]);
  const [loading, setLoading] = useState(true);
  const [tags, setTags] = useState<Tag[]>([]); // State to manage selected tags
  const [categories, setCategories] = useState<Category[]>([]);
  const [sort, setSort] = useState<"" | "asc" | "desc">("");
  const [query, setQuery] = useState("");

  useEffect(() => {
    const fetchData = async () => {
      setLoading(true);
      try {
        // Example API call to fetch food data
        const foodResponse = await getAllDishes({
          query,
          categories,
          tags,
          sort,
        });
        console.log(foodResponse.data, foodResponse.success);
        if (!foodResponse || !foodResponse.data) {
          toast.error("No data fetched from BE");
          return;
        }
        setFoodItems(foodResponse.data);
      } catch (error) {
        console.error("Error fetching food data:", error);
      } finally {
        setLoading(false);
      }
    };

    fetchData();
  }, [query, sort, tags, categories]); // Added tags as a dependency to refetch when tags change

  console.log(foodItems);

  return (
    <div className="bg-gray-50 text-gray-800">
      <Toaster />
      {/* Hero Section with Banner Image */}
      <section
        className="relative h-[60vh] bg-cover bg-center text-white"
        style={{ backgroundImage: "url(/food.jpg)" }}
      >
        <div className="absolute inset-0 bg-black opacity-40"></div>
        <div className={`relative bg-[url(/pngFood.png)] bg-contain z-10 flex flex-col items-center justify-center h-full text-center`}>
          <h1 className="text-4xl font-bold mb-4">Find Your Favorite Food</h1>
          <p className="text-lg mb-6">
            Discover delicious dishes and explore a variety of food options.
          </p>
        </div>
      </section>

      {/* Custom Search Bar */}
      <div
        className="grid my-6 px-4"
      >
        <div className="max-w-7xl mx-auto grid grid-cols-1 md:grid-cols-2 gap-8">
          {/* Search Input with Font Awesome Search Icon */}
          <div className="w-full md:w-auto mb-2 flex-grow relative">
            <input
              type="text"
              className="form-control w-full p-3 pl-12 border border-gray-300 rounded-md"
              id="search-input"
              name="query"
              placeholder="Search"
              value={query}
              onChange={(e) => setQuery(e.target.value)}
            />
            <Search className="absolute left-3 top-1/2 transform -translate-y-1/2 text-gray-400" />
          </div>

          {/* Sort by Price Dropdown */}
          <div className="mb-2">
            <select
              className="form-select p-3 border border-gray-300 rounded-md"
              id="sort-by-price"
              name="sort"
              value={sort}
              onChange={(e) => {
                const value = e.target.value as "" | "asc" | "desc";
                setSort(value); // Update the sort state
              }}
            >
              <option value="asc">Low to High</option>
              <option value="desc">High to Low</option>
            </select>
          </div>

          <div className="mb-6">
            <TagSelectorCreateDish
              dishTags={tags}
              setDishTags={setTags} // Update selected tags
              disabled={loading} // Disable if data is being loaded
            />
          </div>
          <div className="mb-6">
            <CategorySelectorDishPage
              dishCategories={categories}
              setDishCategories={setCategories} // Update selected categories
              disabled={loading} // Disable if data is being loaded
            />
          </div>
        </div>
      </div>

      {/* Food Items Section */}
      <section className="py-16 bg-white">
        <h2 className="text-2xl font-bold text-center mb-12">Available Food</h2>

        <div
          id="food-items"
          className="max-w-7xl mx-auto grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-3 gap-8"
        >
          {loading ? (
            <div className="loading flex justify-center items-center h-48">
              <div className="spinner border-4 border-t-4 border-blue-600 rounded-full w-10 h-10 animate-spin"></div>
            </div>
          ) : (
            foodItems.map((food) => (
              <DishCardFE
                id={food.id}
                key={food.id}
                name={food.name}
                price={food.price}
                description={food.description}
                images={food.images}
              />
            ))
          )}
        </div>
      </section>
    </div>
  );
};

export default FoodPage;
