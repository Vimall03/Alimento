import {
  Select,
  SelectTrigger,
  SelectValue,
  SelectContent,
  SelectItem,
} from "@/components/ui/select";
import { Tag } from "@prisma/client";
import React from "react";

interface TagSelectorCreateDishProps {
  dishTags: Tag[];
  setDishTags: (tags: Tag[]) => void;
  disabled: boolean;
}

const TagSelectorCreateDish: React.FC<TagSelectorCreateDishProps> = ({
  dishTags,
  setDishTags,
  disabled,
}) => {
  const tags = Object.values(Tag); // Get tags from Prisma enum

  // Handle selecting or deselecting a tag
  const handleTagSelect = (tag: Tag) => {
    if (disabled) return; // Prevent action if disabled
    if (dishTags.includes(tag)) {
      // Remove tag if already selected
      setDishTags(dishTags.filter((t) => t !== tag));
    } else {
      // Add tag if not already selected
      setDishTags([...dishTags, tag]);
    }
  };

  return (
    <div className={disabled ? "opacity-50 pointer-events-none" : ""}>
      <div className="mb-2">
        <Select onValueChange={(value) => handleTagSelect(value as Tag)}>
          <SelectTrigger className="w-64" disabled={disabled}>
            <SelectValue placeholder="Select tags" />
          </SelectTrigger>
          <SelectContent>
            {tags.map((tag) => (
              <SelectItem key={tag} value={tag}>
                <div className="flex items-center">
                  <input
                    type="checkbox"
                    checked={dishTags.includes(tag)}
                    onChange={() => handleTagSelect(tag)}
                    disabled={disabled}
                    className="mr-2"
                  />
                  {tag}
                </div>
              </SelectItem>
            ))}
          </SelectContent>
        </Select>
      </div>

      {/* Display Selected Tags */}
      <div className="flex flex-wrap gap-2 mt-2">
        {dishTags.map((tag) => (
          <span
            key={tag}
            className="bg-blue-200 text-blue-800 px-3 py-1 rounded-full flex items-center space-x-2"
          >
            <span>{tag}</span>
            <button
              type="button"
              onClick={() => handleTagSelect(tag)}
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

export default TagSelectorCreateDish;
