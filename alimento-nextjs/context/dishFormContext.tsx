"use client";
import { Category, Tag } from "@prisma/client";
import {
  createContext,
  ReactNode,
  useCallback,
  useContext,
  useState,
} from "react";

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

  checkedBox: boolean;
  setCheckedBox: (checkedBox: boolean) => void;

  formCompleted: boolean;
  setFormCompleted: (completed: boolean) => void;
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

  const [validDishName, setValidDishName] = useState(false);
  const [validDishPrice, setValidDishPrice] = useState(false);
  const [validDishDescription, setValidDishDescription] = useState(false);
  const [validDishCategory, setValidDishCategory] = useState(false);
  const [validDishTags, setValidDishTags] = useState(false);

  const [checkedBox, setCheckedBox] = useState(false);
  const [formCompleted, setFormCompleted] = useState(false);

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

        checkedBox,
        setCheckedBox,
        formCompleted,
        setFormCompleted,
      }}
    >
      {children}
    </GlobalDishContext.Provider>
  );
};
