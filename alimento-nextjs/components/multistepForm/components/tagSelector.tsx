import {
    Select,
    SelectTrigger,
    SelectValue,
    SelectContent,
    SelectItem,
  } from "@/components/ui/select";
import { useGlobalDish } from "@/context/dishFormContext";
  import { Tag } from "@prisma/client";
  import { useState } from "react";
  
  const TagSelector = () => {
    const tags = Object.values(Tag)
    const {dishTags,setDishTags} = useGlobalDish()
  
    const handleTagSelect = (tag:Tag) => {
      if (!dishTags.includes(tag)) {
        setDishTags([...dishTags, tag]);
      }
    };
  
    const handleRemoveTag = (tag:Tag) => {
      setDishTags(dishTags.filter((t) => t !== tag));
    };
  
    return (
      <div>
        <div className="mb-2">
          <Select onValueChange={handleTagSelect}>
            <SelectTrigger className="w-64">
              <SelectValue placeholder="Select tags" />
            </SelectTrigger>
            <SelectContent>
              {tags.map((tag) => (
                <SelectItem key={tag} value={tag}>
                  {tag}
                </SelectItem>
              ))}
            </SelectContent>
          </Select>
        </div>
  
        {/* Selected Tags */}
        <div className="flex flex-wrap gap-2 mt-2">
          {dishTags.map((tag) => (
            <span
              key={tag}
              className="bg-blue-200 text-blue-800 px-3 py-1 rounded-full flex items-center space-x-2"
            >
              <span>{tag}</span>
              <button
                type="button"
                onClick={() => handleRemoveTag(tag)}
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
  
  export default TagSelector;
  