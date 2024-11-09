import {
    DropdownMenu,
    DropdownMenuContent,
    DropdownMenuItem,
    DropdownMenuLabel,
    DropdownMenuSeparator,
    DropdownMenuTrigger,
  } from '@/components/ui/dropdown-menu';
import { useGlobalDish } from '@/context/dishFormContext';
import { Category } from '@prisma/client';
  import { ChevronDown } from 'lucide-react';
  
  const categories =Object.values(Category)

  const FormPage2 = () => {
    const { dishCategory,setDishCategory } = useGlobalDish();
  
    return (
      <div className="h-3/4 flex  flex-col items-start gap-8 justify-start">
        <h1 className="text-primary-marineBlue font-bold text-[1.6rem] md:text-4xl leading-9">
          Select Category
        </h1>
        <h3 className="text-gray-400 mt-2">
          Please select the most appropriate category for your dish
        </h3>
        <DropdownMenu>
          <DropdownMenuTrigger className="bg-black h-10 text-gray-200 w-full rounded-full flex items-center justify-center">
            {dishCategory || 'Category'} <ChevronDown />
          </DropdownMenuTrigger>
          <DropdownMenuContent>
            <DropdownMenuLabel>
              Select the Category for your dish
            </DropdownMenuLabel>
            <DropdownMenuSeparator />
            {categories.map((category)=>(
                <DropdownMenuItem key={category} onClick={() => setDishCategory(category)}>
                {category}
              </DropdownMenuItem>
            ))}
          </DropdownMenuContent>
        </DropdownMenu>
      </div>
    );
  };
  
  export default FormPage2;
  