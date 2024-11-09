import {
    Select,
    SelectTrigger,
    SelectValue,
    SelectContent,
    SelectItem,
  } from "@/components/ui/select";
  import { Category } from "@prisma/client";
  import React from "react";
  
  interface CategorySelectorDishPageProps {
    dishCategories: Category[];
    setDishCategories: (Categorys: Category[]) => void;
    disabled: boolean;
  }
  
  const CategorySelectorDishPage: React.FC<CategorySelectorDishPageProps> = ({
    dishCategories,
    setDishCategories,
    disabled,
  }) => {
    const Categories = Object.values(Category); // Get Categorys from Prisma enum
  
    // Handle selecting or deselecting a Category
    const handleCategorySelect = (Category: Category) => {
      if (disabled) return; // Prevent action if disabled
      if (dishCategories.includes(Category)) {
        // Remove Category if already selected
        setDishCategories(dishCategories.filter((t) => t !== Category));
      } else {
        // Add Category if not already selected
        setDishCategories([...dishCategories, Category]);
      }
    };
  
    return (
      <div className={disabled ? "opacity-50 pointer-events-none" : ""}>
        <div className="mb-2">
          <Select onValueChange={(value) => handleCategorySelect(value as Category)}>
            <SelectTrigger className="w-64" disabled={disabled}>
              <SelectValue placeholder="Select Categories" />
            </SelectTrigger>
            <SelectContent>
              {Categories.map((Category) => (
                <SelectItem key={Category} value={Category}>
                  <div className="flex items-center">
                    <input
                      type="checkbox"
                      checked={dishCategories.includes(Category)}
                      onChange={() => handleCategorySelect(Category)}
                      disabled={disabled}
                      className="mr-2"
                    />
                    {Category}
                  </div>
                </SelectItem>
              ))}
            </SelectContent>
          </Select>
        </div>
  
        {/* Display Selected Categorys */}
        <div className="flex flex-wrap gap-2 mt-2">
          {dishCategories.map((Category) => (
            <span
              key={Category}
              className="bg-blue-200 text-blue-800 px-3 py-1 rounded-full flex items-center space-x-2"
            >
              <span>{Category}</span>
              <button
                type="button"
                onClick={() => handleCategorySelect(Category)}
                disabled={disabled}
                className="text-sm text-blue-600"
              >
                ×
              </button>
            </span>
          ))}
        </div>
      </div>
    );
  };
  
  export default CategorySelectorDishPage;
  