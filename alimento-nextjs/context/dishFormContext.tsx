"use client";
import { createDish } from "@/actions/dish/dishCREATE";
import { Category, Tag } from "@prisma/client";
import {
  createContext,
  ReactNode,
  useCallback,
  useContext,
  useState,
} from "react";
import toast from "react-hot-toast";

interface GlobalContextType {
  currentStep: number;
  setCurrentStep: (step: number) => void;
  completed: boolean;
  setCompleted: (completed: boolean) => void;

  dishName: string;
  setDishName: (name: string) => void;
  dishPrice: number;
  setDishPrice: (price: number) => void;
  dishDescription: string;
  setDishDescription: (description: string) => void;
  dishCategory: Category;
  setDishCategory: (category: Category) => void;
  dishTags: Tag[];
  setDishTags: (tags: Tag[]) => void;

  validDishName: boolean;
  setValidDishName: (valid: boolean) => void;
  validDishPrice: boolean;
  setValidDishPrice: (valid: boolean) => void;
  validDishDescription: boolean;
  setValidDishDescription: (valid: boolean) => void;
  validDishCategory: boolean;
  setValidDishCategory: (valid: boolean) => void;
  validDishTags: boolean;
  setValidDishTags: (valid: boolean) => void;
  validImageUrls: boolean; // New state for image URL validation
  setValidImageUrls: (valid: boolean) => void;


  imageUrl: string[];
  setImageUrl: (url: string[]) => void;

  handleImageChange: (url: string) => void;
  handleImageRemove: (url: string) => void;

  checkedBox: boolean;
  setCheckedBox: (checkedBox: boolean) => void;

  formCompleted: boolean;
  setFormCompleted: (completed: boolean) => void;

  submitListingForm: (vendorId:string)=>void
}

export const GlobalDishContext = createContext<GlobalContextType | undefined>(
  undefined
);

export const useGlobalDish = () => {
  const context = useContext(GlobalDishContext);
  if (!context) {
    throw new Error("useGlobalDish must be used within a GlobalDishProvider");
  }
  return context;
};

export const GlobalDishProvider = ({ children }: { children: ReactNode }) => {
  const [currentStep, setCurrentStep] = useState(1);
  const [completed, setCompleted] = useState(false);

  const [dishName, setDishName] = useState("");
  const [dishPrice, setDishPrice] = useState(0);
  const [dishDescription, setDishDescription] = useState("");
  const [dishCategory, setDishCategory] = useState<Category>(
    Category.APPETIZER
  );
  const [dishTags, setDishTags] = useState<Tag[]>([]);

  const [imageUrl, setImageUrl] = useState<string[]>([]);

  const handleImageChange = useCallback((url: string) => {
    setImageUrl(prevUrls => [...prevUrls, url]); // Use the previous state
  }, []);

  const handleImageRemove = useCallback((url: string) => {
    setImageUrl(prevUrls => prevUrls.filter(image => image !== url)); // Use the previous state
  }, []);

  const [validDishName, setValidDishName] = useState(false);
  const [validDishPrice, setValidDishPrice] = useState(false);
  const [validDishDescription, setValidDishDescription] = useState(false);
  const [validDishCategory, setValidDishCategory] = useState(false);
  const [validDishTags, setValidDishTags] = useState(false);
  const [validImageUrls, setValidImageUrls] = useState(false);

  const [checkedBox, setCheckedBox] = useState(false);
  const [formCompleted, setFormCompleted] = useState(false);

  const submitListingForm = async (vendorId:string) => {

    let allValid = true;
  
    // Validate dish name
    if (dishName.trim().length < 1) {
      setValidDishName(false);
      allValid = false;
    } else {
      setValidDishName(true);
    }
  
    // Validate dish price
    if (dishPrice <= 0) {
      setValidDishPrice(false);
      allValid = false;
    } else {
      setValidDishPrice(true);
    }
  
    // Validate dish description
    if (dishDescription.trim().length <= 0) {
      setValidDishDescription(false);
      allValid = false;
    } else {
      setValidDishDescription(true);
    }
  
    // Validate dish category
    if (!Object.values(Category).includes(dishCategory)) {
      setValidDishCategory(false);
      allValid = false;
    } else {
      setValidDishCategory(true);
    }
  
    // Validate dish tags
    if (dishTags.length === 0) {
      setValidDishTags(false);
      allValid = false;
    } else {
      setValidDishTags(true);
    }
  

    if (imageUrl.length === 0) {
      setValidImageUrls(false); // No image URLs provided
      allValid = false;
    } else {
      setValidImageUrls(true); // At least one image URL is present
    }

    // If all fields are valid, proceed with submission
    if (allValid) {
      setFormCompleted(true);
  
      try {
        if (!vendorId) {
          console.log('No seller ID provided');
          return;
        }
  
        const response = await createDish({
            name: dishName,
            price: dishPrice,
            description: dishDescription,
            category: dishCategory,
            tags: dishTags,
            vendorId:vendorId,
            images:imageUrl
        });
  
        if (!response.data) {
          console.error('Error submitting listing.');
          return;
        }
  
        toast.success('Listing submitted successfully:', response.data);
        window.location.pathname = `/vendor/${vendorId}`;
      } catch (error) {
        toast.error('Error submitting listing');
      }
    } else {
      toast.error('Form is not valid.');
    }
  };
  

  return (
    <GlobalDishContext.Provider
      value={{
        currentStep,
        setCurrentStep,
        completed,
        setCompleted,

        dishName,
        setDishName,
        dishPrice,
        setDishPrice,
        dishDescription,
        setDishDescription,
        dishCategory,
        setDishCategory,
        dishTags,
        setDishTags,
        imageUrl,
        setImageUrl,
        handleImageChange,
        handleImageRemove,


        validDishName,
        setValidDishName,
        validDishPrice,
        setValidDishPrice,
        validDishDescription,
        setValidDishDescription,
        validDishCategory,
        setValidDishCategory,
        validDishTags,
        setValidDishTags,

        validImageUrls,
        setValidImageUrls,


        checkedBox,
        setCheckedBox,
        formCompleted,
        setFormCompleted,

        submitListingForm
      }}
    >
      {children}
    </GlobalDishContext.Provider>
  );
};
